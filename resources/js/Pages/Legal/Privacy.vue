<script setup>
    import { computed } from 'vue'
    import { usePage } from '@inertiajs/vue3'
    import AppHead from '@/Components/Seo/Head.vue'
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'

    const props = defineProps({
        document: {
            type: Object,
            required: true,
        },
    })

    const page = usePage()
    const t = page.props.translations.legal

    const publishedDate = computed(() => {
        const [year, month, day] = props.document.publishedAt.split('-').map(Number)
        const locale = page.props.locale === 'en' ? 'en-GB' : page.props.locale

        return new Intl.DateTimeFormat(locale, {
            day: '2-digit',
            month: 'long',
            year: 'numeric',
        }).format(new Date(year, month - 1, day))
    })

    const printDocument = () => window.print()
</script>

<template>
    <AppHead :title="t.privacy_meta_title" :description="t.privacy_meta_description" />

    <ParallaxBackground :opacity="0.28" :speed="0.15" />
    <PageGradient :opacity="[1, 0.55, 0.65, 0.85, 1]" />

    <div class="legal-page relative z-20 min-h-screen py-8 md:py-12">
        <div class="container mx-auto max-w-5xl px-4">
            <article class="overflow-hidden rounded-2xl border-2 border-sushi-gold bg-sushi-dark/90 shadow-2xl backdrop-blur-sm">
                <header class="border-b border-sushi-gold/30 px-5 py-7 text-center sm:px-8 md:px-12 md:py-10">
                    <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full border-2 border-sushi-gold bg-sushi-gold/15 text-2xl text-sushi-gold">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h1 class="text-2xl font-bold leading-tight text-sushi-gold sm:text-3xl md:text-4xl">
                        {{ t.privacy_title }}
                    </h1>
                    <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-sushi-silver/75 sm:text-base">
                        {{ t.privacy_subtitle }}
                    </p>

                    <div class="mt-5 flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-xs text-sushi-silver/60 sm:text-sm">
                        <span>{{ t.version_label }}: {{ document.version }}</span>
                        <span class="hidden h-1 w-1 rounded-full bg-sushi-gold/60 sm:block"></span>
                        <span>{{ t.published_label }}: {{ publishedDate }}</span>
                    </div>

                    <button
                        type="button"
                        class="no-print mt-6 inline-flex items-center gap-2 rounded-lg bg-sushi-gold px-5 py-3 text-sm font-semibold text-sushi-dark transition hover:bg-sushi-gold_op"
                        @click="printDocument"
                    >
                        <i class="fa-solid fa-print"></i>
                        {{ t.print_button }}
                    </button>
                </header>

                <div class="px-5 py-7 sm:px-8 md:px-12 md:py-10">
                    <div class="legal-content" v-html="document.content"></div>

                    <p
                        v-if="$page.props.locale !== 'ro'"
                        class="mt-10 rounded-xl border border-sushi-gold/30 bg-sushi-first/60 px-4 py-3 text-xs leading-relaxed text-sushi-silver/65 sm:text-sm"
                    >
                        {{ t.authoritative_notice }}
                    </p>
                </div>
            </article>
        </div>
    </div>
</template>

<style scoped>
    .legal-content {
        color: rgba(236, 244, 244, 0.86);
        font-size: 0.95rem;
        line-height: 1.8;
    }

    .legal-content :deep(h2) {
        margin-top: 2.25rem;
        margin-bottom: 0.85rem;
        color: rgb(212, 175, 55);
        font-size: 1.35rem;
        font-weight: 700;
        line-height: 1.35;
    }

    .legal-content :deep(h2:first-child) {
        margin-top: 0;
    }

    .legal-content :deep(h3) {
        margin-top: 1.5rem;
        margin-bottom: 0.65rem;
        color: rgba(236, 244, 244, 0.95);
        font-size: 1.05rem;
        font-weight: 600;
    }

    .legal-content :deep(p) {
        margin-bottom: 0.85rem;
    }

    .legal-content :deep(ul) {
        margin: 0.75rem 0 1rem 1.25rem;
        list-style: disc;
    }

    .legal-content :deep(li) {
        margin-bottom: 0.4rem;
        padding-left: 0.25rem;
    }

    .legal-content :deep(strong) {
        color: rgba(236, 244, 244, 0.98);
        font-weight: 600;
    }

    .legal-content :deep(a) {
        color: rgb(212, 175, 55);
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    @media (min-width: 768px) {
        .legal-content {
            font-size: 1rem;
        }
    }

    @media print {
        :global(header),
        :global(footer),
        :global(.no-print) {
            display: none !important;
        }

        .legal-page {
            min-height: auto;
            padding: 0;
        }

        article {
            border: 0;
            box-shadow: none;
        }

        .legal-content,
        .legal-content :deep(h3),
        .legal-content :deep(strong) {
            color: #111;
        }

        .legal-content :deep(h2),
        .legal-content :deep(a) {
            color: #6f5600;
        }
    }
</style>
