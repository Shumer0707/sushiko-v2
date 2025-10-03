<script setup>
    import { ref, onMounted, onUnmounted } from 'vue'

    const isVisible = ref(false)

    function handleScroll() {
        // Показываем кнопку после 200px прокрутки
        isVisible.value = window.scrollY > 200
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth', // Плавная прокрутка
        })
    }

    onMounted(() => {
        window.addEventListener('scroll', handleScroll)
    })

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll)
    })
</script>

<template>
    <!-- Кнопка появляется только когда isVisible = true -->
    <Transition name="fade-slide">
        <button
            v-if="isVisible"
            @click="scrollToTop"
            class="fixed bottom-8 right-8 z-50 w-14 h-14 bg-sushi-gold/80 text-sushi-dark rounded-full shadow-2xl hover:bg-opacity-90 hover:scale-110 transition-all duration-300 flex items-center justify-center group"
            aria-label="Наверх"
        >
            <i class="fas fa-arrow-up text-2xl group-hover:animate-bounce"></i>
        </button>
    </Transition>
</template>

<style scoped>
    /* Анимация появления/исчезновения */
    .fade-slide-enter-active,
    .fade-slide-leave-active {
        transition: all 0.3s ease;
    }

    .fade-slide-enter-from {
        opacity: 0;
        transform: translateY(20px);
    }

    .fade-slide-leave-to {
        opacity: 0;
        transform: translateY(20px);
    }
</style>
