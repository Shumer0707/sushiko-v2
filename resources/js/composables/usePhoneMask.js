// resources/js/composables/usePhoneMask.js

import { ref } from 'vue'
import countryCodes from '@/data/countryCodes.json'

export function usePhoneMask(initialValue = '') {
    const formattedValue = ref(initialValue)

    // Определение длины кода страны
    const getCountryCodeLength = (digits) => {
        if (digits.length === 0) return 0

        // Проверяем 1 цифру
        if (countryCodes[digits[0]]) {
            return countryCodes[digits[0]]
        }

        // Проверяем 2 цифры
        if (digits.length >= 2) {
            const twoDigit = digits.slice(0, 2)
            if (countryCodes[twoDigit]) {
                return countryCodes[twoDigit]
            }
        }

        // Проверяем 3 цифры
        if (digits.length >= 3) {
            const threeDigit = digits.slice(0, 3)
            if (countryCodes[threeDigit]) {
                return countryCodes[threeDigit]
            }
        }

        // По умолчанию 3 цифры
        return 3
    }

    // Форматирование телефона
    const formatPhone = (value) => {
        // Только цифры
        const digits = value.replace(/\D/g, '')

        if (digits.length === 0) {
            return ''
        }

        const countryCodeLength = getCountryCodeLength(digits)
        let formatted = '+'

        if (digits.length <= countryCodeLength) {
            formatted += digits
        } else {
            formatted += digits.slice(0, countryCodeLength) + ' '

            const remainingDigits = digits.slice(countryCodeLength)

            if (remainingDigits.length <= 2) {
                formatted += remainingDigits
            } else if (remainingDigits.length <= 5) {
                formatted += remainingDigits.slice(0, 2) + ' ' + remainingDigits.slice(2)
            } else if (remainingDigits.length <= 8) {
                formatted += remainingDigits.slice(0, 2) + ' ' + remainingDigits.slice(2, 5) + ' ' + remainingDigits.slice(5)
            } else {
                formatted +=
                    remainingDigits.slice(0, 2) +
                    ' ' +
                    remainingDigits.slice(2, 5) +
                    ' ' +
                    remainingDigits.slice(5, 8) +
                    ' ' +
                    remainingDigits.slice(8, 11)
            }
        }

        return formatted
    }

    const getCleanValue = () => {
        const digits = formattedValue.value.replace(/\D/g, '')
        return digits ? '+' + digits : ''
    }

    const handleInput = (event) => {
        const cursorPosition = event.target.selectionStart
        const oldValue = formattedValue.value
        const newValue = event.target.value

        const formatted = formatPhone(newValue)
        formattedValue.value = formatted

        setTimeout(() => {
            if (event.target) {
                let newCursorPosition = cursorPosition

                if (formatted.length - oldValue.length > 1) {
                    newCursorPosition = cursorPosition + (formatted.length - oldValue.length)
                } else if (formatted.length < oldValue.length && cursorPosition > 0) {
                    if (oldValue[cursorPosition] === ' ') {
                        newCursorPosition = cursorPosition - 1
                    }
                }

                newCursorPosition = Math.min(Math.max(0, newCursorPosition), formatted.length)
                event.target.setSelectionRange(newCursorPosition, newCursorPosition)
            }
        }, 0)
    }

    const isValid = () => {
        const digits = formattedValue.value.replace(/\D/g, '')
        return digits.length >= 10
    }

    return {
        formattedValue,
        handleInput,
        getCleanValue,
        isValid,
    }
}
