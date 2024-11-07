<script setup>
const pageTitle = "Dashboard";
import { Progress } from "@/components/ui/progress";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
</script>

<template>
    <Head :title="pageTitle" />
    <PageTitle :title="pageTitle" />
    <div class="grid auto-rows-max items-start gap-4 md:gap-8 lg:col-span-2">
        <div class="grid gap-4 md:grid-cols-2 md:gap-8 lg:grid-cols-4">
            <Card>
                <CardHeader class="pb-2">
                    <CardDescription>This Week</CardDescription>
                    <CardTitle class="text-4xl"> $1329 </CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="text-xs text-muted-foreground">
                        +25% from last week
                    </div>
                </CardContent>
                <CardFooter>
                    <Progress :model-value="25" aria-label="25% increase" />
                </CardFooter>
            </Card>
            <Card>
                <CardHeader class="pb-2">
                    <CardDescription>This Week</CardDescription>
                    <CardTitle class="text-4xl"> $1329 </CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="text-xs text-muted-foreground">
                        +25% from last week
                    </div>
                </CardContent>
                <CardFooter>
                    <Progress :model-value="25" aria-label="25% increase" />
                </CardFooter>
            </Card>
            <Card>
                <CardHeader class="pb-2">
                    <CardDescription>This Week</CardDescription>
                    <CardTitle class="text-4xl"> $1329 </CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="text-xs text-muted-foreground">
                        +25% from last week
                    </div>
                </CardContent>
                <CardFooter>
                    <Progress :model-value="25" aria-label="25% increase" />
                </CardFooter>
            </Card>
            <Card>
                <CardHeader class="pb-2">
                    <CardDescription>This Month</CardDescription>
                    <CardTitle class="text-3xl"> $5,329 </CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="text-xs text-muted-foreground">
                        +10% from last month
                    </div>
                </CardContent>
                <CardFooter>
                    <Progress :model-value="12" aria-label="12% increase" />
                </CardFooter>
            </Card>
        </div>
    </div>
</template>
