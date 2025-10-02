<!-- Components/UI/OverlayBackdrop.vue -->
<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition-opacity duration-300 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition-opacity duration-200 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="isVisible"
                class="fixed inset-0 bg-sushi-dark bg-opacity-50"
                :style="{ zIndex: zIndex }"
                @click="handleBackdropClick"
            >
                <!-- Слот для контента меню -->
                <slot />
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
    // Props
    const props = defineProps({
        isVisible: {
            type: Boolean,
            required: true,
        },
        closeOnBackdropClick: {
            type: Boolean,
            default: true,
        },
        zIndex: {
            type: Number,
            default: 20, // ставим 50 по умолчанию (было 20, но это слишком низко)
        },
    })

    // Events
    const emit = defineEmits(['close'])

    // Обработчик клика по затемнению
    const handleBackdropClick = (event) => {
        // Если клик именно по backdrop (не по содержимому)
        if (event.target === event.currentTarget && props.closeOnBackdropClick) {
            emit('close')
        }
    }
</script>
