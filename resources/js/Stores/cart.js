// resources/js/Stores/cart.js
import axios from 'axios'
import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],

        deliverySettings: {
            freeDeliveryThreshold: 0,
            deliveryCost: 0,
        },
        isSyncing: false,
    }),

    getters: {
        unitPrice: () => (product) => {
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

        totalWithDelivery() {
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
        },

        removeFromCart(productId) {
            const index = this.items.findIndex((item) => item.product.id === productId)

            if (index !== -1) {
                this.items.splice(index, 1)
                this.saveToStorage()
            }
        },

        updateQuantity(productId, quantity) {
            const item = this.items.find((item) => item.product.id === productId)

            if (item) {
                if (quantity <= 0) {
                    this.removeFromCart(productId)
                } else {
                    item.quantity = quantity
                    this.saveToStorage()
                }
            }
        },

        incrementQuantity(productId) {
            const item = this.items.find((item) => item.product.id === productId)
            if (item) {
                item.quantity++
                this.saveToStorage()
            }
        },

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

        clearCart() {
            this.items = []
            this.saveToStorage()
        },

        updateDeliverySettings(freeThreshold, cost) {
            this.deliverySettings.freeDeliveryThreshold = freeThreshold
            this.deliverySettings.deliveryCost = cost
        },

        saveToStorage() {
            try {
                localStorage.setItem('sushiko_cart', JSON.stringify(this.items))
            } catch (error) {
                console.error('Cart save error:', error)
            }
        },

        loadFromStorage() {
            try {
                const saved = localStorage.getItem('sushiko_cart')
                if (saved) {
                    this.items = JSON.parse(saved)
                }
            } catch (error) {
                console.error('Cart load error:', error)
                this.items = []
            }
        },

        async syncCartProducts(locale = 'ru') {
            if (this.isSyncing || this.items.length === 0) return

            this.isSyncing = true

            try {
                const ids = this.items.map((item) => item?.product?.id).filter(Boolean)

                if (ids.length === 0) return

                const response = await axios.post(route('cart.products', { locale }), { ids })
                const freshProducts = response.data?.products ?? []
                const freshMap = new Map(freshProducts.map((product) => [product.id, product]))

                this.items = this.items
                    .map((item) => {
                        const freshProduct = freshMap.get(item.product.id)

                        if (!freshProduct) {
                            return null
                        }

                        return {
                            ...item,
                            product: {
                                ...item.product,
                                ...freshProduct,
                            },
                        }
                    })
                    .filter(Boolean)

                this.saveToStorage()
            } catch (error) {
                console.error('Cart sync failed:', error)
            } finally {
                this.isSyncing = false
            }
        },
    },
})
