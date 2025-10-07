<script setup>
    import { onMounted, nextTick } from 'vue'
    import { router } from '@inertiajs/vue3'

    /**
     * Плавный скролл к якорю после загрузки страницы
     */
    function smoothScrollToHash() {
        if (!window.location.hash) return

        const hash = window.location.hash.substring(1) // убираем #

        // Удаляем хэш из URL сразу
        const urlWithoutHash = window.location.pathname + window.location.search
        window.history.replaceState(null, '', urlWithoutHash)

        // Ищем элемент
        const element = document.getElementById(hash)

        if (element) {
            // Задержка для рендера Vue
            setTimeout(() => {
                const headerOffset = 100
                const elementPosition = element.getBoundingClientRect().top
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset

                // Плавный скролл
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth',
                })
            }, 400)
        } else {
            console.log('⚠️ Элемент не найден:', hash)
        }
    }

    // При первой загрузке
    onMounted(() => {
        nextTick(() => {
            smoothScrollToHash()
        })
    })

    // При переходах через Inertia
    router.on('navigate', () => {
        nextTick(() => {
            smoothScrollToHash()
        })
    })
</script>

<template>
    <!-- Компонент без UI -->
</template>
