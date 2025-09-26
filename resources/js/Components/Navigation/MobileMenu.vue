<template>
    <OverlayBackdrop :is-visible="isVisible" @close="$emit('close')">
        <!-- Мобильное меню - выезжает сверху -->
        <div v-if="isVisible" class="absolute top-0 left-0 right-0 bg-sushi-dark text-white shadow-2xl mobile-menu" @click.stop>
            <div class="container mx-auto px-4 py-6">
                <!-- Заголовок меню -->
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-600">
                    <h2 class="text-xl font-bold">Меню</h2>
                    <button @click="$emit('close')" class="text-white hover:text-sushi-gold p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

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
                                        <img :src="`/images/flag-${locale}.png`" :alt="locale.toUpperCase()" class="w-6 h-4" />
                                        <span>{{ getLanguageName(locale) }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Правая колонка - Категории -->
                    <div>
                        <h3 class="text-lg font-bold text-sushi-gold mb-3 border-b border-sushi-gold pb-1">Категории суши</h3>
                        <div class="space-y-1 max-h-96 overflow-y-auto custom-scrollbar">
                            <Link
                                v-for="category in categories"
                                :key="category.id"
                                :href="localizedRoute(`/category/${category.slug}`)"
                                class="block py-3 px-3 text-white hover:text-sushi-gold hover:bg-gray-700 rounded-lg transition-colors border-l-2 border-transparent hover:border-sushi-gold"
                                @click="$emit('close')"
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
                            </Link>
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

    // Props
    const props = defineProps({
        isVisible: {
            type: Boolean,
            required: true,
        },
        categories: {
            type: Array,
            default: () => [],
        },
        currentLocale: {
            type: String,
            required: true,
        },
    })

    // Emits
    const emit = defineEmits(['close'])

    const { localizedRoute } = useLocale()
    const page = usePage()

    // Названия языков
    const getLanguageName = (locale) => {
        const names = {
            ro: 'Română',
            ru: 'Русский',
            en: 'English',
        }
        return names[locale] || locale
    }
</script>

<style scoped>
    /* Анимация выезжания сверху */
    .mobile-menu {
        animation: slideDown 0.3s ease-out forwards;
    }

    @keyframes slideDown {
        0% {
            opacity: 0;
            transform: translateY(-100%);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* При закрытии */
    .mobile-menu.closing {
        animation: slideUp 0.25s ease-in forwards;
    }

    @keyframes slideUp {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        100% {
            opacity: 0;
            transform: translateY(-100%);
        }
    }
</style>
