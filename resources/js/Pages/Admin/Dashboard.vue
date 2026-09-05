<script setup>
    import { Head, Link, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'

    const page = usePage()
    const user = page.props.auth?.user ?? null

    const siteDisabled = computed(() => page.props.siteDisabled)
</script>

<template>
    <Head title="Dashboard" />

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                Добро пожаловать, {{ user?.name || 'пользователь' }}!
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col items-stretch gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold mb-2">Режим работы сайта</h2>

                        <p class="text-sm text-gray-600 mb-2">
                            Текущий статус:
                            <span :class="siteDisabled ? 'text-red-600' : 'text-green-600'" class="font-semibold">
                                {{ siteDisabled ? 'выключен' : 'включен' }}
                            </span>
                        </p>

                        <p class="text-sm text-gray-500">
                            Управление заглушкой и текстами перенесено на отдельную страницу настроек.
                        </p>
                    </div>

                    <Link
                        :href="route('admin.public-status.edit')"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-lg bg-admin-primary px-4 py-2 text-white transition hover:bg-admin-muted"
                    >
                        Открыть настройки
                    </Link>
                </div>

                <div v-if="$page.props.flash?.success" class="mt-3 text-sm text-green-600">
                    {{ $page.props.flash.success }}
                </div>
            </div>
        </div>
    </div>
</template>
