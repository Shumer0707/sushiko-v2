<template>
    <!--
        bg-sushi-dark - используем наш кастомный цвет
        border-t-2 - верхняя граница
        relative z-50 - футер поверх всего остального
    -->
    <footer class="bg-sushi-dark border-t-2 border-sushi-gold border-opacity-30 relative z-40">
        <div class="container mx-auto px-4 py-8">
            <!--
                grid - CSS Grid сетка
                grid-cols-1 - на мобилках 1 колонка
                md:grid-cols-3 - на средних экранах и больше 3 колонки
                gap-8 - отступы между элементами
            -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                <!-- ЛЕВАЯ КОЛОНКА - Лого + описание -->
                <div class="text-center md:text-left">
                    <!-- Лого -->
                    <div class="mb-4">
                        <img src="/images/footer/logo.webp" alt="Sushiko" class="h-16 md:h-20 mx-auto md:mx-0" />
                    </div>

                    <!-- Описание -->
                    <p class="text-sm text-sushi-silver opacity-80 leading-relaxed max-w-xs mx-auto md:mx-0">
                        Лучшие суши и роллы в Кишиневе. Свежие ингредиенты, традиционные рецепты, быстрая доставка.
                    </p>
                </div>

                <!-- ЦЕНТРАЛЬНАЯ КОЛОНКА - Навигация + Контакты в две колонки -->
                <div class="text-center">
                    <!--
                        Две колонки: Навигация | Контакты
                        grid grid-cols-2 - делим на 2 равные колонки
                        gap-8 - отступ между колонками
                    -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
                        <!-- ЛЕВАЯ - Навигация -->
                        <div class="text-center sm:text-left">
                            <h3 class="text-sushi-gold font-semibold text-base mb-3">Навигация</h3>
                            <nav class="flex flex-col gap-2">
                                <!--
                                    Link - компонент Inertia для навигации без перезагрузки страницы
                                    hover:text-sushi-gold - при наведении меняем цвет
                                    transition-colors duration-300 - плавная анимация смены цвета (300мс)
                                -->
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

                        <!-- ПРАВАЯ - Контакты -->
                        <div class="text-center sm:text-left">
                            <h3 class="text-sushi-gold font-semibold text-base mb-3">Контакты</h3>
                            <div class="flex flex-col gap-2 text-sm">
                                <!--
                                    Телефон
                                    fa-solid fa-phone - иконка телефона из Font Awesome
                                    fa-solid - стиль (заливка), есть ещё fa-regular (контур)
                                    justify-center sm:justify-start - по центру на мобилках, слева на десктопе
                                -->
                                <a
                                    href="tel:+37360123456"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 flex items-center justify-center sm:justify-start gap-2"
                                >
                                    <i class="fa-solid fa-phone"></i>
                                    <span>+373 60 123 456</span>
                                </a>

                                <!-- Email -->
                                <a
                                    href="mailto:info@sushiko.md"
                                    class="text-sushi-silver hover:text-sushi-gold transition-colors duration-300 flex items-center justify-center sm:justify-start gap-2"
                                >
                                    <i class="fa-solid fa-envelope"></i>
                                    <span>info@sushiko.md</span>
                                </a>

                                <!--
                                    Адрес
                                    target="_blank" - открывает ссылку в новой вкладке
                                    rel="noopener noreferrer" - безопасность (защита от tabnabbing)
                                -->
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

                    <!-- Социальные сети - под обеими колонками -->
                    <div class="mt-6">
                        <div class="flex justify-center gap-4">
                            <!--
                                Иконки соцсетей из Font Awesome
                                fa-brands - это категория брендов (соцсети, логотипы компаний)
                                w-10 h-10 - размер 40x40px
                                rounded-full - круглые
                                bg-opacity-20 - полупрозрачный фон
                                hover:scale-110 - при наведении увеличиваем на 10%
                                group - класс для управления hover состоянием детей
                            -->

                            <!-- Instagram -->
                            <a
                                href="https://instagram.com/sushiko"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                                aria-label="Instagram"
                            >
                                <!--
                                    fa-brands fa-instagram - оригинальная иконка Instagram
                                    text-lg - размер иконки
                                    group-hover:text-sushi-dark - при наведении на родителя меняем цвет
                                -->
                                <i
                                    class="fa-brands fa-instagram text-lg text-sushi-gold group-hover:text-sushi-dark transition-colors"
                                ></i>
                            </a>

                            <!-- Facebook -->
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

                            <!-- Telegram -->
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

                <!-- ПРАВАЯ КОЛОНКА - Фирменный символ (кот) -->
                <div class="text-center md:text-right">
                    <!-- Картинка кота -->
                    <div class="mb-3 flex justify-center md:justify-end">
                        <img
                            src="/images/footer/cat.webp"
                            alt="Sushiko Cat"
                            class="h-16 md:h-20 opacity-90 hover:opacity-100 hover:scale-105 transition-all duration-300"
                        />
                    </div>

                    <!-- Подпись / слоган под котом -->
                    <p class="text-xs text-sushi-silver opacity-70 leading-relaxed max-w-xs mx-auto md:mx-0 md:ml-auto">
                        Наш талисман следит за качеством каждого ролла! 🍣
                    </p>
                </div>
            </div>

            <!--
                Нижняя часть - копирайт
                mt-8 - отступ сверху
                pt-6 - padding сверху
                border-t - верхняя граница
            -->
            <div class="mt-8 pt-6 border-t border-sushi-gold border-opacity-20 text-center">
                <p class="text-xs text-sushi-silver opacity-60">
                    &copy; {{ new Date().getFullYear() }} Sushiko.md. Все права защищены.
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
    // Link - компонент из Inertia для навигации без перезагрузки страницы
    import { Link } from '@inertiajs/vue3'
</script>

<style scoped>
    /*
        scoped - стили применяются только к этому компоненту
        fadeIn - плавное появление футера при загрузке
    */
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
