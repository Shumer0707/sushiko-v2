<template>
    <div
        class="product-card bg-sushi-dark bg-opacity-80 rounded-xl overflow-hidden border border-sushi-gold border-opacity-20 shadow-sm cursor-pointer group md:backdrop-blur-sm md:shadow-lg md:hover:shadow-2xl md:hover:border-opacity-50 md:transition-all md:duration-300"
    >
        <!-- Картинка товара -->
        <div @click="goToProduct" class="relative aspect-square overflow-hidden bg-sushi-first">
            <img
                v-if="product.image_url"
                :src="product.image_url"
                :alt="product.name"
                class="w-full h-full object-cover md:transition-transform md:duration-500 md:group-hover:scale-110"
                loading="lazy"
            />

            <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sushi-first to-sushi-dark">
                <div class="text-center">
                    <div class="text-3xl md:text-6xl mb-1 md:mb-2 opacity-30">🍱</div>
                    <span class="text-sushi-gold text-[10px] md:text-sm opacity-50 font-medium">Фото скоро</span>
                </div>
            </div>

            <!-- Категория -->
            <div class="absolute top-1 md:top-2 left-1 md:left-2 flex items-center gap-1 max-w-[90%]">
                <span
                    class="inline-flex w-fit px-1.5 md:px-2 py-0.5 md:py-1 bg-sushi-dark bg-opacity-90 backdrop-blur-sm text-[9px] md:text-xs font-medium text-sushi-gold rounded-full border border-sushi-gold border-opacity-30"
                >
                    {{ product.category.name }}
                </span>

                <!-- PROMO badge -->
                <span
                    v-if="hasPromotion"
                    class="inline-flex items-center gap-1 w-fit px-1.5 md:px-2 py-0.5 md:py-1 bg-sushi-red_promo/90 backdrop-blur-sm text-[9px] md:text-xs font-bold text-white rounded-full border border-white/20 shadow max-w-full"
                >
                    <template v-if="isDiscount">
                        -
                        <span class="font-semibold opacity-90 truncate">{{ savingAmount }} {{ product.currency }}</span>
                    </template>

                    <template v-else-if="isGift">🎁 {{ t.product_present }}</template>
                </span>
            </div>

            <!-- Кол-во в корзине -->
            <div v-if="itemInCart" class="absolute top-1 md:top-2 right-1 md:right-2">
                <span
                    class="px-1.5 md:px-2 py-0.5 md:py-1 bg-sushi-red text-white text-[9px] md:text-xs font-bold rounded-full border border-white border-opacity-30 shadow-lg"
                >
                    {{ itemInCart.quantity }}
                </span>
            </div>

            <div
                class="hidden md:flex absolute inset-0 bg-gradient-to-t from-sushi-dark via-sushi-dark/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 items-end justify-center pb-4"
            >
                <span class="text-sushi-gold font-semibold text-sm">{{ t.home_menu_more }} →</span>
            </div>
        </div>

        <!-- Информация о товаре -->
        <div class="p-2 md:p-3">
            <h3
                @click="goToProduct"
                class="text-xs md:text-base font-semibold text-sushi-silver mb-1 md:mb-2 line-clamp-2 min-h-[2rem] md:min-h-[2.5rem] group-hover:text-sushi-gold transition-colors duration-300"
            >
                {{ product.name }}
                <span
                    v-if="isGift"
                    @click.stop="goToGiftProduct"
                    class="ml-1 text-[10px] md:text-xs font-bold text-sushi-red_promo opacity-90 whitespace-nowrap underline cursor-pointer hover:opacity-100 transition"
                >
                    + {{ giftName }}
                </span>
            </h3>

            <p
                v-if="product.short_description"
                class="hidden md:block text-xs text-sushi-silver opacity-70 mb-3 line-clamp-2 min-h-[2rem]"
            >
                {{ product.short_description }}
            </p>

            <!-- Цена и кнопки -->
            <div class="flex items-center justify-between mt-2 md:mt-3">
                <!-- Price block -->
                <div class="flex flex-col leading-tight">
                    <!-- Discount: old price -->
                    <div v-if="isDiscount" class="flex items-baseline gap-1">
                        <span class="text-[10px] md:text-xs text-sushi-gold line-through">
                            {{ product.price }}
                        </span>
                        <span class="text-[10px] md:text-xs text-sushi-silver/60">
                            {{ product.currency }}
                        </span>
                    </div>

                    <!-- Current price -->
                    <div v-if="isDiscount" class="flex items-baseline gap-0.5 md:gap-1">
                        <span class="text-base md:text-xl font-bold text-sushi-red_promo">
                            {{ displayPrice }}
                        </span>
                        <span class="text-[10px] md:text-xs text-sushi-silver opacity-70">
                            {{ product.currency }}
                        </span>
                    </div>
                    <div v-else class="flex items-baseline gap-0.5 md:gap-1">
                        <span class="text-base md:text-xl font-bold text-sushi-gold">
                            {{ displayPrice }}
                        </span>
                        <span class="text-[10px] md:text-xs text-sushi-silver opacity-70">
                            {{ product.currency }}
                        </span>
                    </div>
                </div>

                <!-- Кнопки корзины -->
                <div class="h-[34px] flex items-center">
                    <button
                        v-if="!itemInCart"
                        @click.stop="addToCart"
                        class="h-full px-2 md:px-3 bg-sushi-red hover:bg-sushi-red/80 text-white rounded-lg text-[12px] md:text-sm font-medium shadow-md whitespace-nowrap md:transition-all md:duration-300 md:hover:scale-105 md:active:scale-95 md:hover:shadow-lg"
                    >
                        {{ t.home_menu_in_cart }}
                    </button>

                    <div
                        v-else
                        class="h-full flex items-center gap-0.5 md:gap-1 bg-sushi-dark border border-sushi-gold border-opacity-30 rounded-lg overflow-hidden"
                    >
                        <button
                            @click.stop="decrementQuantity"
                            class="h-full px-2 md:px-3 bg-sushi-red/20 hover:bg-sushi-red/40 text-sushi-gold text-xs md:text-base font-bold transition-colors duration-200"
                        >
                            −
                        </button>

                        <span class="px-2 md:px-3 text-xs md:text-sm font-bold text-sushi-gold">
                            {{ itemInCart.quantity }}
                        </span>

                        <button
                            @click.stop="incrementQuantity"
                            class="h-full px-2 md:px-3 bg-sushi-red/20 hover:bg-sushi-red/40 text-sushi-gold text-xs md:text-base font-bold transition-colors duration-200"
                        >
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { router, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import { useCartStore } from '@/Stores/cart'

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    })

    const page = usePage()
    const t = page.props.translations.common
    const locale = computed(() => page.props.current_locale || 'ru')

    const cartStore = useCartStore()

    const itemInCart = computed(() => {
        return cartStore.getCartItem(props.product.id)
    })

    /**
     * Promotions (MVP for UI)
     * ожидаем с бэка:
     * - product.has_promotion (bool)
     * - product.promotion_type ('discount'|'gift'|null)
     * - product.final_price (string/number) для скидки
     * - product.gift_product { name, quantity } для подарка
     */
    const hasPromotion = computed(() => !!props.product.has_promotion)
    const isDiscount = computed(() => hasPromotion.value && props.product.promotion_type === 'discount')
    const isGift = computed(() => hasPromotion.value && props.product.promotion_type === 'gift')

    const displayPrice = computed(() => {
        if (isDiscount.value && props.product.final_price != null && props.product.final_price !== '') {
            return props.product.final_price
        }
        return props.product.price
    })

    const savingAmount = computed(() => {
        if (!isDiscount.value) return ''
        const base = Number(props.product.price || 0)
        const final = Number(props.product.final_price || 0)
        const diff = base - final
        return diff > 0 ? diff.toFixed(0) : '0'
    })

    const giftName = computed(() => props.product.gift_product?.name || '')
    const giftQty = computed(() => props.product.gift_product?.quantity || null)

    const goToProduct = () => {
        router.visit(
            route('product.show', {
                locale: locale.value,
                slug: props.product.slug,
            })
        )
    }

    const goToGiftProduct = () => {
        if (!props.product.gift_product?.slug) return

        router.visit(
            route('product.show', {
                locale: locale.value,
                slug: props.product.gift_product.slug,
            })
        )
    }

    const addToCart = () => {
        cartStore.addToCart(props.product)
    }

    const incrementQuantity = () => {
        cartStore.incrementQuantity(props.product.id)
    }

    const decrementQuantity = () => {
        cartStore.decrementQuantity(props.product.id)
    }
</script>
