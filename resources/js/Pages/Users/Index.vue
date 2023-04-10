<template>
    <Head title="Users"/>
    <div class="flex justify-between mb-5">
        <h1 class="text-4xl font-bold dark:text-gray-300">Users</h1>
        <div class="flex">
            <div class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" v-model="search"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
                           placeholder="Search" required>
                </div>
            </div>
            <!--            <div class="relative mt-2 rounded-md shadow-sm">-->
            <!--                <input-->
            <!--                    v-model="search"-->
            <!--                    type="text"-->
            <!--                    class="block w-full rounded-md border-0 py-1.5 pl-5 pr-8 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"-->
            <!--                    placeholder="Search...">-->
            <!--                <div class="absolute inset-y-0 right-0 flex items-center">-->
            <!--                    <font-awesome-icon icon="search" class="pl-2 pr-3"/>-->
            <!--                </div>-->
            <!--            </div>-->
            <button @click="openModal(false)"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-5 mr-1">
                Add user
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto overflow-y-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Edit
                </th>
                <th>
                    Delete
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="user in users.data"
                :key="user.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    v-text="user.name">
                </th>
                <td class="px-6 py-4" v-text="user.email">
                </td>
                <td class="px-6 py-4">
                    <button
                        @click="openModal(true, user)" class="font-medium text-blue-600 hover:underline">
                        <font-awesome-icon icon="edit" class="pl-2 pr-3"/>
                    </button>
                </td>
                <td class="px-6 py-4">
                    <button
                        @click="openModalDelete(user)" class="font-medium text-green-700 hover:underline">
                        <font-awesome-icon icon="cannabis" class="pl-2 pr-3"/>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
    <div
        class="w-full flex items-center justify-between border-t border-gray-200 dark:border-gray-800 text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 px-4 py-3 sm:px-6 preserve-scroll">
        <Pagination :links="users.links" :from="users.from" :to="users.to" :total="users.total"
                    :last_page="users.last_page"></Pagination>
    </div>
</template>

<script setup>
import Pagination from "../../Shared/Pagination.vue";
import {library} from "@fortawesome/fontawesome-svg-core";
import {faSearch} from "@fortawesome/free-solid-svg-icons";
import {faEdit} from "@fortawesome/free-solid-svg-icons";
import {faCannabis} from "@fortawesome/free-solid-svg-icons";
import {h, ref, watch} from "vue";
import {router} from '@inertiajs/vue3'
import {ModalsContainer, useModal} from 'vue-final-modal'
import ModalConfirmPlainCss from '../../Shared/ModalConfirmPlainCss.vue'
import AddEditUser from "./AddEditUser.vue";
import DeleteUser from "./DeleteUser.vue";

const {open, close, patchOptions} = useModal({
    component: ModalConfirmPlainCss,
    attrs: {
        onClose() {
            close()
        },
    },
    slots: {
        default: ''
    }
})

function openModal(isEdit, user = null) {
    const attrs = {
        title: isEdit ? 'Edit user' : 'Add user',
    }
    const slots = {
        default: () => {
            // Create a new instance of the AddEditUser component with the `user` prop
            return h(AddEditUser, {user: user, button: 'Save'})
        }
    }
    patchOptions({
        attrs: attrs,
        slots: slots
    })
    open()
}

function openModalDelete(user) {
    const attrs = {
        title: `Delete user`,
        onClose() {
            close()
        },
        onConfirm() {
            function deleteUser(user) {
                router.delete('/users', {user: user}, {
                    preserveState: true,
                    replace: true
                })
            }
        }
    }
    const slots = {
        default: () => {
            return h(DeleteUser, {user: user, button: 'Delete'})
        }
    }
    patchOptions({
        attrs: attrs,
        slots: slots
    })
    open()
}

let props = defineProps({
    users: Object,
    filters: String
})

library.add(faSearch, faEdit, faCannabis)

let search = ref(props.filters);

watch(search, value => {
    router.get('/users', {search: value}, {
        preserveState: true,
        replace: true
    })
})

function deleteUser(user) {
    router.delete('/users', {user: user}, {
        preserveState: true,
        replace: true
    })
}
</script>

<style scoped>

</style>
