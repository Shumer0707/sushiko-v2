<script setup>
    import { Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        attribute: { type: Object, required: true },
        values: { type: Array, required: true },
    })

    const destroyValue = (id) => {
        if (confirm('Удалить это значение?')) {
            router.delete(
                route('admin.attribute-values.destroy', {
                    attribute: props.attribute.id,
                    value: id,
                })
            )
        }
    }
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col items-stretch gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-xl font-semibold text-admin-text">
                Значения: {{ attribute.translation?.name || `#${attribute.id}` }}
            </h1>
            <div class="grid grid-cols-2 gap-2 sm:flex">
                <Link
                    :href="route('admin.attributes.index')"
                    class="rounded-lg border px-3 py-2 text-center text-sm text-admin-text transition hover:bg-admin-background sm:px-4"
                >
                    ← К атрибутам
                </Link>
                <Link
                    :href="route('admin.attribute-values.create', attribute.id)"
                    class="rounded-lg bg-admin-primary px-3 py-2 text-center text-sm text-white transition hover:bg-admin-muted sm:px-4"
                >
                    Добавить
                </Link>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
                <thead class="bg-admin-background text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">RU</th>
                        <th class="px-4 py-2 border">RO</th>
                        <th class="px-4 py-2 border">EN</th>
                        <th class="px-4 py-2 border">Порядок</th>
                        <th class="px-4 py-2 border">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="v in values" :key="v.id" class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ v.id }}</td>
                        <td class="px-4 py-2 border">{{ v.translations.find((t) => t.language === 'ru')?.value || '—' }}</td>
                        <td class="px-4 py-2 border">{{ v.translations.find((t) => t.language === 'ro')?.value || '—' }}</td>
                        <td class="px-4 py-2 border">{{ v.translations.find((t) => t.language === 'en')?.value || '—' }}</td>
                        <td class="px-4 py-2 border">{{ v.sort_order }}</td>
                        <td class="px-4 py-2 border whitespace-nowrap space-x-1">
                            <Link
                                :href="
                                    route('admin.attribute-values.edit', {
                                        attribute: attribute.id,
                                        value: v.id,
                                    })
                                "
                                class="inline-block px-2.5 py-1.5 bg-admin-primary text-white rounded-lg hover:bg-admin-muted transition"
                            >
                                Редактировать
                            </Link>
                            <button
                                @click="destroyValue(v.id)"
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
