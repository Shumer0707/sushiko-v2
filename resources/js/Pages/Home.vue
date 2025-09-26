<script setup>
    import AppHead from '@/Components/Seo/Head.vue'
</script>

<template>
    <AppHead title="Главная" description="Добро пожаловать в SUSHIKO - лучшие суши и роллы в Кишиневе" />

    <div class="space-y-8">
        <h1 class="text-4xl font-bold mb-4">Главная страница SUSHIKO</h1>
        <p class="text-lg">Добро пожаловать на наш сайт!</p>

        <!-- Много контента для тестирования -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div v-for="n in 10" :key="n" class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Блок контента {{ n }}</h2>
                <p class="text-gray-600 mb-4">
                    Это тестовый контент для проверки скролла. Мы делаем суши и роллы уже много лет.
                    Наши повара используют только свежие ингредиенты и традиционные рецепты.
                </p>
                <p class="text-gray-600 mb-4">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                    nostrud exercitation ullamco laboris.
                </p>
                <div class="h-32 bg-gray-100 rounded mb-4 flex items-center justify-center">
                    <span class="text-gray-500">Место для картинки суши {{ n }}</span>
                </div>
                <p class="text-gray-600">
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                    eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.
                </p>
            </div>
        </div>

        <!-- Еще больше контента -->
        <div class="bg-sushi-dark text-white p-8 rounded-lg">
            <h2 class="text-2xl font-bold mb-4">О нашем ресторане</h2>
            <p class="mb-4">Высокие блоки текста для длинного скролла...</p>
            <div class="space-y-4">
                <p v-for="i in 15" :key="i">
                    Параграф {{ i }}: Наш ресторан SUSHIKO предлагает широкий выбор японской кухни.
                    Мы гордимся качеством наших блюд и быстрой доставкой по Кишиневу.
                </p>
            </div>
        </div>
    </div>
</template>
