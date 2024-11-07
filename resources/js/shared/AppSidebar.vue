<script setup>
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";
import { Home, LineChart, Package2, Settings, Users2 } from "lucide-vue-next";
</script>

<template>
    <aside
        class="fixed inset-y-0 left-0 z-10 hidden w-14 flex-col border-r bg-background sm:flex"
    >
        <nav class="flex flex-col items-center gap-4 px-2 sm:py-5">
            <Link
                :href="route('admin.dashboard')"
                class="group flex h-9 w-9 shrink-0 items-center justify-center gap-2 rounded-full bg-primary text-lg font-semibold text-primary-foreground md:h-8 md:w-8 md:text-base"
            >
                <Package2
                    class="h-4 w-4 transition-all group-hover:scale-110"
                />
                <span class="sr-only">Acme Inc</span>
            </Link>
            <TooltipProvider :delayDuration="100">
                <Tooltip>
                    <TooltipTrigger as-child>
                        <NavLink
                            :href="route('admin.dashboard')"
                            :active="$page.url.startsWith('/admin/dashboard')"
                        >
                            <Home class="h-5 w-5" />
                            <span class="sr-only">Dashboard</span>
                        </NavLink>
                    </TooltipTrigger>
                    <TooltipContent side="right"> Dashboard </TooltipContent>
                </Tooltip>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <NavLink
                            :href="route('admin.member')"
                            :active="$page.url.startsWith('/admin/member')"
                        >
                            <Users2 class="h-5 w-5" />
                            <span class="sr-only">Member</span>
                        </NavLink>
                    </TooltipTrigger>
                    <TooltipContent side="right"> Member </TooltipContent>
                </Tooltip>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Link
                            href="#"
                            class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
                        >
                            <LineChart class="h-5 w-5" />
                            <span class="sr-only">Analytics</span>
                        </Link>
                    </TooltipTrigger>
                    <TooltipContent side="right"> Analytics </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        </nav>
        <nav class="mt-auto flex flex-col items-center gap-4 px-2 sm:py-5">
            <TooltipProvider :delayDuration="100">
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Link
                            href="#"
                            class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
                        >
                            <Settings class="h-5 w-5" />
                            <span class="sr-only">Settings</span>
                        </Link>
                    </TooltipTrigger>
                    <TooltipContent side="right"> Settings </TooltipContent>
                </Tooltip>
            </TooltipProvider>
        </nav>
    </aside>
</template>
