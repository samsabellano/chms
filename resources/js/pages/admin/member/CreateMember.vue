<script setup>
const pageTitle = "Create Member";
import { ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import { cn } from "@/lib/utils";
import { format } from "date-fns";
import {
    Calendar as CalendarIcon,
    Loader2,
    Check,
    ChevronsUpDown,
} from "lucide-vue-next";
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
import {
    Command,
    CommandEmpty,
    CommandGroup,
    CommandInput,
    CommandItem,
    CommandList,
} from "@/components/ui/command";
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";

const { toast } = useToast();
const workplaceAddress = ref("");
const value = ref("");
const open = ref(false);
const props = defineProps({
    suffixes: {
        type: Object,
        required: true,
    },
    genders: {
        type: Object,
        required: true,
    },
    occupations: {
        type: Object,
        required: true,
    },
    workplaces: {
        type: Object,
        required: true,
    },
});

const frameworks = [
    { value: "next.js", label: "Next.js" },
    {
        value: "sveltekit",
        label: "Samuel C. Sabellano Jr",
    },
    { value: "nuxt", label: "Nuxt" },
    { value: "remix", label: "Remix" },
    { value: "astro", label: "Astro" },
];

const form = useForm({
    first_name: null,
    middle_name: null,
    last_name: null,
    suffix: null,
    gender: null,
    birth_date: null,
    civil_status: null,
    contact_number: null,
    photo: null,

    // Address
    address_line_1: null,
    address_line_2: null,
    barangay: null,
    city_or_municipality: null,
    state_or_province: null,
    country: null,
    postal_code: null,

    // Workplace
    occupation: null,
    workplace_id: null,
    workplace_address: null,
});

watch(
    () => form.workplace_id,
    (newValue) => {
        const selectedWorkplace = props.workplaces.data.find(
            (workplace) => workplace.id.toString() === newValue
        );

        if (selectedWorkplace) {
            workplaceAddress.value = selectedWorkplace.address;
        } else {
            workplaceAddress.value = "";
        }
    }
);

function saveMember() {
    form.post(route("admin.member.store"), {
        onSuccess: () => {
            form.reset();
            toast({
                title: "Success",
                description: "Member successfully created",
            });
        },
        onError: () => {
            toast({
                title: "Uh oh! Something went wrong.",
                description:
                    "Unable to process the form. Pleace check the errors.",
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
                                                    <SelectItem
                                                        v-for="suffix in props.suffixes"
                                                        :key="suffix"
                                                        :value="suffix"
                                                    >
                                                        {{ suffix }}
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
                                                    <SelectItem
                                                        v-for="gender in props.genders"
                                                        :key="gender"
                                                        :value="gender"
                                                    >
                                                        {{ gender }}
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
                                            Related to member
                                        </Label>
                                        <Popover v-model:open="open">
                                            <PopoverTrigger as-child>
                                                <Button
                                                    variant="outline"
                                                    role="combobox"
                                                    :aria-expanded="open"
                                                    class="w-full justify-between"
                                                >
                                                    {{
                                                        value
                                                            ? frameworks.find(
                                                                  (framework) =>
                                                                      framework.value ===
                                                                      value
                                                              )?.label
                                                            : ""
                                                    }}
                                                </Button>
                                            </PopoverTrigger>
                                            <PopoverContent class="w-full p-0">
                                                <Command>
                                                    <CommandInput
                                                        class="h-9"
                                                        placeholder="Search framework..."
                                                    />
                                                    <CommandEmpty
                                                        >No framework
                                                        found.</CommandEmpty
                                                    >
                                                    <CommandList>
                                                        <CommandGroup>
                                                            <CommandItem
                                                                v-for="framework in frameworks"
                                                                :key="
                                                                    framework.value
                                                                "
                                                                :value="
                                                                    framework.value
                                                                "
                                                                @select="
                                                                    (ev) => {
                                                                        if (
                                                                            typeof ev
                                                                                .detail
                                                                                .value ===
                                                                            'string'
                                                                        ) {
                                                                            value =
                                                                                ev
                                                                                    .detail
                                                                                    .value;
                                                                        }
                                                                        open = false;
                                                                    }
                                                                "
                                                            >
                                                                {{
                                                                    framework.label
                                                                }}
                                                                <Check
                                                                    :class="
                                                                        cn(
                                                                            'ml-auto h-4 w-4',
                                                                            value ===
                                                                                framework.value
                                                                                ? 'opacity-100'
                                                                                : 'opacity-0'
                                                                        )
                                                                    "
                                                                />
                                                            </CommandItem>
                                                        </CommandGroup>
                                                    </CommandList>
                                                </Command>
                                            </PopoverContent>
                                        </Popover>
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
                                        <Label for="postal-code">
                                            Postal Code
                                        </Label>
                                        <Input
                                            v-model="form.postal_code"
                                            :class="{
                                                'ring-1 ring-red-300':
                                                    form.errors.postal_code,
                                            }"
                                            id="postal-code"
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
                                    class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-4 gap-y-6"
                                >
                                    <div class="grid gap-2 relative">
                                        <Label for="occupation">
                                            Occupation
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
                                        </Label>
                                        <Select v-model="form.occupation">
                                            <SelectTrigger
                                                :class="{
                                                    'ring-1 ring-red-300':
                                                        form.errors.occupation,
                                                }"
                                                id="occupation"
                                                class="items-start [&_[data-description]]:hidden"
                                            >
                                                <SelectValue />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectGroup>
                                                    <SelectItem
                                                        v-for="occupation in props
                                                            .occupations.data"
                                                        :key="occupation.id"
                                                        :value="
                                                            occupation.id.toString()
                                                        "
                                                    >
                                                        {{ occupation.name }}
                                                    </SelectItem>
                                                </SelectGroup>
                                            </SelectContent>
                                        </Select>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.occupation"
                                        >
                                            {{ form.errors.occupation }}
                                        </div>
                                    </div>
                                    <div class="grid gap-2 relative">
                                        <Label for="company">
                                            Workplace
                                            <span class="text-muted-foreground">
                                                (optional)
                                            </span>
                                        </Label>
                                        <Select v-model="form.workplace_id">
                                            <SelectTrigger
                                                :class="{
                                                    'ring-1 ring-red-300':
                                                        form.errors
                                                            .workplace_id,
                                                }"
                                                id="company"
                                                class="items-start [&_[data-description]]:hidden"
                                            >
                                                <SelectValue />
                                            </SelectTrigger>
                                            <SelectContent>
                                                <SelectGroup>
                                                    <SelectItem
                                                        v-for="workplace in props
                                                            .workplaces.data"
                                                        :key="workplace.id"
                                                        :value="
                                                            workplace.id.toString()
                                                        "
                                                    >
                                                        {{ workplace.name }}
                                                    </SelectItem>
                                                </SelectGroup>
                                            </SelectContent>
                                        </Select>
                                        <div
                                            class="absolute text-xs text-red-500 top-[60px]"
                                            v-if="form.errors.workplace_id"
                                        >
                                            {{ form.errors.workplace_id }}
                                        </div>
                                    </div>
                                    <div
                                        class="grid gap-2 relative"
                                        v-if="workplaceAddress"
                                    >
                                        <Label for="company-address">
                                            Address
                                        </Label>
                                        <TooltipProvider :delayDuration="300">
                                            <Tooltip>
                                                <TooltipTrigger as-child>
                                                    <Input
                                                        v-model="
                                                            workplaceAddress
                                                        "
                                                        id="company-address"
                                                        required
                                                        readonly
                                                    />
                                                </TooltipTrigger>
                                                <TooltipContent>
                                                    <p>
                                                        This field is readonly
                                                    </p>
                                                </TooltipContent>
                                            </Tooltip>
                                        </TooltipProvider>
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
