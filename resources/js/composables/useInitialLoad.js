import { ref } from 'vue';

export function useInitialLoad(loadFn) {
    const isReady = ref(false);
    const isLoading = ref(false);
    const hasLoaded = ref(false);

    const load = async () => {
        // предотвращаем повторный запрос
        if (isLoading.value || hasLoaded.value) {
            console.warn('Запрос уже выполняется или данные загружены.');
            return;
        }

        isLoading.value = true;
        isReady.value = false;

        try {
            if (typeof loadFn === 'function') {
                await loadFn();
            }
            hasLoaded.value = true;
        } catch (error) {
            console.error('Ошибка при загрузке данных:', error);
        } finally {
            isLoading.value = false;
            isReady.value = true;
        }
    };

    return { isReady, isLoading, hasLoaded, load };
}
