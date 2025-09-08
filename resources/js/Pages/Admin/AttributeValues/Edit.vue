<script setup>
    import { useForm, Link } from '@inertiajs/vue3'
    import { watch } from 'vue'

    const props = defineProps({
        attribute: { type: Object, required: true },
        value: { type: Object, required: true },
    })

    const getVal = (lang) => props.value.translations.find((t) => t.language === lang)?.value || ''

    const form = useForm({
        sort_order: props.value.sort_order ?? 0,
        translations: {
            ru: getVal('ru'),
            ro: getVal('ro'),
            en: getVal('en'),
        },
    })

    watch(
        () => props.value,
        (v) => {
            form.sort_order = v.sort_order ?? 0
            form.translations.ru = getVal('ru')
            form.translations.ro = getVal('ro')
            form.translations.en = getVal('en')
        },
        { immediate: true }
    )

    const submit = () =>
        form.put(route('admin.attribute-values.update', { attribute: props.attribute.id, value: props.value.id }))
</script>

<template>
    <div class="max-w-7xl mx-auto space-y-8 text-admin-text" :key="value.id">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold">
                Редактировать значение — {{ attribute.translation?.name || `#${attribute.id}` }}
            </h1>
            <Link
                :href="route('admin.attribute-values.index', attribute.id)"
                class="px-4 py-2 border rounded hover:bg-gray-50 transition"
            >
                ← К значениям
            </Link>
        </div>

        <form @submit.prevent="submit" class="space-y-8">
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Параметры</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Порядок</label>
                        <input type="number" v-model.number="form.sort_order" min="0" class="form-input w-full" />
                        <div v-if="form.errors.sort_order" class="text-red-500 text-sm">{{ form.errors.sort_order }}</div>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Переводы</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">RU</h3>
                        <input v-model="form.translations.ru" class="form-input w-full" placeholder="Значение (RU)" />
                        <div v-if="form.errors['translations.ru']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ru'] }}
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">RO</h3>
                        <input v-model="form.translations.ro" class="form-input w-full" placeholder="Valoare (RO)" />
                        <div v-if="form.errors['translations.ro']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ro'] }}
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">EN</h3>
                        <input v-model="form.translations.en" class="form-input w-full" placeholder="Value (EN)" />
                        <div v-if="form.errors['translations.en']" class="text-red-500 text-sm">
                            {{ form.errors['translations.en'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Обновить</button>
                <Link
                    :href="route('admin.attribute-values.index', attribute.id)"
                    class="px-4 py-2 border rounded hover:bg-gray-50 transition"
                >
                    Отмена
                </Link>
            </div>
        </form>
    </div>
</template>
