<template>
    <div class="banner-gallery w-full">
        <Swiper
            :modules="modules"
            :slides-per-view="1"
            :space-between="0"
            :loop="displayBanners.length > 1"
            :autoplay="{
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            }"
            :speed="800"
            :navigation="displayBanners.length > 1"
            :pagination="displayBanners.length > 1 ? { clickable: true } : false"
            :grab-cursor="true"
            class="banner-swiper"
        >
            <SwiperSlide v-for="(banner, index) in displayBanners" :key="banner.id" class="relative">
                <div class="relative h-[500px] md:h-[600px] lg:h-[700px] overflow-hidden">
                    <picture>
                        <source :srcset="getBannerSrc(banner, 'mobile')" media="(max-width: 768px)" />

                        <img
                            :src="getBannerSrc(banner, 'desktop')"
                            :alt="banner.title || 'Banner'"
                            class="w-full h-full object-fill md:object-cover"
                            :loading="index === 0 ? 'eager' : 'lazy'"
                            :fetchpriority="index === 0 ? 'high' : 'auto'"
                            decoding="async"
                            @load="index === 0 && notifyPageReady()"
                        />
                    </picture>

                    <div
                        class="absolute inset-0 bg-sushi-dark"
                        :style="{ opacity: getOverlayOpacity(banner) }"
                    ></div>

                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white px-4 max-w-4xl">
                            <h2 v-if="banner.title" class="font-display text-3xl md:text-5xl font-bold mb-4">
                                {{ banner.title }}
                            </h2>
                            <p v-if="banner.description" class="text-lg md:text-xl mb-6 opacity-90">
                                {{ banner.description }}
                            </p>

                            <!--
                            <button
                                v-if="banner.buttonText"
                                @click="handleBannerClick(banner)"
                                class="bg-sushi-gold hover:bg-sushi-red text-sushi-dark hover:text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl"
                            >
                                {{ banner.buttonText }}
                            </button>
                            -->
                        </div>
                    </div>
                </div>
            </SwiperSlide>
        </Swiper>
    </div>
</template>

<script setup>
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

    let firstBannerReady = false

    const notifyPageReady = () => {
        if (firstBannerReady) return
        firstBannerReady = true

        if (typeof window !== 'undefined') {
            window.dispatchEvent(new Event('sushi:page-ready'))
        }
    }

    const bannersDefolt = [
        {
            id: 1,
            title: t.home_ban_title_1,
            description: t.home_ban_description_1,
            imageDesktop: '/images/banners/header-1-1920.webp',
            imageMobile: '/images/banners/header-1-768.webp',
            buttonText: t.home_ban_button_1,
            link: '/catalog',
            openInNewTab: false,
        },
        {
            id: 2,
            title: t.home_ban_title_2,
            description: t.home_ban_description_2,
            imageDesktop: '/images/banners/header-2-1920.webp',
            imageMobile: '/images/banners/header-2-768.webp',
            buttonText: t.home_ban_button_2,
            link: '/catalog',
            openInNewTab: false,
        },
        {
            id: 3,
            title: t.home_ban_title_3,
            description: t.home_ban_description_3,
            imageDesktop: '/images/banners/header-4-1920.webp',
            imageMobile: '/images/banners/header-4-768.webp',
            buttonText: t.home_ban_button_3,
            link: '/about',
            openInNewTab: false,
        },
    ]

    const usingFallbackBanners = props.banners.length === 0
    const displayBanners = usingFallbackBanners ? bannersDefolt : props.banners

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

    const getOverlayOpacity = (banner) => {
        if (usingFallbackBanners) {
            return 0.2
        }

        const opacity = Number(banner.overlayOpacity ?? 0)

        if (Number.isNaN(opacity)) {
            return 0
        }

        return Math.min(Math.max(opacity, 0), 100) / 100
    }

    const handleBannerClick = (banner) => {
        if (!banner.link) return

        if (banner.link.startsWith('http')) {
            window.open(banner.link, banner.openInNewTab ? '_blank' : '_self')
            return
        }

        router.visit(banner.link)
    }
</script>

<style scoped>
    .banner-gallery {
        width: 100%;
        margin: 0;
    }

    .banner-swiper {
        --swiper-navigation-color: rgba(212, 175, 55);
        --swiper-pagination-color: rgba(212, 175, 55);
        --swiper-navigation-size: 24px;
        cursor: grab;
    }

    .banner-swiper:active {
        cursor: grabbing;
    }

    .banner-swiper :deep(.swiper-button-next),
    .banner-swiper :deep(.swiper-button-prev) {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .banner-swiper :deep(.swiper-button-next):hover,
    .banner-swiper :deep(.swiper-button-prev):hover {
        transform: scale(1.1);
    }

    .banner-swiper :deep(.swiper-pagination) {
        bottom: 20px;
        cursor: pointer;
    }

    .banner-swiper :deep(.swiper-pagination-bullet) {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .banner-swiper :deep(.swiper-pagination-bullet):hover {
        background: rgba(212, 175, 55, 0.7);
        transform: scale(1.1);
    }

    .banner-swiper :deep(.swiper-pagination-bullet-active) {
        background: rgba(212, 175, 55, 1);
        transform: scale(1.2);
    }

    @media (max-width: 768px) {
        .banner-swiper :deep(.swiper-button-next),
        .banner-swiper :deep(.swiper-button-prev) {
            width: 40px;
            height: 40px;
            --swiper-navigation-size: 20px;
        }
    }
</style>
