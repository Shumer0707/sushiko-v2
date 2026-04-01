<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        banners: Array,
    })
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-admin-text">Баннеры главной</h1>
            <Link
                :href="route('admin.home-banners.create')"
                class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition"
            >
                Добавить баннер
            </Link>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
                <thead class="bg-admin-background text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Порядок</th>
                        <th class="px-4 py-2 border">Превью</th>
                        <th class="px-4 py-2 border">Заголовок</th>
                        <th class="px-4 py-2 border">Ссылка</th>
                        <th class="px-4 py-2 border">Статус</th>
                        <th class="px-4 py-2 border">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="banner in banners" :key="banner.id" class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ banner.id }}</td>
                        <td class="px-4 py-2 border">{{ banner.sort_order }}</td>
                        <td class="px-4 py-2 border">
                            <img
                                v-if="banner.translation?.image_desktop_url"
                                :src="banner.translation.image_desktop_url"
                                alt=""
                                class="w-24 h-12 object-cover border rounded"
                            />
                            <span v-else>-</span>
                        </td>
                        <td class="px-4 py-2 border">{{ banner.translation?.title || '-' }}</td>
                        <td class="px-4 py-2 border">{{ banner.link || '-' }}</td>
                        <td class="px-4 py-2 border">
                            <span
                                class="inline-block px-2 py-1 rounded text-xs font-medium"
                                :class="banner.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'"
                            >
                                {{ banner.is_active ? 'Активен' : 'Неактивен' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border whitespace-nowrap space-x-2">
                            <Link
                                :href="route('admin.home-banners.edit', banner.id)"
                                class="inline-block px-2.5 py-1.5 bg-admin-primary text-white rounded-lg hover:bg-admin-muted transition"
                            >
                                Редактировать
                            </Link>
                            <Link
                                as="button"
                                method="delete"
                                :href="route('admin.home-banners.destroy', banner.id)"
                                class="inline-block px-2.5 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                            >
                                Удалить
                            </Link>
                        </td>
                    </tr>

                    <tr v-if="banners.length === 0">
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Баннеров пока нет</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
