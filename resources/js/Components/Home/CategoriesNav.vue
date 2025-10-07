<template>
    <section class="categories-nav py-8 bg-gradient-to-b from-sushi-first/90 to-sushi-dark/90 container mx-auto rounded-xl">
        <div class="container mx-auto px-4">
            <!-- Заголовок секции - компактнее -->
            <div class="text-center mb-6">
                <h2 class="font-display text-2xl md:text-3xl font-bold text-sushi-gold mb-2">Наше меню</h2>
                <p class="font-display text-sushi-silver text-sm md:text-base opacity-80">
                    Выберите категорию и откройте мир японской кухни
                </p>
            </div>

            <!-- Swiper с категориями -->
            <div class="categories-swiper-wrapper relative">
                <Swiper
                    :modules="modules"
                    :slides-per-view="3"
                    :space-between="10"
                    :loop="false"
                    :navigation="true"
                    :grab-cursor="true"
                    :breakpoints="{
                        480: { slidesPerView: 4, spaceBetween: 12 },
                        640: { slidesPerView: 5, spaceBetween: 12 },
                        768: { slidesPerView: 6, spaceBetween: 14 },
                        1024: { slidesPerView: 7, spaceBetween: 16 },
                        1280: { slidesPerView: 8, spaceBetween: 16 },
                        1536: { slidesPerView: 10, spaceBetween: 18 },
                    }"
                    class="category-swiper"
                >
                    <SwiperSlide v-for="category in categories" :key="category.id">
                        <!-- Карточка категории -->
                        <div @click="goToCategory(category)" class="category-card cursor-pointer group">
                            <!-- Картинка - ещё меньше -->
                            <div
                                class="relative w-full aspect-square rounded-lg overflow-hidden mb-2 border-2 border-sushi-gold border-opacity-20 group-hover:border-opacity-60 transition-all duration-300"
                            >
                                <img
                                    :src="category.image_url"
                                    :alt="category.name"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                />

                                <!-- Overlay при наведении - золотой -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-sushi-dark via-sushi-dark/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                >
                                    <div class="absolute bottom-1 left-1 right-1">
                                        <span class="text-sushi-gold text-[10px] font-semibold">Перейти →</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Название категории - меньше -->
                            <h3
                                class="text-center text-xs md:text-sm font-semibold text-sushi-silver group-hover:text-sushi-gold transition-colors duration-300 px-1 line-clamp-2"
                            >
                                {{ category.name }}
                            </h3>
                        </div>
                    </SwiperSlide>
                </Swiper>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { computed } from 'vue'
    import { router, usePage } from '@inertiajs/vue3'
    import { Swiper, SwiperSlide } from 'swiper/vue'
    import { Navigation } from 'swiper/modules'

    // Импортируем стили Swiper
    import 'swiper/css'
    import 'swiper/css/navigation'

    // Подключаем модули
    const modules = [Navigation]

    // Достаем категории из shared data
    const page = usePage()
    const categories = computed(() => page.props.navigation_categories || [])

    // Переход к категории
    const goToCategory = (category) => {
        // Скроллим к секции категории на главной странице
        const element = document.getElementById(`category-${category.id}`)
        if (element) {
            // Плавный скролл с отступом для fixed header
            const headerOffset = 100 // отступ сверху
            const elementPosition = element.getBoundingClientRect().top
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth',
            })
        } else {
            // Если секции нет - переходим на страницу категории
            router.visit(`/category/${category.slug}`)
        }
    }
</script>

<style scoped>
    .categories-swiper-wrapper {
        padding: 0 32px; /* отступы для стрелок */
    }

    /* Стили для Swiper - золотые стрелки */
    .category-swiper {
        --swiper-navigation-color: rgba(212, 175, 55, 1);
        --swiper-navigation-size: 16px;
    }

    /* Стрелки навигации - КРУГЛЫЕ кнопки с золотым */
    .category-swiper :deep(.swiper-button-next),
    .category-swiper :deep(.swiper-button-prev) {
        background: rgba(17, 13, 14, 0.9); /* более плотный фон */
        width: 44px;
        height: 44px;
        border-radius: 50%; /* круглые */
        border: 2px solid rgba(212, 175, 55, 0.4);
        transition: all 0.3s ease;

        /* Центрируем стрелку внутри */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Убираем стандартный ::after со стрелкой */
    .category-swiper :deep(.swiper-button-next::after),
    .category-swiper :deep(.swiper-button-prev::after) {
        font-size: 16px; /* размер стрелки */
        font-weight: 900; /* жирнее */
    }

    .category-swiper :deep(.swiper-button-next):hover,
    .category-swiper :deep(.swiper-button-prev):hover {
        background: rgba(212, 175, 55, 0.2); /* золотистый фон при наведении */
        border-color: rgba(212, 175, 55, 1);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
        transform: scale(1.1);
    }

    .category-swiper :deep(.swiper-button-next) {
        right: 0;
    }

    .category-swiper :deep(.swiper-button-prev) {
        left: 0;
    }

    /* Адаптив для мобилок - делаем стрелки меньше */
    @media (max-width: 768px) {
        .categories-swiper-wrapper {
            padding: 0 28px; /* меньше отступы */
        }

        .category-swiper :deep(.swiper-button-next),
        .category-swiper :deep(.swiper-button-prev) {
            width: 36px; /* меньше на мобилке */
            height: 36px;
        }

        .category-swiper :deep(.swiper-button-next::after),
        .category-swiper :deep(.swiper-button-prev::after) {
            font-size: 14px; /* стрелка меньше */
        }
    }

    /* Анимация появления карточек */
    @media (prefers-reduced-motion: no-preference) {
        .category-card {
            animation: fadeInScale 0.5s ease-out backwards;
        }
    }

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Золотая тень при наведении на карточку */
    .category-card:hover .relative {
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
    }
</style>
