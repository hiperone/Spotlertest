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
        account: Object,
        users: Array,
    },
    remember: "form",
    data() {
        return {
            form: useForm({
                name: this.account.name,
                address: this.account.address,
                town_city: this.account.town_city,
                country: this.account.country,
                post_code: this.account.post_code,
                phone: this.account.phone,
                owner_id: this.account.owner_id,
            }),
        };
    },
    methods: {
        updateAccount() {
            try {
                router.put(
                    route("accounts.update", this.account.id),
                    this.form
                );
            } catch (error) {
                console.error(error);
            }
        },
        deleteAccount() {
            try {
                if (confirm("Are you sure you want to delete this account?")) {
                    router.delete(route("accounts.destroy", this.account.id));
                }
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>

<template>
    <Head :title="'Edit - ' + account.name" />

    <BreezeAuthenticatedLayout>
        <div class="max-w-screen-lg mx-auto my-6 space-y-6">
            <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Account Information</h3>
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
                        <form @submit.prevent="updateAccount">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input
                                        type="text"
                                        id="name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.name"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="owner" class="block text-sm font-medium text-gray-700">Owner</label>
                                    <select
                                        id="owner_id"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="form.owner_id"
                                        required
                                    >
                                        <option
                                            v-for="user in users"
                                            :key="user.id"
                                            :value="user.id"
                                        >
                                            {{ user.name }}
                                        </option>
                                    </select>
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
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <input
                                        type="text"
                                        id="country"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.country"
                                        required
                                    >
                                </div>

                                <div class="col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <input
                                        type="text"
                                        id="address"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.address"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="city" class="block text-sm font-medium text-gray-700">Town/City</label>
                                    <input
                                        type="text"
                                        id="city"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.town_city"
                                        required
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="post-code" class="block text-sm font-medium text-gray-700">Post code</label>
                                    <input
                                        type="text"
                                        id="post-code"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.post_code"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button
                                    type="button"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    @click="deleteAccount()"
                                >
                                    Delete
                                </button>
                                <div>
                                    <Link
                                        :href="route('accounts.index')"
                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Cancel
                                    </Link>
                                    <button
                                        type="submit"
                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Save
                                    </button>
                                  </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
