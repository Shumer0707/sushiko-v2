<script setup>
    import { useForm, Link } from '@inertiajs/vue3'
    import { onMounted, watch } from 'vue'

    const props = defineProps({
        product: { type: Object, required: true },
        brands: { type: Array, default: () => [] },
        categories: { type: Array, default: () => [] },
        attributes: { type: Array, default: () => [] }, // [{id, translation, values:[{id, translation}]}]
    })

    const pickT = (lang, key) => props.product.translations?.find((t) => t.language === lang)?.[key] ?? ''

    // ----- form -----
    const form = useForm({
        brand_id: props.product.brand_id ?? null,
        category_id: props.product.category_id ?? null,
        sku: props.product.sku ?? '',
        price: props.product.price ?? 0,
        currency: props.product.currency ?? 'MDL',
        is_active: !!props.product.is_active,
        sort_order: props.product.sort_order ?? 0,
        translations: {
            ru: {
                name: pickT('ru', 'name'),
                slug: pickT('ru', 'slug'),
                short_description: pickT('ru', 'short_description'),
                full_description: pickT('ru', 'full_description'),
            },
            ro: {
                name: pickT('ro', 'name'),
                slug: pickT('ro', 'slug'),
                short_description: pickT('ro', 'short_description'),
                full_description: pickT('ro', 'full_description'),
            },
            en: {
                name: pickT('en', 'name'),
                slug: pickT('en', 'slug'),
                short_description: pickT('en', 'short_description'),
                full_description: pickT('en', 'full_description'),
            },
        },
        // изображения
        images: [], // новые файлы
        delete_image_ids: [], // id картинок к удалению
        main_image_id: props.product.images?.find((i) => i.is_main)?.id ?? null,
        small_image_id: props.product.images?.find((i) => i.small_path)?.id ?? null,
        // атрибуты: { [attributeId:number]: number[] } — id значений
        attributes: {},
    })

    // предзаполняем выбранные значения атрибутов из продукта
    const hydrateAttributesFromProduct = () => {
        // сначала гарантируем массивы под каждый атрибут (для корректной работы v-model с чекбоксами)
        props.attributes.forEach((a) => {
            if (!Array.isArray(form.attributes[a.id])) form.attributes[a.id] = []
        })

        // затем проставляем текущие значения (attribute_values -> pivot.attribute_id)
        ;(props.product.attribute_values || []).forEach((val) => {
            const attrId = val?.pivot?.attribute_id
            const valueId = val?.id
            if (!attrId || !Number.isInteger(Number(attrId)) || !Number.isInteger(Number(valueId))) return
            if (!Array.isArray(form.attributes[attrId])) form.attributes[attrId] = []
            if (!form.attributes[attrId].includes(valueId)) form.attributes[attrId].push(valueId)
        })
    }

    // при монтировании инициализируем атрибуты
    onMounted(() => {
        hydrateAttributesFromProduct()
    })

    // если нам «привезли» другой продукт — переинициализируем
    watch(
        () => props.product,
        (p) => {
            form.brand_id = p.brand_id ?? null
            form.category_id = p.category_id ?? null
            form.sku = p.sku ?? ''
            form.price = p.price ?? 0
            form.currency = p.currency ?? 'MDL'
            form.is_active = !!p.is_active
            form.sort_order = p.sort_order ?? 0

            for (const lang of ['ru', 'ro', 'en']) {
                const t = p.translations?.find((tt) => tt.language === lang)
                form.translations[lang].name = t?.name ?? ''
                form.translations[lang].slug = t?.slug ?? ''
                form.translations[lang].short_description = t?.short_description ?? ''
                form.translations[lang].full_description = t?.full_description ?? ''
            }

            form.main_image_id = p.images?.find((i) => i.is_main)?.id ?? null
            form.small_image_id = p.images?.find((i) => i.small_path)?.id ?? null

            // сбрасываем и наполняем атрибуты заново
            form.attributes = {}
            hydrateAttributesFromProduct()
        },
        { immediate: false }
    )

    // новые изображения
    const onNewImages = (e) => {
        form.images = Array.from(e.target.files || [])
    }

    // Нормализация перед отправкой: метод spoofing + фильтрация value_id по каждому атрибуту
    form.transform((data) => {
        // карта допустимых value_id на каждый attribute_id
        const allow = {}
        props.attributes.forEach((a) => {
            allow[a.id] = new Set((a.values || []).map((v) => Number(v.id)))
        })

        const normalizedAttrs = {}
        Object.keys(allow).forEach((k) => {
            const attrId = Number(k)
            const current = data.attributes?.[attrId]
            const arr = Array.isArray(current) ? current : current != null ? [current] : []
            normalizedAttrs[attrId] = arr.map((v) => Number(v)).filter((v) => Number.isInteger(v) && allow[attrId].has(v))
        })

        // почистим delete_image_ids и main_image_id
        const cleanedDeleteIds = Array.isArray(data.delete_image_ids)
            ? data.delete_image_ids.map((n) => Number(n)).filter(Number.isInteger)
            : []

        const cleanedMainId = data.main_image_id != null && data.main_image_id !== '' ? Number(data.main_image_id) : null

        const cleanedSmallId = data.small_image_id != null && data.small_image_id !== '' ? Number(data.small_image_id) : null

        return {
            ...data,
            _method: 'put',
            attributes: normalizedAttrs,
            delete_image_ids: cleanedDeleteIds,
            main_image_id: cleanedMainId,
            small_image_id: cleanedSmallId,
        }
    })

    const submit = () => {
        // страховка: гарантируем массивы под каждый атрибут
        props.attributes.forEach((a) => {
            if (!Array.isArray(form.attributes[a.id])) form.attributes[a.id] = []
        })

        form.post(route('admin.products.update', props.product.id), {
            forceFormData: true,
            preserveScroll: true,
        })
    }
</script>

<template>
    <div class="max-w-7xl mx-auto py-6 space-y-8 text-admin-text">
        <h1 class="text-xl font-semibold">Редактировать товар</h1>

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
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Категория</label>
                        <select v-model="form.category_id" class="w-full rounded border px-2 py-1 bg-white">
                            <option :value="null">— не выбрана —</option>
                            <option v-for="c in props.categories" :key="c.id" :value="c.id">
                                {{ c.translation?.name ?? `#${c.id}` }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">SKU</label>
                        <input v-model="form.sku" class="w-full rounded border px-2 py-1" />
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Цена</label>
                        <input type="number" step="0.01" v-model.number="form.price" class="w-full rounded border px-2 py-1" />
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Валюта</label>
                        <input v-model="form.currency" class="w-full rounded border px-2 py-1" />
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
                        </div>

                        <div>
                            <label class="block">Slug</label>
                            <input v-model="form.translations[lang].slug" class="w-full rounded border px-2 py-1" />
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
            <div class="space-y-4">
                <h2 class="text-lg font-semibold">Галерея</h2>

                <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                    <div
                        v-for="img in props.product.images || []"
                        :key="img.id"
                        class="p-2 rounded border space-y-2 bg-white/70"
                        :class="[
                            form.main_image_id === img.id ? 'border-green-500 ring-2 ring-green-400' : '',
                            form.small_image_id === img.id ? 'border-blue-500 ring-2 ring-blue-400' : '',
                        ]"
                    >
                        <img :src="`/storage/${img.path}`" class="w-full h-24 object-cover rounded border" />

                        <div class="mt-2 flex flex-col gap-1 text-xs">
                            <!-- удалить -->
                            <label class="inline-flex items-center gap-1">
                                <input type="checkbox" :value="img.id" v-model="form.delete_image_ids" />
                                <span>Удалить</span>
                            </label>

                            <!-- главное -->
                            <label class="inline-flex items-center gap-1">
                                <input type="radio" name="main_image" :value="img.id" v-model="form.main_image_id" />
                                <span class="text-green-700 font-semibold">Главное</span>
                            </label>

                            <!-- small -->
                            <label class="inline-flex items-center gap-1">
                                <input type="radio" name="small_image" :value="img.id" v-model="form.small_image_id" />
                                <span class="text-blue-700 font-semibold">Для сетки (small)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Добавить изображения</label>
                    <input type="file" multiple @change="onNewImages" />
                </div>
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
                            class="flex items-center gap-2 text-sm px-2 py-1 rounded hover:bg-admin-muted/10 transition"
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
                </div>
            </div>

            <!-- Кнопки -->
            <div class="flex gap-2">
                <button class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-admin-muted transition">Обновить</button>
                <Link :href="route('admin.products.index')" class="px-4 py-2 border rounded-lg hover:bg-white transition">
                    Отмена
                </Link>
            </div>
        </form>
    </div>
</template>
