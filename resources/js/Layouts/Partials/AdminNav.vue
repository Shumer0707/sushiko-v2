<script setup>
    import { Link, usePage } from '@inertiajs/vue3'

    const isActivePath = (prefix) => usePage().url.startsWith(prefix)

    const navItems = [
        { name: 'Главная', route: 'admin.dashboard', path: '/admin', exact: true },
        { name: 'Категории', route: 'admin.categories.index', path: '/admin/categories' },
        { name: 'Бренды', route: 'admin.brands.index', path: '/admin/brands' },
        { name: 'Товары', route: 'admin.products.index', path: '/admin/products' },
        { name: 'Атрибуты', route: 'admin.attributes.index', path: '/admin/attributes' },
        { name: 'Заказы', route: 'admin.orders.index', path: '/admin/orders' },
        { name: 'Акции', route: 'admin.promotions.index', path: '/admin/promotions' },
    ]
</script>

<template>
    <nav class="flex gap-3">
        <template v-for="item in navItems" :key="item.route">
            <Link
                :href="route(item.route)"
                :class="[
                    'px-3 py-1 rounded',
                    item.exact
                        ? isActivePath(item.path) &&
                          !isActivePath('/admin/categories') &&
                          !isActivePath('/admin/brands') &&
                          !isActivePath('/admin/attributes') &&
                          !isActivePath('/admin/products')&&
                          !isActivePath('/admin/orders')&&
                          !isActivePath('/admin/promotions')
                            ? 'bg-gray-900 text-white'
                            : 'bg-gray-100 hover:bg-gray-200'
                        : isActivePath(item.path)
                        ? 'bg-gray-900 text-white'
                        : 'bg-gray-100 hover:bg-gray-200',
                ]"
            >
                {{ item.name }}
            </Link>
        </template>
    </nav>
</template>
