<script setup>
const props = defineProps({
    active: Boolean,
});
</script>

<template>
    <Link
        class="flex h-9 w-9 items-center justify-center rounded-lg transition-colors md:h-8 md:w-8"
        :class="{
            'bg-accent text-orange-foreground text-orange-600': active,
        }"
    >
        <slot />
    </Link>
</template>
