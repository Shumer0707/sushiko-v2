<script setup>
    // Никаких пропсов пока, данные захардкодим внутри
</script>

<template>
    <div class="bg-sushi-dark bg-opacity-60 backdrop-blur-sm rounded-2xl border-2 border-sushi-gold p-8 shadow-2xl">
        <!-- Заголовок -->
        <h3 class="text-2xl font-bold text-sushi-gold mb-6 text-center">Наши контакты</h3>

        <!-- Список контактов -->
        <div class="space-y-6">
            <!-- Адрес -->
            <div class="flex items-start gap-4 group">
                <div
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center flex-shrink-0 group-hover:bg-sushi-gold transition-all duration-300"
                >
                    <i class="fas fa-map-marker-alt text-sushi-gold text-xl group-hover:text-sushi-dark transition-colors"></i>
                </div>
                <div>
                    <h4 class="text-sushi-gold font-semibold mb-1">Адрес</h4>
                    <p class="text-white text-sm leading-relaxed">
                        ул. Штефан чел Маре 10,
                        <br />
                        Кишинёв, Молдова
                    </p>
                </div>
            </div>

            <!-- Телефон -->
            <div class="flex items-start gap-4 group">
                <div
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center flex-shrink-0 group-hover:bg-sushi-gold transition-all duration-300"
                >
                    <i class="fas fa-phone-alt text-sushi-gold text-xl group-hover:text-sushi-dark transition-colors"></i>
                </div>
                <div>
                    <h4 class="text-sushi-gold font-semibold mb-1">Телефон</h4>
                    <a href="tel:+37322123456" class="text-white text-sm hover:text-sushi-gold transition-colors">
                        +373 (22) 123-456
                    </a>
                </div>
            </div>

            <!-- Email -->
            <div class="flex items-start gap-4 group">
                <div
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center flex-shrink-0 group-hover:bg-sushi-gold transition-all duration-300"
                >
                    <i class="fas fa-envelope text-sushi-gold text-xl group-hover:text-sushi-dark transition-colors"></i>
                </div>
                <div>
                    <h4 class="text-sushi-gold font-semibold mb-1">Email</h4>
                    <a href="mailto:info@sushiko.md" class="text-white text-sm hover:text-sushi-gold transition-colors">
                        info@sushiko.md
                    </a>
                </div>
            </div>

            <!-- Часы работы -->
            <div class="flex items-start gap-4 group">
                <div
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center flex-shrink-0 group-hover:bg-sushi-gold transition-all duration-300"
                >
                    <i class="fas fa-clock text-sushi-gold text-xl group-hover:text-sushi-dark transition-colors"></i>
                </div>
                <div>
                    <h4 class="text-sushi-gold font-semibold mb-1">Часы работы</h4>
                    <p class="text-white text-sm">
                        Пн-Пт:
                        <span class="text-sushi-gold">10:00 - 23:00</span>
                        <br />
                        Сб-Вс:
                        <span class="text-sushi-gold">11:00 - 00:00</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Разделитель -->
        <div class="my-8 border-t border-sushi-gold opacity-30"></div>

        <!-- Соцсети -->
        <div>
            <h4 class="text-sushi-gold font-semibold mb-4 text-center">Мы в соцсетях</h4>
            <div class="flex justify-center gap-4">
                <!-- Instagram -->
                <a
                    href="https://instagram.com/sushiko"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                    aria-label="Instagram"
                >
                    <i class="fa-brands fa-instagram text-xl text-sushi-gold group-hover:text-sushi-dark transition-colors"></i>
                </a>

                <!-- Facebook -->
                <a
                    href="https://facebook.com/sushiko"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                    aria-label="Facebook"
                >
                    <i class="fa-brands fa-facebook-f text-xl text-sushi-gold group-hover:text-sushi-dark transition-colors"></i>
                </a>

                <!-- Telegram -->
                <a
                    href="https://t.me/sushiko"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="w-12 h-12 rounded-full bg-sushi-gold bg-opacity-20 border-2 border-sushi-gold flex items-center justify-center hover:bg-sushi-gold hover:scale-110 transition-all duration-300 group"
                    aria-label="Telegram"
                >
                    <i class="fa-brands fa-telegram text-xl text-sushi-gold group-hover:text-sushi-dark transition-colors"></i>
                </a>
            </div>
        </div>
    </div>
</template>
