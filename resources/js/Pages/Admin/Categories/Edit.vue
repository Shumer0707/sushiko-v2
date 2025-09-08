<script setup>
    import { useForm, Link } from '@inertiajs/vue3'

    const props = defineProps({
        category: { type: Object, required: true },
        parents: { type: Array, default: () => [] },
    })

    const pick = (lang, key) => props.category.translations.find((t) => t.language === lang)?.[key] || ''

    const form = useForm({
        parent_id: props.category.parent_id,
        image: null,
        translations: {
            ru: { name: pick('ru', 'name'), slug: pick('ru', 'slug') },
            ro: { name: pick('ro', 'name'), slug: pick('ro', 'slug') },
            en: { name: pick('en', 'name'), slug: pick('en', 'slug') },
        },
    })

    const onFile = (e) => {
        form.image = e.target.files?.[0] ?? null
    }

    const submit = () =>
        form
            .transform((d) => ({ ...d, _method: 'put' }))
            .post(route('admin.categories.update', props.category.id), {
                forceFormData: true,
            })
</script>

<template>
    <div class="max-w-7xl mx-auto space-y-8 text-admin-text">
        <h1 class="text-xl font-semibold">Редактировать категорию</h1>

        <form @submit.prevent="submit" class="space-y-8">
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Изображение</h2>
                <div v-if="props.category.image_url">
                    <p class="text-sm text-gray-600 mb-2">Текущая картинка:</p>
                    <img :src="props.category.image_url" class="w-20 h-20 object-cover border rounded" />
                </div>
                <div class="space-y-2">
                    <label class="font-semibold">Заменить картинку</label>
                    <input type="file" @change="onFile" />
                    <div v-if="form.errors.image" class="text-red-500 text-sm">{{ form.errors.image }}</div>
                </div>
            </div>

            <div v-if="props.parents.length" class="space-y-4">
                <h2 class="text-lg font-semibold">Родительская категория</h2>
                <select v-model="form.parent_id" class="form-input w-full">
                    <option :value="null">— без родителя —</option>
                    <option v-for="p in parents" :key="p.id" :value="p.id">
                        {{ p.translation?.name ?? `#${p.id}` }}
                    </option>
                </select>
                <div v-if="form.errors.parent_id" class="text-red-500 text-sm">{{ form.errors.parent_id }}</div>
            </div>

            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Переводы</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">RU</h3>
                        <input v-model="form.translations.ru.name" class="form-input w-full" placeholder="Название (RU)" />
                        <input v-model="form.translations.ru.slug" class="form-input w-full mt-2" placeholder="Slug (RU)" />
                        <div v-if="form.errors['translations.ru.name']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ru.name'] }}
                        </div>
                        <div v-if="form.errors['translations.ru.slug']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ru.slug'] }}
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">RO</h3>
                        <input v-model="form.translations.ro.name" class="form-input w-full" placeholder="Denumire (RO)" />
                        <input v-model="form.translations.ro.slug" class="form-input w-full mt-2" placeholder="Slug (RO)" />
                        <div v-if="form.errors['translations.ro.name']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ro.name'] }}
                        </div>
                        <div v-if="form.errors['translations.ro.slug']" class="text-red-500 text-sm">
                            {{ form.errors['translations.ro.slug'] }}
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 uppercase">EN</h3>
                        <input v-model="form.translations.en.name" class="form-input w-full" placeholder="Name (EN)" />
                        <input v-model="form.translations.en.slug" class="form-input w-full mt-2" placeholder="Slug (EN)" />
                        <div v-if="form.errors['translations.en.name']" class="text-red-500 text-sm">
                            {{ form.errors['translations.en.name'] }}
                        </div>
                        <div v-if="form.errors['translations.en.slug']" class="text-red-500 text-sm">
                            {{ form.errors['translations.en.slug'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Обновить
                </button>
                <Link :href="route('admin.categories.index')" class="px-4 py-2 border rounded hover:bg-gray-50 transition">
                    Отмена
                </Link>
            </div>
        </form>
    </div>
</template>
