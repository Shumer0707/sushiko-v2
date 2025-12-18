let initialized = false

const KEY_PREV = 'prev_internal_url'
const KEY_CUR = 'current_internal_url'

const getPath = () => window.location.pathname + window.location.search + window.location.hash

export function useInternalBack() {
    const init = () => {
        if (initialized) return
        initialized = true

        // current при старте
        sessionStorage.setItem(KEY_CUR, getPath())

        // Перед любой Inertia-навигацией (включая router.visit)
        document.addEventListener('inertia:before', () => {
            const cur = sessionStorage.getItem(KEY_CUR) || getPath()
            sessionStorage.setItem(KEY_PREV, cur)
        })

        // После навигации — фиксируем новый current
        document.addEventListener('inertia:navigate', () => {
            sessionStorage.setItem(KEY_CUR, getPath())
        })
    }

    const getBackUrl = (fallbackUrl) => {
        const prev = sessionStorage.getItem(KEY_PREV)
        if (prev && prev.startsWith('/')) return prev
        return fallbackUrl
    }

    return { init, getBackUrl }
}
