<script setup>
const pageTitle = "Create Member";
import { useForm } from "@inertiajs/vue3";
import { cn } from "@/lib/utils";
import { format } from "date-fns";
import { Calendar as CalendarIcon, Loader2 } from "lucide-vue-next";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Calendar } from "@/components/ui/v-calendar";
import { useToast } from "@/components/ui/toast/use-toast";
import Toaster from "@/components/ui/toast/Toaster.vue";
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

const { toast } = useToast();
const form = useForm({
    first_name: "",
    middle_name: "",
    last_name: "",
    suffix: "",
    gender: "",
    birth_date: "",
    civil_status: "",
    address: "",
});

function saveMember() {
    form.post(route("admin.member.store"), {
        onSuccess: () => {
            form.reset();
            toast({
                title: "Success",
                description: "Member successfully created",
            });
        },
    });
}
</script>

<template>
    <Head :title="pageTitle" />
    <PageTitle :title="pageTitle" />
    <Toaster />
    <form @submit.prevent="saveMember" novalidate autocomplete="off">
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
                        <div class="grid gap-7">
                            <div
                                class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <div class="grid gap-2 relative">
                                    <Label for="first-name">First name</Label>
                                    <Input
                                        v-model="form.first_name"
                                        :class="{
                                            'ring-1 ring-red-300':
                                                form.errors.first_name,
                                        }"
                                        id="first-name"
                                        placeholder="Enter first name"
                                        required
                                    />
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.first_name"
                                    >
                                        {{ form.errors.first_name }}
                                    </div>
                                </div>
                                <div class="grid gap-2 relative">
                                    <Label for="middle-name">
                                        Middle name
                                        <span class="text-muted-foreground"
                                            >(optional)</span
                                        >
                                    </Label>
                                    <Input
                                        v-model="form.middle_name"
                                        :class="{
                                            'ring-1 ring-red-300':
                                                form.errors.middle_name,
                                        }"
                                        id="middle-name"
                                        placeholder="Enter middle name"
                                        required
                                    />
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.middle_name"
                                    >
                                        {{ form.errors.middle_name }}
                                    </div>
                                </div>
                                <div class="grid gap-2 relative">
                                    <Label for="last-name">Last name</Label>
                                    <Input
                                        v-model="form.last_name"
                                        :class="{
                                            'ring-1 ring-red-300':
                                                form.errors.last_name,
                                        }"
                                        id="last-name"
                                        placeholder="Enter last name"
                                        required
                                    />
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.last_name"
                                    >
                                        {{ form.errors.last_name }}
                                    </div>
                                </div>
                            </div>
                            <div
                                class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4"
                            >
                                <div class="grid gap-2 relative">
                                    <Label for="suffix">
                                        Suffix
                                        <span class="text-muted-foreground"
                                            >(optional)</span
                                        >
                                    </Label>
                                    <Select v-model="form.suffix">
                                        <SelectTrigger
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.suffix,
                                            }"
                                            id="suffix"
                                            class="items-start [&_[data-description]]:hidden"
                                        >
                                            <SelectValue
                                                placeholder="Select suffix"
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
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.suffx"
                                    >
                                        {{ form.errors.suffx }}
                                    </div>
                                </div>
                                <div class="grid gap-2 relative">
                                    <Label for="gender"> Gender </Label>
                                    <Select v-model="form.gender">
                                        <SelectTrigger
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.gender,
                                            }"
                                            id="gender"
                                            class="items-start [&_[data-description]]:hidden"
                                        >
                                            <SelectValue
                                                placeholder="Select gender"
                                            />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem value="Male">
                                                    Male
                                                </SelectItem>
                                                <SelectItem value="Female">
                                                    Female
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.gender"
                                    >
                                        {{ form.errors.gender }}
                                    </div>
                                </div>
                                <div class="grid gap-2 relative">
                                    <Label for="date-of-birth">
                                        Date of birth
                                    </Label>
                                    <Popover>
                                        <PopoverTrigger
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.birth_date,
                                            }"
                                            as-child
                                            id="date-of-birth"
                                        >
                                            <Button
                                                :variant="'outline'"
                                                :class="
                                                    cn(
                                                        'justify-start text-left font-normal',
                                                        !form.birth_date &&
                                                            'text-muted-foreground'
                                                    )
                                                "
                                            >
                                                <CalendarIcon
                                                    class="mr-2 h-4 w-4"
                                                />
                                                <span>{{
                                                    form.birth_date
                                                        ? format(
                                                              form.birth_date,
                                                              "PPP"
                                                          )
                                                        : "Select date of birth"
                                                }}</span>
                                            </Button>
                                        </PopoverTrigger>
                                        <PopoverContent class="w-auto p-0">
                                            <Calendar
                                                v-model="form.birth_date"
                                            />
                                        </PopoverContent>
                                    </Popover>
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.birth_date"
                                    >
                                        {{ form.errors.birth_date }}
                                    </div>
                                </div>
                            </div>
                            <div
                                class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4"
                            >
                                <div class="grid gap-2 relative">
                                    <Label for="civil-status">
                                        Civil Status
                                    </Label>
                                    <Select v-model="form.civil_status">
                                        <SelectTrigger
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.civil_status,
                                            }"
                                            id="civil-status"
                                            class="items-start [&_[data-description]]:hidden"
                                        >
                                            <SelectValue
                                                placeholder="Select civil status"
                                            />
                                        </SelectTrigger>
                                        <SelectContent>
                                            <SelectGroup>
                                                <SelectItem value="Single">
                                                    Single
                                                </SelectItem>
                                                <SelectItem value="Married">
                                                    Married
                                                </SelectItem>
                                                <SelectItem value="Widowed">
                                                    Widowed
                                                </SelectItem>
                                                <SelectItem value="Separated">
                                                    Separated
                                                </SelectItem>
                                            </SelectGroup>
                                        </SelectContent>
                                    </Select>
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.civil_status"
                                    >
                                        {{ form.errors.civil_status }}
                                    </div>
                                </div>
                                <div class="grid gap-2 relative">
                                    <Label for="address"> Address </Label>
                                    <Input
                                        v-model="form.address"
                                        :class="{
                                            'ring-1 ring-red-300':
                                                form.errors.address,
                                        }"
                                        id="address"
                                        placeholder="Enter address"
                                        required
                                    />
                                    <div
                                        class="absolute text-xs text-red-500 bottom-[-19px]"
                                        v-if="form.errors.address"
                                    >
                                        {{ form.errors.address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <div class="pb-6 px-6">
                        <Button type="submit">
                            <Loader2
                                v-if="form.processing"
                                class="w-4 h-4 mr-2 animate-spin"
                            />
                            {{ form.processing ? "Saving" : "Save member" }}
                        </Button>
                    </div>
                </Card>
            </div>
        </div>
    </form>
</template>
