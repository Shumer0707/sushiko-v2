<script setup>
    import { useForm, Link } from '@inertiajs/vue3'

    const props = defineProps({
        banner: { type: Object, required: true },
    })

    const pick = (lang, key, fallback = '') => props.banner.translations.find((t) => t.language === lang)?.[key] ?? fallback
    const pickUrl = (lang, key) => props.banner.translations.find((t) => t.language === lang)?.[key] ?? null

    const form = useForm({
        is_active: !!props.banner.is_active,
        sort_order: props.banner.sort_order ?? 0,
        link: props.banner.link ?? '',
        open_in_new_tab: !!props.banner.open_in_new_tab,
        translations: {
            ru: { title: pick('ru', 'title'), description: pick('ru', 'description'), button_text: pick('ru', 'button_text'), image_desktop: null, image_mobile: null },
            ro: { title: pick('ro', 'title'), description: pick('ro', 'description'), button_text: pick('ro', 'button_text'), image_desktop: null, image_mobile: null },
            en: { title: pick('en', 'title'), description: pick('en', 'description'), button_text: pick('en', 'button_text'), image_desktop: null, image_mobile: null },
        },
    })

    const submit = () => {
        form.transform((data) => ({ ...data, _method: 'put' }))
            .post(route('admin.home-banners.update', props.banner.id), { forceFormData: true })
    }
</script>

<template>
    <div class="max-w-7xl mx-auto space-y-8 text-admin-text">
        <h1 class="text-xl font-semibold">Редактировать баннер</h1>

        <form @submit.prevent="submit" class="space-y-8">
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Настройки</h2>
                <div class="flex flex-wrap items-center gap-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" v-model="form.is_active" />
                        Активен
                    </label>
                    <div>
                        <label class="font-semibold block mb-1">Порядок</label>
                        <input type="number" v-model.number="form.sort_order" class="form-input w-24" min="0" />
                        <div v-if="form.errors.sort_order" class="text-red-500 text-sm">{{ form.errors.sort_order }}</div>
                    </div>
                    <div class="flex-1 min-w-[280px]">
                        <label class="font-semibold block mb-1">Ссылка</label>
                        <input type="text" v-model="form.link" class="form-input w-full" placeholder="/contact или https://..." />
                        <div v-if="form.errors.link" class="text-red-500 text-sm">{{ form.errors.link }}</div>
                    </div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" v-model="form.open_in_new_tab" />
                        Открывать в новой вкладке
                    </label>
                </div>
            </div>

            <div class="space-y-6">
                <h2 class="text-lg font-semibold">Переводы и картинки</h2>

                <div v-for="lang in ['ru', 'ro', 'en']" :key="lang" class="border rounded-lg p-4 space-y-4">
                    <h3 class="font-semibold uppercase">{{ lang }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <div v-if="pickUrl(lang, 'image_desktop_url')">
                                <p class="text-sm text-gray-600 mb-2">Текущая desktop картинка:</p>
                                <img :src="pickUrl(lang, 'image_desktop_url')" class="w-48 h-24 object-cover border rounded" />
                            </div>
                            <label class="font-semibold block mb-1">Заменить desktop картинку</label>
                            <input type="file" @change="(e) => (form.translations[lang].image_desktop = e.target.files?.[0] ?? null)" />
                            <div v-if="form.errors[`translations.${lang}.image_desktop`]" class="text-red-500 text-sm">
                                {{ form.errors[`translations.${lang}.image_desktop`] }}
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div v-if="pickUrl(lang, 'image_mobile_url')">
                                <p class="text-sm text-gray-600 mb-2">Текущая mobile картинка:</p>
                                <img :src="pickUrl(lang, 'image_mobile_url')" class="w-28 h-24 object-cover border rounded" />
                            </div>
                            <label class="font-semibold block mb-1">Заменить mobile картинку</label>
                            <input type="file" @change="(e) => (form.translations[lang].image_mobile = e.target.files?.[0] ?? null)" />
                            <div v-if="form.errors[`translations.${lang}.image_mobile`]" class="text-red-500 text-sm">
                                {{ form.errors[`translations.${lang}.image_mobile`] }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="font-semibold block mb-1">Заголовок</label>
                            <input type="text" v-model="form.translations[lang].title" class="form-input w-full" />
                            <div v-if="form.errors[`translations.${lang}.title`]" class="text-red-500 text-sm">
                                {{ form.errors[`translations.${lang}.title`] }}
                            </div>
                        </div>
                        <div>
                            <label class="font-semibold block mb-1">Описание</label>
                            <textarea v-model="form.translations[lang].description" rows="3" class="form-input w-full"></textarea>
                            <div v-if="form.errors[`translations.${lang}.description`]" class="text-red-500 text-sm">
                                {{ form.errors[`translations.${lang}.description`] }}
                            </div>
                        </div>
                        <div>
                            <label class="font-semibold block mb-1">Текст кнопки</label>
                            <input type="text" v-model="form.translations[lang].button_text" class="form-input w-full" />
                            <div v-if="form.errors[`translations.${lang}.button_text`]" class="text-red-500 text-sm">
                                {{ form.errors[`translations.${lang}.button_text`] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Обновить
                </button>
                <Link :href="route('admin.home-banners.index')" class="px-4 py-2 border rounded hover:bg-gray-50 transition">
                    Отмена
                </Link>
            </div>
        </form>
    </div>
</template>
