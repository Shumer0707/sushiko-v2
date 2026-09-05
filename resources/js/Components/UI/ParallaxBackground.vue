<script setup>
    import { ref, onMounted, onUnmounted } from 'vue'
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

    const mobileMediaQuery = typeof window !== 'undefined' ? window.matchMedia('(max-width: 767px)') : null
    const isMobile = ref(mobileMediaQuery?.matches ?? false)
    const mobileImage = ref(null)

    // на мобилках показываем случайную картинку
    const pickRandomMobileImage = () => {
        const arr = props.images
        if (arr.length === 0) return

        const rand = arr[Math.floor(Math.random() * arr.length)]
        mobileImage.value = rand
    }

    const handleViewportChange = (event) => {
        isMobile.value = event.matches

        if (isMobile.value && !mobileImage.value) {
            pickRandomMobileImage()
        }
    }

    if (isMobile.value) {
        pickRandomMobileImage()
    }

    onMounted(() => {
        if (mobileMediaQuery?.addEventListener) {
            mobileMediaQuery.addEventListener('change', handleViewportChange)
        } else {
            mobileMediaQuery?.addListener(handleViewportChange)
        }

        if (isMobile.value && !mobileImage.value) {
            pickRandomMobileImage()
        }
    })

    onUnmounted(() => {
        if (mobileMediaQuery?.removeEventListener) {
            mobileMediaQuery.removeEventListener('change', handleViewportChange)
        } else {
            mobileMediaQuery?.removeListener(handleViewportChange)
        }
    })

    // параллакс только для десктопа
    const backgroundRef = useParallaxBackground(props.speed)

    // Две дополнительные панели страхуют короткие экраны на длинной странице без тройного повторения всей ленты.
    const backgroundImages = [...props.images, ...props.images.slice(0, 2)]
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
            <div v-for="(image, index) in backgroundImages" :key="`${image}-${index}`" class="image-card">
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

    .image-card {
        contain: layout paint;
    }

    .image-content {
        width: 100%;
        height: 100vh;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        border-bottom: 10px solid red;
    }

    /* ======= Mobile Static BG (random) ======= */
    .mobile-bg {
        width: 100%;
        height: 100%;
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
