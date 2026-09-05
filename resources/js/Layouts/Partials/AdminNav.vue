<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { ref } from 'vue'

    const page = usePage()
    const isOpen = ref(false)
    const isActivePath = (prefix) => page.url.startsWith(prefix)

    const navItems = [
        { name: 'Главная', route: 'admin.dashboard', path: '/admin', exact: true },
        { name: 'Категории', route: 'admin.categories.index', path: '/admin/categories' },
        { name: 'Бренды', route: 'admin.brands.index', path: '/admin/brands' },
        { name: 'Товары', route: 'admin.products.index', path: '/admin/products' },
        { name: 'Атрибуты', route: 'admin.attributes.index', path: '/admin/attributes' },
        { name: 'Заказы', route: 'admin.orders.index', path: '/admin/orders' },
        { name: 'Акции', route: 'admin.promotions.index', path: '/admin/promotions' },
        { name: 'Баннеры', route: 'admin.home-banners.index', path: '/admin/home-banners' },
        { name: 'Статус сайта', route: 'admin.public-status.edit', path: '/admin/public-status' },
    ]

    const itemClasses = (item) => {
        const isActive = item.exact
            ? isActivePath(item.path) && !navItems.slice(1).some((navItem) => isActivePath(navItem.path))
            : isActivePath(item.path)

        return isActive ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
    }
</script>

<template>
    <nav class="relative">
        <button
            type="button"
            class="inline-flex items-center gap-2 rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white xl:hidden"
            :aria-expanded="isOpen"
            aria-controls="admin-navigation"
            @click="isOpen = !isOpen"
        >
            Разделы
            <svg
                class="h-4 w-4 transition-transform"
                :class="{ 'rotate-180': isOpen }"
                viewBox="0 0 20 20"
                fill="currentColor"
                aria-hidden="true"
            >
                <path
                    fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.25 4.5a.75.75 0 0 1-1.08 0l-4.25-4.5a.75.75 0 0 1 .02-1.06Z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>

        <div
            id="admin-navigation"
            :class="isOpen ? 'grid' : 'hidden'"
            class="absolute right-0 top-full z-40 mt-2 w-[min(20rem,calc(100vw-2rem))] grid-cols-2 gap-2 rounded-xl border border-gray-200 bg-white p-3 shadow-xl xl:static xl:mt-0 xl:flex xl:w-auto xl:flex-wrap xl:justify-end xl:border-0 xl:bg-transparent xl:p-0 xl:shadow-none"
        >
            <Link
                v-for="item in navItems"
                :key="item.route"
                :href="route(item.route)"
                :class="[
                    'rounded-lg px-3 py-2 text-center text-sm transition xl:py-1.5',
                    itemClasses(item),
                ]"
                @click="isOpen = false"
            >
                {{ item.name }}
            </Link>
        </div>
    </nav>
</template>
