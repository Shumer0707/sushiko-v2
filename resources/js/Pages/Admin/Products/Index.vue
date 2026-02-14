<script setup>
    import { ref } from 'vue'
    import { Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        products: {
            type: Object, // теперь объект с пагинацией
            default: () => ({ data: [], current_page: 1, last_page: 1, prev_page_url: null, next_page_url: null }),
        },
        categories: {
            type: Array,
            default: () => [],
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    })

    // локальное состояние выбранной категории
    const selectedCategoryId = ref(props.filters?.category_id ?? '')

    // фильтр по категории
    const onCategoryChange = () => {
        const value = selectedCategoryId.value || null
        router.get(route('admin.products.index'), value ? { category_id: value } : {}, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
        })
    }

    // массовая активация/деактивация
    const activateAll = () => {
        if (!confirm('Вы точно хотите активировать все товары?')) return
        router.post(route('admin.products.activateAll'), {}, { preserveState: true, preserveScroll: true })
    }

    const deactivateAll = () => {
        if (!confirm('Вы точно хотите деактивировать все товары?')) return
        router.post(route('admin.products.deactivateAll'), {}, { preserveState: true, preserveScroll: true })
    }

    // пагинация
    const goToPage = (url) => {
        if (!url) return
        router.get(url, {}, { preserveState: true, preserveScroll: true })
    }
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h1 class="text-xl font-semibold text-admin-text">Товары</h1>

            <div class="flex flex-col md:flex-row gap-3 md:items-center">
                <!-- Фильтр по категории -->
                <div class="flex items-center gap-2">
                    <span class="text-sm text-admin-text/80">Категория:</span>
                    <select
                        v-model="selectedCategoryId"
                        @change="onCategoryChange"
                        class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm text-admin-text bg-white focus:outline-none focus:ring-2 focus:ring-admin-primary/60"
                    >
                        <option value="">Все</option>
                        <option v-for="c in categories" :key="c.id" :value="c.id">
                            {{ c.translation?.name || `Категория #${c.id}` }}
                        </option>
                    </select>
                </div>

                <!-- Кнопки массовой активации -->
                <div class="flex gap-2">
                    <button
                        @click.prevent="activateAll"
                        class="px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 transition"
                    >
                        Активировать все
                    </button>
                    <button
                        @click.prevent="deactivateAll"
                        class="px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-700 transition"
                    >
                        Деактивировать все
                    </button>
                </div>

                <Link
                    :href="route('admin.products.create')"
                    class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition text-sm"
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
                        <th class="px-4 py-2 border">Изображение</th>
                        <th class="px-4 py-2 border">Название</th>
                        <th class="px-4 py-2 border">SKU</th>
                        <th class="px-4 py-2 border">Цена</th>
                        <th class="px-4 py-2 border">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="p in products.data" :key="p.id" class="border-t hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ p.id }}</td>
                        <td class="px-4 py-2 border">
                            <img :src="p.main_image_url" class="w-12 h-12 object-cover border rounded" />
                        </td>
                        <td class="px-4 py-2 border">{{ p.translation?.name || '—' }}</td>
                        <td class="px-4 py-2 border">{{ p.sku }}</td>
                        <td class="px-4 py-2 border">{{ p.price }} {{ p.currency }}</td>
                        <td class="px-4 py-2 border whitespace-nowrap space-x-2">
                            <Link
                                :href="route('admin.products.edit', p.id)"
                                class="inline-block px-2.5 py-1.5 bg-admin-primary text-white rounded-lg hover:bg-admin-muted transition"
                            >
                                Редактировать
                            </Link>
                            <Link
                                as="button"
                                method="delete"
                                :href="route('admin.products.destroy', p.id)"
                                class="inline-block px-2.5 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                            >
                                Удалить
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        <div class="mt-4 flex justify-between items-center">
            <button
                :disabled="!products.prev_page_url"
                @click="goToPage(products.prev_page_url)"
                class="px-3 py-1 bg-gray-300 rounded disabled:opacity-50"
            >
                Назад
            </button>
            <span>Страница {{ products.current_page }} из {{ products.last_page }}</span>
            <button
                :disabled="!products.next_page_url"
                @click="goToPage(products.next_page_url)"
                class="px-3 py-1 bg-gray-300 rounded disabled:opacity-50"
            >
                Вперёд
            </button>
        </div>
    </div>
</template>
