<!-- Pages/Cart.vue -->
<template>
    <Head title="Корзина" />

    <!-- Фон с параллаксом (как на главной) -->
    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.4" :speed="0.2" max-height="100vh" />

    <!-- Градиент поверх страницы (переиспользуемый компонент) -->
    <PageGradient />

    <!-- Контент -->
    <div class="relative z-20 min-h-screen">
        <div class="container mx-auto px-4 py-8 max-w-6xl">
            <!-- Заголовок -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-sushi-silver mb-2">Корзина</h1>
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
                    :total-items="cartStore.totalItems"
                    :total-price="cartStore.totalPrice"
                    :currency="cartStore.currency"
                    :locale="$page.props.locale"
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
    import { Head } from '@inertiajs/vue3'
    import { ref, computed } from 'vue'
    import { useCartStore } from '@/Stores/cart'
    import { router } from '@inertiajs/vue3'
    import { usePage } from '@inertiajs/vue3'

    // Компоненты
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'
    import CartEmpty from '@/Components/Cart/CartEmpty.vue'
    import CartItem from '@/Components/Cart/CartItem.vue'
    import CartSummary from '@/Components/Cart/CartSummary.vue'
    import CheckoutModal from '@/Components/Cart/CheckoutModal.vue'

    const cartStore = useCartStore()
    const page = usePage()

    // Состояние модалки
    const showCheckoutModal = ref(false)

    // Склонение слова "товар"
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

    // Удалить товар с подтверждением
    const removeItem = (productId) => {
        if (confirm('Удалить товар из корзины?')) {
            cartStore.removeFromCart(productId)
        }
    }

    // Очистить корзину с подтверждением
    const clearCart = () => {
        if (confirm('Очистить всю корзину?')) {
            cartStore.clearCart()
        }
    }

    // Обработка отправки заказа
    const handleOrderSubmit = (orderData) => {
        console.log('Заказ отправлен:', orderData)

        // Здесь будет отправка на сервер
        // axios.post('/api/orders', orderData)

        // Пока просто показываем alert
        alert(`Спасибо за заказ, ${orderData.customer.name}! Мы свяжемся с вами по телефону ${orderData.customer.phone}`)

        // Закрываем модалку
        showCheckoutModal.value = false

        // Очищаем корзину
        cartStore.clearCart()

        // Редирект на главную
        setTimeout(() => {
            router.visit(route('home', { locale: page.props.locale }))
        }, 1000)
    }
</script>
