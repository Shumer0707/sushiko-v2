<template>
    <section class="categories-nav py-8 bg-sushi-dark container mx-auto">
        <div class="container mx-auto px-4">
            <!-- Заголовок секции - компактнее -->
            <div class="text-center mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-sushi-gold mb-2">Наше меню</h2>
                <p class="text-sushi-silver text-sm md:text-base opacity-80">
                    Выберите категорию и откройте мир японской кухни
                </p>
            </div>

            <!-- Swiper с категориями -->
            <div class="categories-swiper-wrapper relative">
                <Swiper
                    :modules="modules"
                    :slides-per-view="2"
                    :space-between="12"
                    :loop="false"
                    :navigation="true"
                    :grab-cursor="true"
                    :breakpoints="{
                        640: { slidesPerView: 3, spaceBetween: 16 },
                        768: { slidesPerView: 4, spaceBetween: 16 },
                        1024: { slidesPerView: 5, spaceBetween: 20 },
                        1280: { slidesPerView: 6, spaceBetween: 20 },
                    }"
                    class="category-swiper"
                >
                    <SwiperSlide v-for="category in categories" :key="category.id">
                        <!-- Карточка категории -->
                        <div @click="goToCategory(category)" class="category-card cursor-pointer group">
                            <!-- Картинка - меньше -->
                            <div
                                class="relative w-full aspect-square rounded-xl overflow-hidden mb-2 border-2 border-sushi-gold border-opacity-20 group-hover:border-opacity-60 transition-all duration-300"
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
                                    <div class="absolute bottom-2 left-2 right-2">
                                        <span class="text-sushi-gold text-xs font-semibold">Перейти →</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Название категории - меньше -->
                            <h3
                                class="text-center text-sm md:text-base font-semibold text-sushi-silver group-hover:text-sushi-gold transition-colors duration-300 px-1"
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
        padding: 0 36px; /* отступы для стрелок - меньше */
    }

    /* Стили для Swiper - золотые стрелки */
    .category-swiper {
        --swiper-navigation-color: rgba(212, 175, 55, 1);
        --swiper-navigation-size: 18px;
    }

    /* Стрелки навигации - темные с золотым */
    .category-swiper :deep(.swiper-button-next),
    .category-swiper :deep(.swiper-button-prev) {
        background: rgba(17, 13, 14, 0.8);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 2px solid rgba(212, 175, 55, 0.3);
        transition: all 0.3s ease;
    }

    .category-swiper :deep(.swiper-button-next):hover,
    .category-swiper :deep(.swiper-button-prev):hover {
        background: rgba(212, 175, 55, 0.9);
        border-color: rgba(212, 175, 55, 1);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        transform: scale(1.05);
    }

    .category-swiper :deep(.swiper-button-next) {
        right: 0;
    }

    .category-swiper :deep(.swiper-button-prev) {
        left: 0;
    }

    /* На мобилке прячем стрелки */
    @media (max-width: 768px) {
        .categories-swiper-wrapper {
            padding: 0;
        }

        .category-swiper :deep(.swiper-button-next),
        .category-swiper :deep(.swiper-button-prev) {
            display: none;
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
