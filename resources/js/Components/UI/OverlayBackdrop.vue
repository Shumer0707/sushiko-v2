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
            <div v-if="isVisible" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="handleBackdropClick">
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
