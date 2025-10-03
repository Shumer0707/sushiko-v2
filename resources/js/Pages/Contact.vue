<script setup>
    import AppHead from '@/Components/Seo/Head.vue'
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'
    import ContactMap from '@/Components/Contact/ContactMap.vue'
    import ContactInfo from '@/Components/Contact/ContactInfo.vue'
    import ContactForm from '@/Components/Common/ContactForm.vue'
</script>

<template>
    <AppHead title="Контакты" description="Свяжитесь с SUSHIKO - адрес, телефон, время работы и форма обратной связи" />

    <!-- Фон с параллаксом -->
    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.4" :speed="0.2" max-height="100vh" />

    <!-- Градиент поверх -->
    <PageGradient />

    <!-- Контент -->
    <div class="relative z-20 min-h-screen">
        <!-- Hero секция (с bg и обводкой) -->
        <section class="py-8 md:py-10">
            <div class="container mx-auto px-4">
                <div
                    class="bg-sushi-dark bg-opacity-60 backdrop-blur-sm rounded-2xl border-2 border-sushi-gold p-8 md:p-8 shadow-2xl"
                >
                    <div class="text-center">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-sushi-gold mb-3">Свяжитесь с нами</h1>
                        <p class="text-white text-base md:text-lg max-w-2xl mx-auto">
                            Мы всегда рады вашим вопросам и предложениям. Выберите удобный способ связи!
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Контакты + Форма (2 колонки) -->
        <section class="p-b-6 md:p-b-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Левая колонка - Контакты -->
                    <div class="h-full">
                        <ContactInfo class="h-full" />
                    </div>

                    <!-- Правая колонка - Форма -->
                    <div class="h-full">
                        <ContactForm class="h-full" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Карта (внизу, на всю ширину) -->
        <section class="py-6 md:py-8 pb-12">
            <div class="container mx-auto px-4">
                <ContactMap :latitude="47.0105" :longitude="28.8638" address="ул. Штефан чел Маре 10, Кишинёв" />
            </div>
        </section>
    </div>
</template>

<style scoped>
    :deep(body) {
        background-color: rgb(52, 48, 47); /* sushi-first */
    }
</style>
