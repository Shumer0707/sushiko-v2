<template>
    <section class="products-menu py-8 container mx-auto">
        <div class="container mx-auto px-4">
            <!-- Если товаров нет -->
            <div v-if="!products || products.length === 0" class="font-display text-center py-8">
                <p class="text-base text-sushi-silver opacity-80">{{ t.home_menu_not_item }}</p>
            </div>

            <!-- Товары по категориям -->
            <div v-else class="space-y-12">
                <!-- Перебираем категории -->
                <div
                    v-for="category in categoriesWithProducts"
                    :key="category.id"
                    :id="`category-${category.id}`"
                    class="category-section"
                >
                    <!-- Заголовок категории с прозрачным фоном -->
                    <div
                        class="flex items-center justify-between mb-6 bg-sushi-dark bg-opacity-70 backdrop-blur-sm rounded-xl p-4 border border-sushi-gold border-opacity-20"
                    >
                        <div class="flex items-center gap-3">
                            <!-- Иконка категории (если есть) - меньше -->
                            <div
                                v-if="category.image_url"
                                class="w-12 h-12 rounded-full overflow-hidden border-2 border-sushi-gold"
                            >
                                <img :src="category.image_url" :alt="category.name" class="w-full h-full object-cover" />
                            </div>

                            <!-- Название категории - меньше -->
                            <h2 class="font-display text-xl md:text-2xl font-bold text-sushi-gold">
                                {{ category.name }}
                            </h2>
                        </div>

                        <!-- Количество товаров -->
                        <span
                            class="text-xs md:text-sm text-sushi-silver bg-sushi-dark bg-opacity-60 px-3 py-1.5 rounded-full border border-sushi-gold border-opacity-30"
                        >
                            {{ category.products.length }} {{ declension(category.products.length) }}
                        </span>
                    </div>

                    <!-- Сетка товаров - БОЛЬШЕ карточек в ряд -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
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
    import ProductCard from '@/Components/Home/ProductCard.vue'
    import { usePage } from '@inertiajs/vue3'

    const page = usePage()
    const t = page.props.translations.common

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
        const titles = [t.home_menu_col_1, t.home_menu_col_2, t.home_menu_col_3]

        return titles[count % 100 > 4 && count % 100 < 20 ? 2 : cases[Math.min(count % 10, 5)]]
    }
</script>

<style scoped>
    /* Убираем фон - будет просвечивать параллакс */
    .products-menu {
        background: transparent;
    }

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
