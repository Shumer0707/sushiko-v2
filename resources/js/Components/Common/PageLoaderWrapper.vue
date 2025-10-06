<script setup>
    defineProps({
        loading: {
            type: Boolean,
            default: false,
        },
    })
</script>

<template>
    <div class="relative">
        <!-- Лоадер (показывается пока loading = true) -->
        <Transition name="fade">
            <div v-if="loading" class="min-h-screen flex items-center justify-center bg-sushi-first relative">
                <!-- Фоновый паттерн -->
                <div
                    class="absolute inset-0 opacity-10"
                    style="background-image: url('/images/sushi-pattern.jpg'); background-size: cover"
                ></div>

                <!-- Градиент поверх -->
                <div class="absolute inset-0 bg-gradient-to-b from-sushi-first via-transparent to-sushi-first"></div>

                <!-- Контент лоадера -->
                <div class="relative z-10 text-center">
                    <!-- Крутящаяся креветка -->
                    <div class="mb-6 animate-spin-slow">
                        <span class="text-8xl block" style="filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.5))">🍤</span>
                    </div>

                    <!-- Текст -->
                    <h2 class="text-2xl md:text-3xl font-bold text-sushi-gold mb-3 animate-pulse">SUSHIKO</h2>
                    <p class="text-white text-lg">Готовим вкусняшки...</p>

                    <!-- Анимированные точки -->
                    <div class="mt-4 flex justify-center gap-2">
                        <span class="w-3 h-3 bg-sushi-gold rounded-full animate-bounce" style="animation-delay: 0s"></span>
                        <span class="w-3 h-3 bg-sushi-gold rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                        <span class="w-3 h-3 bg-sushi-gold rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- Основной контент (показывается когда loading = false) -->
        <Transition name="fade-up">
            <div v-if="!loading">
                <slot />
            </div>
        </Transition>
    </div>
</template>

<style scoped>
    /* Медленное вращение для креветки */
    @keyframes spin-slow {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin-slow {
        animation: spin-slow 3s linear infinite;
    }

    /* Анимация появления контента */
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }

    .fade-up-enter-active {
        transition: all 0.6s ease;
    }

    .fade-up-enter-from {
        opacity: 0;
        transform: translateY(20px);
    }
</style>
