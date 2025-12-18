// resources/js/stores/products.js
import { defineStore } from 'pinia'
import axios from 'axios'

export const useProductsStore = defineStore('products', {
    state: () => ({
        products: [],
        categories: [],
        loaded: false,
        loading: false,
    }),

    getters: {
        // Получить товары по категории
        getProductsByCategory: (state) => (categoryId) => {
            return state.products.filter((p) => p.category?.id === categoryId)
        },

        // Получить категорию по slug
        getCategoryBySlug: (state) => (slug) => {
            return state.categories.find((c) => c.slug === slug)
        },

        // Получить товар по slug
        getProductBySlug: (state) => (slug) => {
            return state.products.find((p) => p.slug === slug)
        },

        // Категории с товарами (для меню)
        categoriesWithProducts: (state) => {
            const categoryMap = new Map()

            // Инициализируем категории
            state.categories.forEach((category) => {
                categoryMap.set(category.id, {
                    ...category,
                    products: [],
                })
            })

            // Распределяем товары по категориям
            state.products.forEach((product) => {
                const categoryId = product.category?.id
                if (categoryId && categoryMap.has(categoryId)) {
                    categoryMap.get(categoryId).products.push(product)
                }
            })

            // Возвращаем только категории с товарами
            return Array.from(categoryMap.values()).filter((category) => category.products.length > 0)
        },
    },

    actions: {
        // Инициализация из SSR данных (первая загрузка)
        initFromProps(products = [], categories = []) {
            if (!this.loaded && products.length > 0) {
                this.products = products
                this.categories = categories
                this.loaded = true
                // console.log('✅ Products initialized from SSR:', products.length, 'products')
            }
        },

        // Обновить данные через API (если нужно)
        async refresh() {
            if (this.loading) return

            this.loading = true
            try {
                const locale = document.documentElement.lang || 'ru'
                const response = await axios.get(`/${locale}/api/products`)

                this.products = response.data.products
                this.categories = response.data.categories
                this.loaded = true

                // console.log('✅ Products refreshed from API')
            } catch (error) {
                console.error('❌ Error refreshing products:', error)
            } finally {
                this.loading = false
            }
        },

        // Очистить store
        clear() {
            this.products = []
            this.categories = []
            this.loaded = false
            this.loading = false
        },
    },
})
