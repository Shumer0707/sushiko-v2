<template>
    <header class="bg-sushi-dark text-sushi-white z-30">
        <!-- Верхняя строка -->
        <div class="border-b border-gray-700">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <!-- Лого -->
                    <div class="flex items-center">
                        <Link :href="localizedRoute('/')" class="block">
                            <img src="/images/logo-v1.webp" alt="logo" class="w-32 lg:w-48" />
                        </Link>
                    </div>

                    <!-- Телефоны (только на lg+ экранах) -->
                    <div class="hidden lg:flex flex-1">
                        <div class="flex-1 text-center">
                            <div class="flex justify-center items-center space-x-6">
                                <div>
                                    <span class="text-lg font-semibold">{{ t.contacts_phone_number }}</span>
                                    <!-- <span class="mx-2">|</span> -->
                                    <!-- <span class="text-lg font-semibold">070000000</span> -->
                                </div>
                            </div>
                            <div class="text-sm text-gray-300 mt-1">{{ t.phone_time }}</div>
                        </div>
                    </div>

                    <!-- Правая часть -->
                    <div class="flex items-center space-x-4">
                        <!-- Навигация для десктопа (скрываем на мобильных) -->
                        <div class="hidden lg:flex items-center space-x-6">
                            <Link :href="localizedRoute('/')" class="text-white hover:text-sushi-gold transition-colors">
                                {{ t.home }}
                            </Link>
                            <Link :href="localizedRoute('/contact')" class="text-white hover:text-sushi-gold transition-colors">
                                {{ t.contact }}
                            </Link>
                        </div>

                        <!-- Гамбургер (только на мобильных) -->
                        <BurgerButton :is-open="mobileMenuOverlay.isOpen.value" @toggle="toggleMobileMenu" />

                        <!-- Корзина (всегда видна) -->
                        <MiniCart :is-closing="mobileMenuOverlay.isClosing.value" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Нижняя строка - ТОЛЬКО для больших экранов -->
        <div class="hidden lg:block">
            <div class="container mx-auto px-4 py-3 lg:py-2">
                <div class="flex justify-between items-center">
                    <!-- 🎯 Категории - теперь с прокруткой вместо переходов -->
                    <nav class="flex space-x-8 xl:space-x-6 lg:space-x-4">
                        <a
                            v-for="category in categories"
                            :key="category.id"
                            :href="`#category-${category.id}`"
                            @click.prevent="scrollToCategory(category.id)"
                            class="text-white hover:text-sushi-gold transition-colors font-medium text-base xl:text-base lg:text-sm cursor-pointer"
                        >
                            {{ category.name }}
                        </a>
                    </nav>

                    <!-- Новый компонент языков -->
                    <LanguageDropdown :current-locale="currentLocale" />
                </div>
            </div>
        </div>

        <!-- Мобильное меню -->
        <MobileMenu
            :is-visible="mobileMenuOverlay.isOpen.value"
            :is-closing="mobileMenuOverlay.isClosing.value"
            :modal-id="'mobile-menu'"
            :categories="categories"
            :current-locale="currentLocale"
            @close="closeMobileMenu"
            @scroll-to-category="scrollToCategory"
        />
    </header>
</template>

<script setup>
    import { useLocale } from '@/composables/useLocale'
    import { useOverlay } from '@/composables/useOverlay'
    import LanguageDropdown from '@/Components/Navigation/LanguageDropdown.vue'
    import MobileMenu from '@/Components/Navigation/MobileMenu.vue'
    import MiniCart from '@/Components/Navigation/MiniCart.vue'
    import BurgerButton from '@/Components/Navigation/BurgerButton.vue'
    import { Link, usePage, router } from '@inertiajs/vue3'

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

    const scrollToCategory = (categoryId) => {
        // Получаем текущий путь страницы
        const currentPath = window.location.pathname

        // Варианты главной страницы (с учётом локализации)
        const homePathVariants = ['/', `/${currentLocale}`, `/${currentLocale}/`]

        // Проверяем, находимся ли мы на главной странице
        const isHomePage = homePathVariants.some((path) => currentPath === path)

        if (isHomePage) {
            const element = document.getElementById(`category-${categoryId}`)

            if (element) {
                // Закрываем мобильное меню (если оно открыто)
                closeMobileMenu()

                // Плавная прокрутка с учётом высоты хедера
                const headerOffset = 100 // отступ сверху для хедера (в пикселях)
                const elementPosition = element.getBoundingClientRect().top // позиция элемента относительно viewport
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset // финальная позиция с учётом скролла

                // Прокручиваем плавно
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth',
                })
            }
        } else {
            closeMobileMenu()

            // Переходим на главную + добавляем хеш (например: /ru#category-5)
            router.visit(localizedRoute('/') + `#category-${categoryId}`)
        }
    }
</script>
