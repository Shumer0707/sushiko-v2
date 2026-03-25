<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3'

    const props = defineProps({
        siteDisabled: { type: Boolean, required: true },
        content: { type: Object, required: true },
    })

    const form = useForm({
        is_disabled: props.siteDisabled,
        content: {
            ru: {
                title: props.content.ru?.title ?? '',
                text: props.content.ru?.text ?? '',
                note: props.content.ru?.note ?? '',
            },
            ro: {
                title: props.content.ro?.title ?? '',
                text: props.content.ro?.text ?? '',
                note: props.content.ro?.note ?? '',
            },
            en: {
                title: props.content.en?.title ?? '',
                text: props.content.en?.text ?? '',
                note: props.content.en?.note ?? '',
            },
        },
    })

    const submit = () => {
        form.put(route('admin.public-status.update'), {
            preserveScroll: true,
        })
    }
</script>

<template>
    <Head title="Статус сайта" />

    <div class="p-6 max-w-7xl mx-auto space-y-8 text-admin-text">
        <div class="flex justify-between items-center gap-4">
            <div>
                <h1 class="text-xl font-semibold">Страница недоступности сайта</h1>
                <p class="text-sm text-gray-600 mt-1">
                    Здесь можно включить заглушку и задать универсальный текст для всех случаев.
                </p>
            </div>

            <Link :href="route('admin.dashboard')" class="px-4 py-2 border rounded-lg hover:bg-white transition">
                Назад
            </Link>
        </div>

        <form @submit.prevent="submit" class="space-y-8">
            <div class="bg-white border border-gray-300 rounded-lg p-6 space-y-4">
                <h2 class="text-lg font-semibold">Режим сайта</h2>

                <label class="inline-flex items-center gap-3">
                    <input v-model="form.is_disabled" type="checkbox" class="rounded" />
                    <span class="font-medium">Показывать страницу недоступности вместо публичной части сайта</span>
                </label>

                <p class="text-sm text-gray-600">
                    Текущий статус:
                    <span :class="form.is_disabled ? 'text-red-600' : 'text-green-600'" class="font-semibold">
                        {{ form.is_disabled ? 'сайт выключен' : 'сайт включен' }}
                    </span>
                </p>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg p-6 space-y-6">
                <div>
                    <h2 class="text-lg font-semibold">Тексты страницы</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Поля ниже выводятся на странице заглушки для соответствующего языка.
                    </p>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    <div v-for="lang in ['ru', 'ro', 'en']" :key="lang" class="border rounded-lg p-4 space-y-4">
                        <h3 class="font-semibold uppercase">{{ lang }}</h3>

                        <div>
                            <label class="block font-medium mb-1">Заголовок</label>
                            <input v-model="form.content[lang].title" class="w-full rounded border px-3 py-2" />
                            <div v-if="form.errors[`content.${lang}.title`]" class="text-red-500 text-sm mt-1">
                                {{ form.errors[`content.${lang}.title`] }}
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">Основной текст</label>
                            <textarea
                                v-model="form.content[lang].text"
                                rows="5"
                                class="w-full rounded border px-3 py-2"
                            ></textarea>
                            <div v-if="form.errors[`content.${lang}.text`]" class="text-red-500 text-sm mt-1">
                                {{ form.errors[`content.${lang}.text`] }}
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">Дополнительная строка</label>
                            <input v-model="form.content[lang].note" class="w-full rounded border px-3 py-2" />
                            <div v-if="form.errors[`content.${lang}.note`]" class="text-red-500 text-sm mt-1">
                                {{ form.errors[`content.${lang}.note`] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="bg-admin-primary text-white px-5 py-2 rounded-lg hover:bg-admin-muted transition disabled:opacity-50"
                >
                    Сохранить
                </button>

                <div v-if="$page.props.flash?.success" class="text-sm text-green-600">
                    {{ $page.props.flash.success }}
                </div>
            </div>
        </form>
    </div>
</template>
