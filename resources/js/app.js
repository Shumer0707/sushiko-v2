import '../css/app.css'
import './bootstrap'

import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import { createPinia } from 'pinia'
import { router } from '@inertiajs/vue3'

import MainLayout from './Layouts/MainLayout.vue'
import AuthenticatedLayout from './Layouts/AuthenticatedLayout.vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

// страницы без авторизации
const publicPages = ['Home', 'About', 'Contact', 'Cart', 'Product', 'Errors/404']
// при желании сюда можно добавить ещё: 'Catalog', 'Product', и т.д.

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    title: (title) => title,
    resolve: (name) =>
        resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')).then((page) => {
            // Если в самом компоненте уже прописан layout — не трогаем
            if (page.default.layout) {
                return page
            }

            const isPublic = publicPages.includes(name)
            const isAdmin = name.startsWith('Admin/')

            // Если явно не указали, выбираем по правилам
            page.default.layout = isAdmin ? AuthenticatedLayout : isPublic ? MainLayout : AuthenticatedLayout

            return page
        }),
    setup({ el, App, props, plugin }) {
        const pinia = createPinia()
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .mount(el)
    },
    progress: { color: '#4B5563' },
})

// Блокируем автоскролл браузера при переходах с хэшем
router.on('before', (event) => {
    const url = event.detail.visit.url
    if (url.hash) {
        event.detail.visit.preserveScroll = true
    }
})
