<template>
    <Head>
        <!-- Заголовок страницы -->
        <title>{{ title }} - {{ siteName }}</title>

        <!-- Основные мета-теги -->
        <meta name="description" :content="description" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Canonical URL -->
        <link rel="canonical" :href="currentUrl" />

        <!-- Hreflang для многоязычности -->
        <link rel="alternate" hreflang="ru" :href="getLocalizedUrl('ru')" />
        <link rel="alternate" hreflang="ro" :href="getLocalizedUrl('ro')" />
        <link rel="alternate" hreflang="en" :href="getLocalizedUrl('en')" />
        <link rel="alternate" hreflang="x-default" :href="getLocalizedUrl('ru')" />

        <!-- Open Graph для соцсетей -->
        <meta property="og:title" :content="title" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="fullImageUrl" />
        <meta property="og:url" :content="currentUrl" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" :content="siteName" />
    </Head>
</template>

<script setup>
    import { Head, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'

    const props = defineProps({
        title: {
            type: String,
            default: 'Главная страница',
        },
        description: {
            type: String,
            default: 'Описание сайта по умолчанию',
        },
        image: {
            type: String,
            default: '/images/default-og-image.jpg',
        },
    })

    const siteName = 'Мой Сайт'
    const page = usePage()

    // Полный URL для картинки
    const fullImageUrl = computed(() => {
        return window.location.origin + props.image
    })

    // Текущий URL страницы
    const currentUrl = computed(() => {
        return window.location.origin + page.url
    })

    // Функция для создания URL с другой локалью
    const getLocalizedUrl = (locale) => {
        const currentPath = page.url
        // Заменяем текущую локаль на нужную
        const newPath = currentPath.replace(/^\/[a-z]{2}/, `/${locale}`)
        return window.location.origin + newPath
    }
</script>
