<script setup>
    import { ref, onMounted } from 'vue'
    import { Swiper, SwiperSlide } from 'swiper/vue'
    import { Navigation, Pagination, Autoplay } from 'swiper/modules'
    import { router, usePage } from '@inertiajs/vue3'

    import 'swiper/css'
    import 'swiper/css/navigation'
    import 'swiper/css/pagination'

    const page = usePage()
    const t = page.props.translations.common

    const modules = [Navigation, Pagination, Autoplay]

    const props = defineProps({
        banners: {
            type: Array,
            default: () => [],
        },
    })

    const bannersDefolt = [
        {
            id: 1,
            title: t.home_ban_title_1,
            description: t.home_ban_description_1,
            image: '/images/banners/header-1.webp',
            buttonText: t.home_ban_button_1,
            link: '/catalog',
        },
        {
            id: 2,
            title: t.home_ban_title_2,
            description: t.home_ban_description_2,
            image: '/images/banners/header-2.webp',
            buttonText: t.home_ban_button_2,
            link: '/catalog',
        },
        {
            id: 3,
            title: t.home_ban_title_3,
            description: t.home_ban_description_3,
            image: '/images/banners/header-4.webp',
            buttonText: t.home_ban_button_3,
            link: '/about',
        },
    ]

    const displayBanners = props.banners.length > 0 ? props.banners : bannersDefolt

    // 👇 Определяем мобилку один раз, без resize
    const isMobile = ref(false)

    onMounted(() => {
        if (typeof window !== 'undefined') {
            isMobile.value = window.innerWidth < 768
        }
    })

    // 👇 Хелпер картинок
    const getBannerSrc = (banner, type = 'desktop') => {
        if (type === 'mobile' && banner.imageMobile) return banner.imageMobile
        if (type === 'desktop' && banner.imageDesktop) return banner.imageDesktop

        const base = banner.image || ''
        const [path, query] = base.split('?')
        const dotIndex = path.lastIndexOf('.')

        if (dotIndex === -1) return base

        const suffix = type === 'mobile' ? '-768' : '-1920'
        const withSuffix = path.slice(0, dotIndex) + suffix + path.slice(dotIndex)

        return query ? `${withSuffix}?${query}` : withSuffix
    }

    const handleBannerClick = (banner) => {
        if (banner.link) {
            if (banner.link.startsWith('http')) {
                window.open(banner.link, '_blank')
            } else {
                router.visit(banner.link)
            }
        }
    }
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
        border-bottom: 10px solid red;
    }

    /* ======= Mobile Static BG (random) ======= */
    .mobile-bg {
        width: 432px;
        height: 768px;
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
