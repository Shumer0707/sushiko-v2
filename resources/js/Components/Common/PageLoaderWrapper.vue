<!-- PageLoaderWrapper.vue -->
<script setup>
    import { ref, watch, onMounted } from 'vue'

    const props = defineProps({
        loading: {
            type: Boolean,
            default: false,
        },
    })

    // 🔥 Убираем showContent - он не нужен!
    onMounted(() => {
        document.body.style.backgroundColor = 'rgb(52, 48, 47)'
    })
</script>

<template>
    <div class="relative">
        <!-- Лоадер -->
        <Transition name="fade">
            <div v-if="loading" class="fixed inset-0 z-20 flex items-center justify-center bg-sushi-first">
                <div
                    class="absolute inset-0 opacity-10"
                    style="background-image: url('/images/sushi-pattern.jpg'); background-size: cover"
                ></div>

                <div class="absolute inset-0 bg-gradient-to-b from-sushi-first via-transparent to-sushi-first"></div>

                <div class="relative z-10 text-center">
                    <div class="mb-6 animate-spin-slow">
                        <span class="text-8xl block" style="filter: drop-shadow(0 0 20px rgba(212, 175, 55, 0.5))">🍤</span>
                    </div>

                    <h2 class="text-2xl md:text-3xl font-bold text-sushi-gold mb-3 animate-pulse">SUSHIKO</h2>
                    <p class="text-white text-lg">Готовим вкусняшки...</p>

                    <div class="mt-4 flex justify-center gap-2">
                        <span class="w-3 h-3 bg-sushi-gold rounded-full animate-bounce" style="animation-delay: 0s"></span>
                        <span class="w-3 h-3 bg-sushi-gold rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                        <span class="w-3 h-3 bg-sushi-gold rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- 🔥 Контент ВСЕГДА в DOM, как в старом проекте -->
        <div
            :class="{
                'opacity-0 pointer-events-none': loading,
                'opacity-100': !loading,
                'transition-opacity duration-500': true,
            }"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>
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

    /* Анимация лоадера */
    .fade-enter-active,
    .fade-leave-active {
        transition: opacity 0.5s ease;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }
</style>
