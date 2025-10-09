<template>
    <div
        :class="[
            'fixed top-0 left-0 right-0 bg-sushi-dark shadow-xl z-50 transition-transform duration-300 border-b border-gray-700',
            isVisible ? 'translate-y-0' : '-translate-y-full',
        ]"
    >
        <div class="container mx-auto px-4 py-3 lg:py-2">
            <div class="flex justify-between items-center">
                <!-- Лого -->
                <Link :href="localizedRoute('/')" class="flex items-center">
                    <img src="/images/logo-v1.webp" alt="" class="w-32 lg:w-48" />
                </Link>

                <!-- 🎯 Навигация по категориям - теперь с прокруткой (только lg+ экраны) -->
                <nav class="hidden lg:flex space-x-6 xl:space-x-6 lg:space-x-3 flex-1 justify-center">
                    <a
                        v-for="category in categories"
                        :key="category.id"
                        :href="`#category-${category.id}`"
                        @click.prevent="scrollToCategory(category.id)"
                        class="text-white hover:text-sushi-gold transition-colors font-medium text-sm xl:text-sm lg:text-xs cursor-pointer"
                    >
                        {{ category.name }}
                    </a>
                </nav>

                <!-- Правая часть: Корзина + Гамбургер -->
                <div class="flex items-center space-x-3">
                    <!-- Корзина (всегда видна) -->
                    <MiniCart />

                    <!-- Гамбургер (только на мобильных < lg) -->
                    <BurgerButton :is-open="mobileMenuOverlay.isOpen.value" @toggle="toggleMobileMenu" />
                </div>
            </div>

            <!-- Мобильное меню для sticky header -->
            <MobileMenu
                v-if="mobileMenuOverlay.isOpen.value"
                :modal-id="'sticky-mobile-menu'"
                :is-visible="mobileMenuOverlay.isOpen.value"
                :is-closing="mobileMenuOverlay.isClosing.value"
                :categories="categories"
                :current-locale="page.props.current_locale"
                @close="mobileMenuOverlay.close()"
                @scroll-to-category="scrollToCategory"
            />
        </div>
    </div>
</template>

<script setup>
    import { Link, usePage, router } from '@inertiajs/vue3'
    import { useLocale } from '@/composables/useLocale'
    import { useOverlay } from '@/composables/useOverlay'
    import MiniCart from '@/Components/Navigation/MiniCart.vue'
    import MobileMenu from '@/Components/Navigation/MobileMenu.vue'
    import { ref, onMounted, onUnmounted } from 'vue'
    import BurgerButton from '@/Components/Navigation/BurgerButton.vue'

    const page = usePage()
    const categories = page.props.navigation_categories
    const currentLocale = page.props.current_locale
    const { localizedRoute } = useLocale()

    // Состояние видимости
    const isVisible = ref(false)

    // Мобильное меню через систему оверлеев
    const mobileMenuOverlay = useOverlay('sticky-mobile-menu')

    // Переключение мобильного меню
    const toggleMobileMenu = () => {
        mobileMenuOverlay.toggle()
    }

    // Обработчик скролла
    const handleScroll = () => {
        const currentScrollY = window.scrollY

        if (currentScrollY > 200) {
            isVisible.value = true
        } else {
            isVisible.value = false
            mobileMenuOverlay.close() // закрываем мобильное меню при скролле вверх
        }
    }

    // 🎯 ФУНКЦИЯ ПРОКРУТКИ К КАТЕГОРИИ (та же логика что в Header.vue)
    const scrollToCategory = (categoryId) => {
        // Получаем текущий путь страницы
        const currentPath = window.location.pathname

        // Варианты главной страницы (с учётом локализации)
        const homePathVariants = ['/', `/${currentLocale}`, `/${currentLocale}/`]

        // Проверяем, находимся ли мы на главной странице
        const isHomePage = homePathVariants.some((path) => currentPath === path)

        if (isHomePage) {
            // ✅ МЫ УЖЕ НА ГЛАВНОЙ - просто скроллим
            const element = document.getElementById(`category-${categoryId}`)

            if (element) {
                // Закрываем мобильное меню (если оно открыто)
                mobileMenuOverlay.close()

                // Плавная прокрутка с учётом высоты sticky header
                const headerOffset = 100
                const elementPosition = element.getBoundingClientRect().top
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth',
                })
            }
        } else {
            // ❌ МЫ НА ДРУГОЙ СТРАНИЦЕ - переходим на главную с хешем
            mobileMenuOverlay.close()

            // Переход на главную + хеш
            router.visit(localizedRoute('/') + `#category-${categoryId}`)
        }
    }

    onMounted(() => {
        window.addEventListener('scroll', handleScroll)
    })

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll)
    })
</script>
