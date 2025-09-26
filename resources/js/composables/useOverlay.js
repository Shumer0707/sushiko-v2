// resources/js/composables/useOverlay.js
import { ref, nextTick } from 'vue'

// Глобальное состояние для всех оверлеев
const activeOverlays = ref(new Set())
const isAnyOverlayActive = ref(false)

export function useOverlay(overlayId) {
    const isOpen = ref(false)

    const open = async () => {
        if (isOpen.value) return

        // Добавляем в активные оверлеи
        activeOverlays.value.add(overlayId)
        isAnyOverlayActive.value = true
        isOpen.value = true

        // Блокируем скролл с поддержкой modern CSS и fallback
        await nextTick()
        blockScroll()
    }

    const close = () => {
        if (!isOpen.value) return

        // Убираем из активных оверлеев
        activeOverlays.value.delete(overlayId)
        isOpen.value = false

        // Если других оверлеев нет - разблокируем скролл
        if (activeOverlays.value.size === 0) {
            isAnyOverlayActive.value = false
            unblockScroll()
        }
    }

    const toggle = () => {
        isOpen.value ? close() : open()
    }

    return {
        isOpen,
        open,
        close,
        toggle,
        isAnyOverlayActive,
    }
}

// Блокировка скролла с умным определением метода
function blockScroll() {
    const body = document.body
    const html = document.documentElement

    // Проверяем поддержку scrollbar-gutter
    if (CSS.supports('scrollbar-gutter', 'stable')) {
        // Современный подход - используем CSS
        body.style.overflow = 'hidden'
    } else {
        // Fallback для старых браузеров
        const scrollbarWidth = getScrollbarWidth()

        // Сохраняем текущее состояние
        body.dataset.originalOverflow = body.style.overflow
        body.dataset.originalPaddingRight = body.style.paddingRight

        // Применяем блокировку с компенсацией
        body.style.overflow = 'hidden'
        body.style.paddingRight = `${(parseInt(body.style.paddingRight) || 0) + scrollbarWidth}px`
    }
}

// Разблокировка скролла
function unblockScroll() {
    const body = document.body

    if (CSS.supports('scrollbar-gutter', 'stable')) {
        // Современный подход
        body.style.overflow = ''
    } else {
        // Fallback - восстанавливаем сохраненные значения
        body.style.overflow = body.dataset.originalOverflow || ''
        body.style.paddingRight = body.dataset.originalPaddingRight || ''

        // Очищаем dataset
        delete body.dataset.originalOverflow
        delete body.dataset.originalPaddingRight
    }
}

// Утилита для определения ширины скроллбара (для fallback)
function getScrollbarWidth() {
    // Кешируем результат
    if (typeof getScrollbarWidth.cached !== 'undefined') {
        return getScrollbarWidth.cached
    }

    const outer = document.createElement('div')
    outer.style.cssText = `
        visibility: hidden;
        overflow: scroll;
        position: absolute;
        top: -9999px;
        width: 100px;
        height: 100px;
    `
    document.body.appendChild(outer)

    const inner = document.createElement('div')
    inner.style.width = '100%'
    outer.appendChild(inner)

    const scrollbarWidth = outer.offsetWidth - inner.offsetWidth
    document.body.removeChild(outer)

    // Кешируем результат
    getScrollbarWidth.cached = scrollbarWidth
    return scrollbarWidth
}

// Дополнительные утилиты для отладки
export const overlayDebug = {
    getActiveOverlays: () => Array.from(activeOverlays.value),
    getOverlayCount: () => activeOverlays.value.size,
    isAnyActive: () => isAnyOverlayActive.value,
    forceCloseAll: () => {
        activeOverlays.value.clear()
        isAnyOverlayActive.value = false
        unblockScroll()
    },
}
