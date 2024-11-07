<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>

<template v-slot:page-title>
    <h1
        class="flex-1 shrink-0 whitespace-nowrap text-xl font-semibold tracking-tight sm:grow-0 dark:text-neutral-50"
    >
        {{ title }}
    </h1>
</template>
