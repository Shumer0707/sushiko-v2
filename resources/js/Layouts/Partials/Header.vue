<template>
    <header class="bg-sushi-dark text-white">
        <!-- Верхняя строка -->
        <div class="border-b border-gray-700">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <!-- Лого -->
                    <div class="flex items-center">
                        <Link :href="localizedRoute('/')" class="block">
                            <div class="text-white">
                                <div class="text-xl xl:text-2xl lg:text-xl font-bold tracking-wider">SUSHIKO</div>
                                <div class="text-xs text-gray-300 -mt-1 tracking-widest">sushi & rolls</div>
                            </div>
                        </Link>
                    </div>

                    <!-- Телефоны (только на lg+ экранах) -->
                    <div class="hidden lg:flex flex-1">
                        <div class="flex-1 text-center">
                            <div class="flex justify-center items-center space-x-6">
                                <div>
                                    <span class="text-lg font-semibold">060000000</span>
                                    <span class="mx-2">|</span>
                                    <span class="text-lg font-semibold">070000000</span>
                                </div>
                            </div>
                            <div class="text-sm text-gray-300 mt-1">с 10:00 до 22:00 Доставка занимает в среднем 40 минут.</div>
                        </div>
                    </div>

                    <!-- Правая часть -->
                    <div class="flex items-center space-x-4">
                        <!-- Корзина (всегда видна) -->
                        <MiniCart />

                        <!-- Навигация для десктопа (скрываем на мобильных) -->
                        <div class="hidden lg:flex items-center space-x-6">
                            <Link :href="localizedRoute('/')" class="text-white hover:text-sushi-gold transition-colors">
                                Главная
                            </Link>
                            <Link :href="localizedRoute('/contact')" class="text-white hover:text-sushi-gold transition-colors">
                                Контакты
                            </Link>
                        </div>

                        <!-- Гамбургер (только на мобильных) -->
                        <button
                            @click="toggleMobileMenu"
                            class="lg:hidden text-white p-2 hover:bg-gray-700 rounded transition-colors"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    :d="mobileMenuOverlay.isOpen.value ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'"
                                ></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Нижняя строка - ТОЛЬКО для больших экранов -->
        <div class="hidden lg:block">
            <div class="container mx-auto px-4 py-3 lg:py-2">
                <div class="flex justify-between items-center">
                    <!-- Категории -->
                    <nav class="flex space-x-8 xl:space-x-8 lg:space-x-4">
                        <Link
                            v-for="category in categories"
                            :key="category.id"
                            :href="localizedRoute(`/category/${category.slug}`)"
                            class="text-white hover:text-sushi-gold transition-colors font-medium text-base xl:text-base lg:text-sm"
                        >
                            {{ category.name }}
                        </Link>
                    </nav>

                    <!-- Новый компонент языков -->
                    <LanguageDropdown :current-locale="currentLocale" />
                </div>
            </div>
        </div>

        <!-- Мобильное меню -->
        <MobileMenu
            :is-visible="mobileMenuOverlay.isOpen.value"
            :categories="categories"
            :current-locale="currentLocale"
            @close="closeMobileMenu"
        />
    </header>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { useLocale } from '@/composables/useLocale'
    import { useOverlay } from '@/composables/useOverlay'
    import LanguageDropdown from '@/Components/Navigation/LanguageDropdown.vue'
    import MobileMenu from '@/Components/Navigation/MobileMenu.vue'
    import MiniCart from '@/Components/Navigation/MiniCart.vue'

    const page = usePage()
    const t = page.props.translations.common
    const currentLocale = page.props.current_locale
    const categories = page.props.navigation_categories

    const { localizedRoute } = useLocale()

    // Мобильное меню через систему оверлеев
    const mobileMenuOverlay = useOverlay('mobile-menu')

    // Функции управления мобильным меню
    const toggleMobileMenu = () => {
        mobileMenuOverlay.toggle()
    }

    const closeMobileMenu = () => {
        mobileMenuOverlay.close()
    }
</script>
