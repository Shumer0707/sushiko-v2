<template>
    <div class="lg:col-span-1">
        <div class="bg-sushi-dark/50 border border-sushi-first rounded-lg p-4 sm:p-6 lg:sticky lg:top-24">
            <h3 class="text-xl font-bold text-sushi-silver mb-4">{{ t.cart_summary_title }}</h3>

            <!-- Список товаров (кратко) -->
            <div class="space-y-2 mb-4 max-h-[200px] overflow-y-auto custom-scrollbar">
                <div
                    v-for="item in items"
                    :key="item.product.id"
                    class="flex justify-between items-center text-sm text-sushi-silver/80 py-2 border-b border-sushi-first/30"
                >
                    <div class="flex-grow min-w-0 pr-2">
                        <span class="truncate block">{{ item.product.name }}</span>
                        <span class="text-xs text-sushi-silver/60">
                            {{ item.quantity }} ×
                            <span
                                v-if="item.product.has_promotion && item.product.promotion_type === 'discount'"
                                class="text-sushi-gold line-through"
                            >
                                {{ item.product.price }}
                            </span>
                            <span
                                :class="
                                    item.product.has_promotion && item.product.promotion_type === 'discount'
                                        ? 'text-sushi-red_promo font-bold ml-1'
                                        : ''
                                "
                            >
                                {{ cartStore.unitPrice(item.product).toFixed(2) }}
                            </span>
                            {{ currency }}

                            <span
                                v-if="isGiftPromo(item.product) && giftName(item.product)"
                                class="ml-2 text-sushi-red_promo font-bold"
                            >
                                🎁 + {{ giftName(item.product) }}
                            </span>
                        </span>
                    </div>
                    <span class="font-medium text-sushi-gold flex-shrink-0">
                        {{ (cartStore.unitPrice(item.product) * item.quantity).toFixed(2) }}
                    </span>
                </div>
            </div>

            <!-- Разделитель -->
            <div class="border-t border-sushi-first my-4"></div>

            <!-- Подсчеты -->
            <div class="space-y-3 mb-6">
                <!-- Товары -->
                <div class="flex justify-between text-sushi-silver/80 text-sm sm:text-base">
                    <span>{{ t.cart_summary_products }} ({{ totalItems }})</span>
                    <span>{{ totalPrice }} {{ currency }}</span>
                </div>

                <!-- Доставка -->
                <div class="flex justify-between text-sushi-silver/80 text-sm sm:text-base">
                    <span>{{ t.cart_summary_delivery }}</span>
                    <span v-if="isFreeDelivery" class="text-sushi-gold font-medium">{{ t.cart_summary_free_delivery }}</span>
                    <span v-else class="text-sushi-silver">{{ deliveryCost }} {{ currency }}</span>
                </div>

                <!-- Подсказка до бесплатной доставки -->
                <div
                    v-if="!isFreeDelivery && Number(amountUntilFree) > 0"
                    class="text-xs text-sushi-gold/80 bg-sushi-first/20 rounded p-2"
                >
                    💡 {{ t.cart_summary_until_free }} {{ amountUntilFree }} {{ currency }} {{ t.cart_summary_until_free_text }}
                </div>

                <!-- Итого -->
                <div class="border-t border-sushi-first pt-3">
                    <div class="flex justify-between items-center">
                        <span class="text-base sm:text-lg font-semibold text-sushi-silver">{{ t.cart_summary_total }}</span>
                        <span class="text-xl sm:text-2xl font-bold text-sushi-gold">{{ totalWithDelivery }} {{ currency }}</span>
                    </div>
                </div>
            </div>

            <!-- Кнопки -->
            <button
                @click="$emit('checkout')"
                class="block w-full bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-3 rounded-lg font-medium text-center transition-colors mb-3"
            >
                {{ t.cart_summary_checkout }}
            </button>

            <Link
                :href="route('home', { locale: locale })"
                class="block w-full bg-sushi-first hover:bg-sushi-first/80 text-sushi-silver border border-sushi-dark py-3 rounded-lg font-medium text-center transition-colors"
            >
                {{ t.cart_summary_continue }}
            </Link>

            <!-- Очистить корзину -->
            <button
                @click="$emit('clear')"
                class="w-full mt-4 text-red-400 hover:text-red-300 text-sm underline transition-colors"
            >
                {{ t.cart_summary_clear }}
            </button>
        </div>
    </div>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { useCartStore } from '@/Stores/cart'

    const page = usePage()
    const t = page.props.translations.common

    const props = defineProps({
        items: {
            type: Array,
            required: true,
        },
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
        deliveryCost: {
            type: Number,
            required: true,
        },
        isFreeDelivery: {
            type: Boolean,
            required: true,
        },
        amountUntilFree: {
            type: [Number, String],
            required: true,
        },
        totalWithDelivery: {
            type: [Number, String],
            required: true,
        },
    })
    const cartStore = useCartStore()

    const isGiftPromo = (product) => {
        return !!product?.has_promotion && product?.promotion_type === 'gift'
    }

    const giftName = (product) => {
        return product?.gift_product?.name || ''
    }

    defineEmits(['checkout', 'clear'])
</script>

<style scoped>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.3);
        border-radius: 2px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 175, 55, 0.5);
    }
</style>
