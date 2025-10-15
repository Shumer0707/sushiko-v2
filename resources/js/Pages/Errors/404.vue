<script setup>
    import { ref, onMounted } from 'vue'
    import { router, usePage } from '@inertiajs/vue3'
    import AppHead from '@/Components/Seo/Head.vue'
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'

    const page = usePage()
    const t = page.props.translations.common

    // Рандомная эмодзи суши для веселья
    const sushiEmojis = ['🍣', '🍱', '🍤', '🍙', '🥢']
    const randomEmoji = ref('🍣')

    onMounted(() => {
        randomEmoji.value = sushiEmojis[Math.floor(Math.random() * sushiEmojis.length)]
    })

    const goHome = () => {
        router.visit(route('home', { locale: page.props.locale }))
    }

    const goBack = () => {
        window.history.back()
    }
</script>

<template>
    <AppHead :title="t.error_404_title" :description="t.error_404_description" />

    <!-- Фон с параллаксом -->
    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.3" :speed="0.2" max-height="100vh" />

    <!-- Градиент поверх -->
    <PageGradient />

    <!-- Контент 404 -->
    <div class="relative z-20 min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-2xl">
            <!-- Большая эмодзи -->
            <div class="mb-6">
                <span class="text-9xl block" style="filter: drop-shadow(0 0 30px rgba(212, 175, 55, 0.6))">
                    {{ randomEmoji }}
                </span>
            </div>

            <!-- Код ошибки -->
            <h1 class="text-8xl md:text-9xl font-bold text-sushi-gold mb-4">404</h1>

            <!-- Заголовок -->
            <h2 class="text-2xl md:text-4xl font-bold text-white mb-4">
                {{ t.error_404_heading }}
            </h2>

            <!-- Описание -->
            <p class="text-lg text-sushi-silver mb-8 max-w-md mx-auto">
                {{ t.error_404_text }}
            </p>

            <!-- Кнопки -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <!-- Кнопка "На главную" -->
                <button
                    @click="goHome"
                    class="px-8 py-4 bg-sushi-red hover:bg-sushi-red/90 text-white font-bold rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg"
                >
                    <i class="fas fa-home mr-2"></i>
                    {{ t.error_404_button_home }}
                </button>

                <!-- Кнопка "Назад" -->
                <button
                    @click="goBack"
                    class="px-8 py-4 bg-sushi-dark border-2 border-sushi-gold hover:bg-sushi-gold/20 text-sushi-gold font-bold rounded-lg transition-all duration-300 hover:scale-105 active:scale-95 shadow-lg"
                >
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ t.error_404_button_back }}
                </button>
            </div>

            <!-- Дополнительная инфа -->
            <div class="mt-12 text-sm text-sushi-silver opacity-70">
                <p>{{ t.error_404_hint }}</p>
            </div>
        </div>
    </div>
</template>
