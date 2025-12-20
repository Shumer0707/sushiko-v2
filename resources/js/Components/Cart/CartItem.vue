<template>
    <div class="bg-sushi-dark/50 border border-sushi-first rounded-lg p-4 hover:border-sushi-gold/50 transition-colors">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
            <!-- Верхняя часть (картинка + инфо) -->
            <div class="flex items-center gap-4 flex-grow">
                <!-- Изображение -->
                <Link :href="route('product.show', { locale: locale, slug: item.product.slug })" class="flex-shrink-0">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-sushi-first rounded-lg overflow-hidden">
                        <img
                            v-if="item.product.image_url"
                            :src="item.product.image_url"
                            :alt="item.product.name"
                            class="w-full h-full object-cover hover:scale-110 transition-transform duration-300"
                        />
                        <div v-else class="w-full h-full flex items-center justify-center text-2xl sm:text-3xl">🍣</div>
                    </div>
                </Link>

                <!-- Информация о товаре -->
                <div class="flex-grow min-w-0">
                    <Link
                        :href="route('product.show', { locale: locale, slug: item.product.slug })"
                        class="font-semibold text-sushi-silver hover:text-sushi-gold transition-colors block truncate"
                    >
                        {{ item.product.name }}
                    </Link>
                    <div class="text-sm mt-1">
                        <template v-if="isDiscount">
                            <span class="text-sushi-gold line-through">{{ item.product.price }}</span>
                            <span class="text-sushi-silver/60 ml-1">{{ item.product.currency }}</span>

                            <span class="ml-2 text-sushi-red_promo font-bold">
                                {{ unitPrice.toFixed(2) }}
                            </span>
                        </template>

                        <template v-else>
                            <span class="text-sushi-silver/60">{{ unitPrice.toFixed(2) }} {{ item.product.currency }}</span>
                        </template>

                        <div
                            v-if="isGift && giftName"
                            @click.stop="giftSlug && goToGiftProduct()"
                            class="text-xs text-sushi-red_promo font-bold mt-1 w-fit"
                            :class="giftSlug ? 'underline cursor-pointer hover:opacity-100 opacity-90 transition' : 'opacity-80'"
                        >
                            🎁 + {{ giftName }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Нижняя часть (управление количеством + сумма + удалить) -->
            <div class="flex items-center justify-between lg:justify-end gap-3 lg:gap-4">
                <!-- Кнопки +/- -->
                <div class="flex items-center gap-1 sm:gap-2 bg-sushi-first rounded-lg overflow-hidden">
                    <button
                        @click="$emit('decrement')"
                        class="px-2 sm:px-3 py-2 bg-sushi-dark hover:bg-sushi-red/40 text-sushi-gold font-bold transition-colors text-lg"
                    >
                        −
                    </button>
                    <span class="px-3 sm:px-4 py-2 text-sushi-silver font-medium min-w-[2.5ch] text-center">
                        {{ item.quantity }}
                    </span>
                    <button
                        @click="$emit('increment')"
                        class="px-2 sm:px-3 py-2 bg-sushi-dark hover:bg-sushi-red/40 text-sushi-gold font-bold transition-colors text-lg"
                    >
                        +
                    </button>
                </div>

                <!-- Сумма за позицию -->
                <div class="text-right min-w-[80px] sm:min-w-[100px]">
                    <p class="font-bold text-sushi-gold text-sm sm:text-base">{{ itemTotal }} {{ item.product.currency }}</p>
                </div>

                <!-- Кнопка удалить -->
                <button
                    @click="$emit('remove')"
                    class="text-red-400 hover:text-red-300 p-2 transition-colors flex-shrink-0"
                    :title="t.cart_item_remove"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
</template>

<script setup>
    import { Link, usePage, router } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import { useCartStore } from '@/Stores/cart'

    const page = usePage()
    const t = page.props.translations.common

    const props = defineProps({
        item: {
            type: Object,
            required: true,
        },
        locale: {
            type: String,
            required: true,
        },
    })

    defineEmits(['increment', 'decrement', 'remove'])

    const cartStore = useCartStore()

    const isDiscount = computed(() => props.item.product?.has_promotion && props.item.product?.promotion_type === 'discount')
    const isGift = computed(() => props.item.product?.has_promotion && props.item.product?.promotion_type === 'gift')

    const unitPrice = computed(() => cartStore.unitPrice(props.item.product))

    const itemTotal = computed(() => {
        return (unitPrice.value * props.item.quantity).toFixed(2)
    })

    const giftName = computed(() => props.item.product?.gift_product?.name || '')

    const giftSlug = computed(() => props.item.product?.gift_product?.slug || '')

    const goToGiftProduct = () => {
        if (!giftSlug.value) return

        router.visit(
            route('product.show', {
                locale: props.locale,
                slug: giftSlug.value,
            })
        )
    }
</script>
