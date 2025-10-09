<template>
    <OverlayBackdrop :is-visible="isVisible" @close="$emit('close')">
        <!-- Мобильное меню - выезжает точно из-под хедера -->
        <div
            v-if="isVisible"
            :data-modal-content="modalId"
            :class="[
                'bg-sushi-dark text-white shadow-2xl mobile-menu',
                // 🎯 Добавляем класс closing при анимации закрытия
                isClosing ? 'closing' : '',
            ]"
            :style="menuStyle"
            @click.stop
        >
            <div class="container mx-auto px-4 py-6">
                <!-- Заголовок меню -->
                <!-- <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-600">
                    <h2 class="text-xl font-bold">Меню</h2>
                    <button @click="$emit('close')" class="text-white hover:text-sushi-gold p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div> -->

                <!-- Основной контент в две колонки -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- Левая колонка - Оглавление/Заголовки -->
                    <div class="space-y-6">
                        <!-- Основная навигация -->
                        <div>
                            <h3 class="text-lg font-bold text-sushi-gold mb-3 border-b border-sushi-gold pb-1">Навигация</h3>
                            <nav class="space-y-2">
                                <Link
                                    :href="localizedRoute('/')"
                                    class="block py-2 px-3 text-white hover:text-sushi-gold hover:bg-gray-700 rounded-lg transition-colors font-medium"
                                    @click="$emit('close')"
                                >
                                    🏠 Главная
                                </Link>
                                <Link
                                    :href="localizedRoute('/contact')"
                                    class="block py-2 px-3 text-white hover:text-sushi-gold hover:bg-gray-700 rounded-lg transition-colors font-medium"
                                    @click="$emit('close')"
                                >
                                    📞 Контакты
                                </Link>
                            </nav>
                        </div>

                        <!-- Языки -->
                        <div>
                            <h3 class="text-lg font-bold text-sushi-gold mb-3 border-b border-sushi-gold pb-1">Язык</h3>
                            <div class="space-y-2">
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
                                            'w-full flex items-center space-x-3 px-3 py-2 rounded-lg transition-colors text-left',
                                            currentLocale === locale
                                                ? 'bg-sushi-gold text-black font-bold'
                                                : 'text-white hover:text-sushi-gold hover:bg-gray-700',
                                        ]"
                                    >
                                        <!-- <img :src="`/images/flag-${locale}.png`" :alt="locale.toUpperCase()" class="w-6 h-4" /> -->
                                        <span>{{ getLanguageName(locale) }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Правая колонка - Категории (теперь с прокруткой) -->
                    <div>
                        <h3 class="text-lg font-bold text-sushi-gold mb-3 border-b border-sushi-gold pb-1">Меню</h3>
                        <div class="space-y-1 max-h-96 overflow-y-auto custom-scrollbar">
                            <!-- 🎯 Заменили Link на a с событием -->
                            <a
                                v-for="category in categories"
                                :key="category.id"
                                :href="`#category-${category.id}`"
                                @click.prevent="handleCategoryClick(category.id)"
                                class="block py-3 px-3 text-white hover:text-sushi-gold hover:bg-gray-700 rounded-lg transition-colors border-l-2 border-transparent hover:border-sushi-gold cursor-pointer"
                            >
                                <div class="flex items-center justify-between">
                                    <span class="font-medium">{{ category.name }}</span>
                                    <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </OverlayBackdrop>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { useLocale } from '@/composables/useLocale'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'
    import { computed } from 'vue'

    // Props
    const props = defineProps({
        isVisible: {
            type: Boolean,
            required: true,
        },
        isClosing: {
            type: Boolean,
            default: false,
        },
        categories: {
            type: Array,
            default: () => [],
        },
        currentLocale: {
            type: String,
            required: true,
        },
        modalId: {
            type: String,
            default: 'mobile-menu',
        },
    })

    // 🎯 Добавляем emit для прокрутки к категории
    const emit = defineEmits(['close', 'scroll-to-category'])

    const { localizedRoute } = useLocale()
    const page = usePage()

    // Вычисляем стиль для позиционирования под хедером
    const menuStyle = computed(() => {
        if (!props.isVisible) return {}

        // Определяем активный хедер
        const header = document.querySelector('header')
        const stickyHeader = document.querySelector('.fixed.translate-y-0') // sticky когда виден

        const activeHeader = stickyHeader || header
        const headerHeight = activeHeader ? activeHeader.offsetHeight : 80

        return {
            position: 'fixed',
            top: `${headerHeight}px`,
            left: '0',
            right: '0',
            maxHeight: `calc(100vh - ${headerHeight}px)`,
            overflowY: 'auto',
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

    // 🎯 Обработчик клика по категории - передаём событие родителю (Header)
    const handleCategoryClick = (categoryId) => {
        emit('scroll-to-category', categoryId)
    }
</script>

<style scoped>
    .mobile-menu {
        animation: slideDownFromHeader 0.5s ease-out forwards;
    }

    @keyframes slideDownFromHeader {
        0% {
            transform: translateY(-100%);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            transform: translateY(0);
        }
    }

    .mobile-menu.closing {
        animation: slideUpToHeader 0.4s ease-in forwards;
    }

    @keyframes slideUpToHeader {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            transform: translateY(-100%);
        }
    }

    /* Кастомный скроллбар */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(212, 175, 55, 0.5);
        border-radius: 2px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(212, 175, 55, 0.8);
    }
</style>
