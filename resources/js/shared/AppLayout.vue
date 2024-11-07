<script setup>
import AppSidebar from "@/shared/AppSidebar.vue";
import AppHeader from "@/shared/AppHeader.vue";
</script>

<template>
    <div class="flex min-h-screen w-full flex-col bg-muted/40">
        <AppSidebar />
        <div class="flex flex-col sm:gap-4 sm:py-4 sm:pl-14">
            <AppHeader />
            <main
                class="grid flex-1 flex-col items-start gap-4 p-4 sm:px-6 sm:py-0 md:gap-6"
            >
                <slot />
            </main>
        </div>
    </div>
</template>
