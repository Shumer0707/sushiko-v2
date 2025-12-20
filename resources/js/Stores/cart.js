// resources/js/Stores/cart.js
import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [], // Массив товаров в корзине

        deliverySettings: {
            freeDeliveryThreshold: 0,
            deliveryCost: 0,
        },
    }),

    getters: {
        unitPrice: (state) => (product) => {
            const toNumber = (v) => Number(String(v).replace(',', '.').trim())

            if (
                product?.has_promotion &&
                product?.promotion_type === 'discount' &&
                product?.final_price != null &&
                product?.final_price !== ''
            ) {
                return toNumber(product.final_price) || 0
            }

            return toNumber(product?.price || 0) || 0
        },

        totalItems: (state) => state.items.reduce((sum, item) => sum + item.quantity, 0),

        totalPrice() {
            const total = this.items.reduce((sum, item) => sum + this.unitPrice(item.product) * item.quantity, 0)
            return total.toFixed(2)
        },

        currency: (state) => state.items[0]?.product?.currency || 'MDL',

        deliveryCost() {
            const total = this.items.reduce((sum, item) => sum + this.unitPrice(item.product) * item.quantity, 0)
            return total >= this.deliverySettings.freeDeliveryThreshold ? 0 : this.deliverySettings.deliveryCost
        },

        isFreeDelivery() {
            const total = this.items.reduce((sum, item) => sum + this.unitPrice(item.product) * item.quantity, 0)
            return total >= this.deliverySettings.freeDeliveryThreshold
        },

        amountUntilFreeDelivery() {
            const total = this.items.reduce((sum, item) => sum + this.unitPrice(item.product) * item.quantity, 0)
            const remaining = this.deliverySettings.freeDeliveryThreshold - total
            return remaining > 0 ? remaining.toFixed(2) : 0
        },

        totalWithDelivery(state) {
            const subtotal = parseFloat(this.totalPrice)
            const delivery = this.deliveryCost
            return (subtotal + delivery).toFixed(2)
        },

        isInCart: (state) => (productId) => state.items.some((item) => item.product.id === productId),
        getCartItem: (state) => (productId) => state.items.find((item) => item.product.id === productId),
    },

    actions: {
        initDeliverySettings(settings) {
            if (!settings) return

            this.deliverySettings = {
                freeDeliveryThreshold: settings.freeDeliveryThreshold ?? 0,
                deliveryCost: settings.deliveryCost ?? 0,
            }
        },
        // Добавить товар в корзину
        addToCart(product, quantity = 1, selectedAttributes = {}) {
            const existingItem = this.items.find((item) => item.product.id === product.id)

            if (existingItem) {
                existingItem.quantity += quantity
            } else {
                this.items.push({
                    product: {
                        id: product.id,
                        name: product.name,
                        slug: product.slug,
                        price: product.price,
                        currency: product.currency,
                        image_url: product.image_url,

                        // ✅ Promotions (важно для корзины)
                        has_promotion: !!product.has_promotion,
                        promotion_type: product.promotion_type || null,
                        final_price: product.final_price ?? null,
                        gift_product: product.gift_product
                            ? {
                                  name: product.gift_product.name,
                                  slug: product.gift_product.slug,
                                  quantity: product.gift_product.quantity ?? 1,
                              }
                            : null,
                    },
                    quantity,
                    selectedAttributes,
                })
            }

            this.saveToStorage()
            // console.log('✅ Добавлено в корзину:', product.name, 'x', quantity)
        },

        // Удалить товар из корзины
        removeFromCart(productId) {
            const index = this.items.findIndex((item) => item.product.id === productId)

            if (index !== -1) {
                const removedItem = this.items[index]
                this.items.splice(index, 1)
                this.saveToStorage()

                // console.log('🗑️ Удалено из корзины:', removedItem.product.name)
            }
        },

        // Обновить количество товара
        updateQuantity(productId, quantity) {
            const item = this.items.find((item) => item.product.id === productId)

            if (item) {
                if (quantity <= 0) {
                    this.removeFromCart(productId)
                } else {
                    item.quantity = quantity
                    this.saveToStorage()

                    // console.log('🔄 Обновлено количество:', item.product.name, '→', quantity)
                }
            }
        },

        // Увеличить количество на 1
        incrementQuantity(productId) {
            const item = this.items.find((item) => item.product.id === productId)
            if (item) {
                item.quantity++
                this.saveToStorage()
            }
        },

        // Уменьшить количество на 1
        decrementQuantity(productId) {
            const item = this.items.find((item) => item.product.id === productId)
            if (item) {
                if (item.quantity > 1) {
                    item.quantity--
                    this.saveToStorage()
                } else {
                    this.removeFromCart(productId)
                }
            }
        },

        // Очистить всю корзину
        clearCart() {
            this.items = []
            this.saveToStorage()
            // console.log('🧹 Корзина очищена')
        },

        // Обновить настройки доставки (если нужно менять из админки)
        updateDeliverySettings(freeThreshold, cost) {
            this.deliverySettings.freeDeliveryThreshold = freeThreshold
            this.deliverySettings.deliveryCost = cost
        },

        // Сохранить в localStorage
        saveToStorage() {
            try {
                localStorage.setItem('sushiko_cart', JSON.stringify(this.items))
            } catch (error) {
                console.error('❌ Ошибка сохранения корзины:', error)
            }
        },

        // Загрузить из localStorage
        loadFromStorage() {
            try {
                const saved = localStorage.getItem('sushiko_cart')
                if (saved) {
                    this.items = JSON.parse(saved)
                    // console.log('✅ Корзина загружена из localStorage:', this.items.length, 'товаров')
                }
            } catch (error) {
                console.error('❌ Ошибка загрузки корзины:', error)
                this.items = []
            }
        },
    },
})
