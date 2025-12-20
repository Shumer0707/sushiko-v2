<script setup>
    import { useForm, Link } from '@inertiajs/vue3'
    import { computed, ref, watch } from 'vue'

    const props = defineProps({
        promotion: Object,
        products: Array,
        types: Array,
    })

    const form = useForm({
        product_id: props.promotion.product_id ?? '',
        type: props.promotion.type,
        title: props.promotion.title ?? '',
        discount_price: props.promotion.discount_price ?? '',
        gift_product_id: props.promotion.gift_product_id ?? '',
        gift_quantity: props.promotion.gift_quantity ?? 1,
        is_active: !!props.promotion.is_active,
        starts_at: props.promotion.starts_at ?? '',
        ends_at: props.promotion.ends_at ?? '',
        priority: props.promotion.priority ?? 100,
    })

    /**
     * ===== Product (main) =====
     */
    const productSearch = ref('')

    const selectedProduct = computed(() => props.products.find((p) => p.id === Number(form.product_id)))

    const filteredProducts = computed(() => {
        if (!productSearch.value) return props.products

        const q = productSearch.value.toLowerCase()

        return props.products.filter((p) => p.translation?.name?.toLowerCase().includes(q) || String(p.id).includes(q))
    })

    // init input from existing value
    if (selectedProduct.value) {
        productSearch.value = selectedProduct.value.translation?.name || ''
    }

    // select → input
    watch(
        () => form.product_id,
        () => {
            if (selectedProduct.value) {
                productSearch.value = selectedProduct.value.translation?.name || ''
            }
        }
    )

    // input → reset select
    watch(
        () => productSearch.value,
        (val) => {
            if (selectedProduct.value && val !== selectedProduct.value.translation?.name) {
                form.product_id = ''
            }
        }
    )

    /**
     * ===== Gift product =====
     */
    const giftProductSearch = ref('')

    const selectedGiftProduct = computed(() => props.products.find((p) => p.id === Number(form.gift_product_id)))

    const filteredGiftProducts = computed(() => {
        if (!giftProductSearch.value) return props.products

        const q = giftProductSearch.value.toLowerCase()

        return props.products.filter((p) => p.translation?.name?.toLowerCase().includes(q) || String(p.id).includes(q))
    })

    if (selectedGiftProduct.value) {
        giftProductSearch.value = selectedGiftProduct.value.translation?.name || ''
    }

    watch(
        () => form.gift_product_id,
        () => {
            if (selectedGiftProduct.value) {
                giftProductSearch.value = selectedGiftProduct.value.translation?.name || ''
            }
        }
    )

    watch(
        () => giftProductSearch.value,
        (val) => {
            if (selectedGiftProduct.value && val !== selectedGiftProduct.value.translation?.name) {
                form.gift_product_id = ''
            }
        }
    )

    /**
     * ===== Type helpers =====
     */
    const isDiscount = computed(() => form.type === 'discount')
    const isGift = computed(() => form.type === 'gift')
</script>

<template>
    <div class="p-6 max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-semibold text-admin-text">Редактирование акции</h1>

            <Link :href="route('admin.promotions.index')" class="text-sm text-admin-muted hover:underline">← Назад</Link>
        </div>

        <!-- Form -->
        <form
            @submit.prevent="form.put(route('admin.promotions.update', promotion.id))"
            class="bg-white border border-gray-300 rounded-lg p-6 space-y-6"
        >
            <!-- Product -->
            <div>
                <label class="block text-sm font-medium mb-1">Товар</label>

                <div class="space-y-2">
                    <input
                        v-model="productSearch"
                        type="text"
                        placeholder="Поиск товара..."
                        class="w-full border rounded px-3 py-2 text-sm"
                    />

                    <select v-model="form.product_id" size="6" class="w-full border rounded px-3 py-2">
                        <option v-for="p in filteredProducts" :key="p.id" :value="p.id">
                            {{ p.translation?.name || '—' }} (ID {{ p.id }})
                        </option>
                    </select>
                </div>

                <div v-if="form.errors.product_id" class="text-red-600 text-xs mt-1">
                    {{ form.errors.product_id }}
                </div>
            </div>

            <!-- Type (locked) -->
            <div>
                <label class="block text-sm font-medium mb-1">Тип акции</label>
                <select v-model="form.type" disabled class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed">
                    <option value="discount">Скидка</option>
                    <option value="gift">Подарок</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Тип акции нельзя изменить после создания</p>
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium mb-1">Название (опционально)</label>
                <input v-model="form.title" type="text" class="w-full border rounded px-3 py-2" />
            </div>

            <!-- Discount -->
            <div v-if="isDiscount">
                <label class="block text-sm font-medium mb-1">Цена по акции</label>
                <input v-model="form.discount_price" type="number" step="0.01" class="w-full border rounded px-3 py-2" />
                <div v-if="form.errors.discount_price" class="text-red-600 text-xs mt-1">
                    {{ form.errors.discount_price }}
                </div>
            </div>

            <!-- Gift -->
            <div v-if="isGift" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Товар-подарок</label>

                    <div class="space-y-2">
                        <input
                            v-model="giftProductSearch"
                            type="text"
                            placeholder="Поиск подарка..."
                            class="w-full border rounded px-3 py-2 text-sm"
                        />

                        <select v-model="form.gift_product_id" size="6" class="w-full border rounded px-3 py-2">
                            <option v-for="p in filteredGiftProducts" :key="p.id" :value="p.id">
                                {{ p.translation?.name || '—' }} (ID {{ p.id }})
                            </option>
                        </select>
                    </div>

                    <div v-if="form.errors.gift_product_id" class="text-red-600 text-xs mt-1">
                        {{ form.errors.gift_product_id }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Количество</label>
                    <input v-model="form.gift_quantity" type="number" min="1" class="w-full border rounded px-3 py-2" />
                    <div v-if="form.errors.gift_quantity" class="text-red-600 text-xs mt-1">
                        {{ form.errors.gift_quantity }}
                    </div>
                </div>
            </div>

            <!-- Meta -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Активна</label>
                    <input type="checkbox" v-model="form.is_active" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Дата начала</label>
                    <input type="date" v-model="form.starts_at" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Дата окончания</label>
                    <input type="date" v-model="form.ends_at" class="w-full border rounded px-3 py-2" />
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3">
                <Link :href="route('admin.promotions.index')" class="px-4 py-2 border rounded-lg hover:bg-gray-100 transition">
                    Отмена
                </Link>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="bg-admin-primary text-white px-6 py-2 rounded-lg hover:bg-admin-muted transition"
                >
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</template>
