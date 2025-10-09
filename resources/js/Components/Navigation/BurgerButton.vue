<template>
    <button
        @click="$emit('toggle')"
        class="burger-button lg:hidden text-white p-2 hover:bg-gray-700 rounded transition-colors touch-manipulation"
        aria-label="Меню"
    >
        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <!-- Верхняя линия -->
            <line
                ref="topLine"
                :x1="coords.top.x1"
                :y1="coords.top.y1"
                :x2="coords.top.x2"
                :y2="coords.top.y2"
                stroke-width="2"
                stroke-linecap="round"
            />

            <!-- Средняя линия -->
            <line
                ref="middleLine"
                x1="4"
                y1="12"
                x2="20"
                y2="12"
                stroke-width="2"
                stroke-linecap="round"
                :style="{ opacity: coords.middle.opacity }"
            />

            <!-- Нижняя линия -->
            <line
                ref="bottomLine"
                :x1="coords.bottom.x1"
                :y1="coords.bottom.y1"
                :x2="coords.bottom.x2"
                :y2="coords.bottom.y2"
                stroke-width="2"
                stroke-linecap="round"
            />
        </svg>
    </button>
</template>

<script setup>
    import { reactive, watch } from 'vue'

    const props = defineProps({
        isOpen: {
            type: Boolean,
            required: true,
        },
    })

    defineEmits(['toggle'])

    // Реактивные координаты
    const coords = reactive({
        top: { x1: 4, y1: 6, x2: 20, y2: 6 },
        middle: { opacity: 1 },
        bottom: { x1: 4, y1: 18, x2: 20, y2: 18 },
    })

    // Функция плавной анимации
    function animateValue(obj, prop, from, to, duration = 300) {
        const startTime = performance.now()

        function update(currentTime) {
            const elapsed = currentTime - startTime
            const progress = Math.min(elapsed / duration, 1)

            // Easing function (ease-in-out)
            const eased = progress < 0.5 ? 2 * progress * progress : 1 - Math.pow(-2 * progress + 2, 2) / 2

            obj[prop] = from + (to - from) * eased

            if (progress < 1) {
                requestAnimationFrame(update)
            }
        }

        requestAnimationFrame(update)
    }

    // Следим за изменением isOpen
    watch(
        () => props.isOpen,
        (newVal) => {
            if (newVal) {
                // Открываем - превращаем в крестик
                animateValue(coords.top, 'x1', 4, 6)
                animateValue(coords.top, 'y2', 6, 18)
                animateValue(coords.top, 'x2', 20, 18)

                animateValue(coords.middle, 'opacity', 1, 0)

                animateValue(coords.bottom, 'x1', 4, 6)
                animateValue(coords.bottom, 'y2', 18, 6)
                animateValue(coords.bottom, 'x2', 20, 18)
            } else {
                // Закрываем - возвращаем в бургер
                animateValue(coords.top, 'x1', 6, 4)
                animateValue(coords.top, 'y2', 18, 6)
                animateValue(coords.top, 'x2', 18, 20)

                animateValue(coords.middle, 'opacity', 0, 1)

                animateValue(coords.bottom, 'x1', 6, 4)
                animateValue(coords.bottom, 'y2', 6, 18)
                animateValue(coords.bottom, 'x2', 18, 20)
            }
        }
    )
</script>

<style scoped>
    .burger-button {
        transition: background-color 0.2s ease;
    }
</style>
