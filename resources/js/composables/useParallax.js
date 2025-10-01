import { ref, onMounted, onUnmounted } from 'vue'

/**
 * Композабл для параллакс-эффекта
 *
 * @param {number} speed - скорость параллакса
 *   Положительные значения (0.1-0.5): элемент отстаёт (фоновый эффект)
 *   Отрицательные значения (-0.1 до -0.3): элемент опережает
 * @param {number} limit - максимальное смещение в пикселях (опционально)
 */
export function useParallax(speed = 0.3, limit = null) {
    const elementRef = ref(null)
    let ticking = false // для оптимизации через requestAnimationFrame

    const handleScroll = () => {
        if (!elementRef.value) return

        // Оптимизация: не вызываем transform на каждый скролл
        if (!ticking) {
            window.requestAnimationFrame(() => {
                updateTransform()
                ticking = false
            })
            ticking = true
        }
    }

    const updateTransform = () => {
        if (!elementRef.value) return

        // Получаем позицию элемента относительно viewport
        const rect = elementRef.value.getBoundingClientRect()
        const elementTop = rect.top + window.pageYOffset
        const scrolled = window.pageYOffset

        // Вычисляем смещение относительно видимости элемента
        // Когда элемент в центре экрана - смещение = 0
        const windowHeight = window.innerHeight
        const elementCenter = elementTop + rect.height / 2
        const viewportCenter = scrolled + windowHeight / 2

        let offset = (scrolled - elementTop) * speed

        // Ограничиваем смещение если задан limit
        if (limit) {
            offset = Math.max(-limit, Math.min(limit, offset))
        }

        elementRef.value.style.transform = `translate3d(0, ${offset}px, 0)`
    }

    onMounted(() => {
        if (elementRef.value) {
            // Используем Intersection Observer для оптимизации
            // (параллакс работает только когда элемент виден)
            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            window.addEventListener('scroll', handleScroll, { passive: true })
                            handleScroll() // начальная позиция
                        } else {
                            window.removeEventListener('scroll', handleScroll)
                        }
                    })
                },
                { rootMargin: '100px' } // начинаем чуть раньше
            )

            observer.observe(elementRef.value)

            // Сохраняем observer для очистки
            elementRef.value._observer = observer
        }
    })

    onUnmounted(() => {
        if (elementRef.value?._observer) {
            elementRef.value._observer.disconnect()
        }
        window.removeEventListener('scroll', handleScroll)
    })

    return (el) => {
        elementRef.value = el
    }
}
