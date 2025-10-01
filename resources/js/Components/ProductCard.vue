<template>
    <div
        class="product-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer"
    >
        <!-- Картинка товара -->
        <div @click="goToProduct" class="relative aspect-square overflow-hidden bg-sushi-silver">
            <img
                :src="product.image_url"
                :alt="product.name"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                loading="lazy"
            />

            <!-- Бейдж категории -->
            <div class="absolute top-3 left-3">
                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-xs font-medium text-first_color rounded-full shadow-sm">
                    {{ product.category.name }}
                </span>
            </div>

            <!-- Overlay при наведении -->
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-6"
            >
                <span class="text-white font-medium">Подробнее →</span>
            </div>
        </div>

        <!-- Информация о товаре -->
        <div class="p-4">
            <!-- Название -->
            <h3
                @click="goToProduct"
                class="text-lg font-semibold text-first_color mb-2 line-clamp-2 min-h-[3.5rem] group-hover:text-second_color transition-colors duration-300"
            >
                {{ product.name }}
            </h3>

            <!-- Короткое описание -->
            <p v-if="product.short_description" class="text-sm text-sushi-dark_op mb-3 line-clamp-2 min-h-[2.5rem]">
                {{ product.short_description }}
            </p>

            <!-- Цена и кнопка -->
            <div class="flex items-center justify-between mt-4">
                <!-- Цена -->
                <div class="flex items-baseline gap-1">
                    <span class="text-2xl font-bold text-first_color">
                        {{ product.price }}
                    </span>
                    <span class="text-sm text-sushi-dark_op">
                        {{ product.currency }}
                    </span>
                </div>

                <!-- Кнопка в корзину -->
                <button
                    @click.stop="addToCart"
                    class="px-4 py-2 bg-third_color hover:bg-third_color/90 text-white rounded-lg font-medium transition-all duration-300 hover:scale-105 active:scale-95"
                >
                    В корзину
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { router } from '@inertiajs/vue3'

    // Пропсы
    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    })

    // Переход на страницу товара
    const goToProduct = () => {
        router.visit(`/product/${props.product.slug}`)
    }

    // Добавить в корзину
    const addToCart = () => {
        // Тут будет логика добавления в корзину через Pinia store
        console.log('Add to cart:', props.product)

        // Можно показать уведомление
        // toast.success(`${props.product.name} добавлен в корзину`)

        // Пока что просто логируем
        alert(`${props.product.name} добавлен в корзину!`)
    }
</script>
