<script setup>
    import { onMounted, ref } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import { useLocale } from '@/composables/useLocale'

    const page = usePage()
    const t = page.props.translations.legal
    const version = page.props.privacy_policy.version
    const { localizedRoute } = useLocale()

    const storageKey = 'sushiko_privacy_notice'
    const isVisible = ref(false)

    onMounted(() => {
        try {
            const savedPreference = JSON.parse(localStorage.getItem(storageKey) || 'null')
            isVisible.value = savedPreference?.version !== version
        } catch {
            isVisible.value = true
        }
    })

    const acknowledge = () => {
        try {
            localStorage.setItem(
                storageKey,
                JSON.stringify({
                    version,
                    acknowledgedAt: new Date().toISOString(),
                })
            )
        } catch {
            // The notice can still be dismissed for the current page if storage is unavailable.
        }

        isVisible.value = false
    }
</script>

<template>
    <Transition
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="translate-y-5 opacity-0"
        enter-to-class="translate-y-0 opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="translate-y-0 opacity-100"
        leave-to-class="translate-y-5 opacity-0"
    >
        <div v-if="isVisible" class="fixed inset-x-0 bottom-0 z-[100] p-3 sm:p-4" role="status" aria-live="polite">
            <div
                class="mx-auto flex max-w-5xl flex-col gap-4 rounded-xl border border-sushi-gold/60 bg-sushi-dark/95 px-4 py-4 shadow-2xl backdrop-blur-md sm:flex-row sm:items-center sm:px-5"
            >
                <div class="flex min-w-0 flex-1 items-start gap-3">
                    <div
                        class="mt-0.5 flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full border border-sushi-gold/70 bg-sushi-gold/15 text-sushi-gold"
                    >
                        <i class="fa-solid fa-shield-halved text-sm"></i>
                    </div>
                    <p class="text-sm leading-relaxed text-sushi-silver/85">
                        {{ t.notice_text }}
                        <a
                            :href="localizedRoute('/privacy')"
                            class="font-medium text-sushi-gold underline decoration-sushi-gold/60 underline-offset-4 transition hover:text-sushi-silver"
                        >
                            {{ t.notice_link }}
                        </a>
                    </p>
                </div>

                <button
                    type="button"
                    class="w-full flex-shrink-0 rounded-lg bg-sushi-gold px-6 py-2.5 text-sm font-semibold text-sushi-dark transition hover:bg-sushi-gold_op sm:w-auto"
                    @click="acknowledge"
                >
                    {{ t.notice_button }}
                </button>
            </div>
        </div>
    </Transition>
</template>
