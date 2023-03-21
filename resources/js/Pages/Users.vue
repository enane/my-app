<template>
    <Head title="Users"/>
    <div class="flex justify-between mb-5">
        <h1 class="text-4xl font-bold">Users</h1>
        <!--        <input type="text" placeholder="Search...">-->

        <div>

            <div class="relative mt-2 rounded-md shadow-sm">
                <input
                    v-model="search"
                    type="text"
                    class="block w-full rounded-md border-0 py-1.5 pl-5 pr-8 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    placeholder="Search...">
                <div class="absolute inset-y-0 right-0 flex items-center">
<!--                    <font-awesome-icon icon="search" class="pl-2 pr-3"/>-->
                </div>
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b hover:bg-gray-100" v-for="user in users.data" :key="user.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                    v-text="user.name">
                </th>
                <td class="px-6 py-4" v-text="user.email">
                </td>
                <td class="px-6 py-4">
                    <Link :href="`/users/${user.id}/edit`" class="font-medium text-blue-600 hover:underline">
                        Edit
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
            <Pagination :links="users.links" :from="users.from" :to="users.to" :total="users.total"></Pagination>
        </div>
    </div>
</template>

<script setup>
import Pagination from "../Shared/Pagination.vue";
import {library} from "@fortawesome/fontawesome-svg-core";
import {faSearch} from "@fortawesome/free-solid-svg-icons";
import {ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";

defineProps({users: Object})
library.add(faSearch)

let search = ref('');


watch(search, value => {
    console.log(value);
    Inertia.get('/users', { search: value }, {
        preserveState: true
    });
})
</script>

<style scoped>

</style>
