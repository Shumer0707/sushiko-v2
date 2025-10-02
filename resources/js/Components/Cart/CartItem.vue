<!-- Components/Cart/CartItem.vue -->
<template>
    <div class="bg-sushi-dark/50 border border-sushi-first rounded-lg p-4 hover:border-sushi-gold/50 transition-colors">
        <!-- Контейнер: на мобилке колонка, на десктопе строка -->
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
                    <p class="text-sm text-sushi-silver/60 mt-1">{{ item.product.price }} {{ item.product.currency }}</p>
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
                    title="Удалить"
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
    import { Link } from '@inertiajs/vue3'
    import { computed } from 'vue'

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

    const itemTotal = computed(() => {
        return (props.item.product.price * props.item.quantity).toFixed(2)
    })
</script>
