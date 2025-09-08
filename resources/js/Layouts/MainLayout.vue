<script setup>
    import Header from './Partials/Header.vue'
    import Footer from './Partials/Footer.vue'
    import PageLoaderWrapper from '@/Components/common/PageLoaderWrapper.vue'
    import { useInitialLoad } from '@/composables/useInitialLoad'

    // Функция загрузки данных (будет заменяться под проект)
    async function fetchData() {
        await new Promise((resolve) => setTimeout(resolve, 1000))
    }

    // Инициализация загрузки
    const { isReady, load } = useInitialLoad(fetchData)
    load()
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <Header />
        <main class="flex-grow container mx-auto py-6">
            <PageLoaderWrapper :loading="!isReady">
                <slot />
            </PageLoaderWrapper>
        </main>
        <Footer />
    </div>
</template>
