<script setup>
    import { onMounted } from 'vue'
    import Header from './Partials/Header.vue'
    import Footer from './Partials/Footer.vue'
    import PageLoaderWrapper from '@/Components/Common/PageLoaderWrapper.vue'
    import StickyHeader from '@/Components/Navigation/StickyHeader.vue'
    import ScrollToTop from '@/Components/UI/ScrollToTop.vue'
    import HashCleanup from '@/Components/UI/HashCleanup.vue'
    import { useInitialLoad } from '@/composables/useInitialLoad'
    import { useCartStore } from '@/Stores/cart'

    async function fetchData() {
        // Ждём, пока страница скажет "я готова" (например, баннер загрузился)
        const timeout = 1000 // запас, чтобы не зависнуть навсегда

        await new Promise((resolve) => {
            let done = false

            const finish = () => {
                if (done) return
                done = true
                window.removeEventListener('sushi:page-ready', onReady)
                resolve()
            }

            const onReady = () => finish()

            // слушаем событие от страницы
            window.addEventListener('sushi:page-ready', onReady, { once: true })

            // страховка: если событие не пришло — снимаем прелоадер сами
            setTimeout(finish, timeout)
        })
    }

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

        <!-- 🔥 КЛЮЧ: min-h-[calc(100vh-300px)] -->
        <!-- Резервируем место под контент = высота экрана - хедер/футер -->
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
