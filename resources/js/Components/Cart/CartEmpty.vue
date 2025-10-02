<!-- Components/Cart/CartEmpty.vue -->
<template>
    <div class="text-center py-12 sm:py-16 px-4">
        <div class="text-5xl sm:text-6xl mb-4">🛒</div>
        <h2 class="text-xl sm:text-2xl font-bold text-sushi-silver mb-4">Корзина пуста</h2>
        <p class="text-sushi-silver/60 mb-6 text-sm sm:text-base">Добавьте товары из каталога</p>
        <Link
            :href="route('home', { locale: locale })"
            class="inline-block bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark px-6 py-3 rounded-lg font-medium transition-colors"
        >
            Перейти в каталог
        </Link>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        locale: {
            type: String,
            required: true,
        },
    })
</script>
