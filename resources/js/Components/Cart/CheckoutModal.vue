<!-- Components/Cart/CheckoutModal.vue -->
<template>
    <OverlayBackdrop :is-visible="isOpen" :z-index="100" @close="handleClose">
        <!-- Центрирующий контейнер -->
        <div
            v-if="isOpen"
            class="fixed inset-0 flex items-center justify-center p-2 sm:p-4"
            style="z-index: 60"
            @click="handleClose"
        >
            <!-- Модальное окно - останавливаем всплытие клика -->
            <div
                @click.stop
                :class="[
                    'bg-sushi-dark border border-sushi-gold rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto modal-content',
                    isClosing ? 'closing' : '',
                ]"
            >
                <!-- Заголовок -->
                <div class="flex items-center justify-between p-4 sm:p-6 border-b border-sushi-first">
                    <h2 class="text-lg sm:text-2xl font-bold text-sushi-silver">Оформление заказа</h2>
                    <button @click="handleClose" class="text-sushi-silver/60 hover:text-sushi-gold transition-colors p-1">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Содержимое -->
                <div class="p-4 sm:p-6">
                    <!-- Итоговая сумма заказа -->
                    <div class="bg-sushi-first/30 border border-sushi-gold/30 rounded-lg p-3 sm:p-4 mb-6">
                        <div class="flex justify-between items-center flex-wrap gap-2">
                            <span class="text-sushi-silver/80 text-sm sm:text-base">Итого к оплате:</span>
                            <span class="text-xl sm:text-2xl font-bold text-sushi-gold">
                                {{ cartStore.totalPrice }} {{ cartStore.currency }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-sushi-silver/60 mt-2">{{ cartStore.totalItems }} {{ itemsWord }}</p>
                    </div>

                    <!-- Форма -->
                    <form @submit.prevent="submitOrder" class="space-y-3 sm:space-y-4">
                        <!-- Имя -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">
                                Ваше имя
                                <span class="text-red-400">*</span>
                            </label>
                            <input
                                v-model="form.name"
                                type="text"
                                required
                                class="w-full bg-sushi-first border border-sushi-dark rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors"
                                placeholder="Введите ваше имя"
                            />
                        </div>

                        <!-- Телефон -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">
                                Телефон
                                <span class="text-red-400">*</span>
                            </label>
                            <input
                                v-model="form.phone"
                                type="tel"
                                required
                                class="w-full bg-sushi-first border border-sushi-dark rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors"
                                placeholder="+373 XX XXX XXX"
                            />
                        </div>

                        <!-- Email (опционально) -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">Email (опционально)</label>
                            <input
                                v-model="form.email"
                                type="email"
                                class="w-full bg-sushi-first border border-sushi-dark rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors"
                                placeholder="your@email.com"
                            />
                        </div>

                        <!-- Адрес доставки -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">
                                Адрес доставки
                                <span class="text-red-400">*</span>
                            </label>
                            <textarea
                                v-model="form.address"
                                required
                                rows="3"
                                class="w-full bg-sushi-first border border-sushi-dark rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors resize-none"
                                placeholder="Улица, дом, квартира"
                            ></textarea>
                        </div>

                        <!-- Комментарий -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">Комментарий к заказу</label>
                            <textarea
                                v-model="form.comment"
                                rows="3"
                                class="w-full bg-sushi-first border border-sushi-dark rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors resize-none"
                                placeholder="Особые пожелания, время доставки..."
                            ></textarea>
                        </div>

                        <!-- Способ оплаты -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">
                                Способ оплаты
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="space-y-2">
                                <label
                                    class="flex items-center p-3 bg-sushi-first border border-sushi-dark rounded-lg cursor-pointer hover:border-sushi-gold transition-colors"
                                >
                                    <input v-model="form.payment" type="radio" value="cash" class="mr-3 flex-shrink-0" required />
                                    <span class="text-sushi-silver text-sm sm:text-base">Наличными при получении</span>
                                </label>
                                <label
                                    class="flex items-center p-3 bg-sushi-first border border-sushi-dark rounded-lg cursor-pointer hover:border-sushi-gold transition-colors"
                                >
                                    <input v-model="form.payment" type="radio" value="card" class="mr-3 flex-shrink-0" required />
                                    <span class="text-sushi-silver text-sm sm:text-base">Картой при получении</span>
                                </label>
                            </div>
                        </div>

                        <!-- Кнопки -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="w-full sm:flex-1 bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-3 rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed text-sm sm:text-base"
                            >
                                {{ isSubmitting ? 'Отправка...' : 'Подтвердить заказ' }}
                            </button>
                            <button
                                type="button"
                                @click="handleClose"
                                class="w-full sm:flex-1 bg-sushi-first hover:bg-sushi-first/80 text-sushi-silver border border-sushi-dark py-3 rounded-lg font-medium transition-colors text-sm sm:text-base"
                            >
                                Отмена
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </OverlayBackdrop>
</template>

<script setup>
    import { ref, computed, watch } from 'vue'
    import { useCartStore } from '@/Stores/cart'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'

    const props = defineProps({
        isOpen: {
            type: Boolean,
            required: true,
        },
    })

    const emit = defineEmits(['close', 'submit'])

    const cartStore = useCartStore()

    const form = ref({
        name: '',
        phone: '',
        email: '',
        address: '',
        comment: '',
        payment: 'cash',
    })

    const isSubmitting = ref(false)
    const isClosing = ref(false)

    watch(
        () => props.isOpen,
        (isOpen) => {
            if (isOpen) {
                document.body.style.overflow = 'hidden'
                isClosing.value = false
            } else {
                document.body.style.overflow = ''
            }
        }
    )

    const itemsWord = computed(() => {
        const count = cartStore.totalItems
        const lastDigit = count % 10
        const lastTwoDigits = count % 100

        if (lastTwoDigits >= 11 && lastTwoDigits <= 19) return 'товаров'
        if (lastDigit === 1) return 'товар'
        if (lastDigit >= 2 && lastDigit <= 4) return 'товара'
        return 'товаров'
    })

    const handleClose = () => {
        isClosing.value = true
        setTimeout(() => {
            emit('close')
        }, 250)
    }

    const submitOrder = async () => {
        isSubmitting.value = true

        try {
            const orderData = {
                customer: form.value,
                items: cartStore.items,
                total: cartStore.totalPrice,
                currency: cartStore.currency,
            }

            emit('submit', orderData)

            form.value = {
                name: '',
                phone: '',
                email: '',
                address: '',
                comment: '',
                payment: 'cash',
            }
        } catch (error) {
            console.error('Ошибка при отправке заказа:', error)
        } finally {
            isSubmitting.value = false
        }
    }
</script>

<style scoped>
    .modal-content {
        animation: modalSlideIn 0.4s ease-out forwards;
    }

    @keyframes modalSlideIn {
        0% {
            opacity: 0;
            transform: translateY(-100%);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-content.closing {
        animation: modalSlideOut 0.25s ease-in forwards;
    }

    @keyframes modalSlideOut {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            opacity: 0;
            transform: translateY(-100%);
        }
    }

    .modal-content::-webkit-scrollbar {
        width: 6px;
    }

    .modal-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .modal-content::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.5);
        border-radius: 3px;
    }

    .modal-content::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 175, 55, 0.8);
    }
</style>
