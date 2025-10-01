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
                <span class="font-semibold">{{ totalAmount }} MDL</span>
                <div class="text-xs md:text-[10px] text-gray-300 hidden sm:block">{{ totalItems }} товара</div>
            </div>
        </button>

        <!-- Выпадающая мини-корзина -->
        <!-- Выпадающая мини-корзина -->
        <OverlayBackdrop :is-visible="overlay.isOpen.value" @close="overlay.close()">
            <div
                v-if="overlay.isOpen.value"
                data-modal-content="mini-cart"
                :class="[
                    'bg-sushi-dark rounded-b-lg shadow-xl border border-sushi-first z-50 mini-cart sm:min-w-[380px] max-w-[calc(100vw-2rem)]',
                    // 🎯 Добавляем класс closing при анимации закрытия
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
                    <div v-if="cartItems.length === 0" class="p-4 sm:p-6 text-center">
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
                            v-for="item in cartItems"
                            :key="item.id"
                            class="flex items-center space-x-2 sm:space-x-3 p-2 sm:p-3 bg-sushi-first rounded-lg hover:bg-sushi-first/80 transition-colors"
                        >
                            <!-- Изображение товара -->
                            <div
                                class="w-10 h-10 sm:w-12 sm:h-12 bg-sushi-dark border border-sushi-first rounded-lg flex items-center justify-center flex-shrink-0"
                            >
                                <span class="text-lg sm:text-xl">{{ item.emoji || '🍣' }}</span>
                            </div>

                            <!-- Информация о товаре -->
                            <div class="flex-1 min-w-0">
                                <h4 class="font-medium text-sushi-silver truncate text-sm sm:text-base">{{ item.name }}</h4>
                                <p class="text-xs sm:text-sm text-sushi-gold">{{ item.price }} MDL</p>
                            </div>

                            <!-- Количество и управление -->
                            <div class="flex items-center space-x-1 sm:space-x-2 flex-shrink-0">
                                <button
                                    @click="updateQuantity(item.id, item.quantity - 1)"
                                    class="w-5 h-5 sm:w-6 sm:h-6 bg-sushi-dark hover:bg-sushi-gold hover:text-sushi-dark border border-sushi-first rounded text-xs sm:text-sm flex items-center justify-center transition-colors text-sushi-silver"
                                >
                                    -
                                </button>
                                <span class="w-6 sm:w-8 text-center text-xs sm:text-sm font-medium text-sushi-silver">
                                    {{ item.quantity }}
                                </span>
                                <button
                                    @click="updateQuantity(item.id, item.quantity + 1)"
                                    class="w-5 h-5 sm:w-6 sm:h-6 bg-sushi-dark hover:bg-sushi-gold hover:text-sushi-dark border border-sushi-first rounded text-xs sm:text-sm flex items-center justify-center transition-colors text-sushi-silver"
                                >
                                    +
                                </button>
                            </div>

                            <!-- Удалить товар -->
                            <button
                                @click="removeItem(item.id)"
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
                <div v-if="cartItems.length > 0" class="p-3 sm:p-4 border-t border-sushi-first bg-sushi-first/50">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-medium text-sushi-silver/80 text-sm sm:text-base">Итого:</span>
                        <span class="font-bold text-base sm:text-lg text-sushi-gold">{{ totalAmount }} MDL</span>
                    </div>

                    <div class="space-y-2">
                        <button
                            class="w-full bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-2 px-4 rounded-lg font-medium transition-colors text-sm sm:text-base"
                        >
                            Оформить заказ
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

    // Refs
    const triggerButton = ref(null)

    // Overlay система
    const overlay = useOverlay('mini-cart')

    // Временные тестовые данные корзины (потом заменим на реальные)
    const cartItems = ref([
        {
            id: 1,
            name: 'Филадельфия с лососем',
            price: 250,
            quantity: 2,
            emoji: '🍣',
        },
        {
            id: 2,
            name: 'Калифорния с крабом',
            price: 180,
            quantity: 1,
            emoji: '🍤',
        },
    ])

    // Вычисляемые свойства
    const totalItems = computed(() => {
        return cartItems.value.reduce((sum, item) => sum + item.quantity, 0)
    })

    const totalAmount = computed(() => {
        return cartItems.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
    })

    // MiniCart.vue - более простая логика
    const cartStyle = computed(() => {
        if (!overlay.isOpen.value) return {}

        // Всегда определяем активный хедер
        const header = document.querySelector('header')
        const stickyHeader = document.querySelector('.fixed.translate-y-0') // sticky когда виден

        const activeHeader = stickyHeader || header
        const headerHeight = activeHeader ? activeHeader.offsetHeight : 80

        const isSmallScreen = window.innerWidth < 640

        if (isSmallScreen) {
            // Мобильные - на всю ширину
            return {
                top: `${headerHeight}px`,
                left: '0',
                right: '0',
                position: 'fixed',
            }
        } else {
            // Десктоп - справа, но под хедером
            return {
                top: `${headerHeight}px`,
                right: '16px', // отступ от края
                position: 'fixed',
            }
        }
    })

    // Методы управления корзиной
    const updateQuantity = (itemId, newQuantity) => {
        if (newQuantity <= 0) {
            removeItem(itemId)
            return
        }

        const item = cartItems.value.find((item) => item.id === itemId)
        if (item) {
            item.quantity = newQuantity
        }
    }

    const removeItem = (itemId) => {
        const index = cartItems.value.findIndex((item) => item.id === itemId)
        if (index > -1) {
            cartItems.value.splice(index, 1)
        }
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
            /* opacity: 1; */
            transform: translateY(0);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            /* opacity: 0; */
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
