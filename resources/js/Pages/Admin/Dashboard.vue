<script setup>
    import { Head, useForm, usePage } from '@inertiajs/vue3'
    import { computed } from 'vue'

    const page = usePage()
    const user = page.props.auth?.user ?? null

    const siteDisabled = computed(() => page.props.siteDisabled)

    const form = useForm({})

    const buttonText = computed(() => (siteDisabled.value ? 'Включить сайт' : 'Выключить сайт'))

    const confirmText = computed(() =>
        siteDisabled.value
            ? 'Ты уверен? Сайт снова станет доступен для посетителей.'
            : 'Ты уверен? Публичная часть сайта будет отключена.'
    )

    const buttonClass = computed(() => (siteDisabled.value ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'))

    const toggleSite = () => {
        if (!confirm(confirmText.value)) {
            return
        }

        form.post(route('admin.site.toggle'), {
            preserveScroll: true,
        })
    }
</script>

<template>
    <Head title="Dashboard" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                Добро пожаловать, {{ user?.name || 'пользователь' }}!
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-2">Режим работы сайта</h2>

                <p class="text-sm text-gray-600 mb-4">
                    Текущий статус:
                    <span :class="siteDisabled ? 'text-red-600' : 'text-green-600'" class="font-semibold">
                        {{ siteDisabled ? 'выключен' : 'включен' }}
                    </span>
                </p>

                <button
                    @click="toggleSite"
                    :disabled="form.processing"
                    class="px-4 py-2 text-white rounded transition disabled:opacity-50"
                    :class="buttonClass"
                >
                    {{ buttonText }}
                </button>

                <div v-if="$page.props.flash?.success" class="mt-3 text-sm text-green-600">
                    {{ $page.props.flash.success }}
                </div>
            </div>
        </div>
    </div>
</template>
