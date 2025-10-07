<template>
    <footer class="bg-sushi-dark border-t-2 border-sushi-gold border-opacity-30 relative z-40">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- ЛЕВАЯ КОЛОНКА - Лого -->
                <div class="text-center md:text-left">
                    <div class="mb-4">
                        <!--
                            ВАЖНО! Добавляем width и height
                            aspect-[3/1] - соотношение сторон (лого обычно широкое)
                            Это резервирует место ДО загрузки картинки
                        -->
                        <img
                            src="/images/footer/logo.webp"
                            alt="Sushiko"
                            width="240"
                            height="80"
                            class="h-16 md:h-20 w-auto mx-auto md:mx-0"
                        />
                    </div>

                    <p class="text-sm text-sushi-silver opacity-80 leading-relaxed max-w-xs mx-auto md:mx-0">
                        Лучшие суши и роллы в Кишиневе. Свежие ингредиенты, традиционные рецепты, быстрая доставка.
                    </p>
                </div>

                <!-- ЦЕНТРАЛЬНАЯ КОЛОНКА - без изменений -->
                <div class="text-center">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                        <!-- Навигация -->
                        <div class="text-center sm:text-left">
                            <h3 class="text-sushi-gold font-semibold text-base mb-3">Навигация</h3>
                            <nav class="flex flex-col gap-2">
                                <Link
                                    href="/"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 text-sm"
                                >
                                    Главная
                                </Link>
                                <Link
                                    href="/contact"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 text-sm"
                                >
                                    Контакты
                                </Link>
                            </nav>
                        </div>

                        <!-- Контакты -->
                        <div class="text-center sm:text-left">
                            <h3 class="text-sushi-gold font-semibold text-base mb-3">Контакты</h3>
                            <div class="flex flex-col gap-2 text-sm">
                                <a
                                    href="tel:+37360123456"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 flex items-center justify-center sm:justify-start gap-2"
                                >
                                    <i class="fa-solid fa-phone"></i>
                                    <span>+373 60 123 456</span>
                                </a>
                                <a
                                    href="mailto:info@sushiko.md"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 flex items-center justify-center sm:justify-start gap-2"
                                >
                                    <i class="fa-solid fa-envelope"></i>
                                    <span>info@sushiko.md</span>
                                </a>
                                <a
                                    href="https://maps.google.com"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 flex items-center justify-center sm:justify-start gap-2"
                                >
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>Кишинёв, ул. Примерная 123</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Соцсети -->
                    <div class="mt-6">
                        <div class="flex justify-center gap-4">
                            <a
                                href="https://instagram.com/sushiko"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                                aria-label="Instagram"
                            >
                                <i
                                    class="fa-brands fa-instagram text-lg text-sushi-gold group-hover:text-sushi-dark transition-colors"
                                ></i>
                            </a>
                            <a
                                href="https://facebook.com/sushiko"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                                aria-label="Facebook"
                            >
                                <i
                                    class="fa-brands fa-facebook-f text-lg text-sushi-gold group-hover:text-sushi-dark transition-colors"
                                ></i>
                            </a>
                            <a
                                href="https://t.me/sushiko"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                                aria-label="Telegram"
                            >
                                <i
                                    class="fa-brands fa-telegram text-lg text-sushi-gold group-hover:text-sushi-dark transition-colors"
                                ></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ПРАВАЯ КОЛОНКА - Кот -->
                <div class="text-center md:text-right">
                    <div class="mb-3 flex justify-center md:justify-end">
                        <!--
                            ВАЖНО! Тоже добавляем размеры
                            Кот квадратный? Тогда 1:1
                        -->
                        <img
                            src="/images/footer/cat.webp"
                            alt="Sushiko Cat"
                            width="80"
                            height="80"
                            class="h-16 md:h-20 w-auto opacity-90 hover:opacity-100 hover:scale-105 transition-all duration-300"
                        />
                    </div>

                    <p class="text-xs text-sushi-silver opacity-70 leading-relaxed max-w-xs mx-auto md:mx-0 md:ml-auto">
                        Наш талисман следит за качеством каждого ролла! 🍣
                    </p>
                </div>
            </div>

            <!-- Копирайт -->
            <div class="mt-8 pt-6 border-t border-sushi-gold border-opacity-20 text-center">
                <p class="text-xs text-sushi-silver opacity-60">
                    &copy; {{ new Date().getFullYear() }} Sushiko.md. Все права защищены.
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3'
</script>

<style scoped>
    footer {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
