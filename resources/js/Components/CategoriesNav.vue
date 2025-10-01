<template>
    <section class="categories-nav py-12 bg-white">
        <div class="container mx-auto px-4">
            <!-- Заголовок секции -->
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-first_color mb-2">Наше меню</h2>
                <p class="text-sushi-dark_op">Выберите категорию и откройте мир японской кухни</p>
            </div>

            <!-- Swiper с категориями -->
            <div class="categories-swiper-wrapper relative">
                <Swiper
                    :modules="modules"
                    :slides-per-view="2"
                    :space-between="20"
                    :loop="false"
                    :navigation="true"
                    :grab-cursor="true"
                    :breakpoints="{
                        640: { slidesPerView: 3, spaceBetween: 24 },
                        768: { slidesPerView: 4, spaceBetween: 24 },
                        1024: { slidesPerView: 5, spaceBetween: 30 },
                        1280: { slidesPerView: 6, spaceBetween: 30 },
                    }"
                    class="category-swiper"
                >
                    <SwiperSlide v-for="category in categories" :key="category.id">
                        <!-- Карточка категории -->
                        <div @click="goToCategory(category)" class="category-card cursor-pointer group">
                            <!-- Картинка -->
                            <div class="relative w-full aspect-square rounded-2xl overflow-hidden mb-3 shadow-md">
                                <img
                                    :src="category.image_url"
                                    :alt="category.name"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                />

                                <!-- Overlay при наведении -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                >
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <span class="text-white text-sm font-medium">Перейти →</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Название категории -->
                            <h3
                                class="text-center text-base md:text-lg font-semibold text-first_color group-hover:text-second_color transition-colors duration-300 px-2"
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
        padding: 0 40px; /* отступы для стрелок */
    }

    /* Стили для Swiper */
    .category-swiper {
        --swiper-navigation-color: #34302f;
        --swiper-navigation-size: 20px;
    }

    /* Стрелки навигации */
    .category-swiper :deep(.swiper-button-next),
    .category-swiper :deep(.swiper-button-prev) {
        background: white;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .category-swiper :deep(.swiper-button-next):hover,
    .category-swiper :deep(.swiper-button-prev):hover {
        background: #ecf4f4;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
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

    /* Тень при наведении на карточку */
    .category-card:hover .relative {
        box-shadow: 0 10px 25px -5px rgba(52, 48, 47, 0.3);
    }
</style>
