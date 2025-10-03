<script setup>
    import { onMounted, ref } from 'vue'
    import L from 'leaflet'
    import 'leaflet/dist/leaflet.css'

    // Пропсы - координаты и адрес
    const props = defineProps({
        latitude: {
            type: Number,
            default: 47.0105, // Центр Кишинёва
        },
        longitude: {
            type: Number,
            default: 28.8638,
        },
        address: {
            type: String,
            default: 'ул. Штефан чел Маре 10, Кишинёв',
        },
    })

    const mapContainer = ref(null) // Ссылка на DOM элемент карты

    onMounted(() => {
        // Создаём карту
        const map = L.map(mapContainer.value).setView(
            [props.latitude, props.longitude],
            15 // Зум (15 - хороший уровень для города)
        )

        // Подключаем тайлы OpenStreetMap (сами карты)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
        }).addTo(map)

        // Создаём кастомную иконку маркера (золотая)
        const customIcon = L.divIcon({
            className: 'custom-marker',
            html: '<div class="w-8 h-8 bg-sushi-gold rounded-full border-4 border-white shadow-lg flex items-center justify-center"><i class="fas fa-utensils text-sushi-dark text-sm"></i></div>',
            iconSize: [32, 32],
            iconAnchor: [16, 32], // Точка привязки (центр низа)
        })

        // Добавляем маркер на карту
        L.marker([props.latitude, props.longitude], { icon: customIcon })
            .addTo(map)
            .bindPopup(`<b>SUSHIKO</b><br>${props.address}`) // Всплывашка при клике
    })
</script>

<template>
    <div class="relative w-full h-full rounded-2xl overflow-hidden shadow-2xl">
        <!-- Контейнер карты -->
        <div ref="mapContainer" class="w-full h-full min-h-[400px] md:min-h-[500px]"></div>

        <!-- Декоративная рамка -->
        <div class="absolute inset-0 pointer-events-none border-2 border-sushi-gold rounded-2xl"></div>
    </div>
</template>

<style scoped>
    /* Убираем дефолтные стили Leaflet для маркера */
    :deep(.custom-marker) {
        background: transparent !important;
        border: none !important;
    }

    /* Стилизуем попап */
    :deep(.leaflet-popup-content-wrapper) {
        background: rgb(52, 48, 47);
        color: rgb(212, 175, 55);
        border-radius: 12px;
        padding: 8px;
    }

    :deep(.leaflet-popup-tip) {
        background: rgb(52, 48, 47);
    }
</style>
