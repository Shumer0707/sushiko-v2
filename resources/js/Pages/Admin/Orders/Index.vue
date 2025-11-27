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

            <div class="flex flex-wrap items-center gap-4 text-sm">
                <!-- 🔹 Отдельное поле для ID -->
                <div class="flex flex-col">
                    <input
                        v-model="orderId"
                        type="text"
                        inputmode="numeric"
                        placeholder="Например, 125"
                        class="border border-gray-300 rounded-lg px-3 py-1.5 bg-white text-admin-text text-sm w-32"
                        @keyup.enter="applyFilters"
                        @change="applyFilters"
                    />
                    <label class="text-xs text-admin-text/80 mb-1">Ищет по ID заказа</label>
                </div>

                <!-- Фильтр даты -->
                <div class="flex items-center gap-2">
                    <span class="text-admin-text/80">От:</span>
                    <input
                        v-model="dateFrom"
                        type="date"
                        class="border border-gray-300 rounded-lg px-2 py-1 bg-white text-admin-text text-sm"
                        @change="applyFilters"
                    />
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-admin-text/80">До:</span>
                    <input
                        v-model="dateTo"
                        type="date"
                        class="border border-gray-300 rounded-lg px-2 py-1 bg-white text-admin-text text-sm"
                        @change="applyFilters"
                    />
                </div>

                <!-- 🔹 Общий поиск -->
                <div class="flex flex-col">
                    <input
                        v-model="search"
                        type="text"
                        placeholder="Поиск..."
                        class="border border-gray-300 rounded-lg px-3 py-1.5 bg-white text-admin-text text-sm w-56"
                        @keyup.enter="applyFilters"
                    />
                    <span class="text-xs text-gray-400 mt-1">Ищет по имени клиента, телефону и сумме</span>
                </div>
                <!-- 🔹 Сброс -->
                <button @click="resetAll" class="px-3 py-1.5 text-sm bg-gray-200 hover:bg-gray-300 rounded-lg transition">
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

        <div v-else class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-300 text-sm text-admin-text rounded-lg overflow-hidden">
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
            <!-- Пагинация -->
            <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
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
