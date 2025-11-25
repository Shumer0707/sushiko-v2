<template>
    <OverlayBackdrop :is-visible="isOpen" :z-index="9999" @close="close">
        <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center p-4" @click="close">
            <div
                @click.stop
                :class="[
                    'bg-sushi-dark border border-sushi-gold rounded-xl w-full max-w-md p-6 text-center modal-content',
                    isClosing ? 'closing' : '',
                ]"
            >
                <!-- Иконка -->
                <div class="text-sushi-gold text-5xl mb-4">✔️</div>

                <!-- Заголовок -->
                <h2 class="text-2xl font-bold text-sushi-silver mb-2">
                    {{ title }}
                </h2>

                <!-- Текст -->
                <p class="text-sushi-silver/80 text-sm">
                    {{ message }}
                </p>

                <!-- Кнопка -->
                <button
                    @click="close"
                    class="mt-6 w-full bg-sushi-gold hover:bg-sushi-gold_op text-sushi-dark py-3 rounded-lg font-medium transition-colors"
                >
                    {{ buttonText }}
                </button>
            </div>
        </div>
    </OverlayBackdrop>
</template>

<script setup>
    import { ref } from 'vue'
    import OverlayBackdrop from '@/Components/UI/OverlayBackdrop.vue'

    const props = defineProps({
        isOpen: Boolean,
        title: { type: String, default: 'Заказ принят' },
        message: {
            type: String,
            default: 'Ваш заказ успешно оформлен. Ожидайте звонка оператора.',
        },
        buttonText: { type: String, default: 'Закрыть' },
    })

    const emit = defineEmits(['close'])

    const isClosing = ref(false)

    const close = () => {
        isClosing.value = true
        setTimeout(() => emit('close'), 250)
    }
</script>

<style scoped>
    .modal-content {
        animation: modalSlideIn 0.4s ease-out forwards;
    }

    @keyframes modalSlideIn {
        0% {
            opacity: 0;
            transform: translateY(-100%);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-content.closing {
        animation: modalSlideOut 0.25s ease-in forwards;
    }

    @keyframes modalSlideOut {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        50% {
            transform: translateY(1%);
        }
        100% {
            opacity: 0;
            transform: translateY(-100%);
        }
    }
</style>
