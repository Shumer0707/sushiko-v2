import { usePage } from '@inertiajs/vue3'

export function useLocale() {
    const page = usePage()
    const currentLocale = page.props.current_locale

    const localizedRoute = (path) => {
        return `/${currentLocale}${path === '/' ? '' : path}`
    }

    return {
        currentLocale,
        localizedRoute
    }
}
