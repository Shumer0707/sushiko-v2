<template>
    <div class="relative">
        <!-- Кнопка корзины -->
        <button
            data-modal-trigger="mini-cart"
            ref="triggerButton"
            @click="overlay.toggle()"
            class="flex items-center space-x-2 bg-sushi-first px-3 py-2 lg:px-3 lg:py-2 md:px-2 md:py-1 rounded cursor-pointer hover:bg-sushi-first/70 transition-colors"
        >
            <span class="text-sm md:text-xs">🛒</span>
            <div class="text-sm md:text-xs">
                <!-- 🔥 НОВОЕ: Данные из store -->
                <span class="font-semibold">{{ cartStore.totalPrice }} {{ cartStore.currency }}</span>
                <div class="text-xs md:text-[10px] text-gray-300 hidden sm:block">{{ cartStore.totalItems }} {{ itemsWord }}</div>
            </div>

            <!-- 🔥 НОВОЕ: Бейдж с количеством (если есть товары) -->
            <span
                v-if="cartStore.totalItems > 0"
                class="absolute -top-1 -right-1 bg-sushi-red text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center border-2 border-sushi-dark"
            >
                {{ cartStore.totalItems > 99 ? '99+' : cartStore.totalItems }}
            </span>
        </button>

        <!-- Выпадающая мини-корзина -->
        <OverlayBackdrop :is-visible="overlay.isOpen.value" @close="overlay.close()">
            <div
                v-if="overlay.isOpen.value"
                data-modal-content="mini-cart"
                :class="[
                    'bg-sushi-dark rounded-b-lg shadow-xl border border-sushi-first z-50 mini-cart sm:min-w-[380px] max-w-[calc(100vw-2rem)]',
                    overlay.isClosing.value ? 'closing' : '',
                ]"
                :style="cartStyle"
                @click.stop
            >
                <!-- Заголовок корзины -->
                <div class="flex justify-between items-center p-4 sm:p-4 md:p-3 border-b border-sushi-first">
                    <h3 class="font-bold text-sushi-silver text-base sm:text-lg">Корзина</h3>
                    <button @click="overlay.close()" class="text-sushi-silver/60 hover:text-sushi-gold p-1 transition-colors">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Товары в корзине -->
                <div class="max-h-60 sm:max-h-80 overflow-y-auto custom-scrollbar">
                    <!-- Пустая корзина -->
                    <div v-if="cartStore.items.length === 0" class="p-4 sm:p-6 text-center">
                        <div class="text-sushi-gold text-2xl sm:text-4xl mb-2 sm:mb-3">🛒</div>
                        <p class="text-sushi-silver/60 mb-3 sm:mb-4 text-sm sm:text-base">Корзина пуста</p>
                        <button
                            @click="overlay.close()"
                            class="bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark px-3 py-2 sm:px-4 sm:py-2 rounded-lg font-medium transition-colors text-sm sm:text-base"
                        >
                            Продолжить покупки
                        </button>
                    </div>

                    <!-- Товары -->
                    <div v-else class="p-3 sm:p-4 space-y-2 sm:space-y-3">
                        <div
                            v-for="item in cartStore.items"
                            :key="item.product.id"
                            class="flex items-center space-x-2 sm:space-x-3 p-2 sm:p-3 bg-sushi-first rounded-lg hover:bg-sushi-first/80 transition-colors"
                        >
                            <!-- Изображение товара -->
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 bg-sushi-dark border border-sushi-first rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden"
                            >
                                <!-- 🔥 НОВОЕ: Реальное фото товара или плейсхолдер -->
                                <img
                                    v-if="item.product.image_url"
                                    :src="item.product.image_url"
                                    :alt="item.product.name"
                                    class="w-full h-full object-cover"
                                />
                                <span v-else class="text-lg sm:text-xl">🍣</span>
                            </div>

                            <!-- Информация о товаре -->
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-sushi-silver truncate text-sm sm:text-base">
                                    {{ item.product.name }}
                                </h4>
                                <p class="text-xs sm:text-sm text-sushi-gold">
                                    {{ item.product.price }} {{ item.product.currency }}
                                </p>
                            </div>

                            <!-- Количество и управление -->
                            <div class="flex items-center space-x-1 sm:space-x-2 flex-shrink-0">
                                <button
                                    @click="cartStore.decrementQuantity(item.product.id)"
                                    class="w-5 h-5 sm:w-6 sm:h-6 bg-sushi-dark hover:bg-sushi-gold hover:text-sushi-dark border border-sushi-first rounded text-xs sm:text-sm flex items-center justify-center transition-colors text-sushi-silver"
                                >
                                    -
                                </button>
                                <span class="w-6 sm:w-8 text-center text-xs sm:text-sm font-medium text-sushi-silver">
                                    {{ item.quantity }}
                                </span>
                                <button
                                    @click="cartStore.incrementQuantity(item.product.id)"
                                    class="w-5 h-5 sm:w-6 sm:h-6 bg-sushi-dark hover:bg-sushi-gold hover:text-sushi-dark border border-sushi-first rounded text-xs sm:text-sm flex items-center justify-center transition-colors text-sushi-silver"
                                >
                                    +
                                </button>
                            </div>

                            <!-- Удалить товар -->
                            <button
                                @click="cartStore.removeFromCart(item.product.id)"
                                class="text-red-400 hover:text-red-300 p-1 flex-shrink-0 transition-colors"
                            >
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Итого и кнопки -->
                <div v-if="cartStore.items.length > 0" class="p-3 sm:p-4 border-t border-sushi-first bg-sushi-first/50">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-medium text-sushi-silver/80 text-sm sm:text-base">Итого:</span>
                        <span class="font-bold text-base sm:text-lg text-sushi-gold">
                            {{ cartStore.totalPrice }} {{ cartStore.currency }}
                        </span>
                    </div>

                    <div class="space-y-2">
                        <button
                            @click="goToCart"
                            class="w-full bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-2 px-4 rounded-lg font-medium transition-colors text-sm sm:text-base"
                        >
                            Перейти в корзину
                        </button>
                        <button
                            @click="overlay.close()"
                            class="w-full bg-sushi-first hover:bg-sushi-first/80 text-sushi-silver border border-sushi-dark py-2 px-4 rounded-lg font-medium transition-colors text-sm sm:text-base"
                        >
                            Продолжить покупки
                        </button>
                    </div>
                </div>
            </div>
        </OverlayBackdrop>
    </div>
</template>

<script setup>
    import { useOverlay } from '@/composables/useOverlay'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'
    import { ref, computed } from 'vue'
    import { useCartStore } from '@/Stores/cart' // 🔥 Импорт store
    import { router, usePage } from '@inertiajs/vue3'

    // Refs
    const triggerButton = ref(null)

    // 🔥 Подключаем store корзины
    const cartStore = useCartStore()

    // Overlay система
    const overlay = useOverlay('mini-cart')

    // 🔥 Склонение слова "товар" (1 товар, 2 товара, 5 товаров)
    const itemsWord = computed(() => {
        const count = cartStore.totalItems
        const lastDigit = count % 10
        const lastTwoDigits = count % 100

        if (lastTwoDigits >= 11 && lastTwoDigits <= 19) {
            return 'товаров'
        }
        if (lastDigit === 1) {
            return 'товар'
        }
        if (lastDigit >= 2 && lastDigit <= 4) {
            return 'товара'
        }
        return 'товаров'
    })

    // Стили для позиционирования
    const cartStyle = computed(() => {
        if (!overlay.isOpen.value) return {}

        const header = document.querySelector('header')
        const stickyHeader = document.querySelector('.fixed.translate-y-0')

        const activeHeader = stickyHeader || header
        const headerHeight = activeHeader ? activeHeader.offsetHeight : 80

        const isSmallScreen = window.innerWidth < 640

        if (isSmallScreen) {
            return {
                top: `${headerHeight}px`,
                left: '0',
                right: '0',
                position: 'fixed',
            }
        } else {
            return {
                top: `${headerHeight}px`,
                right: '16px',
                position: 'fixed',
            }
        }
    })

    const goToCart = () => {
        overlay.close()
        router.visit(route('cart.index', { locale: usePage().props.locale }))
    }
</script>

<style scoped>
    .mini-cart {
        animation: cartSlideIn 0.5s ease-out forwards;
    }

    @keyframes cartSlideIn {
        0% {
            transform: translateY(-100%);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            transform: translateY(0);
        }
    }

    .mini-cart.closing {
        animation: cartSlideOut 0.4s ease-in forwards;
    }

    @keyframes cartSlideOut {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            transform: translateY(-100%);
        }
    }

    /* Кастомный скроллбар */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.5);
        border-radius: 2px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 175, 55, 0.8);
    }
</style>
