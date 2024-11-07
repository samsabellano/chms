<script setup>
import { Search } from "lucide-vue-next";
import { Input } from "@/components/ui/input";
</script>

<template>
    <div class="relative mr-auto flex-1 md:grow-0">
        <Search
            class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground"
        />
        <Input
            type="search"
            placeholder="Search..."
            class="w-full rounded-lg bg-background pl-8 md:w-[400px] lg:w-[400px]"
        />
    </div>
</template>
