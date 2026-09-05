import { ref, onMounted, onUnmounted } from 'vue'

/**
 * Параллакс-фон
 *
 * @param {number} speed - скорость параллакса (0.1–0.3)
 * @param {number} breakpoint - ширина, ниже которой параллакс отключаем (мобилки)
 */
export function useParallaxBackground(speed = 0.2, breakpoint = 768) {
    const elementRef = ref(null)
    let ticking = false
    let isActive = false

    const updatePosition = () => {
        const el = elementRef.value
        if (!el) return

        // читаем скролл один раз, внутри rAF
        const scrolled = window.scrollY || window.pageYOffset || document.documentElement.scrollTop || 0

        const offset = scrolled * speed

        // только запись transform — без дополнительных чтений layout
        el.style.transform = `translate3d(0, ${-offset}px, 0)`
    }

    const handleScroll = () => {
        if (!isActive) return
        if (ticking) return

        ticking = true
        window.requestAnimationFrame(() => {
            updatePosition()
            ticking = false
        })
    }

    onMounted(() => {
        if (typeof window === 'undefined') return

        // На мобильных устройствах и при системном ограничении движения фон остаётся статичным.
        if (window.innerWidth < breakpoint || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            isActive = false
            return
        }

        isActive = true
        window.addEventListener('scroll', handleScroll, { passive: true })

        // начальная позиция
        updatePosition()
    })

    onUnmounted(() => {
        if (isActive) {
            window.removeEventListener('scroll', handleScroll)
        }
        isActive = false
    })

    // ref-callback для :ref="backgroundRef"
    return (el) => {
        elementRef.value = el
    }
}
