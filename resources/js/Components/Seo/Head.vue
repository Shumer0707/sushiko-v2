<template>
    <Head>
        <!-- Заголовок страницы -->
        <title>{{ fullTitle }}</title>

        <!-- Основные мета-теги -->
        <meta name="description" :content="description" />

        <!-- Canonical URL -->
        <link rel="canonical" :href="currentUrl" />

        <!-- Hreflang для многоязычности -->
        <link rel="alternate" hreflang="ru" :href="getLocalizedUrl('ru')" />
        <link rel="alternate" hreflang="ro" :href="getLocalizedUrl('ro')" />
        <link rel="alternate" hreflang="en" :href="getLocalizedUrl('en')" />
        <link rel="alternate" hreflang="x-default" :href="getLocalizedUrl('ru')" />

        <!-- Open Graph для соцсетей -->
        <meta property="og:title" :content="fullTitle" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="fullImageUrl" />
        <meta property="og:url" :content="currentUrl" />
        <meta property="og:type" :content="ogType" />
        <meta property="og:site_name" content="Sushiko" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="fullTitle" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="fullImageUrl" />
    </Head>
</template>

<script setup>
    import { Head, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'

    const props = defineProps({
        title: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        },
        image: {
            type: String,
            default: '/images/og-default.jpg',
        },
        ogType: {
            type: String,
            default: 'website',
        },
    })

    const page = usePage()

    const fullTitle = computed(() => {
        const result = props.title.trim()
        // console.log('🔥 AppHead fullTitle:', result)
        return result
    })

    // Полный URL для картинки
    const fullImageUrl = computed(() => {
        if (props.image.startsWith('http')) {
            return props.image
        }
        return window.location.origin + props.image
    })

    // Текущий URL страницы
    const currentUrl = computed(() => {
        return window.location.origin + page.url
    })

    // Функция для создания URL с другой локалью
    const getLocalizedUrl = (locale) => {
        const currentPath = page.url
        const pathWithoutLocale = currentPath.replace(/^\/[a-z]{2}(\/|$)/, '/')
        const newPath = `/${locale}${pathWithoutLocale === '/' ? '' : pathWithoutLocale}`
        return window.location.origin + newPath
    }
</script>
