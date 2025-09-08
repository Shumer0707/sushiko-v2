<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="space-x-4">
        <Link href="/dashboard" class="hover:underline">Главная</Link>
        <Link href="/orders" class="hover:underline">Мои заказы</Link>
        <Link href="/profile" class="hover:underline">Профиль</Link>
    </nav>
</template>
