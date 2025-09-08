import { defineStore } from 'pinia';

export const useLayoutStore = defineStore('layout', {
    state: () => ({
        locale: 'ru',
    }),
    actions: {
        setLocale(lang) {
            this.locale = lang;
        }
    },
});
