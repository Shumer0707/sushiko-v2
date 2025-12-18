<template>
    <Head :title="t.cart_page_title" />

    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.4" :speed="0.2" max-height="100vh" />
    <PageGradient />

    <div class="relative z-20 min-h-screen">
        <div class="container mx-auto px-4 py-8 max-w-6xl">
            <!-- Заголовок -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-sushi-silver mb-2">{{ t.cart_page_title }}</h1>
                <p class="text-sushi-silver/60">{{ cartStore.totalItems }} {{ itemsWord }}</p>
            </div>

            <!-- Пустая корзина -->
            <CartEmpty v-if="cartStore.items.length === 0" :locale="$page.props.locale" />

            <!-- Корзина с товарами -->
            <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Список товаров (левая часть) -->
                <div class="lg:col-span-2 space-y-4">
                    <CartItem
                        v-for="item in cartStore.items"
                        :key="item.product.id"
                        :item="item"
                        :locale="$page.props.locale"
                        @increment="cartStore.incrementQuantity(item.product.id)"
                        @decrement="cartStore.decrementQuantity(item.product.id)"
                        @remove="removeItem(item.product.id)"
                    />
                </div>

                <!-- Итоговый блок (правая часть) -->
                <CartSummary
                    :items="cartStore.items"
                    :total-items="cartStore.totalItems"
                    :total-price="cartStore.totalPrice"
                    :currency="cartStore.currency"
                    :locale="$page.props.locale"
                    :delivery-cost="cartStore.deliveryCost"
                    :is-free-delivery="cartStore.isFreeDelivery"
                    :amount-until-free="cartStore.amountUntilFreeDelivery"
                    :total-with-delivery="cartStore.totalWithDelivery"
                    @checkout="showCheckoutModal = true"
                    @clear="clearCart"
                />
            </div>
        </div>
    </div>

    <!-- Snackbar "товар удалён / отменить" -->
    <div v-if="showUndoBar" class="fixed bottom-4 left-1/2 -translate-x-1/2 z-50 px-4">
        <div
            class="bg-sushi-dark/90 border border-sushi-gold/60 text-sushi-silver px-4 py-3 rounded-full shadow-lg flex items-center gap-3"
        >
            <span class="text-sm">
                {{ t.cart_item_removed || 'Товар удалён из корзины' }}
            </span>

            <button @click="undoRemove" class="text-xs font-semibold uppercase tracking-wide underline underline-offset-4">
                {{ t.common_undo || 'Отменить' }}
            </button>

            <button @click="closeUndoBar" class="ml-1 text-sushi-silver/60 text-lg leading-none" aria-label="Close">×</button>
        </div>
    </div>

    <!-- Модалка оформления заказа -->
    <CheckoutModal :is-open="showCheckoutModal" @close="showCheckoutModal = false"/>
</template>

<script setup>
    import { Head, usePage, router } from '@inertiajs/vue3'
    import { ref, computed } from 'vue'
    import { useCartStore } from '@/Stores/cart'

    // Компоненты
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'
    import CartEmpty from '@/Components/Cart/CartEmpty.vue'
    import CartItem from '@/Components/Cart/CartItem.vue'
    import CartSummary from '@/Components/Cart/CartSummary.vue'
    import CheckoutModal from '@/Components/Cart/CheckoutModal.vue'

    const page = usePage()
    const t = page.props.translations.common
    const cartStore = useCartStore()

    if (page.props.deliverySettings) {
        cartStore.initDeliverySettings(page.props.deliverySettings)
    } else {
        console.warn('⚠ deliverySettings не передан в props. Используются значения по умолчанию из стора.')
    }

    const showCheckoutModal = ref(false)

    // Для Undo
    const showUndoBar = ref(false)
    const lastRemovedItem = ref(null)
    const undoTimeoutId = ref(null)

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

    // 🧹 Удаление одной позиции — без confirm, но с возможностью "Отменить"
    const removeItem = (productId) => {
        const item = cartStore.items.find((i) => i.product.id === productId)
        if (!item) return

        // Удаляем из стора
        cartStore.removeFromCart(productId)

        // Запоминаем, чтобы можно было вернуть
        lastRemovedItem.value = {
            product: item.product,
            quantity: item.quantity,
        }

        // Показываем snackbar
        showUndoBar.value = true

        // Перезапускаем таймер, чтобы не мигала при быстром удалении нескольких
        if (undoTimeoutId.value) {
            clearTimeout(undoTimeoutId.value)
        }

        undoTimeoutId.value = setTimeout(() => {
            showUndoBar.value = false
            lastRemovedItem.value = null
            undoTimeoutId.value = null
        }, 5000)
    }

    const undoRemove = () => {
        if (!lastRemovedItem.value) return

        // Предполагаю, что в сторе есть addToCart(product, quantity)
        cartStore.addToCart(lastRemovedItem.value.product, lastRemovedItem.value.quantity)

        showUndoBar.value = false
        lastRemovedItem.value = null

        if (undoTimeoutId.value) {
            clearTimeout(undoTimeoutId.value)
            undoTimeoutId.value = null
        }
    }

    const closeUndoBar = () => {
        showUndoBar.value = false
        lastRemovedItem.value = null

        if (undoTimeoutId.value) {
            clearTimeout(undoTimeoutId.value)
            undoTimeoutId.value = null
        }
    }

    // 🧺 Удалить всё — оставляем confirm
    const clearCart = () => {
        if (confirm(t.cart_confirm_clear)) {
            cartStore.clearCart()
        }
    }

    const handleOrderSubmit = (orderData) => {
        console.log('Заказ отправлен:', orderData)

        alert(`${t.cart_order_success}, ${orderData.customer.name}! ${t.cart_order_contact} ${orderData.customer.phone}`)

        showCheckoutModal.value = false
        cartStore.clearCart()

        setTimeout(() => {
            router.visit(route('home', { locale: page.props.locale }))
        }, 1000)
    }
</script>
