import { ref, onMounted, onUnmounted } from 'vue'

/**
 * Композабл для параллакс-фона (fixed элементов)
 *
 * @param {number} speed - скорость параллакса (чем МЕНЬШЕ - тем медленнее)
 *   0.1 = очень медленно (почти незаметно)
 *   0.2 = медленно (рекомендуется для фона)
 *   0.3 = средне
 *   0.5 = быстро
 */
export function useParallaxBackground(speed = 0.2) {
    const elementRef = ref(null)
    let ticking = false

    const handleScroll = () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                updatePosition()
                ticking = false
            })
            ticking = true
        }
    }

    const updatePosition = () => {
        if (!elementRef.value) return

        const scrolled = window.pageYOffset
        const offset = scrolled * speed

        // Двигаем фон вверх при скролле вниз
        elementRef.value.style.transform = `translate3d(0, ${-offset}px, 0)`
    }

    onMounted(() => {
        window.addEventListener('scroll', handleScroll, { passive: true })
        updatePosition()
    })

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll)
    })

    return (el) => {
        elementRef.value = el
    }
}
