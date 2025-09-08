<script setup>
    import { usePage } from '@inertiajs/vue3'

    const user = usePage().props.auth?.user ?? null
</script>

<template>
    <Head title="Dashboard" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                Добро пожаловать, {{ user?.name || 'пользователь' }}! Здесь будут админские функции.
            </div>
        </div>
    </div>
</template>
