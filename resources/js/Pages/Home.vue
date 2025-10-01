<script setup>
    import AppHead from '@/Components/Seo/Head.vue'
    import BannerGallery from '@/Components/BannerGallery.vue'
    import SeoBlock from '@/Components/SeoBlock.vue'
    import CategoriesNav from '@/Components/CategoriesNav.vue'
    import ProductsMenu from '@/Components/ProductsMenu.vue'
    import ParallaxBackground from '@/Components/ParallaxBackground.vue'

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

    <!-- Градиент поверх ВСЕЙ страницы -->
    <div class="page-gradient"></div>

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
    /* Градиент на ВСЮ страницу */
    .page-gradient {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 1;
        pointer-events: none;

        /* Градиент от прозрачного к коричневому */
        background: linear-gradient(
            to bottom,
            rgba(52, 48, 47, 1) 0%,
            rgba(52, 48, 47, 0) 30%,
            rgba(52, 48, 47, 0.3) 50%,
            rgba(52, 48, 47, 0.7) 70%,
            rgba(52, 48, 47, 1) 100%
        );
    }

    /* Фон всей страницы - коричневый */
    :deep(body) {
        background-color: rgb(52, 48, 47);
    }
</style>
