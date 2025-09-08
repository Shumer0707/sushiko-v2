<script setup>
    import { Link, useForm } from '@inertiajs/vue3'

    defineProps({ attributes: Array })

    const form = useForm({})
    const destroy = (id) => {
        if (confirm('Удалить атрибут?')) {
            form.delete(route('admin.attributes.destroy', id))
        }
    }
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-admin-text">Атрибуты</h1>
            <Link
                :href="route('admin.attributes.create')"
                class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition"
            >
                Добавить
            </Link>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
                <thead class="bg-admin-background text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Название (RU)</th>
                        <th class="px-4 py-2 border">Фильтр</th>
                        <th class="px-4 py-2 border">Вариант</th>
                        <th class="px-4 py-2 border">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="attr in attributes" :key="attr.id" class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ attr.id }}</td>
                        <td class="px-4 py-2 border">
                            {{ attr.translations.find((t) => t.language === 'ru')?.name || '—' }}
                        </td>
                        <td class="px-4 py-2 border">{{ attr.is_filterable ? 'Да' : 'Нет' }}</td>
                        <td class="px-4 py-2 border">{{ attr.is_variant ? 'Да' : 'Нет' }}</td>
                        <td class="px-4 py-2 border space-x-1 whitespace-nowrap">
                            <Link
                                :href="route('admin.attributes.edit', attr.id)"
                                class="inline-block px-2.5 py-1.5 bg-admin-primary text-white rounded-lg hover:bg-admin-muted transition"
                            >
                                Редактировать
                            </Link>
                            <Link
                                :href="route('admin.attribute-values.index', attr.id)"
                                class="inline-block px-2.5 py-1.5 bg-admin-muted text-white rounded-lg hover:bg-admin-text transition"
                            >
                                Значения
                            </Link>
                            <button
                                @click="destroy(attr.id)"
                                class="inline-block px-2.5 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                            >
                                Удалить
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
