<template>
    <Head :title="meta?.title" />

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-xl text-center bg-white/5 backdrop-blur rounded-2xl p-8 border border-white/10">
            <div class="text-4xl mb-4">🎄</div>

            <h1 class="text-2xl font-semibold text-white">
                {{ t.title }}
            </h1>

            <p class="mt-3 text-white/70">
                {{ t.text }}
            </p>

            <p class="mt-6 text-white/80 font-medium">
                {{ t.happy_new_year }}
            </p>
        </div>
    </div>
</template>

<script setup>
    import { Head, usePage } from '@inertiajs/vue3'

    const page = usePage()
    const meta = page.props.meta
    const t = page.props.translations.maintenance
</script>
