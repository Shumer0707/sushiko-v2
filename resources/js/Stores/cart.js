// resources/js/Stores/cart.js
import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [], // Массив товаров в корзине

        // Настройки доставки
        deliverySettings: {
            freeDeliveryThreshold: 500, // Минимальная сумма для бесплатной доставки
            deliveryCost: 50, // Стоимость доставки если не достигнут порог
        },
    }),

    getters: {
        // Общее количество товаров в корзине
        totalItems: (state) => {
            return state.items.reduce((sum, item) => sum + item.quantity, 0)
        },

        // Общая сумма корзины
        totalPrice: (state) => {
            return state.items
                .reduce((sum, item) => {
                    return sum + item.product.price * item.quantity
                }, 0)
                .toFixed(2)
        },

        // Валюта (берём у первого товара, обычно у всех одна)
        currency: (state) => {
            return state.items[0]?.product?.currency || 'MDL'
        },

        // Стоимость доставки (зависит от суммы заказа)
        deliveryCost: (state) => {
            const total = state.items.reduce((sum, item) => {
                return sum + item.product.price * item.quantity
            }, 0)

            // Если сумма >= порога - доставка бесплатно
            if (total >= state.deliverySettings.freeDeliveryThreshold) {
                return 0
            }

            return state.deliverySettings.deliveryCost
        },

        // Бесплатная ли доставка
        isFreeDelivery: (state) => {
            const total = state.items.reduce((sum, item) => {
                return sum + item.product.price * item.quantity
            }, 0)

            return total >= state.deliverySettings.freeDeliveryThreshold
        },

        // Сколько не хватает до бесплатной доставки
        amountUntilFreeDelivery: (state) => {
            const total = state.items.reduce((sum, item) => {
                return sum + item.product.price * item.quantity
            }, 0)

            const remaining = state.deliverySettings.freeDeliveryThreshold - total

            return remaining > 0 ? remaining.toFixed(2) : 0
        },

        // Итоговая сумма с доставкой
        totalWithDelivery(state) {
            const subtotal = parseFloat(this.totalPrice)
            const delivery = this.deliveryCost

            return (subtotal + delivery).toFixed(2)
        },

        // Проверка: есть ли товар в корзине
        isInCart: (state) => (productId) => {
            return state.items.some((item) => item.product.id === productId)
        },

        // Получить товар из корзины
        getCartItem: (state) => (productId) => {
            return state.items.find((item) => item.product.id === productId)
        },
    },

    actions: {
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
                    },
                    quantity,
                    selectedAttributes,
                })
            }

            this.saveToStorage()
            console.log('✅ Добавлено в корзину:', product.name, 'x', quantity)
        },

        // Удалить товар из корзины
        removeFromCart(productId) {
            const index = this.items.findIndex((item) => item.product.id === productId)

            if (index !== -1) {
                const removedItem = this.items[index]
                this.items.splice(index, 1)
                this.saveToStorage()

                console.log('🗑️ Удалено из корзины:', removedItem.product.name)
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

                    console.log('🔄 Обновлено количество:', item.product.name, '→', quantity)
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
            console.log('🧹 Корзина очищена')
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
                    console.log('✅ Корзина загружена из localStorage:', this.items.length, 'товаров')
                }
            } catch (error) {
                console.error('❌ Ошибка загрузки корзины:', error)
                this.items = []
            }
        },
    },
})
