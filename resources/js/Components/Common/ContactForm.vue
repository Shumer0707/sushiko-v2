<script setup>
    import { reactive } from 'vue'
    import { router, usePage } from '@inertiajs/vue3'

    const form = reactive({
        name: '',
        email: '',
        phone: '',
        message: '',
    })

    const page = usePage()
    const errors = page.props.errors || {}
    const flash = page.props.flash || {}

    function submit() {
        router.post(route('contact.send'), form, {
            preserveScroll: true,
            onSuccess: () => {
                // Очищаем форму после успешной отправки
                form.name = ''
                form.email = ''
                form.phone = ''
                form.message = ''
            },
        })
    }
</script>

<template>
    <div class="bg-sushi-dark bg-opacity-60 backdrop-blur-sm rounded-2xl border-2 border-sushi-gold p-8 shadow-2xl">
        <!-- Заголовок -->
        <h3 class="text-2xl font-bold text-sushi-gold mb-6 text-center">Напишите нам</h3>

        <!-- Сообщение об успехе -->
        <div
            v-if="flash.success"
            class="mb-6 p-4 bg-green-500 bg-opacity-20 border-2 border-green-500 rounded-lg text-green-400 text-center animate-pulse"
        >
            <i class="fas fa-check-circle mr-2"></i>
            {{ flash.success }}
        </div>

        <!-- Форма -->
        <form @submit.prevent="submit" class="space-y-5">
            <!-- Имя -->
            <div>
                <label class="block text-sushi-gold font-semibold mb-2">
                    <i class="fas fa-user mr-2"></i>
                    Имя
                </label>
                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Ваше имя"
                    class="w-full px-4 py-3 bg-sushi-first border-2 border-sushi-gold border-opacity-30 rounded-lg text-white placeholder-gray-400 focus:border-sushi-gold focus:outline-none focus:ring-2 focus:ring-sushi-gold focus:ring-opacity-50 transition-all"
                />
                <div v-if="errors.name" class="mt-2 text-red-400 text-sm">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ errors.name }}
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sushi-gold font-semibold mb-2">
                    <i class="fas fa-envelope mr-2"></i>
                    Email
                </label>
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="your@email.com"
                    class="w-full px-4 py-3 bg-sushi-first border-2 border-sushi-gold border-opacity-30 rounded-lg text-white placeholder-gray-400 focus:border-sushi-gold focus:outline-none focus:ring-2 focus:ring-sushi-gold focus:ring-opacity-50 transition-all"
                />
                <div v-if="errors.email" class="mt-2 text-red-400 text-sm">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ errors.email }}
                </div>
            </div>

            <!-- Телефон (новое поле) -->
            <div>
                <label class="block text-sushi-gold font-semibold mb-2">
                    <i class="fas fa-phone mr-2"></i>
                    Телефон
                </label>
                <input
                    v-model="form.phone"
                    type="tel"
                    placeholder="+373 XX XXX XXX"
                    class="w-full px-4 py-3 bg-sushi-first border-2 border-sushi-gold border-opacity-30 rounded-lg text-white placeholder-gray-400 focus:border-sushi-gold focus:outline-none focus:ring-2 focus:ring-sushi-gold focus:ring-opacity-50 transition-all"
                />
                <div v-if="errors.phone" class="mt-2 text-red-400 text-sm">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ errors.phone }}
                </div>
            </div>

            <!-- Сообщение -->
            <div>
                <label class="block text-sushi-gold font-semibold mb-2">
                    <i class="fas fa-comment mr-2"></i>
                    Сообщение
                </label>
                <textarea
                    v-model="form.message"
                    rows="5"
                    placeholder="Напишите ваше сообщение..."
                    class="w-full px-4 py-3 bg-sushi-first border-2 border-sushi-gold border-opacity-30 rounded-lg text-white placeholder-gray-400 focus:border-sushi-gold focus:outline-none focus:ring-2 focus:ring-sushi-gold focus:ring-opacity-50 transition-all resize-none"
                ></textarea>
                <div v-if="errors.message" class="mt-2 text-red-400 text-sm">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    {{ errors.message }}
                </div>
            </div>

            <!-- Кнопка отправки -->
            <button
                type="submit"
                class="w-full bg-sushi-gold text-sushi-dark font-bold py-4 px-6 rounded-lg hover:bg-opacity-90 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-sushi-gold/50"
            >
                <i class="fas fa-paper-plane mr-2"></i>
                Отправить сообщение
            </button>
        </form>
    </div>
</template>
