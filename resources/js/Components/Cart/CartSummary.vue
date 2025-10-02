<!-- Components/Cart/CartSummary.vue -->
<template>
    <div class="lg:col-span-1">
        <!-- На мобилке НЕ sticky, на десктопе sticky -->
        <div class="bg-sushi-dark/50 border border-sushi-first rounded-lg p-4 sm:p-6 lg:sticky lg:top-24">
            <h3 class="text-xl font-bold text-sushi-silver mb-4">Итого</h3>

            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-sushi-silver/80 text-sm sm:text-base">
                    <span>Товары ({{ totalItems }})</span>
                    <span>{{ totalPrice }} {{ currency }}</span>
                </div>
                <div class="flex justify-between text-sushi-silver/80 text-sm sm:text-base">
                    <span>Доставка</span>
                    <span class="text-sushi-gold">Бесплатно</span>
                </div>
                <div class="border-t border-sushi-first pt-3">
                    <div class="flex justify-between items-center">
                        <span class="text-base sm:text-lg font-semibold text-sushi-silver">К оплате:</span>
                        <span class="text-xl sm:text-2xl font-bold text-sushi-gold">{{ totalPrice }} {{ currency }}</span>
                    </div>
                </div>
            </div>

            <button
                @click="$emit('checkout')"
                class="block w-full bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-3 rounded-lg font-medium text-center transition-colors mb-3"
            >
                Оформить заказ
            </button>

            <Link
                :href="route('home', { locale: locale })"
                class="block w-full bg-sushi-first hover:bg-sushi-first/80 text-sushi-silver border border-sushi-dark py-3 rounded-lg font-medium text-center transition-colors"
            >
                Продолжить покупки
            </Link>

            <!-- Очистить корзину -->
            <button
                @click="$emit('clear')"
                class="w-full mt-4 text-red-400 hover:text-red-300 text-sm underline transition-colors"
            >
                Очистить корзину
            </button>
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        totalItems: {
            type: Number,
            required: true,
        },
        totalPrice: {
            type: [Number, String],
            required: true,
        },
        currency: {
            type: String,
            required: true,
        },
        locale: {
            type: String,
            required: true,
        },
    })

    defineEmits(['checkout', 'clear'])
</script>
