<template>
    <div class="relative">
        <!-- Кнопка языка -->
        <button
            ref="triggerButton"
            @click="overlay.toggle()"
            class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-700 transition-colors"
        >
            <img :src="`/images/flag-${currentLocale}.png`" :alt="currentLocale.toUpperCase()" class="w-5 h-3" />
            <span class="text-sm font-medium">{{ currentLocale.toUpperCase() }}</span>
            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': overlay.isOpen.value }">
                <path fill="currentColor" d="M7 10l5 5 5-5z" />
            </svg>
        </button>

        <!-- Выпадающее меню с OverlayBackdrop -->
        <OverlayBackdrop :is-visible="overlay.isOpen.value" @close="overlay.close()">
            <!-- Позиционируем относительно кнопки -->
            <div
                v-if="overlay.isOpen.value"
                class="absolute bg-white rounded-lg shadow-xl border py-2 min-w-[140px] z-50 menu-dropdown"
                :style="dropdownStyle"
                @click.stop
            >
                <form
                    v-for="locale in ['ro', 'ru', 'en']"
                    :key="locale"
                    method="POST"
                    :action="route('locale.switch')"
                    class="block"
                >
                    <input type="hidden" name="_token" :value="$page.props.csrf_token" />
                    <input type="hidden" name="locale" :value="locale" />

                    <button
                        type="submit"
                        :class="[
                            'w-full flex items-center space-x-3 px-4 py-3 text-left text-gray-700 hover:bg-gray-100 transition-colors',
                            currentLocale === locale ? 'bg-gray-50 font-medium' : '',
                        ]"
                    >
                        <img :src="`/images/flag-${locale}.png`" :alt="locale.toUpperCase()" class="w-6 h-4" />
                        <span class="text-sm">{{ getLanguageName(locale) }}</span>
                    </button>
                </form>
            </div>
        </OverlayBackdrop>
    </div>
</template>

<script setup>
    import { useOverlay } from '@/composables/useOverlay'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'
    import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue'

    // Props
    const props = defineProps({
        currentLocale: String,
    })

    // Refs
    const triggerButton = ref(null)

    // Overlay система
    const overlay = useOverlay('language-dropdown')

    // Вычисляем позицию dropdown'а относительно кнопки
    const dropdownStyle = computed(() => {
        if (!triggerButton.value || !overlay.isOpen.value) return {}

        const rect = triggerButton.value.getBoundingClientRect()
        return {
            top: `${rect.bottom + 8}px`, // 8px отступ от кнопки
            right: `${window.innerWidth - rect.right}px`, // выравниваем по правому краю кнопки
        }
    })

    // Названия языков
    const getLanguageName = (locale) => {
        const names = {
            ro: 'Română',
            ru: 'Русский',
            en: 'English',
        }
        return names[locale] || locale
    }

    // Закрытие при нажатии Escape
    const handleEscape = (event) => {
        if (event.key === 'Escape' && overlay.isOpen.value) {
            overlay.close()
        }
    }

    onMounted(() => {
        document.addEventListener('keydown', handleEscape)
    })

    onUnmounted(() => {
        document.removeEventListener('keydown', handleEscape)
    })
</script>

<style scoped>
    /* Анимация появления меню */
    .menu-dropdown {
        animation: menuSlideIn 0.4s ease-out forwards;
    }

    @keyframes menuSlideIn {
        0% {
            opacity: 0;
            transform: translateY(-15px) scale(0.85);
        }
        50% {
            opacity: 0.8;
            transform: translateY(3px) scale(1.02); /* небольшой перелет + увеличение */
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1); /* возвращаемся на место */
        }
    }

    /* Анимация при закрытии */
    .menu-dropdown.closing {
        animation: menuSlideOut 0.25s ease-in forwards;
    }

    @keyframes menuSlideOut {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        60% {
            opacity: 0.4;
            transform: translateY(-5px) scale(0.95); /* сжимаемся и уходим вверх */
        }
        100% {
            opacity: 0;
            transform: translateY(-20px) scale(0.8);
        }
    }
</style>
