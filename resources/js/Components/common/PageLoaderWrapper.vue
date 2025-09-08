<template>
    <div>
        <div v-if="loading" class="flex justify-center items-center min-h-[200px]">
            <span class="animate-spin border-4 border-gray-300 border-t-gray-600 rounded-full w-10 h-10"></span>
        </div>
        <div v-else>
            <slot />
        </div>
    </div>
</template>

<script setup>
defineProps({
    loading: {
        type: Boolean,
        default: false,
    },
});
</script>
