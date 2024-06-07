<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Link, Head, useForm, router } from "@inertiajs/vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        contact: Object,
        accounts: Array,
    },
    remember: "form",
    data() {
        return {
            form: useForm({
                first_name: this.contact.first_name,
                last_name: this.contact.last_name,
                email: this.contact.email,
                phone: this.contact.phone,
                position: this.contact.position,
                account_id: this.contact.account_id,
            }),
        };
    },
    computed: {
        name() {
            return `${this.contact.first_name} ${this.contact.last_name}`;
        },
    },
    methods: {
        updateContact() {
            try {
                router.put(
                    route("contacts.update", this.contact.id),
                    this.form
                );
            } catch (error) {
                console.error(error);
            }
        },
        deleteContact() {
            try {
                if (confirm("Are you sure you want to delete this contact?")) {
                    router.delete(route("contacts.destroy", this.contact.id));
                }
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>

<template>
    <Head :title="'Edit - ' + name" />

    <BreezeAuthenticatedLayout>
        <div class="max-w-screen-lg mx-auto my-6 space-y-6">
            <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Information</h3>
                        <ul class="mt-6">
                            <li
                                class="text-red-500"
                                v-for="(error, key) in form.errors"
                                :key="key"
                            >
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form @submit.prevent="updateContact">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input
                                        type="text"
                                        id="first-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.first_name"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input
                                        type="text"
                                        id="last-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.last_name"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input
                                        type="email"
                                        id="email"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.email"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.phone"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="position" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input
                                        type="text"
                                        id="position"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.position"
                                        required
                                    >
                                </div>

                                <div class="col-span-6">
                                    <label for="account" class="block text-sm font-medium text-gray-700">Account</label>
                                    <select
                                        id="account"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="form.account_id"
                                        required
                                    >
                                        <option
                                            v-for="account in accounts"
                                            :key="account.id"
                                            :value="account.id"
                                        >
                                            {{ account.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button
                                    type="button"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    @click="deleteContact()"
                                >
                                    Delete
                                </button>
                                <div>
                                    <Link :href="route('contacts.index')" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</Link>
                                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
