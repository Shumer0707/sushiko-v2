<script setup>
    import { ref, computed } from 'vue'
    import { Link, router } from '@inertiajs/vue3'

    const props = defineProps({
        orders: Array,
        sort: Object,
        filters: Object,
    })

    // сортировка
    const sortField = computed(() => props.sort?.field ?? 'created_at')
    const sortDirection = computed(() => props.sort?.direction ?? 'desc')

    // фильтры
    const dateFrom = ref(props.filters?.date_from ?? '')
    const dateTo = ref(props.filters?.date_to ?? '')
    const search = ref(props.filters?.search ?? '')
    const orderId = ref(props.filters?.order_id ?? '')

    // раскрытие заказа
    const openedOrderId = ref(null)
    const toggleOrder = (id) => {
        openedOrderId.value = openedOrderId.value === id ? null : id
    }

    const applyFilters = () => {
        router.get(
            route('admin.orders.index'),
            {
                sort: sortField.value,
                direction: sortDirection.value,
                date_from: dateFrom.value || '',
                date_to: dateTo.value || '',
                search: search.value || '',
                order_id: orderId.value || '',
            },
            { preserveState: true, preserveScroll: true, replace: true }
        )
    }

    const changeSort = (field) => {
        let direction = 'asc'
        if (sortField.value === field && sortDirection.value === 'asc') {
            direction = 'desc'
        }

        router.get(
            route('admin.orders.index'),
            {
                sort: field,
                direction,
                date_from: dateFrom.value || '',
                date_to: dateTo.value || '',
                search: search.value || '',
                order_id: orderId.value || '',
            },
            { preserveState: true, preserveScroll: true, replace: true }
        )
    }

    const sortArrow = (field) => {
        if (sortField.value !== field) return '↕'
        return sortDirection.value === 'asc' ? '↑' : '↓'
    }

    const resetAll = () => {
        // очищаем локальное состояние
        orderId.value = ''
        search.value = ''
        dateFrom.value = ''
        dateTo.value = ''

        // делаем запрос БЕЗ параметров
        router.get(
            route('admin.orders.index'),
            {}, // пустые параметры → дефолт
            { preserveState: false, preserveScroll: true, replace: true }
        )
    }
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h1 class="text-xl font-semibold text-admin-text">Заказы</h1>

            <div class="grid grid-cols-1 gap-3 text-sm sm:grid-cols-2 lg:flex lg:flex-wrap lg:items-end">
                <!-- 🔹 Отдельное поле для ID -->
                <label class="flex min-w-0 flex-col gap-1">
                    <span class="text-xs text-admin-text/80">ID заказа</span>
                    <input
                        v-model="orderId"
                        type="text"
                        inputmode="numeric"
                        placeholder="Например, 125"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-admin-text lg:w-32"
                        @keyup.enter="applyFilters"
                        @change="applyFilters"
                    />
                </label>

                <!-- Фильтр даты -->
                <label class="flex min-w-0 flex-col gap-1">
                    <span class="text-xs text-admin-text/80">Дата от</span>
                    <input
                        v-model="dateFrom"
                        type="date"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-admin-text"
                        @change="applyFilters"
                    />
                </label>

                <label class="flex min-w-0 flex-col gap-1">
                    <span class="text-xs text-admin-text/80">Дата до</span>
                    <input
                        v-model="dateTo"
                        type="date"
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-admin-text"
                        @change="applyFilters"
                    />
                </label>

                <!-- 🔹 Общий поиск -->
                <label class="flex min-w-0 flex-col gap-1 sm:col-span-2 lg:col-span-1">
                    <span class="text-xs text-admin-text/80">Имя, телефон или сумма</span>
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Поиск..."
                        class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-admin-text lg:w-56"
                        @keyup.enter="applyFilters"
                    />
                </label>
                <!-- 🔹 Сброс -->
                <button
                    @click="resetAll"
                    class="rounded-lg bg-gray-200 px-3 py-2 text-sm transition hover:bg-gray-300 sm:col-span-2 lg:col-span-1"
                >
                    Сбросить всё
                </button>
            </div>
        </div>

        <div
            v-if="!orders.data || !orders.data.length"
            class="bg-white border border-gray-200 rounded-lg p-6 text-sm text-gray-500"
        >
            Пока нет заказов.
        </div>

        <div v-else class="space-y-4">
            <div class="space-y-3 sm:hidden">
                <article v-for="o in orders.data" :key="o.id" class="overflow-hidden rounded-lg border border-gray-300 bg-white">
                    <button type="button" class="w-full p-4 text-left" @click="toggleOrder(o.id)">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="font-semibold text-admin-text">Заказ #{{ o.id }}</div>
                                <div class="mt-1 text-xs text-gray-500">{{ o.created_at }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold text-admin-text">{{ o.total_with_delivery }} {{ o.currency }}</div>
                                <span class="mt-1 inline-flex rounded-full border border-gray-300 px-2 py-0.5 text-xs">
                                    {{ o.status || 'new' }}
                                </span>
                            </div>
                        </div>

                        <dl class="mt-4 grid grid-cols-2 gap-x-3 gap-y-2 text-sm">
                            <div class="min-w-0">
                                <dt class="text-xs text-gray-500">Клиент</dt>
                                <dd class="break-words">{{ o.customer_name || '—' }}</dd>
                            </div>
                            <div class="min-w-0">
                                <dt class="text-xs text-gray-500">Телефон</dt>
                                <dd class="break-words">{{ o.customer_phone || '—' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Сумма</dt>
                                <dd>{{ o.total }} {{ o.currency }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-gray-500">Доставка</dt>
                                <dd>{{ o.delivery_cost ?? 0 }} {{ o.currency }}</dd>
                            </div>
                        </dl>

                        <div class="mt-3 flex items-center justify-between border-t border-gray-100 pt-3 text-xs text-gray-500">
                            <span>Позиций: {{ o.items_count ?? (o.items?.length || 0) }}</span>
                            <span>{{ openedOrderId === o.id ? 'Скрыть ▲' : 'Показать товары ▼' }}</span>
                        </div>
                    </button>

                    <div v-if="openedOrderId === o.id" class="border-t border-gray-200 bg-gray-50 p-4">
                        <div v-if="o.items && o.items.length" class="space-y-2">
                            <div
                                v-for="(item, idx) in o.items"
                                :key="item.id"
                                class="flex items-start justify-between gap-3 rounded-md border border-gray-200 bg-white p-3 text-sm"
                            >
                                <div class="min-w-0">
                                    <div class="break-words font-medium">{{ idx + 1 }}. {{ item.name }}</div>
                                    <div class="mt-1 text-xs text-gray-500">
                                        {{ item.quantity }} × {{ item.price }} {{ o.currency }}
                                    </div>
                                </div>
                                <div class="shrink-0 font-semibold">{{ item.total }} {{ o.currency }}</div>
                            </div>
                        </div>
                        <div v-else class="text-xs text-gray-500">В этом заказе нет позиций.</div>
                    </div>
                </article>
            </div>

            <div class="hidden overflow-x-auto sm:block">
            <table class="min-w-[1080px] w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
                <thead class="bg-admin-background text-left">
                    <tr>
                        <th class="px-4 py-2 border cursor-pointer select-none" @click="changeSort('id')">
                            <span class="inline-flex items-center gap-1">
                                ID
                                <span class="text-xs text-gray-500">
                                    {{ sortArrow('id') }}
                                </span>
                            </span>
                        </th>
                        <th class="px-4 py-2 border cursor-pointer select-none" @click="changeSort('created_at')">
                            <span class="inline-flex items-center gap-1">
                                Дата
                                <span class="text-xs text-gray-500">
                                    {{ sortArrow('created_at') }}
                                </span>
                            </span>
                        </th>
                        <th class="px-4 py-2 border">Клиент</th>
                        <th class="px-4 py-2 border">Телефон</th>
                        <th class="px-4 py-2 border">Сумма</th>
                        <th class="px-4 py-2 border">Доставка</th>
                        <th class="px-4 py-2 border">Итого</th>
                        <th class="px-4 py-2 border">Валюта</th>
                        <th class="px-4 py-2 border">Статус</th>
                        <th class="px-4 py-2 border">Позиций</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="o in orders.data" :key="o.id">
                        <!-- Основная строка заказа -->
                        <tr class="border-t hover:bg-gray-100 cursor-pointer" @click="toggleOrder(o.id)">
                            <td class="px-4 py-2 border">
                                <span class="inline-flex items-center gap-1">
                                    <span>#{{ o.id }}</span>
                                    <span class="text-xs text-gray-400">
                                        {{ openedOrderId === o.id ? '▴' : '▾' }}
                                    </span>
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                {{ o.created_at }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ o.customer_name || '—' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ o.customer_phone || '—' }}
                            </td>
                            <td class="px-4 py-2 border">{{ o.total }} {{ o.currency }}</td>
                            <td class="px-4 py-2 border">{{ o.delivery_cost ?? 0 }} {{ o.currency }}</td>
                            <td class="px-4 py-2 border font-semibold">{{ o.total_with_delivery }} {{ o.currency }}</td>
                            <td class="px-4 py-2 border">
                                {{ o.currency }}
                            </td>
                            <td class="px-4 py-2 border">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs border border-gray-300">
                                    {{ o.status || 'new' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border text-center">
                                {{ o.items_count ?? (o.items?.length || 0) }}
                            </td>
                        </tr>

                        <!-- Выпадашка со списком товаров -->
                        <tr v-if="openedOrderId === o.id">
                            <td :colspan="10" class="px-4 py-3 border-t bg-gray-50">
                                <div v-if="o.items && o.items.length" class="space-y-2">
                                    <div class="text-xs text-gray-500 mb-1">Товары в заказе:</div>
                                    <table class="w-full text-xs border border-gray-200 bg-white rounded-lg overflow-hidden">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th class="px-3 py-1 border">#</th>
                                                <th class="px-3 py-1 border text-left">Название</th>
                                                <th class="px-3 py-1 border text-right">Цена</th>
                                                <th class="px-3 py-1 border text-center">Кол-во</th>
                                                <th class="px-3 py-1 border text-right">Сумма</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, idx) in o.items" :key="item.id" class="hover:bg-gray-50">
                                                <td class="px-3 py-1 border text-center">
                                                    {{ idx + 1 }}
                                                </td>
                                                <td class="px-3 py-1 border">
                                                    {{ item.name }}
                                                </td>
                                                <td class="px-3 py-1 border text-right">{{ item.price }} {{ o.currency }}</td>
                                                <td class="px-3 py-1 border text-center">
                                                    {{ item.quantity }}
                                                </td>
                                                <td class="px-3 py-1 border text-right">{{ item.total }} {{ o.currency }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div v-else class="text-xs text-gray-500">В этом заказе нет позиций.</div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
            </div>
            <!-- Пагинация -->
            <div class="flex flex-col gap-3 text-xs text-gray-500 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    Показано {{ orders.data.length }} из {{ orders.total }} заказов (страница {{ orders.current_page }} из
                    {{ orders.last_page }})
                </div>

                <div class="flex flex-wrap gap-1">
                    <Link
                        v-for="link in orders.links"
                        :key="link.label"
                        :href="link.url || '#'"
                        :class="[
                            'px-2 py-1 rounded border text-xs',
                            link.active
                                ? 'bg-gray-900 text-white border-gray-900'
                                : link.url
                                ? 'bg-white text-gray-700 hover:bg-gray-100 border-gray-300'
                                : 'bg-gray-100 text-gray-400 border-gray-200 cursor-default',
                        ]"
                        v-html="link.label"
                        :preserve-scroll="true"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
