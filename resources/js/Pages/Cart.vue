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

    <!-- Модалка оформления заказа -->
    <CheckoutModal :is-open="showCheckoutModal" @close="showCheckoutModal = false" @submit="handleOrderSubmit" />
</template>

<script setup>
    import { Head, usePage } from '@inertiajs/vue3'
    import { ref, computed } from 'vue'
    import { useCartStore } from '@/Stores/cart'
    import { router } from '@inertiajs/vue3'

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

    const showCheckoutModal = ref(false)

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

    const removeItem = (productId) => {
        if (confirm(t.cart_item_confirm_remove)) {
            cartStore.removeFromCart(productId)
        }
    }

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
