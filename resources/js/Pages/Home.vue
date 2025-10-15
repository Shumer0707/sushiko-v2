<script setup>
    import { onMounted } from 'vue'
    import AppHead from '@/Components/Seo/Head.vue'
    import BannerGallery from '@/Components/Home/BannerGallery.vue'
    import SeoBlock from '@/Components/Home/SeoBlock.vue'
    import CategoriesNav from '@/Components/Home/CategoriesNav.vue'
    import ProductsMenu from '@/Components/Home/ProductsMenu.vue'
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'
    import { usePage } from '@inertiajs/vue3'

    const page = usePage()
    const t = page.props.translations.common
    const s = page.props.translations.seo

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

    // 🎯 ОБРАБОТКА ПРОКРУТКИ после загрузки страницы
    onMounted(() => {
        // Проверяем, есть ли хеш в URL (например: /ru#category-5)
        const hash = window.location.hash

        if (hash) {
            // Даём странице время отрендериться (300ms обычно достаточно)
            setTimeout(() => {
                const element = document.querySelector(hash) // ищем элемент по ID

                if (element) {
                    // Плавная прокрутка с учётом высоты хедера
                    const headerOffset = 100 // отступ сверху для хедера
                    const elementPosition = element.getBoundingClientRect().top
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth',
                    })
                }
            }, 300)
        }
    })
</script>

<template>
    <AppHead :title="s.home_title" :description="s.home_description" />

    <!-- Фон с параллаксом -->
    <ParallaxBackground image="/images/sushi-pattern.jpg" :opacity="0.4" :speed="0.2" max-height="100vh" />

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
        <section class="py-12">
            <ProductsMenu :products="products" :categories="categories" />
        </section>
    </div>
</template>

<style scoped>
    :deep(body) {
        background-color: rgb(52, 48, 47); /* sushi-first */
    }
</style>
