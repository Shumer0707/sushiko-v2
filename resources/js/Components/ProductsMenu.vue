<template>
    <section class="products-menu py-12 bg-gradient-to-b from-white to-sushi-silver">
        <div class="container mx-auto px-4">
            <!-- Если товаров нет -->
            <div v-if="!products || products.length === 0" class="text-center py-12">
                <p class="text-lg text-sushi-dark_op">Товары не найдены</p>
            </div>

            <!-- Товары по категориям -->
            <div v-else>
                <!-- Перебираем категории -->
                <div
                    v-for="category in categoriesWithProducts"
                    :key="category.id"
                    :id="`category-${category.id}`"
                    class="category-section mb-16 last:mb-0"
                >
                    <!-- Заголовок категории -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <!-- Иконка категории (если есть) -->
                            <div v-if="category.image_url" class="w-16 h-16 rounded-full overflow-hidden shadow-md">
                                <img :src="category.image_url" :alt="category.name" class="w-full h-full object-cover" />
                            </div>

                            <!-- Название категории -->
                            <h2 class="text-3xl md:text-4xl font-bold text-first_color">
                                {{ category.name }}
                            </h2>
                        </div>

                        <!-- Количество товаров -->
                        <span class="text-sm text-sushi-dark_op bg-white px-4 py-2 rounded-full shadow-sm">
                            {{ category.products.length }} {{ declension(category.products.length) }}
                        </span>
                    </div>

                    <!-- Сетка товаров -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <ProductCard v-for="product in category.products" :key="product.id" :product="product" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { computed, onMounted } from 'vue'
    import { useProductsStore } from '@/Stores/products'
    import ProductCard from '@/Components/ProductCard.vue'

    // Пропсы от контроллера (SSR данные)
    const props = defineProps({
        products: {
            type: Array,
            default: () => [],
        },
        categories: {
            type: Array,
            default: () => [],
        },
    })

    // Инициализируем store
    const store = useProductsStore()

    // При монтировании - загружаем данные в store
    onMounted(() => {
        store.initFromProps(props.products, props.categories)
    })

    // Используем данные из store
    const categoriesWithProducts = computed(() => store.categoriesWithProducts)
    const hasProducts = computed(() => store.products.length > 0)

    // Склонение слова "товар"
    const declension = (count) => {
        const cases = [2, 0, 1, 1, 1, 2]
        const titles = ['товар', 'товара', 'товаров']

        return titles[count % 100 > 4 && count % 100 < 20 ? 2 : cases[Math.min(count % 10, 5)]]
    }
</script>

<style scoped>
    /* Плавное появление секций */
    .category-section {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
