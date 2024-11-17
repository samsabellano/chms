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
    contact_number: "",
    photo: "",

    // Address
    address_line_1: "",
    address_line_2: "",
    barangay: "",
    city_or_municipality: "",
    state_or_province: "",
    country: "",
    postal_code: "",
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
                <Card class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <CardHeader>
                            <CardTitle>Basic Information</CardTitle>
                            <CardDescription>
                                Enter the correct details in the fields
                                provided.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="grid gap-y-6">
                                <div
                                    class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-6"
                                >
                                    <div class="grid gap-2 relative">
                                        <Label for="first-name"
                                            >First name</Label
                                        >
                                        <Input
                                            v-model="form.first_name"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.first_name,
                                            }"
                                            id="first-name"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.first_name"
                                        >
                                            {{ form.errors.first_name }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="middle-name">
                                            Middle name
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
                                        </Label>
                                        <Input
                                            v-model="form.middle_name"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.middle_name,
                                            }"
                                            id="middle-name"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
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
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.last_name"
                                        >
                                            {{ form.errors.last_name }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="suffix">
                                            Suffix
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
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
                                                <SelectValue />
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
                                            class="absolute text-xs text-red-500 top-[60px]"
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
                                                <SelectValue />
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
                                            class="absolute text-xs text-red-500 top-[60px]"
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
                                                    <span>{{
                                                        form.birth_date
                                                            ? format(
                                                                  form.birth_date,
                                                                  "PPP"
                                                              )
                                                            : ""
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
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.birth_date"
                                        >
                                            {{ form.errors.birth_date }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="civil-status">
                                            Civil Status
                                        </Label>
                                        <Select v-model="form.civil_status">
                                            <SelectTrigger
                                                :class="{
                                                    'ring-1 ring-red-300':
                                                        form.errors
                                                            .civil_status,
                                                }"
                                                id="civil-status"
                                                class="items-start [&_[data-description]]:hidden"
                                            >
                                                <SelectValue />
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
                                                    <SelectItem
                                                        value="Separated"
                                                    >
                                                        Separated
                                                    </SelectItem>
                                                </SelectGroup>
                                            </SelectContent>
                                        </Select>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.civil_status"
                                        >
                                            {{ form.errors.civil_status }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="address">
                                            Contact Number
                                        </Label>
                                        <Input
                                            v-model="form.contact_number"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.contact_number,
                                            }"
                                            id="address"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.contact_number"
                                        >
                                            {{ form.errors.contact_number }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="address">
                                            Profile Picture
                                        </Label>
                                        <Input
                                            @input="
                                                form.photo =
                                                    $event.target.files[0]
                                            "
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.photo,
                                            }"
                                            id="address"
                                            type="file"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.photo"
                                        >
                                            {{ form.errors.photo }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </div>
                    <hr />
                    <div class="flex flex-col gap-2">
                        <CardHeader>
                            <CardTitle>Address</CardTitle>
                            <CardDescription>
                                Enter the correct address in the fields
                                provided.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="grid gap-y-6">
                                <div
                                    class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-6"
                                >
                                    <div class="grid gap-2 relative">
                                        <Label for="address-line-1">
                                            House No./Bldg./Street
                                        </Label>
                                        <Input
                                            v-model="form.address_line_1"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.address_line_1,
                                            }"
                                            id="address-line-1"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.address_line_1"
                                        >
                                            {{ form.errors.address_line_1 }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="address-line-2">
                                            Address Line 2
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
                                        </Label>
                                        <Input
                                            v-model="form.address_line_2"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.address_line_2,
                                            }"
                                            id="address-line-2"
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.address_line_2"
                                        >
                                            {{ form.errors.address_line_2 }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="barangay"> Barangay </Label>
                                        <Input
                                            v-model="form.barangay"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.barangay,
                                            }"
                                            id="barangay"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.barangay"
                                        >
                                            {{ form.errors.barangay }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="city-or-municipality">
                                            City/Municipality
                                        </Label>
                                        <Input
                                            v-model="form.city_or_municipality"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors
                                                        .city_or_municipality,
                                            }"
                                            id="city-or-municipality"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="
                                                form.errors.city_or_municipality
                                            "
                                        >
                                            {{
                                                form.errors.city_or_municipality
                                            }}
                                        </div>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="
                                                form.errors.city_or_municipality
                                            "
                                        >
                                            {{
                                                form.errors.city_or_municipality
                                            }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="state-or-province">
                                            State/Province
                                        </Label>
                                        <Input
                                            v-model="form.state_or_province"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors
                                                        .state_or_province,
                                            }"
                                            id="state-or-province"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.state_or_province"
                                        >
                                            {{ form.errors.state_or_province }}
                                        </div>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.state_or_province"
                                        >
                                            {{ form.errors.state_or_province }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="country"> Country </Label>
                                        <Input
                                            v-model="form.country"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.country,
                                            }"
                                            id="country"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.country"
                                        >
                                            {{ form.errors.country }}
                                        </div>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.country"
                                        >
                                            {{ form.errors.country }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="country">
                                            Postal Code
                                        </Label>
                                        <Input
                                            v-model="form.postal_code"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.postal_code,
                                            }"
                                            id="country"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.postal_code"
                                        >
                                            {{ form.errors.postal_code }}
                                        </div>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.postal_code"
                                        >
                                            {{ form.errors.postal_code }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </div>
                    <hr />
                    <div class="flex flex-col gap-2">
                        <CardHeader>
                            <CardTitle>Work Information</CardTitle>
                            <CardDescription>
                                Please enter the work details in the fields
                                provided.
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="grid gap-y-6">
                                <div
                                    class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-6"
                                >
                                    <div class="grid gap-2 relative">
                                        <Label for="occupation">
                                            Occupation
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
                                        </Label>
                                        <Select v-model="form.suffix">
                                            <SelectTrigger
                                                :class="{
                                                    'ring-1 ring-red-300':
                                                        form.errors.suffix,
                                                }"
                                                id="occupation"
                                                class="items-start [&_[data-description]]:hidden"
                                            >
                                                <SelectValue />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectGroup>
                                                    <SelectItem
                                                        value="Accountant"
                                                    >
                                                        Accountant
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Architect"
                                                    >
                                                        Architect
                                                    </SelectItem>
                                                    <SelectItem value="Artist">
                                                        Artist
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Attorney"
                                                    >
                                                        Attorney
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Business Owner"
                                                    >
                                                        Business Owner
                                                    </SelectItem>
                                                    <SelectItem value="Chef">
                                                        Chef
                                                    </SelectItem>
                                                    <SelectItem value="Doctor">
                                                        Doctor
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Engineer"
                                                    >
                                                        Engineer
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Law Enforcement"
                                                    >
                                                        Law Enforcement
                                                    </SelectItem>
                                                    <SelectItem value="Nurse">
                                                        Nurse
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Professor"
                                                    >
                                                        Professor
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Software Developer"
                                                    >
                                                        Software Developer
                                                    </SelectItem>
                                                    <SelectItem value="Teacher">
                                                        Teacher
                                                    </SelectItem>
                                                </SelectGroup>
                                            </SelectContent>
                                        </Select>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.suffx"
                                        >
                                            {{ form.errors.suffx }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="company">
                                            Company/Workplace
                                        </Label>
                                        <Select v-model="form.suffix">
                                            <SelectTrigger
                                                :class="{
                                                    'ring-1 ring-red-300':
                                                        form.errors.suffix,
                                                }"
                                                id="company"
                                                class="items-start [&_[data-description]]:hidden"
                                            >
                                                <SelectValue />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectGroup>
                                                    <SelectItem
                                                        value="Accountant"
                                                    >
                                                        McArthur Highway,
                                                        Matina, Davao City
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Architect"
                                                    >
                                                        Ma-a National
                                                        Highschool, Ma-a, Davao
                                                        City
                                                    </SelectItem>
                                                    <SelectItem value="Artist">
                                                        GMall, Bajada Davao City
                                                    </SelectItem>
                                                    <SelectItem
                                                        value="Attorney"
                                                    >
                                                        Uyanguren, Davao City
                                                    </SelectItem>
                                                </SelectGroup>
                                            </SelectContent>
                                        </Select>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.suffx"
                                        >
                                            {{ form.errors.suffx }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="company-address">
                                            Address
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
                                        </Label>
                                        <Input
                                            v-model="form.postal_code"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.postal_code,
                                            }"
                                            id="company-address"
                                            required
                                        />
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.suffx"
                                        >
                                            {{ form.errors.suffx }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </CardContent>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-4 mb-6 px-6">
                        <Link :href="route('admin.member')">
                            <Button type="button" variant="secondary">
                                Cancel
                            </Button>
                        </Link>
                        <Button type="submit">
                            <Loader2
                                v-if="form.processing"
                                class="w-4 h-4 mr-2 animate-spin"
                            />
                            {{ form.processing ? "Saving" : "Save" }}
                        </Button>
                    </div>
                </Card>
            </div>
        </div>
    </form>
</template>
