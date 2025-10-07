<template>
    <div
        class="product-card bg-sushi-dark bg-opacity-80 backdrop-blur-sm rounded-xl overflow-hidden border border-sushi-gold border-opacity-20 hover:border-opacity-50 hover:shadow-2xl shadow-lg transition-all duration-300 group cursor-pointer"
    >
        <!-- Картинка товара -->
        <div @click="goToProduct" class="relative aspect-square overflow-hidden bg-sushi-first">
            <!-- Если есть картинка -->
            <img
                v-if="product.image_url"
                :src="product.image_url"
                :alt="product.name"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                loading="lazy"
            />

            <!-- Плейсхолдер если нет картинки -->
            <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sushi-first to-sushi-dark">
                <div class="text-center">
                    <div class="text-6xl mb-2 opacity-30">🍱</div>
                    <span class="text-sushi-gold text-sm opacity-50 font-medium">Фото скоро появится</span>
                </div>
            </div>

            <!-- Бейдж категории -->
            <div class="absolute top-2 left-2">
                <span
                    class="px-2 py-1 bg-sushi-dark bg-opacity-90 backdrop-blur-sm text-xs font-medium text-sushi-gold rounded-full border border-sushi-gold border-opacity-30"
                >
                    {{ product.category.name }}
                </span>
            </div>

            <!-- 🔥 НОВОЕ: Бейдж количества в корзине -->
            <div v-if="itemInCart" class="absolute top-2 right-2">
                <span
                    class="px-2 py-1 bg-sushi-red text-white text-xs font-bold rounded-full border border-white border-opacity-30 shadow-lg animate-bounce-once"
                >
                    В корзине: {{ itemInCart.quantity }}
                </span>
            </div>

            <!-- Overlay при наведении -->
            <div
                class="absolute inset-0 bg-gradient-to-t from-sushi-dark via-sushi-dark/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4"
            >
                <span class="text-sushi-gold font-semibold text-sm">Подробнее →</span>
            </div>
        </div>

        <!-- Информация о товаре -->
        <div class="p-3">
            <!-- Название -->
            <h3
                @click="goToProduct"
                class="text-base font-semibold text-sushi-silver mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-sushi-gold transition-colors duration-300"
            >
                {{ product.name }}
            </h3>

            <!-- Короткое описание -->
            <p v-if="product.short_description" class="text-xs text-sushi-silver opacity-70 mb-3 line-clamp-2 min-h-[2rem]">
                {{ product.short_description }}
            </p>

            <!-- Цена и кнопки -->
            <div class="flex items-center justify-between mt-3">
                <!-- Цена -->
                <div class="flex items-baseline gap-1">
                    <span class="text-xl font-bold text-sushi-gold">
                        {{ product.price }}
                    </span>
                    <span class="text-xs text-sushi-silver opacity-70">
                        {{ product.currency }}
                    </span>
                </div>

                <!-- 🔥 НОВОЕ: Кнопки в корзину или управление количеством -->
                <div class="flex items-center gap-2">
                    <!-- Если товара НЕТ в корзине - показываем кнопку "В корзину" -->
                    <button
                        v-if="!itemInCart"
                        @click.stop="addToCart"
                        class="px-3 py-1.5 bg-sushi-red hover:bg-sushi-red/80 text-white rounded-lg text-sm font-medium transition-all duration-300 hover:scale-105 active:scale-95 shadow-md hover:shadow-lg"
                    >
                        В корзину
                    </button>

                    <!-- Если товар УЖЕ В корзине - показываем кнопки +/- -->
                    <div
                        v-else
                        class="flex items-center gap-1 bg-sushi-dark border border-sushi-gold border-opacity-30 rounded-lg overflow-hidden"
                    >
                        <!-- Кнопка минус -->
                        <button
                            @click.stop="decrementQuantity"
                            class="px-2 py-1 bg-sushi-red/20 hover:bg-sushi-red/40 text-sushi-gold font-bold transition-colors duration-200"
                        >
                            −
                        </button>

                        <!-- Количество -->
                        <span class="px-3 py-1 text-sm font-bold text-sushi-gold">
                            {{ itemInCart.quantity }}
                        </span>

                        <!-- Кнопка плюс -->
                        <button
                            @click.stop="incrementQuantity"
                            class="px-2 py-1 bg-sushi-red/20 hover:bg-sushi-red/40 text-sushi-gold font-bold transition-colors duration-200"
                        >
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { router, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import { useCartStore } from '@/Stores/cart'

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    })

    const page = usePage()
    const locale = computed(() => page.props.current_locale || 'ru')

    const cartStore = useCartStore()

    const itemInCart = computed(() => {
        return cartStore.getCartItem(props.product.id)
    })

    const goToProduct = () => {
        router.visit(
            route('product.show', {
                locale: locale.value,
                slug: props.product.slug,
            })
        )
    }

    const incrementQuantity = () => {
        cartStore.incrementQuantity(props.product.id)
        console.log('➕ Увеличено:', props.product.name)
    }

    const decrementQuantity = () => {
        cartStore.decrementQuantity(props.product.id)
        console.log('➖ Уменьшено:', props.product.name)
    }
</script>

<style scoped>
    @keyframes bounce-once {
        0%,
        100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animate-bounce-once {
        animation: bounce-once 0.5s ease-out;
    }
</style>
