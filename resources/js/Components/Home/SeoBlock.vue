<template>
    <section class="seo-block bg-gradient-to-b from-sushi-first to-sushi-dark py-8 md:py-12 container mx-auto">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <!-- H1 заголовок - уменьшил -->
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-sushi-gold mb-4">
                    {{ title }}
                </h1>

                <!-- Описание - уменьшил -->
                <p class="text-base md:text-lg text-sushi-silver opacity-90 mb-6 leading-relaxed">
                    {{ description }}
                </p>

                <!-- USP блоки (преимущества) - компактнее -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div
                        v-for="feature in features"
                        :key="feature.id"
                        class="feature-card bg-sushi-dark bg-opacity-60 backdrop-blur-sm rounded-lg p-4 border border-sushi-gold border-opacity-20 hover:border-opacity-50 transition-all duration-300"
                    >
                        <!-- Иконка - меньше -->
                        <div class="flex justify-center mb-3">
                            <div
                                class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center"
                            >
                                <span class="text-2xl">{{ feature.icon }}</span>
                            </div>
                        </div>

                        <!-- Заголовок преимущества -->
                        <h3 class="text-base font-semibold text-sushi-gold mb-2">
                            {{ feature.title }}
                        </h3>

                        <!-- Описание преимущества -->
                        <p class="text-sm text-sushi-silver opacity-80">
                            {{ feature.description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    // Пропсы компонента
    const props = defineProps({
        title: {
            type: String,
            default: 'Суши и роллы с доставкой в Кишиневе',
        },
        description: {
            type: String,
            default:
                'Sushiko - это традиционная японская кухня с использованием только свежих продуктов премиум качества. Готовим роллы по аутентичным рецептам и доставляем быстро по всему Кишиневу.',
        },
        features: {
            type: Array,
            default: () => [
                {
                    id: 1,
                    icon: '🍱',
                    title: 'Свежие продукты',
                    description: 'Только премиум ингредиенты. Доставка рыбы каждый день.',
                },
                {
                    id: 2,
                    icon: '🚀',
                    title: 'Быстрая доставка',
                    description: 'Доставка за 60 минут. Бесплатно от 500 лей.',
                },
                {
                    id: 3,
                    icon: '👨‍🍳',
                    title: 'Японские мастера',
                    description: 'Наши повара обучались в Японии. Аутентичные рецепты.',
                },
            ],
        },
    })
</script>

<style scoped>
    /* Темный фон с градиентом */
    .seo-block {
        position: relative;
    }

    /* Анимация при наведении на карточки - золотая подсветка */
    .feature-card {
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        background-color: rgba(17, 13, 14, 0.8);
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.2);
    }

    /* Плавная анимация появления */
    @media (prefers-reduced-motion: no-preference) {
        .feature-card {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .feature-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .feature-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .feature-card:nth-child(3) {
            animation-delay: 0.3s;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
