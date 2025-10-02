// resources/js/stores/cart.js
import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [], // Массив товаров в корзине
        // Структура item: { product, quantity, selectedAttributes }
    }),

    getters: {
        // Общее количество товаров в корзине
        totalItems: (state) => {
            return state.items.reduce((sum, item) => sum + item.quantity, 0)
        },

        // Общая сумма корзины
        totalPrice: (state) => {
            return state.items.reduce((sum, item) => {
                return sum + item.product.price * item.quantity
            }, 0)
        },

        // Валюта (берём у первого товара, обычно у всех одна)
        currency: (state) => {
            return state.items[0]?.product?.currency || 'MDL'
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
            // Проверяем, есть ли уже такой товар
            const existingItem = this.items.find((item) => item.product.id === product.id)

            if (existingItem) {
                // Если есть - увеличиваем количество
                existingItem.quantity += quantity
            } else {
                // Если нет - добавляем новый
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
                    selectedAttributes, // Например: { size: 'L', spicy: 'Hot' }
                })
            }

            // Сохраняем в localStorage
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
                    // Если количество 0 или меньше - удаляем товар
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
                    // Если количество станет 0 - удаляем
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
