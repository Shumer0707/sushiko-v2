<!-- Components/Cart/CheckoutModal.vue -->
<template>
    <OverlayBackdrop :is-visible="isOpen" :z-index="9999" @close="handleClose">
        <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center p-2 sm:p-4" @click="handleClose">
            <div
                @click.stop
                :class="[
                    'bg-sushi-dark border border-sushi-gold rounded-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto modal-content',
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
                                {{ cartStore.totalWithDelivery }} {{ cartStore.currency }}
                            </span>
                        </div>
                        <p class="text-xs sm:text-sm text-sushi-silver/60 mt-2">{{ cartStore.totalItems }} {{ itemsWord }}</p>
                    </div>

                    <!-- Общая ошибка корзины/товаров -->
                    <div v-if="getError('items')" class="bg-red-500/10 border border-red-400 rounded-lg p-4 mb-6">
                        <p class="text-red-400 font-medium">{{ getError('items') }}</p>
                    </div>

                    <!-- Форма -->
                    <form @submit.prevent="submitOrder" class="space-y-4">
                        <!-- Имя и Телефон (2 колонки) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
                                    :class="[
                                        'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                        getError('customer.name') ? 'border-red-400' : 'border-sushi-dark',
                                    ]"
                                    placeholder="Иван Петров"
                                />
                                <p v-if="getError('customer.name')" class="text-red-400 text-xs mt-1">
                                    {{ getError('customer.name') }}
                                </p>
                            </div>

                            <!-- Телефон с маской -->
                            <div>
                                <label class="block text-sm font-medium text-sushi-silver mb-2">
                                    Телефон
                                    <span class="text-red-400">*</span>
                                </label>
                                <input
                                    :value="phoneMask.formattedValue.value"
                                    @input="phoneMask.handleInput"
                                    type="text"
                                    required
                                    :class="[
                                        'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                        phoneError || getError('customer.phone') ? 'border-red-400' : 'border-sushi-dark',
                                    ]"
                                    placeholder="+373 12 345 678"
                                />
                                <p v-if="phoneError || getError('customer.phone')" class="text-red-400 text-xs mt-1">
                                    {{ phoneError || getError('customer.phone') }}
                                </p>
                            </div>
                        </div>

                        <!-- Email (опционально, на всю ширину) -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">Email (опционально)</label>
                            <input
                                v-model="form.email"
                                type="email"
                                :class="[
                                    'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                    getError('customer.email') ? 'border-red-400' : 'border-sushi-dark',
                                ]"
                                placeholder="your@email.com"
                            />
                            <p v-if="getError('customer.email')" class="text-red-400 text-xs mt-1">
                                {{ getError('customer.email') }}
                            </p>
                        </div>

                        <!-- Способ получения -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-3">
                                Способ получения
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label
                                    class="flex items-center p-3 bg-sushi-first border rounded-lg cursor-pointer transition-colors"
                                    :class="
                                        form.deliveryMethod === 'pickup'
                                            ? 'border-sushi-gold bg-sushi-gold/10'
                                            : 'border-sushi-dark hover:border-sushi-gold/50'
                                    "
                                >
                                    <input
                                        v-model="form.deliveryMethod"
                                        type="radio"
                                        value="pickup"
                                        class="mr-3 flex-shrink-0"
                                        required
                                    />
                                    <span class="text-sushi-silver text-sm sm:text-base">Самовывоз</span>
                                </label>
                                <label
                                    class="flex items-center p-3 bg-sushi-first border rounded-lg cursor-pointer transition-colors"
                                    :class="
                                        form.deliveryMethod === 'delivery'
                                            ? 'border-sushi-gold bg-sushi-gold/10'
                                            : 'border-sushi-dark hover:border-sushi-gold/50'
                                    "
                                >
                                    <input
                                        v-model="form.deliveryMethod"
                                        type="radio"
                                        value="delivery"
                                        class="mr-3 flex-shrink-0"
                                        required
                                    />
                                    <span class="text-sushi-silver text-sm sm:text-base">Доставка</span>
                                </label>
                            </div>
                            <p v-if="getError('delivery.method')" class="text-red-400 text-xs mt-1">
                                {{ getError('delivery.method') }}
                            </p>
                        </div>

                        <!-- Адрес самовывоза (если выбран самовывоз) -->
                        <div
                            v-if="form.deliveryMethod === 'pickup'"
                            class="bg-sushi-first/30 border border-sushi-gold/30 rounded-lg p-4"
                        >
                            <p class="text-sushi-silver font-medium mb-2">Адрес самовывоза:</p>
                            <p class="text-sushi-silver/80 text-sm mb-1">ул. Пушкина, д. 10</p>
                            <p class="text-sushi-silver/60 text-xs">Время работы: 10:00 - 22:00</p>
                        </div>

                        <!-- Блок доставки (если выбрана доставка) -->
                        <div
                            v-if="form.deliveryMethod === 'delivery'"
                            class="space-y-4 bg-sushi-first/10 border border-sushi-first rounded-lg p-4"
                        >
                            <!-- Тип адреса -->
                            <div>
                                <label class="block text-sm font-medium text-sushi-silver mb-3">
                                    Тип адреса
                                    <span class="text-red-400">*</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <label
                                        class="flex items-center p-3 bg-sushi-first border rounded-lg cursor-pointer transition-colors"
                                        :class="
                                            form.addressType === 'house'
                                                ? 'border-sushi-gold bg-sushi-gold/10'
                                                : 'border-sushi-dark hover:border-sushi-gold/50'
                                        "
                                    >
                                        <input v-model="form.addressType" type="radio" value="house" class="mr-3 flex-shrink-0" />
                                        <span class="text-sushi-silver text-sm sm:text-base">Частный дом</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 bg-sushi-first border rounded-lg cursor-pointer transition-colors"
                                        :class="
                                            form.addressType === 'apartment'
                                                ? 'border-sushi-gold bg-sushi-gold/10'
                                                : 'border-sushi-dark hover:border-sushi-gold/50'
                                        "
                                    >
                                        <input
                                            v-model="form.addressType"
                                            type="radio"
                                            value="apartment"
                                            class="mr-3 flex-shrink-0"
                                        />
                                        <span class="text-sushi-silver text-sm sm:text-base">Многоквартирный</span>
                                    </label>
                                </div>
                                <p v-if="getError('delivery.addressType')" class="text-red-400 text-xs mt-1">
                                    {{ getError('delivery.addressType') }}
                                </p>
                            </div>

                            <!-- Адрес и номер дома -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <!-- Адрес (2/3 ширины) -->
                                <div class="sm:col-span-2">
                                    <label class="block text-sm font-medium text-sushi-silver mb-2">
                                        Улица
                                        <span class="text-red-400">*</span>
                                    </label>
                                    <input
                                        v-model="form.address"
                                        type="text"
                                        :required="form.deliveryMethod === 'delivery'"
                                        :class="[
                                            'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                            getError('delivery.address') ? 'border-red-400' : 'border-sushi-dark',
                                        ]"
                                        placeholder="ул. Примерная"
                                    />
                                    <p v-if="getError('delivery.address')" class="text-red-400 text-xs mt-1">
                                        {{ getError('delivery.address') }}
                                    </p>
                                </div>

                                <!-- Номер дома (1/3 ширины) -->
                                <div>
                                    <label class="block text-sm font-medium text-sushi-silver mb-2">
                                        Дом
                                        <span class="text-red-400">*</span>
                                    </label>
                                    <input
                                        v-model="form.houseNumber"
                                        type="text"
                                        :required="form.deliveryMethod === 'delivery'"
                                        :class="[
                                            'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                            getError('delivery.houseNumber') ? 'border-red-400' : 'border-sushi-dark',
                                        ]"
                                        placeholder="10"
                                    />
                                    <p v-if="getError('delivery.houseNumber')" class="text-red-400 text-xs mt-1">
                                        {{ getError('delivery.houseNumber') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Номер квартиры, подъезд и этаж (только для многоквартирного) -->
                            <div v-if="form.addressType === 'apartment'" class="space-y-4">
                                <!-- Квартира -->
                                <div>
                                    <label class="block text-sm font-medium text-sushi-silver mb-2">
                                        Квартира
                                        <span class="text-red-400">*</span>
                                    </label>
                                    <input
                                        v-model="form.apartmentNumber"
                                        type="text"
                                        :required="form.deliveryMethod === 'delivery' && form.addressType === 'apartment'"
                                        :class="[
                                            'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                            getError('delivery.apartmentNumber') ? 'border-red-400' : 'border-sushi-dark',
                                        ]"
                                        placeholder="25"
                                    />
                                    <p v-if="getError('delivery.apartmentNumber')" class="text-red-400 text-xs mt-1">
                                        {{ getError('delivery.apartmentNumber') }}
                                    </p>
                                </div>

                                <!-- Подъезд и Этаж (2 колонки) -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Подъезд -->
                                    <div>
                                        <label class="block text-sm font-medium text-sushi-silver mb-2">
                                            Подъезд
                                            <span class="text-red-400">*</span>
                                        </label>
                                        <input
                                            v-model="form.entrance"
                                            type="text"
                                            :required="form.deliveryMethod === 'delivery' && form.addressType === 'apartment'"
                                            :class="[
                                                'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                                getError('delivery.entrance') ? 'border-red-400' : 'border-sushi-dark',
                                            ]"
                                            placeholder="1"
                                        />
                                        <p v-if="getError('delivery.entrance')" class="text-red-400 text-xs mt-1">
                                            {{ getError('delivery.entrance') }}
                                        </p>
                                        <p v-else class="text-xs text-sushi-silver/50 mt-1">Если нет подъезда — укажите 1</p>
                                    </div>

                                    <!-- Этаж -->
                                    <div>
                                        <label class="block text-sm font-medium text-sushi-silver mb-2">
                                            Этаж
                                            <span class="text-red-400">*</span>
                                        </label>
                                        <input
                                            v-model="form.floor"
                                            type="text"
                                            :required="form.deliveryMethod === 'delivery' && form.addressType === 'apartment'"
                                            :class="[
                                                'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                                getError('delivery.floor') ? 'border-red-400' : 'border-sushi-dark',
                                            ]"
                                            placeholder="5"
                                        />
                                        <p v-if="getError('delivery.floor')" class="text-red-400 text-xs mt-1">
                                            {{ getError('delivery.floor') }}
                                        </p>
                                        <p v-else class="text-xs text-sushi-silver/50 mt-1">Если нет этажа — укажите 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Способ оплаты -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-3">
                                Способ оплаты
                                <span class="text-red-400">*</span>
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label
                                    class="flex items-center p-3 bg-sushi-first border rounded-lg cursor-pointer transition-colors"
                                    :class="
                                        form.payment === 'cash'
                                            ? 'border-sushi-gold bg-sushi-gold/10'
                                            : 'border-sushi-dark hover:border-sushi-gold/50'
                                    "
                                >
                                    <input v-model="form.payment" type="radio" value="cash" class="mr-3 flex-shrink-0" required />
                                    <span class="text-sushi-silver text-sm sm:text-base">Наличными</span>
                                </label>
                                <label
                                    class="flex items-center p-3 bg-sushi-first border rounded-lg cursor-pointer transition-colors"
                                    :class="
                                        form.payment === 'card'
                                            ? 'border-sushi-gold bg-sushi-gold/10'
                                            : 'border-sushi-dark hover:border-sushi-gold/50'
                                    "
                                >
                                    <input v-model="form.payment" type="radio" value="card" class="mr-3 flex-shrink-0" required />
                                    <span class="text-sushi-silver text-sm sm:text-base">Картой</span>
                                </label>
                            </div>
                            <p v-if="getError('payment')" class="text-red-400 text-xs mt-1">
                                {{ getError('payment') }}
                            </p>
                        </div>

                        <!-- Комментарий -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">Комментарий к заказу</label>
                            <textarea
                                v-model="form.comment"
                                rows="3"
                                :class="[
                                    'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors resize-none',
                                    getError('comment') ? 'border-red-400' : 'border-sushi-dark',
                                ]"
                                placeholder="Особые пожелания, время доставки..."
                            ></textarea>
                            <p v-if="getError('comment')" class="text-red-400 text-xs mt-1">
                                {{ getError('comment') }}
                            </p>
                        </div>

                        <!-- Кнопки -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                            <button
                                type="submit"
                                :disabled="isSubmitting"
                                class="w-full sm:flex-1 bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-3 rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed text-sm sm:text-base"
                            >
                                {{ isSubmitting ? 'Отправка...' : 'Оформить заказ' }}
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
    import { router } from '@inertiajs/vue3'
    import { useCartStore } from '@/Stores/cart'
    import { usePhoneMask } from '@/composables/usePhoneMask'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'

    const props = defineProps({
        isOpen: {
            type: Boolean,
            required: true,
        },
    })

    const emit = defineEmits(['close'])

    const cartStore = useCartStore()

    // Инициализация маски телефона
    const phoneMask = usePhoneMask()
    const phoneError = ref('')

    // Ошибки валидации от Laravel
    const validationErrors = ref({})

    const form = ref({
        name: '',
        email: '',
        deliveryMethod: 'pickup',
        addressType: 'apartment',
        address: '',
        houseNumber: '',
        apartmentNumber: '',
        entrance: '',
        floor: '',
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

    // Функция для получения ошибки по ключу
    const getError = (field) => {
        return validationErrors.value[field] ? validationErrors.value[field][0] : null
    }

    const submitOrder = async () => {
        // Сброс ошибок валидации
        validationErrors.value = {}

        // Валидация телефона на фронте
        if (!phoneMask.isValid()) {
            phoneError.value = 'Введите корректный номер телефона (минимум 10 цифр)'
            return
        }
        phoneError.value = ''

        isSubmitting.value = true

        // Преобразуем items: разворачиваем product в корневой уровень
        const formattedItems = cartStore.items.map((item) => ({
            id: item.product.id,
            name: item.product.name,
            price: parseFloat(item.product.price), // преобразуем строку в число
            quantity: item.quantity,
            // Можно добавить selectedAttributes если нужно
            // selectedAttributes: item.selectedAttributes
        }))

        const orderData = {
            customer: {
                name: form.value.name,
                phone: phoneMask.getCleanValue(),
                email: form.value.email,
            },
            delivery: {
                method: form.value.deliveryMethod,
                ...(form.value.deliveryMethod === 'delivery' && {
                    addressType: form.value.addressType,
                    address: form.value.address,
                    houseNumber: form.value.houseNumber,
                    ...(form.value.addressType === 'apartment' && {
                        apartmentNumber: form.value.apartmentNumber,
                        entrance: form.value.entrance,
                        floor: form.value.floor,
                    }),
                }),
            },
            payment: form.value.payment,
            comment: form.value.comment,
            items: formattedItems, // используем преобразованные items
            total: parseFloat(cartStore.totalPrice),
            deliveryCost: parseFloat(cartStore.deliveryCost),
            totalWithDelivery: parseFloat(cartStore.totalWithDelivery),
            currency: cartStore.currency,
        }

        // Отправляем через Inertia на бэкенд
        router.post(route('order.checkout'), orderData, {
            preserveScroll: true,
            onSuccess: () => {
                // Успех - очищаем всё
                validationErrors.value = {}
                cartStore.clearCart()

                form.value = {
                    name: '',
                    email: '',
                    deliveryMethod: 'pickup',
                    addressType: 'apartment',
                    address: '',
                    houseNumber: '',
                    apartmentNumber: '',
                    entrance: '',
                    floor: '',
                    comment: '',
                    payment: 'cash',
                }

                phoneMask.formattedValue.value = ''
                phoneError.value = ''

                handleClose()

                alert('Заказ успешно оформлен! Мы свяжемся с вами в ближайшее время.')
            },
            onError: (errors) => {
                // Сохраняем ошибки для отображения под полями
                validationErrors.value = errors
                console.error('Ошибки валидации:', errors)
            },
            onFinish: () => {
                isSubmitting.value = false
            },
        })
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
