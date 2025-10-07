<script setup>
    import { onMounted } from 'vue'
    import Header from './Partials/Header.vue'
    import Footer from './Partials/Footer.vue'
    import PageLoaderWrapper from '@/Components/Common/PageLoaderWrapper.vue'
    import StickyHeader from '@/Components/Navigation/StickyHeader.vue'
    import ScrollToTop from '@/Components/UI/ScrollToTop.vue'
    import HashCleanup from '@/Components/UI/HashCleanup.vue' // 🔥 Новый компонент
    import { useInitialLoad } from '@/composables/useInitialLoad'
    import { useCartStore } from '@/Stores/cart'

    // Функция загрузки данных
    async function fetchData() {
        await new Promise((resolve) => setTimeout(resolve, 1000))
    }

    // Инициализация загрузки
    const { isReady, load } = useInitialLoad(fetchData)
    load()

    const cartStore = useCartStore()
    onMounted(() => {
        cartStore.loadFromStorage()
    })
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <Header />
        <StickyHeader />
        <main class="flex-grow">
            <PageLoaderWrapper :loading="!isReady">
                <slot />
            </PageLoaderWrapper>
        </main>
        <Footer />

        <ScrollToTop />
        <HashCleanup />
    </div>
</template>
