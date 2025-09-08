<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        categories: Array,
    })
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-admin-text">Категории</h1>
            <Link
                :href="route('admin.categories.create')"
                class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition"
            >
                Добавить категорию
            </Link>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
                <thead class="bg-admin-background text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Картинка</th>
                        <th class="px-4 py-2 border">Название</th>
                        <th class="px-4 py-2 border">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories" :key="category.id" class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ category.id }}</td>
                        <td class="px-4 py-2 border">
                            <img :src="category.image_url" alt="" class="w-12 h-12 object-cover border rounded" />
                        </td>
                        <td class="px-4 py-2 border">{{ category.translation?.name || '—' }}</td>
                        <td class="px-4 py-2 border space-x-2 whitespace-nowrap">
                            <Link
                                :href="route('admin.categories.edit', category.id)"
                                class="inline-block px-2.5 py-1.5 bg-admin-primary text-white rounded-lg hover:bg-admin-muted transition"
                            >
                                Редактировать
                            </Link>
                            <Link
                                as="button"
                                method="delete"
                                :href="route('admin.categories.destroy', category.id)"
                                class="inline-block px-2.5 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                            >
                                Удалить
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
