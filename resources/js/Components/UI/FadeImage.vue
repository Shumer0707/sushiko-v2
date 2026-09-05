<script setup>
    import { ref, watch } from 'vue'

    const props = defineProps({
        src: {
            type: String,
            default: '',
        },
        alt: {
            type: String,
            default: '',
        },
        loading: {
            type: String,
            default: 'lazy',
        },
        fetchpriority: {
            type: String,
            default: 'auto',
        },
        imageClass: {
            type: [String, Array, Object],
            default: '',
        },
    })

    const isLoaded = ref(false)
    const hasError = ref(!props.src)

    watch(
        () => props.src,
        (src) => {
            isLoaded.value = false
            hasError.value = !src
        }
    )
</script>

<template>
    <img
        v-if="!hasError"
        :src="src"
        :alt="alt"
        :loading="loading"
        :fetchpriority="fetchpriority"
        decoding="async"
        :class="[
            imageClass,
            'transition-[opacity,transform] duration-200 ease-out motion-reduce:transition-none',
            isLoaded ? 'opacity-100' : 'opacity-0',
        ]"
        @load="isLoaded = true"
        @error="hasError = true"
    />

    <slot v-else name="fallback" />
</template>
