<script setup>
    import { ref, onMounted } from 'vue'
    import { useParallaxBackground } from '@/composables/useParallaxBackground'

    const props = defineProps({
        images: {
            type: Array,
            default: () => ['/images/s-1.webp', '/images/s-3.webp', '/images/s-5.webp', '/images/s-7.webp', '/images/s-15.webp'],
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

    const isMobile = ref(false)
    const mobileImage = ref(null)

    // на мобилках показываем случайную картинку
    const pickRandomMobileImage = () => {
        const arr = props.images
        const rand = arr[Math.floor(Math.random() * arr.length)]
        mobileImage.value = rand
    }

    onMounted(() => {
        if (typeof window !== 'undefined') {
            isMobile.value = window.innerWidth < 768
            if (isMobile.value) {
                pickRandomMobileImage()
            }
        }
    })

    // параллакс только для десктопа
    const backgroundRef = useParallaxBackground(props.speed)

    // повторяем ленту как у тебя было
    const repeatedImages = [...props.images, ...props.images, ...props.images]
</script>

<template>
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <!-- 📱 Мобильная версия: статичный фон + рандом -->
        <div
            v-if="isMobile"
            class="mobile-bg"
            :style="{
                backgroundImage: `url(${mobileImage})`,
                opacity: opacity,
            }"
        ></div>

        <!-- 💻 Десктопная версия: параллакс -->
        <div v-else :ref="backgroundRef" class="image-strip" :style="{ opacity: opacity }">
            <div v-for="(image, index) in repeatedImages" :key="index" class="image-card">
                <div class="image-content" :style="{ backgroundImage: `url(${image})` }"></div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    /* ======= Desktop Parallax ======= */
    .image-strip {
        position: absolute;
        top: -100%;
        left: 0;
        width: 100%;
        will-change: transform;
    }

    .image-content {
        width: 100%;
        height: 100vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* ======= Mobile Static BG (random) ======= */
    .mobile-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
