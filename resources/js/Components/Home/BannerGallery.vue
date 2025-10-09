<template>
    <div class="banner-gallery w-full">
        <!-- Swiper контейнер -->
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
            <!-- Каждый баннер - это SwiperSlide -->
            <SwiperSlide v-for="banner in displayBanners" :key="banner.id" class="relative">
                <!-- Картинка баннера -->
                <div class="relative h-[500px] md:h-[600px] lg:h-[700px] overflow-hidden">
                    <img :src="banner.image" :alt="banner.title" class="w-full h-full object-cover" />

                    <!-- Overlay для лучшей читаемости текста - используем sushi-dark -->
                    <div class="absolute inset-0 bg-sushi-dark bg-opacity-40"></div>

                    <!-- Контент баннера -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white px-4 max-w-4xl">
                            <h2 class="font-display text-3xl md:text-5xl font-bold mb-4">
                                {{ banner.title }}
                            </h2>
                            <p class="text-lg md:text-xl mb-6 opacity-90">
                                {{ banner.description }}
                            </p>

                            <!-- Кнопка - золотая с красным ховером -->
                            <button
                                v-if="banner.buttonText"
                                @click="handleBannerClick(banner)"
                                class="bg-sushi-gold hover:bg-sushi-red text-sushi-dark hover:text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl"
                            >
                                {{ banner.buttonText }}
                            </button>
                        </div>
                    </div>
                </div>
            </SwiperSlide>
        </Swiper>
    </div>
</template>

<script setup>
    // Импорты для Swiper 12
    import { Swiper, SwiperSlide } from 'swiper/vue'
    import { Navigation, Pagination, Autoplay } from 'swiper/modules'
    import { router, usePage } from '@inertiajs/vue3'

    // Импортируем стили Swiper 12
    import 'swiper/css'
    import 'swiper/css/navigation'
    import 'swiper/css/pagination'

    const page = usePage()
    const t = page.props.translations.common

    // Подключаем нужные модули
    const modules = [Navigation, Pagination, Autoplay]

    // Пропсы компонента
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
                      image: '/images/banners/header-4.webp',
                      buttonText: t.home_ban_button_2,
                      link: '/catalog',
                  },
                  {
                      id: 3,
                      title: t.home_ban_title_3,
                      description: t.home_ban_description_3,
                      image: '/images/banners/header-5.webp',
                      buttonText: t.home_ban_button_3,
                      link: '/about',
                  },
                  {
                      id: 4,
                      title: t.home_ban_title_4,
                      description: t.home_ban_description_4,
                      image: '/images/banners/header-8.webp',
                      buttonText: t.home_ban_button_4,
                      link: '/catalog',
                  },
                  {
                      id: 5,
                      title: t.home_ban_title_5,
                      description: t.home_ban_description_5,
                      image: '/images/banners/header-7.webp',
                      buttonText: t.home_ban_button_5,
                      link: '/about',
                  },
              ]
    // Если пропсы пустые, используем дефолтные тестовые баннеры
    const displayBanners =
        props.banners.length > 0
            ? props.banners
            : bannersDefolt

    // Функция клика по баннеру
    const handleBannerClick = (banner) => {
        if (banner.link) {
            // Если есть внешняя ссылка
            if (banner.link.startsWith('http')) {
                window.open(banner.link, '_blank')
            } else {
                // Внутренняя навигация через Inertia
                router.visit(banner.link)
            }
        }
    }
</script>

<style scoped>
    .banner-gallery {
        width: 100%;
        margin: 0;
    }

    .banner-swiper {
        /* Используем нашу суши-палитру */
        --swiper-navigation-color: rgba(212, 175, 55); /* золото */
        --swiper-pagination-color: rgba(212, 175, 55); /* золото */
        --swiper-navigation-size: 24px;
        cursor: grab;
    }

    /* Когда тянешь слайд */
    .banner-swiper:active {
        cursor: grabbing;
    }

    /* Стилизуем стрелки навигации - тёмный фон */
    .banner-swiper :deep(.swiper-button-next),
    .banner-swiper :deep(.swiper-button-prev) {
        /* background: rgba(17, 13, 14, 0.6); */
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .banner-swiper :deep(.swiper-button-next):hover,
    .banner-swiper :deep(.swiper-button-prev):hover {
        /* background: rgba(212, 175, 55, 0.9); */
        transform: scale(1.1);
    }

    /* Стилизуем пагинацию (точки) */
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
        background: rgba(212, 175, 55, 0.7); /* золото при ховере */
        transform: scale(1.1);
    }

    .banner-swiper :deep(.swiper-pagination-bullet-active) {
        background: rgba(212, 175, 55, 1); /* золото для активной точки */
        transform: scale(1.2);
    }

    /* Адаптивность для мобильных */
    @media (max-width: 768px) {
        .banner-swiper :deep(.swiper-button-next),
        .banner-swiper :deep(.swiper-button-prev) {
            width: 40px;
            height: 40px;
            --swiper-navigation-size: 20px;
        }
    }
</style>
