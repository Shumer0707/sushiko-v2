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
                    <h2 class="text-lg sm:text-2xl font-bold text-sushi-silver">{{ t.checkout_title }}</h2>
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
                            <span class="text-sushi-silver/80 text-sm sm:text-base">{{ t.checkout_total_label }}</span>
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
                                    {{ t.checkout_name_label }}
                                    <span class="text-red-400">{{ t.checkout_required }}</span>
                                </label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    required
                                    :class="[
                                        'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                        getError('customer.name') ? 'border-red-400' : 'border-sushi-dark',
                                    ]"
                                    :placeholder="t.checkout_name_placeholder"
                                />
                                <p v-if="getError('customer.name')" class="text-red-400 text-xs mt-1">
                                    {{ getError('customer.name') }}
                                </p>
                            </div>

                            <!-- Телефон -->
                            <div>
                                <label class="block text-sm font-medium text-sushi-silver mb-2">
                                    {{ t.checkout_phone_label }}
                                    <span class="text-red-400">{{ t.checkout_required }}</span>
                                </label>

                                <div class="flex gap-2">
                                    <!-- Код страны -->
                                    <div class="relative">
                                        <!-- Код страны -->
                                        <select
                                            v-model="form.phoneCode"
                                            class="bg-sushi-first border border-sushi-dark rounded-lg px-3 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors w-28 appearance-none"
                                        >
                                            <option v-for="item in phoneCodes" :key="item.code" :value="item.code">
                                                {{ item.flag }} {{ item.code }}
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Поле телефона -->
                                    <input
                                        v-model="form.phone"
                                        type="text"
                                        required
                                        class="flex-1 bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors"
                                        :class="getError('customer.phone') ? 'border-red-400' : 'border-sushi-dark'"
                                        :placeholder="t.checkout_phone_placeholder"
                                    />
                                </div>

                                <p v-if="getError('customer.phone')" class="text-red-400 text-xs mt-1">
                                    {{ getError('customer.phone') }}
                                </p>
                            </div>
                        </div>

                        <!-- Email (опционально, на всю ширину) -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">
                                {{ t.checkout_email_label }}
                                <span class="text-red-400">{{ t.checkout_required }}</span>
                            </label>
                            <input
                                v-model="form.email"
                                type="email"
                                required
                                :class="[
                                    'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                    getError('customer.email') ? 'border-red-400' : 'border-sushi-dark',
                                ]"
                                :placeholder="t.checkout_email_placeholder"
                            />
                            <p v-if="getError('customer.email')" class="text-red-400 text-xs mt-1">
                                {{ getError('customer.email') }}
                            </p>
                        </div>

                        <!-- Способ получения -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-3">
                                {{ t.checkout_delivery_method_label }}
                                <span class="text-red-400">{{ t.checkout_required }}</span>
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
                                    <span class="text-sushi-silver text-sm sm:text-base">{{ t.checkout_pickup }}</span>
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
                                    <span class="text-sushi-silver text-sm sm:text-base">{{ t.checkout_delivery }}</span>
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
                            <p class="text-sushi-silver font-medium mb-2">{{ t.checkout_pickup_address_label }}</p>
                            <p class="text-sushi-silver/80 text-sm mb-1">{{ t.checkout_pickup_address }}</p>
                            <p class="text-sushi-silver/60 text-xs">{{ t.checkout_pickup_hours }}</p>
                        </div>

                        <!-- Блок доставки (если выбрана доставка) -->
                        <div
                            v-if="form.deliveryMethod === 'delivery'"
                            class="space-y-4 bg-sushi-first/10 border border-sushi-first rounded-lg p-4"
                        >
                            <!-- Тип адреса -->
                            <div>
                                <label class="block text-sm font-medium text-sushi-silver mb-3">
                                    {{ t.checkout_address_type_label }}
                                    <span class="text-red-400">{{ t.checkout_required }}</span>
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
                                        <span class="text-sushi-silver text-sm sm:text-base">{{ t.checkout_house }}</span>
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
                                        <span class="text-sushi-silver text-sm sm:text-base">{{ t.checkout_apartment }}</span>
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
                                        {{ t.checkout_street_label }}
                                        <span class="text-red-400">{{ t.checkout_required }}</span>
                                    </label>
                                    <input
                                        v-model="form.address"
                                        type="text"
                                        :required="form.deliveryMethod === 'delivery'"
                                        :class="[
                                            'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                            getError('delivery.address') ? 'border-red-400' : 'border-sushi-dark',
                                        ]"
                                        :placeholder="t.checkout_street_placeholder"
                                    />
                                    <p v-if="getError('delivery.address')" class="text-red-400 text-xs mt-1">
                                        {{ getError('delivery.address') }}
                                    </p>
                                </div>

                                <!-- Номер дома (1/3 ширины) -->
                                <div>
                                    <label class="block text-sm font-medium text-sushi-silver mb-2">
                                        {{ t.checkout_house_number_label }}
                                        <span class="text-red-400">{{ t.checkout_required }}</span>
                                    </label>
                                    <input
                                        v-model="form.houseNumber"
                                        type="text"
                                        :required="form.deliveryMethod === 'delivery'"
                                        :class="[
                                            'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                            getError('delivery.houseNumber') ? 'border-red-400' : 'border-sushi-dark',
                                        ]"
                                        :placeholder="t.checkout_house_number_placeholder"
                                    />
                                    <p v-if="getError('delivery.houseNumber')" class="text-red-400 text-xs mt-1">
                                        {{ getError('delivery.houseNumber') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Номер квартиры, подъезд и этаж (только для многоквартирного) -->
                            <div v-if="form.addressType === 'apartment'" class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Квартира -->
                                    <div>
                                        <label class="block text-sm font-medium text-sushi-silver mb-2">
                                            {{ t.checkout_apartment_number_label }}
                                            <span class="text-red-400">{{ t.checkout_required }}</span>
                                        </label>
                                        <input
                                            v-model="form.apartmentNumber"
                                            type="text"
                                            :required="form.deliveryMethod === 'delivery' && form.addressType === 'apartment'"
                                            :class="[
                                                'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                                getError('delivery.apartmentNumber') ? 'border-red-400' : 'border-sushi-dark',
                                            ]"
                                            :placeholder="t.checkout_apartment_number_placeholder"
                                        />
                                        <p v-if="getError('delivery.apartmentNumber')" class="text-red-400 text-xs mt-1">
                                            {{ getError('delivery.apartmentNumber') }}
                                        </p>
                                    </div>
                                    <!-- Подъезд -->
                                    <div>
                                        <label class="block text-sm font-medium text-sushi-silver mb-2">
                                            {{ t.checkout_entrance_label }}
                                            <span class="text-red-400">{{ t.checkout_required }}</span>
                                        </label>
                                        <input
                                            v-model="form.entrance"
                                            type="text"
                                            :required="form.deliveryMethod === 'delivery' && form.addressType === 'apartment'"
                                            :class="[
                                                'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                                getError('delivery.entrance') ? 'border-red-400' : 'border-sushi-dark',
                                            ]"
                                            :placeholder="t.checkout_entrance_placeholder"
                                        />
                                        <p v-if="getError('delivery.entrance')" class="text-red-400 text-xs mt-1">
                                            {{ getError('delivery.entrance') }}
                                        </p>
                                        <p v-else class="text-xs text-sushi-silver/50 mt-1">{{ t.checkout_entrance_hint }}</p>
                                    </div>
                                </div>

                                <!-- Этаж и домофон (2 колонки) -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <!-- Этаж -->
                                    <div>
                                        <label class="block text-sm font-medium text-sushi-silver mb-2">
                                            {{ t.checkout_floor_label }}
                                        </label>
                                        <input
                                            v-model="form.floor"
                                            type="text"
                                            :class="[
                                                'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                                getError('delivery.floor') ? 'border-red-400' : 'border-sushi-dark',
                                            ]"
                                            :placeholder="t.checkout_floor_placeholder"
                                        />
                                        <p v-if="getError('delivery.floor')" class="text-red-400 text-xs mt-1">
                                            {{ getError('delivery.floor') }}
                                        </p>
                                        <!-- <p v-else class="text-xs text-sushi-silver/50 mt-1">
                                            {{ t.checkout_floor_hint }}
                                        </p> -->
                                    </div>

                                    <!-- Домофон -->
                                    <div>
                                        <label class="block text-sm font-medium text-sushi-silver mb-2">
                                            {{ t.checkout_intercom_label }}
                                        </label>
                                        <input
                                            v-model="form.intercom"
                                            type="text"
                                            :class="[
                                                'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors',
                                                getError('delivery.intercom') ? 'border-red-400' : 'border-sushi-dark',
                                            ]"
                                            :placeholder="t.checkout_intercom_placeholder"
                                        />
                                        <p v-if="getError('delivery.intercom')" class="text-red-400 text-xs mt-1">
                                            {{ getError('delivery.intercom') }}
                                        </p>
                                        <p v-else class="text-xs text-sushi-silver/50 mt-1">
                                            {{ t.checkout_intercom_hint }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Способ оплаты -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-3">
                                {{ t.checkout_payment_label }}
                                <span class="text-red-400">{{ t.checkout_required }}</span>
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
                                    <span class="text-sushi-silver text-sm sm:text-base">{{ t.checkout_cash }}</span>
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
                                    <span class="text-sushi-silver text-sm sm:text-base">{{ t.checkout_card }}</span>
                                </label>
                            </div>
                            <p v-if="getError('payment')" class="text-red-400 text-xs mt-1">
                                {{ getError('payment') }}
                            </p>
                        </div>

                        <!-- Комментарий -->
                        <div>
                            <label class="block text-sm font-medium text-sushi-silver mb-2">{{ t.checkout_comment_label }}</label>
                            <textarea
                                v-model="form.comment"
                                rows="3"
                                :class="[
                                    'w-full bg-sushi-first border rounded-lg px-3 sm:px-4 py-2 sm:py-3 text-sushi-silver text-sm sm:text-base focus:border-sushi-gold focus:outline-none transition-colors resize-none',
                                    getError('comment') ? 'border-red-400' : 'border-sushi-dark',
                                ]"
                                :placeholder="t.checkout_comment_placeholder"
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
                                {{ isSubmitting ? t.checkout_submitting : t.checkout_submit }}
                            </button>
                            <button
                                type="button"
                                @click="handleClose"
                                class="w-full sm:flex-1 bg-sushi-first hover:bg-sushi-first/80 text-sushi-silver border border-sushi-dark py-3 rounded-lg font-medium transition-colors text-sm sm:text-base"
                            >
                                {{ t.checkout_cancel }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </OverlayBackdrop>
    <SuccessModal
        :is-open="successOpen"
        :title="t.checkout_success_title"
        :message="t.checkout_success_message"
        :button-text="t.checkout_success_close"
        @close="successOpen = false"
    />
</template>

<script setup>
    import { ref, computed, watch } from 'vue'
    import { router, usePage } from '@inertiajs/vue3'
    import { useCartStore } from '@/Stores/cart'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'
    import SuccessModal from '@/Components/Cart/SuccessModal.vue'

    const props = defineProps({
        isOpen: {
            type: Boolean,
            required: true,
        },
    })

    const emit = defineEmits(['close'])

    const page = usePage()
    const t = page.props.translations.common
    const cartStore = useCartStore()

    // Ошибки валидации от Laravel
    const validationErrors = ref({})

    const form = ref({
        name: '',
        phone: '',
        phoneCode: '+373', // MD по умолчанию
        email: '',
        deliveryMethod: 'pickup',
        addressType: 'apartment',
        address: '',
        houseNumber: '',
        apartmentNumber: '',
        entrance: '',
        floor: '',
        intercom: '',
        comment: '',
        payment: 'cash',
    })

    const phoneCodes = [
        { code: '+373', label: 'MD', flag: '🇲🇩' },
        { code: '+40', label: 'RO', flag: '🇷🇴' },
        { code: '+380', label: 'UA', flag: '🇺🇦' },
    ]

    const isSubmitting = ref(false)
    const isClosing = ref(false)
    const successOpen = ref(false)

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

    // Склонение слова "товар"
    const itemsWord = computed(() => {
        const count = cartStore.totalItems
        const lastDigit = count % 10
        const lastTwoDigits = count % 100

        if (lastTwoDigits >= 11 && lastTwoDigits <= 19) {
            return t.item_5 // товаров
        }
        if (lastDigit === 1) {
            return t.item_1 // товар
        }
        if (lastDigit >= 2 && lastDigit <= 4) {
            return t.item_2 // товара
        }
        return t.item_5 // товаров
    })

    const handleClose = () => {
        isClosing.value = true
        setTimeout(() => {
            emit('close')
        }, 250)
    }

    const handleOrderSuccess = () => {
        // 1. Чистим ошибки
        validationErrors.value = {}

        // 2. Очищаем корзину
        cartStore.clearCart()

        // 3. Сбрасываем форму
        form.value = {
            name: '',
            phoneCode: '+373',
            phone: '',
            email: '',
            deliveryMethod: 'pickup',
            addressType: 'apartment',
            address: '',
            houseNumber: '',
            apartmentNumber: '',
            entrance: '',
            floor: '',
            intercom: '',
            comment: '',
            payment: 'cash',
        }

        // 4. Закрываем форму заказа
        handleClose()

        // 5. Открываем модалку успеха
        successOpen.value = true
    }

    // Функция для получения ошибки по ключу
    const getError = (field) => {
        return validationErrors.value[field] ? validationErrors.value[field][0] : null
    }

    const submitOrder = async () => {
        // Сброс ошибок валидации
        validationErrors.value = {}

        isSubmitting.value = true

        // Преобразуем items: разворачиваем product в корневой уровень
        const formattedItems = cartStore.items.map((item) => ({
            id: item.product.id,
            name: item.product.name,
            price: parseFloat(item.product.price), // преобразуем строку в число
            quantity: item.quantity,
        }))

        const orderData = {
            customer: {
                name: form.value.name,
                phone: form.value.phoneCode + form.value.phone.replace(/\s+/g, ''),
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
                        intercom: form.value.intercom,
                    }),
                }),
            },
            payment: form.value.payment,
            comment: form.value.comment,
            items: formattedItems,
            total: parseFloat(cartStore.totalPrice),
            deliveryCost: parseFloat(cartStore.deliveryCost),
            totalWithDelivery: parseFloat(cartStore.totalWithDelivery),
            currency: cartStore.currency,
        }

        // Отправляем через Inertia на бэкенд
        router.post(route('order.checkout'), orderData, {
            preserveScroll: true,
            onSuccess: () => {
                handleOrderSuccess()
            },
            onError: (errors) => {
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
