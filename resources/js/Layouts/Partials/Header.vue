<template>
    <header class="bg-white shadow p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="space-x-4">
                <nav class="space-x-4">
                    <Link :href="localizedRoute('/')" class="hover:underline">{{ t.home }}</Link>
                    <Link :href="localizedRoute('/about')" class="hover:underline">{{ t.about }}</Link>
                    <Link :href="localizedRoute('/contact')" class="hover:underline">{{ t.contact }}</Link>
                    <Link href="/admin" class="hover:underline">Кабинет</Link>
                </nav>
            </div>

            <form method="POST" :action="route('locale.switch')" class="ml-4">
                <input type="hidden" name="_token" :value="$page.props.csrf_token" />
                <select name="locale" @change="(e) => e.target.form.submit()" class="border rounded px-2 py-1">
                    <option value="ru" :selected="currentLocale === 'ru'">RU</option>
                    <option value="ro" :selected="currentLocale === 'ro'">RO</option>
                    <option value="en" :selected="currentLocale === 'en'">EN</option>
                </select>
            </form>
        </nav>
    </header>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/vue3'
    import { useLocale } from '@/composables/useLocale'

    const page = usePage()
    const t = page.props.translations.common
    const currentLocale = page.props.current_locale // Берем из Inertia

    const { localizedRoute } = useLocale()
</script>
