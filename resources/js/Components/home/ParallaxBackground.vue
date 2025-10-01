<script setup>
    import { useParallaxBackground } from '@/composables/useParallaxBackground'

    const props = defineProps({
        images: {
            type: Array,
            // Массив картинок - можно передать из Home.vue или использовать дефолтные
            default: () => [
                '/images/sinsai-1.webp',
                '/images/sinsai-3.webp',
                '/images/sinsai-5.webp',
                '/images/sinsai-7.webp',
                '/images/sinsai-15.webp',
            ],
        },
        opacity: {
            type: Number,
            default: 0.3,
        },
        speed: {
            type: Number,
            default: 0.15,
        },
    })

    const backgroundRef = useParallaxBackground(props.speed)

    // Дублируем картинки чтобы была бесконечная лента
    // (первый набор + второй набор + третий набор)
    const repeatedImages = [...props.images, ...props.images, ...props.images]
</script>

<template>
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <!-- Лента из картинок с параллаксом -->
        <div :ref="backgroundRef" class="image-strip" :style="{ opacity: opacity }">
            <!-- Каждая картинка в красивой рамке -->
            <div v-for="(image, index) in repeatedImages" :key="index" class="image-card">

                    <!-- Сама картинка -->
                    <div class="image-content" :style="{ backgroundImage: `url(${image})` }"></div>

            </div>
        </div>
    </div>
</template>

<style scoped>
    /* Лента из картинок */
    .image-strip {
        position: absolute;
        top: -100%; /* Большой запас для параллакса */
        left: 0;
        width: 100%;
        will-change: transform;
    }
    /* Сама картинка */
    .image-content {
        width: 100%;
        height: 100vh; /* Высота картинки */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-bottom: 10px solid red;
    }

    /* На мобилках */
    @media (max-width: 768px) {
        .image-strip {
            padding: 1rem;
        }

        .image-card {
            margin-bottom: 1.5rem;
        }

        .image-frame {
            border-width: 3px;
            padding: 0.75rem;
        }

        .image-content {
            height: 40vh; /* Меньше высота на мобилках */
        }
    }

    /* На планшетах */
    @media (min-width: 768px) and (max-width: 1024px) {
        .image-content {
            height: 50vh;
        }
    }
</style>
