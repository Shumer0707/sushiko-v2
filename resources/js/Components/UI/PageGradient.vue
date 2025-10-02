<script setup>
    /**
     * PageGradient - компонент градиента для переиспользования
     *
     * Props:
     * - color: основной цвет градиента (по умолчанию sushi-first из tailwind)
     * - opacity: массив значений прозрачности [top, mid1, mid2, mid3, bottom]
     * - zIndex: z-index слоя (по умолчанию 1)
     */

    const props = defineProps({
        // Цвет градиента (RGB формат)
        color: {
            type: String,
            default: '52, 48, 47', // rgb значения из sushi-first
        },
        // Прозрачность в ключевых точках градиента [0%, 30%, 50%, 70%, 100%]
        opacity: {
            type: Array,
            default: () => [1, 0, 0.3, 0.7, 1],
        },
        // Z-index слоя
        zIndex: {
            type: Number,
            default: 1,
        },
    })

    // Формируем градиент из пропсов
    const gradientStyle = {
        background: `linear-gradient(
            to bottom,
            rgba(${props.color}, ${props.opacity[0]}) 0%,
            rgba(${props.color}, ${props.opacity[1]}) 30%,
            rgba(${props.color}, ${props.opacity[2]}) 50%,
            rgba(${props.color}, ${props.opacity[3]}) 70%,
            rgba(${props.color}, ${props.opacity[4]}) 100%
        )`,
        zIndex: props.zIndex,
    }
</script>

<template>
    <!--
        Градиентный оверлей на всю страницу
        position: fixed - фиксированная позиция (не скроллится)
        pointer-events: none - не блокирует клики
    -->
    <div class="page-gradient" :style="gradientStyle"></div>
</template>

<style scoped>
    .page-gradient {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        pointer-events: none; /* не блокирует клики по контенту */
    }
</style>
