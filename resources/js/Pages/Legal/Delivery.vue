<script setup>
    import { usePage } from '@inertiajs/vue3'
    import AppHead from '@/Components/Seo/Head.vue'
    import ParallaxBackground from '@/Components/UI/ParallaxBackground.vue'
    import PageGradient from '@/Components/UI/PageGradient.vue'

    const page = usePage()
    const t = page.props.translations.legal
    const common = page.props.translations.common

    const deliveryRates = [
        { range: t.delivery_rate_below_200, cost: t.delivery_cost_100 },
        { range: t.delivery_rate_from_200, cost: t.delivery_cost_50 },
        { range: t.delivery_rate_from_600, cost: t.delivery_cost_free, featured: true },
    ]

    const phoneHref = `tel:${common.contacts_phone_number.replace(/\s+/g, '')}`
</script>

<template>
    <AppHead :title="t.delivery_meta_title" :description="t.delivery_meta_description" />

    <ParallaxBackground :opacity="0.28" :speed="0.15" />
    <PageGradient :opacity="[1, 0.55, 0.65, 0.85, 1]" />

    <div class="relative z-20 min-h-screen py-8 md:py-12">
        <div class="container mx-auto max-w-5xl px-4">
            <article class="overflow-hidden rounded-2xl border-2 border-sushi-gold bg-sushi-dark/90 shadow-2xl backdrop-blur-sm">
                <header class="border-b border-sushi-gold/30 px-5 py-7 text-center sm:px-8 md:px-12 md:py-10">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full border-2 border-sushi-gold bg-sushi-gold/15 text-2xl text-sushi-gold"
                    >
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h1 class="text-2xl font-bold leading-tight text-sushi-gold sm:text-3xl md:text-4xl">
                        {{ t.delivery_title }}
                    </h1>
                    <p class="mx-auto mt-3 max-w-2xl text-sm leading-relaxed text-sushi-silver/75 sm:text-base">
                        {{ t.delivery_subtitle }}
                    </p>
                </header>

                <div class="space-y-8 px-5 py-7 sm:px-8 md:px-12 md:py-10">
                    <section>
                        <h2 class="mb-4 flex items-center gap-3 text-xl font-bold text-sushi-gold sm:text-2xl">
                            <i class="fa-solid fa-motorcycle text-lg"></i>
                            {{ t.delivery_courier_title }}
                        </h2>

                        <div class="grid gap-3 md:grid-cols-3">
                            <div
                                v-for="rate in deliveryRates"
                                :key="rate.range"
                                class="rounded-xl border p-4"
                                :class="
                                    rate.featured
                                        ? 'border-sushi-gold bg-sushi-gold/10'
                                        : 'border-sushi-gold/25 bg-sushi-first/45'
                                "
                            >
                                <div class="text-sm leading-relaxed text-sushi-silver/70">{{ rate.range }}</div>
                                <div class="mt-2 font-semibold text-sushi-silver">{{ rate.cost }}</div>
                            </div>
                        </div>

                        <p class="mt-5 rounded-xl border border-sushi-gold/25 bg-sushi-first/45 p-4 text-sm leading-relaxed text-sushi-silver/80 sm:text-base">
                            {{ t.delivery_outside_city_prefix }}
                            <a
                                :href="phoneHref"
                                class="whitespace-nowrap font-semibold text-sushi-gold underline decoration-sushi-gold/60 underline-offset-4 transition hover:text-sushi-silver"
                            >
                                {{ common.contacts_phone_number }}
                            </a>.
                        </p>
                    </section>

                    <section class="rounded-xl border border-sushi-gold/40 bg-sushi-gold/10 p-4 sm:p-5">
                        <h2 class="flex items-center gap-2 text-lg font-bold text-sushi-gold">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ t.delivery_important_title }}
                        </h2>
                        <p class="mt-3 leading-relaxed text-sushi-silver">{{ t.delivery_average_time }}</p>
                        <p class="mt-2 text-sm leading-relaxed text-sushi-silver/70 sm:text-base">
                            {{ t.delivery_time_exception }}
                        </p>
                    </section>

                    <section class="grid gap-4 md:grid-cols-2">
                        <div class="rounded-xl border border-sushi-gold/25 bg-sushi-first/45 p-5">
                            <h2 class="flex items-center gap-3 text-lg font-bold text-sushi-gold sm:text-xl">
                                <i class="fa-regular fa-clock"></i>
                                {{ t.delivery_scheduled_title }}
                            </h2>
                            <p class="mt-3 text-sm leading-relaxed text-sushi-silver/80 sm:text-base">
                                {{ t.delivery_scheduled_text }}
                            </p>
                        </div>

                        <div class="rounded-xl border border-sushi-gold/25 bg-sushi-first/45 p-5">
                            <h2 class="flex items-center gap-3 text-lg font-bold text-sushi-gold sm:text-xl">
                                <i class="fa-regular fa-credit-card"></i>
                                {{ t.delivery_payment_title }}
                            </h2>
                            <ul class="mt-3 space-y-3 text-sm leading-relaxed text-sushi-silver/80 sm:text-base">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check mt-1 text-xs text-sushi-gold"></i>
                                    <span>{{ t.delivery_payment_cash }}</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check mt-1 text-xs text-sushi-gold"></i>
                                    <span>{{ t.delivery_payment_card }}</span>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </article>
        </div>
    </div>
</template>
