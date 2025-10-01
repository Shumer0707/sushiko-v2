<template>
    <section class="seo-block bg-gradient-to-b from-sushi-silver to-white py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <!-- H1 заголовок -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-first_color mb-6">
                    {{ title }}
                </h1>

                <!-- Описание -->
                <p class="text-lg md:text-xl text-sushi-dark_op mb-8 leading-relaxed">
                    {{ description }}
                </p>

                <!-- USP блоки (преимущества) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
                    <div
                        v-for="feature in features"
                        :key="feature.id"
                        class="feature-card bg-white rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300"
                    >
                        <!-- Иконка -->
                        <div class="flex justify-center mb-4">
                            <div
                                class="w-16 h-16 rounded-full bg-gradient-to-br from-second_color to-sushi-gold flex items-center justify-center"
                            >
                                <span class="text-3xl">{{ feature.icon }}</span>
                            </div>
                        </div>

                        <!-- Заголовок преимущества -->
                        <h3 class="text-lg font-semibold text-first_color mb-2">
                            {{ feature.title }}
                        </h3>

                        <!-- Описание преимущества -->
                        <p class="text-sm text-sushi-dark_op">
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
    /* Плавный градиент для фона */
    .seo-block {
        position: relative;
    }

    /* Анимация при наведении на карточки */
    .feature-card {
        border: 1px solid rgba(181, 131, 107, 0.1);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        border-color: rgba(181, 131, 107, 0.3);
        transform: translateY(-4px);
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
