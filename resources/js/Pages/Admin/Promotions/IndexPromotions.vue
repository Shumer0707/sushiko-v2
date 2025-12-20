<script setup>
    import { Link } from '@inertiajs/vue3'

    defineProps({
        promotions: Object, // paginator
    })

    const typeLabel = (type) => {
        if (type === 'discount') return 'Скидка'
        if (type === 'gift') return 'Подарок'
        return '—'
    }

    const typeBadgeClass = (type) => {
        if (type === 'discount') return 'bg-green-100 text-green-700'
        if (type === 'gift') return 'bg-blue-100 text-blue-700'
        return 'bg-gray-100 text-gray-600'
    }
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-admin-text">Акции</h1>

            <Link
                :href="route('admin.promotions.create')"
                class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition"
            >
                Добавить акцию
            </Link>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
                <thead class="bg-admin-background text-left">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Товар</th>
                        <th class="px-4 py-2 border">Тип</th>
                        <th class="px-4 py-2 border">Описание</th>
                        <th class="px-4 py-2 border">Статус</th>
                        <th class="px-4 py-2 border">Действия</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="p in promotions.data" :key="p.id" class="border-t hover:bg-gray-100">
                        <!-- ID -->
                        <td class="px-4 py-2 border">{{ p.id }}</td>

                        <!-- Product -->
                        <td class="px-4 py-2 border">
                            {{ p.product?.translation?.name || '—' }}
                        </td>

                        <!-- Type -->
                        <td class="px-4 py-2 border">
                            <span class="inline-block px-2 py-1 rounded text-xs font-medium" :class="typeBadgeClass(p.type)">
                                {{ typeLabel(p.type) }}
                            </span>
                        </td>

                        <!-- Description -->
                        <td class="px-4 py-2 border">
                            <template v-if="p.type === 'discount'">
                                Цена по акции:
                                <strong>{{ p.discount_price }}</strong>
                            </template>

                            <template v-else-if="p.type === 'gift'">
                                Подарок:
                                <strong>
                                    {{ p.gift_product?.translation?.name || '—' }}
                                </strong>
                                × {{ p.gift_quantity }}
                            </template>

                            <template v-else>—</template>
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-2 border">
                            <span
                                class="inline-block px-2 py-1 rounded text-xs font-medium"
                                :class="p.is_active ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'"
                            >
                                {{ p.is_active ? 'Активна' : 'Неактивна' }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-4 py-2 border whitespace-nowrap space-x-2">
                            <Link
                                :href="route('admin.promotions.edit', p.id)"
                                class="inline-block px-2.5 py-1.5 bg-admin-primary text-white rounded-lg hover:bg-admin-muted transition"
                            >
                                Редактировать
                            </Link>

                            <Link
                                as="button"
                                method="delete"
                                :href="route('admin.promotions.destroy', p.id)"
                                class="inline-block px-2.5 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                            >
                                Удалить
                            </Link>
                        </td>
                    </tr>

                    <!-- Empty -->
                    <tr v-if="promotions.data.length === 0">
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Акций пока нет</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
