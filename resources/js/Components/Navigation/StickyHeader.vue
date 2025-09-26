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
                    <div class="text-white">
                        <div class="text-lg xl:text-xl lg:text-base font-bold tracking-wider">SUSHIKO</div>
                        <div class="text-xs xl:text-xs lg:text-[10px] text-gray-300 -mt-1 tracking-widest">sushi & rolls</div>
                    </div>
                </Link>

                <!-- Навигация по категориям (только lg+ экраны) -->
                <nav class="hidden lg:flex space-x-6 xl:space-x-6 lg:space-x-3 flex-1 justify-center">
                    <Link
                        v-for="category in categories"
                        :key="category.id"
                        :href="localizedRoute(`/category/${category.slug}`)"
                        class="text-white hover:text-sushi-gold transition-colors font-medium text-sm xl:text-sm lg:text-xs"
                    >
                        {{ category.name }}
                    </Link>
                </nav>

                <!-- Правая часть: Корзина + Гамбургер -->
                <div class="flex items-center space-x-3">
                    <!-- Корзина (всегда видна) -->
                    <MiniCart />

                    <!-- Гамбургер (только на мобильных < lg) -->
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

            <!-- Мобильное меню для sticky header -->
            <MobileMenu
                v-if="mobileMenuOverlay.isOpen.value"
                :is-visible="mobileMenuOverlay.isOpen.value"
                :categories="categories"
                :current-locale="page.props.current_locale"
                @close="mobileMenuOverlay.close()"
            />
        </div>
    </div>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { useLocale } from '@/composables/useLocale'
    import { useOverlay } from '@/composables/useOverlay'
    import MiniCart from '@/Components/Navigation/MiniCart.vue'
    import MobileMenu from '@/Components/Navigation/MobileMenu.vue'
    import { ref, onMounted, onUnmounted } from 'vue'

    const page = usePage()
    const categories = page.props.navigation_categories
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

    onMounted(() => {
        window.addEventListener('scroll', handleScroll)
    })

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll)
    })
</script>
