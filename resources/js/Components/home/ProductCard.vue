<template>
    <div
        class="product-card bg-sushi-dark bg-opacity-80 backdrop-blur-sm rounded-xl overflow-hidden border border-sushi-gold border-opacity-20 hover:border-opacity-50 hover:shadow-2xl shadow-lg transition-all duration-300 group cursor-pointer"
    >
        <!-- Картинка товара - меньше -->
        <div @click="goToProduct" class="relative aspect-square overflow-hidden bg-sushi-first">
            <!-- Если есть картинка -->
            <img
                v-if="product.image_url"
                :src="product.image_url"
                :alt="product.name"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                loading="lazy"
            />

            <!-- Плейсхолдер если нет картинки -->
            <div v-else class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sushi-first to-sushi-dark">
                <div class="text-center">
                    <!-- Иконка суши -->
                    <div class="text-6xl mb-2 opacity-30">🍱</div>
                    <span class="text-sushi-gold text-sm opacity-50 font-medium">Фото скоро появится</span>
                </div>
            </div>

            <!-- Бейдж категории - золотой -->
            <div class="absolute top-2 left-2">
                <span
                    class="px-2 py-1 bg-sushi-dark bg-opacity-90 backdrop-blur-sm text-xs font-medium text-sushi-gold rounded-full border border-sushi-gold border-opacity-30"
                >
                    {{ product.category.name }}
                </span>
            </div>

            <!-- Overlay при наведении - золотой -->
            <div
                class="absolute inset-0 bg-gradient-to-t from-sushi-dark via-sushi-dark/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4"
            >
                <span class="text-sushi-gold font-semibold text-sm">Подробнее →</span>
            </div>
        </div>

        <!-- Информация о товаре - компактнее -->
        <div class="p-3">
            <!-- Название - меньше -->
            <h3
                @click="goToProduct"
                class="text-base font-semibold text-sushi-silver mb-2 line-clamp-2 min-h-[2.5rem] group-hover:text-sushi-gold transition-colors duration-300"
            >
                {{ product.name }}
            </h3>

            <!-- Короткое описание - меньше -->
            <p v-if="product.short_description" class="text-xs text-sushi-silver opacity-70 mb-3 line-clamp-2 min-h-[2rem]">
                {{ product.short_description }}
            </p>

            <!-- Цена и кнопка - компактнее -->
            <div class="flex items-center justify-between mt-3">
                <!-- Цена - золотая -->
                <div class="flex items-baseline gap-1">
                    <span class="text-xl font-bold text-sushi-gold">
                        {{ product.price }}
                    </span>
                    <span class="text-xs text-sushi-silver opacity-70">
                        {{ product.currency }}
                    </span>
                </div>

                <!-- Кнопка в корзину - красная -->
                <button
                    @click.stop="addToCart"
                    class="px-3 py-1.5 bg-sushi-red hover:bg-sushi-red/80 text-white rounded-lg text-sm font-medium transition-all duration-300 hover:scale-105 active:scale-95 shadow-md hover:shadow-lg"
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
