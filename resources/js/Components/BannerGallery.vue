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

                    <!-- Overlay для лучшей читаемости текста -->
                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>

                    <!-- Контент баннера -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center text-white px-4 max-w-4xl">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">
                                {{ banner.title }}
                            </h2>
                            <p class="text-lg md:text-xl mb-6 opacity-90">
                                {{ banner.description }}
                            </p>

                            <!-- Кнопка если нужна -->
                            <button
                                v-if="banner.buttonText"
                                @click="handleBannerClick(banner)"
                                class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-300"
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
    import { router } from '@inertiajs/vue3'

    // Импортируем стили Swiper 12
    import 'swiper/css'
    import 'swiper/css/navigation'
    import 'swiper/css/pagination'

    // Подключаем нужные модули
    // Navigation - стрелки влево/вправо
    // Pagination - точки-индикаторы внизу
    // Autoplay - автоматическая прокрутка
    const modules = [Navigation, Pagination, Autoplay]

    // Пропсы компонента
    const props = defineProps({
        banners: {
            type: Array,
            default: () => [],
        },
    })

    // Если пропсы пустые, используем дефолтные тестовые баннеры
    const displayBanners =
        props.banners.length > 0
            ? props.banners
            : [
                  {
                      id: 1,
                      title: 'Добро пожаловать в Sushiko!',
                      description: 'Лучшие суши в Кишиневе. Свежие ингредиенты, традиционные рецепты',
                      image: '/images/banners/sushi-banner-1.jpg',
                      buttonText: 'Посмотреть меню',
                      link: '/catalog',
                  },
                  {
                      id: 2,
                      title: 'Бесплатная доставка',
                      description: 'При заказе от 500 лей доставляем бесплатно по всему Кишиневу',
                      image: '/images/banners/delivery-banner.jpg',
                      buttonText: 'Заказать сейчас',
                      link: '/catalog',
                  },
                  {
                      id: 3,
                      title: 'Свежие роллы каждый день',
                      description: 'Готовим роллы только из свежих продуктов. Никаких заморозок!',
                      image: '/images/banners/fresh-rolls-banner.jpg',
                      buttonText: 'Узнать больше',
                      link: '/about',
                  },
                  {
                      id: 4,
                      title: 'Специальные предложения',
                      description: 'Каждую неделю новые акции и специальные комбо-наборы',
                      image: '/images/banners/special-banner.jpg',
                      buttonText: 'Смотреть акции',
                      link: '/catalog',
                  },
                  {
                      id: 5,
                      title: 'Японская кухня',
                      description: 'Аутентичные рецепты от наших японских шеф-поваров',
                      image: '/images/banners/japanese-banner.jpg',
                      buttonText: 'Узнать больше',
                      link: '/about',
                  },
              ]

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

        // Можно добавить аналитику
        console.log('Banner clicked:', banner.title)
    }
</script>

<style scoped>
    /* Кастомные стили для Swiper */
    .banner-gallery {
        /* Растягиваем на всю ширину экрана */
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
    }

    .banner-swiper {
        --swiper-navigation-color: #fff;
        --swiper-pagination-color: #dc2626;
        --swiper-navigation-size: 24px;
        cursor: grab;
    }

    /* Когда тянешь слайд */
    .banner-swiper:active {
        cursor: grabbing;
    }

    /* Стилизуем стрелки навигации */
    .banner-swiper :deep(.swiper-button-next),
    .banner-swiper :deep(.swiper-button-prev) {
        background: rgba(0, 0, 0, 0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .banner-swiper :deep(.swiper-button-next):hover,
    .banner-swiper :deep(.swiper-button-prev):hover {
        background: rgba(0, 0, 0, 0.7);
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
        background: rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .banner-swiper :deep(.swiper-pagination-bullet):hover {
        background: rgba(255, 255, 255, 0.8);
        transform: scale(1.1);
    }

    .banner-swiper :deep(.swiper-pagination-bullet-active) {
        background: #dc2626;
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
