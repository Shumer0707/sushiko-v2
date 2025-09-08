<script setup>
    import { useForm, Link } from '@inertiajs/vue3'
    import { onMounted } from 'vue'

    const props = defineProps({
        brands: { type: Array, default: () => [] },
        categories: { type: Array, default: () => [] },
        attributes: { type: Array, default: () => [] }, // [{id, translation, values:[{id, translation}]}]
    })

    const form = useForm({
        brand_id: null,
        category_id: null,
        sku: '',
        price: 0,
        currency: 'MDL',
        is_active: true,
        sort_order: 0,
        translations: {
            ru: { name: '', slug: '', short_description: '', full_description: '' },
            ro: { name: '', slug: '', short_description: '', full_description: '' },
            en: { name: '', slug: '', short_description: '', full_description: '' },
        },
        images: [],
        attributes: {}, // { [attributeId: number]: number[] }
    })

    const onImages = (e) => {
        form.images = Array.from(e.target.files || [])
    }

    // Инициализируем массивы под каждый атрибут
    onMounted(() => {
        props.attributes.forEach((a) => {
            if (!Array.isArray(form.attributes[a.id])) {
                form.attributes[a.id] = []
            }
        })
    })

    // Нормализуем перед отправкой
    form.transform((data) => {
        const allow = {}
        props.attributes.forEach((a) => {
            allow[a.id] = new Set((a.values || []).map((v) => Number(v.id)))
        })

        const normalized = {}
        Object.keys(allow).forEach((k) => {
            const attrId = Number(k)
            const current = data.attributes?.[attrId]
            const arr = Array.isArray(current) ? current : current != null ? [current] : []
            normalized[attrId] = arr.map((v) => Number(v)).filter((v) => Number.isInteger(v) && allow[attrId].has(v))
        })

        return { ...data, attributes: normalized }
    })

    const submit = () => {
        props.attributes.forEach((a) => {
            if (!Array.isArray(form.attributes[a.id])) {
                form.attributes[a.id] = []
            }
        })
        form.post(route('admin.products.store'))
    }
</script>

<template>
    <div class="p-6 max-w-7xl mx-auto space-y-8 text-admin-text">
        <h1 class="text-xl font-semibold">Добавить товар</h1>

        <form @submit.prevent="submit" class="space-y-8">
            <!-- Основные данные -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Основные данные</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Бренд</label>
                        <select v-model="form.brand_id" class="w-full rounded border px-2 py-1 bg-white">
                            <option :value="null">— не выбран —</option>
                            <option v-for="b in props.brands" :key="b.id" :value="b.id">
                                {{ b.translation?.name ?? `#${b.id}` }}
                            </option>
                        </select>
                        <div v-if="form.errors.brand_id" class="text-red-500 text-sm mt-1">{{ form.errors.brand_id }}</div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Категория</label>
                        <select v-model="form.category_id" class="w-full rounded border px-2 py-1 bg-white">
                            <option :value="null">— не выбрана —</option>
                            <option v-for="c in props.categories" :key="c.id" :value="c.id">
                                {{ c.translation?.name ?? `#${c.id}` }}
                            </option>
                        </select>
                        <div v-if="form.errors.category_id" class="text-red-500 text-sm mt-1">{{ form.errors.category_id }}</div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">SKU</label>
                        <input v-model="form.sku" class="w-full rounded border px-2 py-1" />
                        <div v-if="form.errors.sku" class="text-red-500 text-sm mt-1">{{ form.errors.sku }}</div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Цена</label>
                        <input type="number" step="0.01" v-model.number="form.price" class="w-full rounded border px-2 py-1" />
                        <div v-if="form.errors.price" class="text-red-500 text-sm mt-1">{{ form.errors.price }}</div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Валюта</label>
                        <input v-model="form.currency" class="w-full rounded border px-2 py-1" />
                        <div v-if="form.errors.currency" class="text-red-500 text-sm mt-1">{{ form.errors.currency }}</div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="is_active" type="checkbox" v-model="form.is_active" />
                        <label for="is_active" class="font-semibold">Активен</label>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Порядок</label>
                        <input type="number" min="0" v-model.number="form.sort_order" class="w-full rounded border px-2 py-1" />
                    </div>
                </div>
            </div>

            <!-- Переводы -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Переводы</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div v-for="lang in ['ru', 'ro', 'en']" :key="lang" class="space-y-2">
                        <h3 class="font-semibold uppercase">{{ lang }}</h3>

                        <div>
                            <label class="block">Название</label>
                            <input v-model="form.translations[lang].name" class="w-full rounded border px-2 py-1" />
                            <div v-if="form.errors[`translations.${lang}.name`]" class="text-red-500 text-sm mt-1">
                                {{ form.errors[`translations.${lang}.name`] }}
                            </div>
                        </div>

                        <div>
                            <label class="block">Slug</label>
                            <input v-model="form.translations[lang].slug" class="w-full rounded border px-2 py-1" />
                            <div v-if="form.errors[`translations.${lang}.slug`]" class="text-red-500 text-sm mt-1">
                                {{ form.errors[`translations.${lang}.slug`] }}
                            </div>
                        </div>

                        <div>
                            <label class="block">Кратко</label>
                            <textarea
                                v-model="form.translations[lang].short_description"
                                class="w-full rounded border px-2 py-1"
                                rows="3"
                            ></textarea>
                        </div>

                        <div>
                            <label class="block">Полное описание</label>
                            <textarea
                                v-model="form.translations[lang].full_description"
                                class="w-full rounded border px-2 py-1"
                                rows="5"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Галерея -->
            <div class="space-y-2">
                <h2 class="text-lg font-semibold">Галерея</h2>
                <input type="file" multiple @change="onImages" />
                <div v-if="form.errors['images.0']" class="text-red-500 text-sm mt-1">Проверьте форматы и размер файлов</div>
            </div>

            <!-- Атрибуты -->
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Атрибуты</h2>

                <div v-for="attr in props.attributes" :key="attr.id" class="rounded border p-4 bg-white/50">
                    <label class="block font-semibold mb-2">{{ attr.translation?.name ?? `#${attr.id}` }}</label>

                    <div class="flex flex-wrap gap-3">
                        <label
                            v-for="val in attr.values || []"
                            :key="val.id"
                            class="inline-flex items-center gap-2 text-sm px-2 py-1 rounded hover:bg-admin-muted/10 transition"
                            :for="`attr-${attr.id}-val-${val.id}`"
                        >
                            <input
                                class="rounded"
                                type="checkbox"
                                :id="`attr-${attr.id}-val-${val.id}`"
                                :value="val.id"
                                v-model="form.attributes[attr.id]"
                            />
                            <span>{{ val.translation?.value ?? `#${val.id}` }}</span>
                        </label>
                    </div>

                    <div v-if="form.errors[`attributes.${attr.id}`]" class="text-red-500 text-sm mt-2">
                        {{ form.errors[`attributes.${attr.id}`] }}
                    </div>
                </div>
            </div>

            <!-- Кнопки -->
            <div class="flex gap-2">
                <button class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition">
                    Сохранить
                </button>
                <Link :href="route('admin.products.index')" class="px-4 py-2 border rounded-lg hover:bg-white transition">
                    Отмена
                </Link>
            </div>
        </form>
    </div>
</template>
