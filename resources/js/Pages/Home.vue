<script setup>
    import AppHead from '@/Components/Seo/Head.vue'
    import BannerGallery from '@/Components/home/BannerGallery.vue'
    import SeoBlock from '@/Components/home/SeoBlock.vue'
    import CategoriesNav from '@/Components/home/CategoriesNav.vue'
    import ProductsMenu from '@/Components/home/ProductsMenu.vue'
    import ParallaxBackground from '@/Components/home/ParallaxBackground.vue'
    // Переиспользуемый UI компонент
    import PageGradient from '@/Components/UI/PageGradient.vue'

    defineProps({
        banners: {
            type: Array,
            default: () => [],
        },
        products: {
            type: Array,
            default: () => [],
        },
        categories: {
            type: Array,
            default: () => [],
        },
    })
</script>

<template>
    <AppHead title="Главная" description="Добро пожаловать в SUSHIKO - лучшие суши и роллы в Кишиневе" />

    <!-- Фон с параллаксом -->
    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.4" :speed="0.2" max-height="100vh" />

    <!--
        Градиент поверх ВСЕЙ страницы (теперь переиспользуемый компонент!)
        Можно настроить через пропсы:
        - color="52, 48, 47" - цвет в RGB
        - :opacity="[1, 0, 0.3, 0.7, 1]" - прозрачность в 5 точках
        - :z-index="1" - слой
    -->
    <PageGradient />

    <!-- Контент -->
    <div class="relative z-20 min-h-screen">
        <!-- 1. Галерея баннеров -->
        <section class="py-8">
            <BannerGallery :banners="banners" />
        </section>

        <!-- 2. SEO блок -->
        <section class="py-12">
            <SeoBlock />
        </section>

        <!-- 3. Навигация с категориями -->
        <section class="py-12">
            <CategoriesNav />
        </section>

        <!-- 4. Меню товаров -->
        <section class="py-16">
            <ProductsMenu :products="products" :categories="categories" />
        </section>
    </div>
</template>

<style scoped>
    :deep(body) {
        background-color: rgb(52, 48, 47); /* sushi-first */
    }
</style>
