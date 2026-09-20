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
                <div class="grid grid-cols-[minmax(0,1fr)_auto] items-center gap-x-3 text-sm text-sushi-silver/80 sm:text-base">
                    <label class="col-start-1 row-start-1 flex min-w-0 cursor-pointer items-center gap-2">
                        <input
                            type="checkbox"
                            :checked="deliveryEnabled"
                            class="h-4 w-4 shrink-0 rounded border-sushi-gold/60 bg-sushi-dark text-sushi-gold focus:ring-sushi-gold focus:ring-offset-sushi-dark"
                            @change="$emit('update:deliveryEnabled', $event.target.checked)"
                        />
                        <span>{{ t.checkout_delivery }}</span>
                    </label>
                    <span v-if="!deliveryEnabled" class="col-start-2 row-start-1 shrink-0 text-sushi-silver">
                        {{ t.checkout_pickup }}
                    </span>
                    <template v-else-if="isFreeDelivery">
                        <span class="col-start-2 row-start-1 shrink-0 text-right font-medium text-sushi-gold">
                            {{ t.cart_summary_free_delivery }}
                        </span>
                        <span class="col-start-2 row-start-2 mt-0.5 text-right text-[10px] text-sushi-silver/55">
                            ({{ t.cart_summary_within_city }})
                        </span>
                    </template>
                    <span v-else class="col-start-2 row-start-1 shrink-0 text-sushi-silver">
                        {{ deliveryCost }} {{ currency }}
                    </span>
                </div>

                <a
                    :href="localizedRoute('/delivery')"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 text-xs text-sushi-gold underline decoration-sushi-gold/60 underline-offset-4 transition hover:text-sushi-silver"
                >
                    {{ legal.delivery_terms_link }}
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>

                <!-- Подсказка до бесплатной доставки -->
                <div
                    v-if="deliveryEnabled && isHighDeliveryCost && Number(amountUntilStandardDelivery) > 0"
                    class="text-xs text-sushi-gold/80 bg-sushi-first/20 rounded p-2"
                >
                    💡 {{ t.cart_summary_until_standard }} {{ amountUntilStandardDelivery }} {{ currency }} —
                    {{ t.cart_summary_standard_delivery_cost }} {{ standardDeliveryCost }} {{ currency }}
                    <span class="text-[11px] text-sushi-silver/55">({{ t.cart_summary_within_city }})</span>
                </div>
                <div
                    v-else-if="deliveryEnabled && !isFreeDelivery && Number(amountUntilFree) > 0"
                    class="text-xs text-sushi-gold/80 bg-sushi-first/20 rounded p-2"
                >
                    💡 {{ t.cart_summary_until_free }} {{ amountUntilFree }} {{ currency }} {{ t.cart_summary_until_free_text }}
                    <span class="text-[11px] text-sushi-silver/55">({{ t.cart_summary_within_city }})</span>
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
    import { useLocale } from '@/composables/useLocale'

    const page = usePage()
    const t = page.props.translations.common
    const legal = page.props.translations.legal
    const { localizedRoute } = useLocale()

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
        deliveryEnabled: {
            type: Boolean,
            required: true,
        },
        isFreeDelivery: {
            type: Boolean,
            required: true,
        },
        isHighDeliveryCost: {
            type: Boolean,
            required: true,
        },
        amountUntilStandardDelivery: {
            type: [Number, String],
            required: true,
        },
        standardDeliveryCost: {
            type: Number,
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

    defineEmits(['checkout', 'clear', 'update:deliveryEnabled'])
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
