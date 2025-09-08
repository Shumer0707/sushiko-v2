<script setup>
    import { useForm, Link } from '@inertiajs/vue3'
    import { watch } from 'vue'

    const props = defineProps({
        attribute: { type: Object, required: true },
    })

    const getName = (lang) => props.attribute.translations.find((t) => t.language === lang)?.name || ''

    const form = useForm({
        type: props.attribute.type ?? 'select',
        unit: props.attribute.unit ?? '',
        is_filterable: !!props.attribute.is_filterable,
        is_variant: !!props.attribute.is_variant,
        sort_order: props.attribute.sort_order ?? 0,
        translations: {
            ru: getName('ru'),
            ro: getName('ro'),
            en: getName('en'),
        },
    })

    watch(
        () => props.attribute,
        (a) => {
            form.type = a.type ?? 'select'
            form.unit = a.unit ?? ''
            form.is_filterable = !!a.is_filterable
            form.is_variant = !!a.is_variant
            form.sort_order = a.sort_order ?? 0
            form.translations.ru = getName('ru')
            form.translations.ro = getName('ro')
            form.translations.en = getName('en')
        },
        { immediate: true }
    )

    const submit = () => form.put(route('admin.attributes.update', props.attribute.id))
</script>

<template>
    <div class="max-w-7xl mx-auto space-y-8 text-admin-text" :key="props.attribute.id">
        <h1 class="text-xl font-semibold">Редактировать атрибут</h1>

        <form @submit.prevent="submit" class="space-y-8">
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Параметры</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Тип</label>
                        <select v-model="form.type" class="form-input w-full">
                            <option value="select">select</option>
                            <option value="text">text</option>
                            <option value="number">number</option>
                        </select>
                        <div v-if="form.errors.type" class="text-red-500 text-sm">{{ form.errors.type }}</div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Ед. измерения</label>
                        <input v-model="form.unit" class="form-input w-full" placeholder="мм / кг / см и т.п." />
                        <div v-if="form.errors.unit" class="text-red-500 text-sm">{{ form.errors.unit }}</div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Порядок</label>
                        <input type="number" v-model.number="form.sort_order" class="form-input w-full" min="0" />
                        <div v-if="form.errors.sort_order" class="text-red-500 text-sm">{{ form.errors.sort_order }}</div>
                    </div>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" v-model="form.is_filterable" />
                        <span class="font-semibold">Доступен в фильтрах</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" v-model="form.is_variant" />
                        <span class="font-semibold">Используется для вариаций</span>
                    </label>
                </div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Переводы</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">RU</h3>
                        <input v-model="form.translations.ru" class="form-input w-full" placeholder="Название (RU)" />
                        <div v-if="form.errors['translations.ru']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ru'] }}
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">RO</h3>
                        <input v-model="form.translations.ro" class="form-input w-full" placeholder="Denumire (RO)" />
                        <div v-if="form.errors['translations.ro']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ro'] }}
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">EN</h3>
                        <input v-model="form.translations.en" class="form-input w-full" placeholder="Name (EN)" />
                        <div v-if="form.errors['translations.en']" class="text-red-500 text-sm">
                            {{ form.errors['translations.en'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Обновить</button>
                <Link :href="route('admin.attributes.index')" class="px-4 py-2 border rounded hover:bg-gray-50 transition">
                    Отмена
                </Link>
            </div>
        </form>
    </div>
</template>
