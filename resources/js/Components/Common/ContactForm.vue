<script setup>
import { reactive } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const form = reactive({
    name: '',
    email: '',
    message: ''
});

const errors = usePage().props.errors || {};
const flash = usePage().props.flash || {};

function submit() {
    router.post(route('contact.send'), form, {
        preserveScroll: true,
    });
}
</script>

<template>
    <div class="max-w-lg mx-auto">
        <h2 class="text-2xl font-bold mb-4">Связаться с нами</h2>

        <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block font-medium">Имя</label>
                <input v-model="form.name" type="text" class="border rounded px-3 py-2 w-full" />
                <div v-if="errors.name" class="text-red-500 text-sm">{{ errors.name }}</div>
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input v-model="form.email" type="email" class="border rounded px-3 py-2 w-full" />
                <div v-if="errors.email" class="text-red-500 text-sm">{{ errors.email }}</div>
            </div>

            <div>
                <label class="block font-medium">Сообщение</label>
                <textarea v-model="form.message" rows="4" class="border rounded px-3 py-2 w-full"></textarea>
                <div v-if="errors.message" class="text-red-500 text-sm">{{ errors.message }}</div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Отправить
            </button>

            <div v-if="flash.success" class="text-green-600 mt-2">{{ flash.success }}</div>
        </form>
    </div>
</template>
