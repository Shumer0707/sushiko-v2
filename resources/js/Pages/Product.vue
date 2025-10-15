<script setup>
    import { computed } from 'vue'
    import AppHead from '@/Components/Seo/Head.vue'
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'
    import { useCartStore } from '@/Stores/cart'
    import { router, usePage } from '@inertiajs/vue3'

    const page = usePage()
    const t = page.props.translations.common

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    })

    const cartStore = useCartStore()

    // Проверяем, есть ли товар в корзине
    const itemInCart = computed(() => {
        return cartStore.getCartItem(props.product.id)
    })

    // 🔥 ИСПОЛЬЗУЕМ ГОТОВЫЕ meta из контроллера
    const meta = computed(() => page.props.meta || {})

    // Остальной твой код...
    const addToCart = () => {
        cartStore.addToCart(props.product, 1)
    }

    const incrementQuantity = () => {
        cartStore.incrementQuantity(props.product.id)
    }

    const decrementQuantity = () => {
        cartStore.decrementQuantity(props.product.id)
    }

    const removeFromCart = () => {
        cartStore.removeFromCart(props.product.id)
    }

    const goToCart = () => {
        router.visit(route('cart.index', { locale: page.props.locale }))
    }
</script>

<template>
    <!-- 🔥 ИСПОЛЬЗУЕМ meta из контроллера -->
    <AppHead
        :title="meta.title || product.name"
        :description="meta.description || product.short_description"
        :image="meta.image || product.image_url"
        og-type="product"
    />

    <!-- Фон с параллаксом -->
    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.4" :speed="0.2" max-height="100vh" />

    <!-- Градиент поверх -->
    <PageGradient />

    <!-- Контент -->
    <div class="relative z-20 py-6 md:py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Кнопка "Назад" -->
            <div class="mb-4">
                <a
                    href="/"
                    class="inline-flex items-center gap-2 text-sushi-gold hover:text-sushi-silver transition-colors text-sm"
                >
                    <i class="fas fa-arrow-left"></i>
                    <span>{{ t.product_back_to_menu }}</span>
                </a>
            </div>

            <!-- Основной контент (2 колонки) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Левая колонка - Изображение -->
                <div
                    class="bg-sushi-dark bg-opacity-60 backdrop-blur-sm rounded-2xl border-2 border-sushi-gold p-4 md:p-6 shadow-2xl"
                >
                    <div class="relative aspect-square overflow-hidden rounded-xl bg-sushi-first">
                        <!-- Если есть картинка -->
                        <img
                            v-if="product.image_url"
                            :src="product.image_url"
                            :alt="product.name"
                            class="w-full h-full object-cover"
                        />

                        <!-- Плейсхолдер если нет картинки -->
                        <div
                            v-else
                            class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sushi-first to-sushi-dark"
                        >
                            <div class="text-center">
                                <div class="text-8xl mb-3 opacity-30">🍱</div>
                                <span class="text-sushi-gold text-base opacity-50 font-medium">{{ t.product_photo_soon }}</span>
                            </div>
                        </div>

                        <!-- Бейдж категории -->
                        <div class="absolute top-3 left-3">
                            <span
                                class="px-3 py-1.5 bg-sushi-dark bg-opacity-90 backdrop-blur-sm text-xs font-medium text-sushi-gold rounded-full border border-sushi-gold border-opacity-30"
                            >
                                {{ product.category.name }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Правая колонка - Информация -->
                <div
                    class="bg-sushi-dark bg-opacity-60 backdrop-blur-sm rounded-2xl border-2 border-sushi-gold p-6 md:p-8 shadow-2xl flex flex-col"
                >
                    <!-- Название -->
                    <h1 class="text-2xl md:text-3xl font-bold text-sushi-gold mb-3">
                        {{ product.name }}
                    </h1>

                    <!-- Короткое описание -->
                    <p v-if="product.short_description" class="text-sushi-silver text-base mb-4">
                        {{ product.short_description }}
                    </p>

                    <!-- Разделитель -->
                    <div class="border-t border-sushi-gold opacity-30 my-4"></div>

                    <!-- Полное описание -->
                    <div v-if="product.description" class="mb-4">
                        <h3 class="text-lg font-semibold text-sushi-gold mb-2">{{ t.product_description_title }}</h3>
                        <p class="text-white text-sm leading-relaxed">
                            {{ product.description }}
                        </p>
                    </div>

                    <!-- Состав (если есть) -->
                    <div v-if="product.ingredients" class="mb-4">
                        <h3 class="text-lg font-semibold text-sushi-gold mb-2">{{ t.product_ingredients_title }}</h3>
                        <p class="text-white text-sm leading-relaxed">
                            {{ product.ingredients }}
                        </p>
                    </div>

                    <!-- Spacer - отталкивает цену и кнопки вниз -->
                    <div class="flex-grow"></div>

                    <!-- Разделитель -->
                    <div class="border-t border-sushi-gold opacity-30 my-4"></div>

                    <!-- Цена -->
                    <div class="mb-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-bold text-sushi-gold">
                                {{ product.price }}
                            </span>
                            <span class="text-lg text-sushi-silver opacity-70">
                                {{ product.currency }}
                            </span>
                        </div>
                    </div>

                    <!-- Кнопки управления -->
                    <div class="flex items-center gap-3">
                        <!-- Если товара НЕТ в корзине -->
                        <button
                            v-if="!itemInCart"
                            @click="addToCart"
                            class="flex-1 bg-sushi-red hover:bg-sushi-red/90 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg"
                        >
                            <i class="fas fa-shopping-cart mr-2"></i>
                            {{ t.product_add_to_cart }}
                        </button>

                        <!-- Если товар УЖЕ В корзине -->
                        <template v-else>
                            <!-- Кнопки +/- -->
                            <div
                                class="flex-1 flex items-center justify-between bg-sushi-first border-2 border-sushi-gold rounded-lg p-1.5"
                            >
                                <!-- Кнопка минус -->
                                <button
                                    @click="decrementQuantity"
                                    class="w-10 h-10 bg-sushi-red/20 hover:bg-sushi-red/40 text-sushi-gold font-bold text-lg rounded-lg transition-colors duration-200"
                                >
                                    −
                                </button>

                                <!-- Количество -->
                                <span class="text-xl font-bold text-sushi-gold">
                                    {{ itemInCart.quantity }}
                                </span>

                                <!-- Кнопка плюс -->
                                <button
                                    @click="incrementQuantity"
                                    class="w-10 h-10 bg-sushi-red/20 hover:bg-sushi-red/40 text-sushi-gold font-bold text-lg rounded-lg transition-colors duration-200"
                                >
                                    +
                                </button>
                            </div>

                            <!-- Кнопка "Удалить" (крестик) -->
                            <button
                                @click="removeFromCart"
                                class="px-5 py-3 bg-sushi-dark border-2 border-red-500 hover:bg-red-500/20 text-red-500 font-bold rounded-lg transition-all duration-300 hover:scale-105 shadow-lg group"
                                :title="t.product_remove_from_cart"
                            >
                                <i class="fas fa-times group-hover:rotate-90 transition-transform duration-300"></i>
                            </button>

                            <!-- Кнопка "Перейти в корзину" -->
                            <button
                                @click="goToCart"
                                class="px-5 py-3 bg-sushi-gold hover:bg-sushi-gold/90 text-sushi-dark font-bold rounded-lg transition-all duration-300 hover:scale-105 shadow-lg"
                            >
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
