<script setup>
const pageTitle = "Create Member";
import * as z from "zod";
import { ref } from "vue";
import { cn } from "@/lib/utils";
import { format } from "date-fns";
import { useForm } from "@inertiajs/vue3";
import { toTypedSchema } from "@vee-validate/zod";
import { Calendar as CalendarIcon } from "lucide-vue-next";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Calendar } from "@/components/ui/v-calendar";
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover";
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";

const date = ref();
const formSchema = toTypedSchema(
    z.object({
        firstName: z.string().min(2).max(50),
        middleName: z.string().min(2).max(50).nullable(),
    })
);

const createMemberForm = useForm({
    validationSchema: formSchema,
});
</script>

<template>
    <Head :title="pageTitle" />
    <PageTitle :title="pageTitle" />
    <form action="">
        <div class="grid gap-4 lg:grid-cols-1 lg:gap-8">
            <div
                class="grid auto-rows-max items-start gap-4 lg:col-span-2 lg:gap-8"
            >
                <Card>
                    <CardHeader>
                        <CardTitle>Personal Information</CardTitle>
                        <CardDescription>
                            Please enter the correct details in the required
                            fields provided.
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div class="grid gap-4">
                            <div
                                class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4"
                            >
                                <div class="grid gap-2">
                                    <Label for="first-name">First name</Label>
                                    <Input
                                        id="first-name"
                                        placeholder="Enter first name"
                                        required
                                    />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="middle-name">
                                        Middle name
                                        <span class="text-muted-foreground"
                                            >(optional)</span
                                        >
                                    </Label>
                                    <Input
                                        id="middle-name"
                                        placeholder="Enter middle name"
                                        required
                                    />
                                </div>
                                <div class="grid gap-2">
                                    <Label for="last-name">Last name</Label>
                                    <Input
                                        id="last-name"
                                        placeholder="Enter last name"
                                        required
                                    />
                                </div>
                            </div>
                            <div
                                class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4"
                            >
                                <div class="grid gap-2">
                                    <Label for="suffix">
                                        Suffix
                                        <span class="text-muted-foreground"
                                            >(optional)</span
                                        >
                                    </Label>
                                    <Select>
                                        <SelectTrigger
                                            id="suffix"
                                            class="items-start [&_[data-description]]:hidden"
                                        >
                                            <SelectValue
                                                placeholder="Select a suffix"
                                            />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem value="Sr">
                                                    Sr
                                                </SelectItem>
                                                <SelectItem value="Jr">
                                                    Jr
                                                </SelectItem>
                                                <SelectItem value="I">
                                                    I
                                                </SelectItem>
                                                <SelectItem value="II">
                                                    II
                                                </SelectItem>
                                                <SelectItem value="III">
                                                    III
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div class="grid gap-2">
                                    <Label for="gender"> Gender </Label>
                                    <Select>
                                        <SelectTrigger
                                            id="gender"
                                            class="items-start [&_[data-description]]:hidden"
                                        >
                                            <SelectValue
                                                placeholder="Select a suffix"
                                            />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem value="Sr">
                                                    Male
                                                </SelectItem>
                                                <SelectItem value="Jr">
                                                    Female
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                </div>
                                <div class="grid gap-2">
                                    <Label for="date-of-birth">
                                        Date of birth
                                    </Label>
                                    <Popover>
                                        <PopoverTrigger
                                            as-child
                                            id="date-of-birth"
                                        >
                                            <Button
                                                :variant="'outline'"
                                                :class="
                                                    cn(
                                                        'justify-start text-left font-normal',
                                                        !date &&
                                                            'text-muted-foreground'
                                                    )
                                                "
                                            >
                                                <CalendarIcon
                                                    class="mr-2 h-4 w-4"
                                                />
                                                <span>{{
                                                    date
                                                        ? format(date, "PPP")
                                                        : "Select date of birth"
                                                }}</span>
                                            </Button>
                                        </PopoverTrigger>
                                        <PopoverContent class="w-auto p-0">
                                            <Calendar v-model="date" />
                                        </PopoverContent>
                                    </Popover>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <div class="pb-6 px-6">
                        <Button type="submit"> Save member </Button>
                    </div>
                </Card>
            </div>
        </div>
    </form>
</template>
