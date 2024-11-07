<script setup>
const pageTitle = "Members";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import {
    File,
    ListFilter,
    MoreHorizontal,
    PlusCircle,
    Loader2,
} from "lucide-vue-next";
import { Button } from "@/components/ui/button";
import { useToast } from "@/components/ui/toast/use-toast";
import Toaster from "@/components/ui/toast/Toaster.vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
    DialogClose,
} from "@/components/ui/dialog";

const { toast } = useToast();
const deleteForm = useForm({});
const props = defineProps({
    members: {
        type: Object,
        required: true,
    },
    fullName: {
        type: String,
        default: "",
    },
    id: {
        type: Number,
        default: null,
    },
});

const memberName = ref(props.fullName);
const memberId = ref(props.id);

const confirmDelete = (member) => {
    memberId.value = member.id;
    memberName.value = member.fullName;
};

const deleteMember = () => {
    if (memberId.value) {
        deleteForm.delete(route("admin.member.delete", memberId.value), {
            preserveScroll: true,
            onSuccess: () =>
                toast({
                    title: "Delete Successful",
                    description: "Member successfully deleted",
                }),
        });
    }
};

const cancelDeleteMember = () => {
    memberId.value = null;
    memberName.value = "";
};
</script>

<template>
    <Head :title="pageTitle" />
    <PageTitle :title="pageTitle" />
    <Toaster />
    <Tabs default-value="all">
        <div class="flex items-center">
            <TabsList>
                <TabsTrigger value="all"> All </TabsTrigger>
                <TabsTrigger value="adult"> Adult </TabsTrigger>
                <TabsTrigger value="youth"> Youth </TabsTrigger>
                <TabsTrigger value="children"> Children </TabsTrigger>
            </TabsList>
            <div class="ml-auto flex items-center gap-2">
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline" size="sm" class="h-7 gap-1">
                            <ListFilter class="h-3.5 w-3.5" />
                            <span
                                class="sr-only sm:not-sr-only sm:whitespace-nowrap"
                            >
                                Filter
                            </span>
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Filter by</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <DropdownMenuItem checked> Active </DropdownMenuItem>
                        <DropdownMenuItem>Draft</DropdownMenuItem>
                        <DropdownMenuItem> Archived </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
                <Button size="sm" variant="outline" class="h-7 gap-1">
                    <File class="h-3.5 w-3.5" />
                    <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">
                        Export
                    </span>
                </Button>
                <Link :href="route('admin.member.create')">
                    <Button size="sm" class="h-7 gap-1">
                        <PlusCircle class="h-3.5 w-3.5" />
                        <span
                            class="sr-only sm:not-sr-only sm:whitespace-nowrap"
                        >
                            Add Member
                        </span>
                    </Button>
                </Link>
            </div>
        </div>
        <TabsContent value="all">
            <Card>
                <CardHeader>
                    <CardTitle>Products</CardTitle>
                    <CardDescription>
                        Manage your products and view their sales performance.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead
                                    class="hidden w-[100px] sm:table-cell"
                                >
                                    <span class="sr-only">img</span>
                                </TableHead>
                                <TableHead>Name</TableHead>
                                <TableHead>Civil Status</TableHead>
                                <TableHead class="hidden md:table-cell">
                                    Gender
                                </TableHead>
                                <TableHead class="hidden md:table-cell">
                                    Age
                                </TableHead>
                                <TableHead class="hidden md:table-cell">
                                    Address
                                </TableHead>
                                <TableHead>
                                    <span class="sr-only">Actions</span>
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow
                                v-for="member in props.members.data"
                                :key="member.id"
                            >
                                <TableCell class="hidden sm:table-cell">
                                    <img
                                        alt="Product image"
                                        class="aspect-square rounded-md object-cover"
                                        height="64"
                                        src="https://img.freepik.com/free-photo/young-woman-smiling_23-2148503620.jpg?t=st=1730449105~exp=1730452705~hmac=f100b2c3bd78f4e1454b8b36f47803bc18c21a306e3984b4ff534e952deeb95e&w=1060"
                                        width="64"
                                    />
                                </TableCell>
                                <TableCell class="font-medium">
                                    {{ member.fullName }}
                                </TableCell>
                                <TableCell>
                                    {{ member.civilStatus }}
                                </TableCell>
                                <TableCell class="hidden md:table-cell">
                                    {{ member.gender }}
                                </TableCell>
                                <TableCell class="hidden md:table-cell">
                                    {{ member.age !== 0 ? member.age : "--" }}
                                </TableCell>
                                <TableCell class="hidden md:table-cell">
                                    {{ member.address }}
                                </TableCell>
                                <TableCell>
                                    <Dialog>
                                        <DropdownMenu>
                                            <DropdownMenuTrigger as-child>
                                                <Button
                                                    aria-haspopup="true"
                                                    size="icon"
                                                    variant="ghost"
                                                >
                                                    <MoreHorizontal
                                                        class="h-4 w-4"
                                                    />
                                                    <span class="sr-only">
                                                        Toggle menu
                                                    </span>
                                                </Button>
                                            </DropdownMenuTrigger>
                                            <DropdownMenuContent align="end">
                                                <DropdownMenuLabel>
                                                    Actions
                                                </DropdownMenuLabel>
                                                <DropdownMenuSeparator />
                                                <DropdownMenuItem>
                                                    Edit
                                                </DropdownMenuItem>
                                                <DialogTrigger as-child>
                                                    <DropdownMenuItem
                                                        @click="
                                                            confirmDelete(
                                                                member
                                                            )
                                                        "
                                                    >
                                                        <span
                                                            class="sr-only sm:not-sr-only sm:whitespace-nowrap text-red-400"
                                                        >
                                                            Delete
                                                        </span>
                                                    </DropdownMenuItem>
                                                </DialogTrigger>
                                            </DropdownMenuContent>
                                            <DialogContent
                                                class="sm:max-w-[425px]"
                                            >
                                                <DialogHeader>
                                                    <DialogTitle
                                                        class="dark:text-neutral-50"
                                                    >
                                                        Delete Member
                                                    </DialogTitle>
                                                    <DialogDescription>
                                                        {{ memberName }}
                                                    </DialogDescription>
                                                </DialogHeader>
                                                <DialogFooter>
                                                    <DialogClose as-child>
                                                        <Button
                                                            @click="
                                                                cancelDeleteMember
                                                            "
                                                            type="button"
                                                            variant="secondary"
                                                        >
                                                            Cancel
                                                        </Button>
                                                    </DialogClose>
                                                    <Button
                                                        @click="deleteMember"
                                                        :disabled="
                                                            deleteForm.processing
                                                        "
                                                        type="submit"
                                                    >
                                                        <Loader2
                                                            v-if="
                                                                deleteForm.processing
                                                            "
                                                            class="w-4 h-4 mr-2 animate-spin"
                                                        />
                                                        {{
                                                            deleteForm.processing
                                                                ? "Deleting"
                                                                : "Delete"
                                                        }}
                                                    </Button>
                                                </DialogFooter>
                                            </DialogContent>
                                        </DropdownMenu>
                                    </Dialog>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
                <CardFooter>
                    <div class="text-xs text-muted-foreground">
                        Showing <strong>1-10</strong> of <strong>32</strong>
                        products
                    </div>
                </CardFooter>
            </Card>
        </TabsContent>
    </Tabs>
</template>
