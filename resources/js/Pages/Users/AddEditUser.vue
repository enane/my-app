<template>
    <form @submit.prevent="submit " class="w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-300" for="grid-name">
                    Name
                </label>
                <input
                    v-model="form.name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
                    id="grid-name"
                    type="text"
                    name="name"
                    placeholder="Name">
                <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-300"
                       for="grid-password">
                    Password
                </label>
                <input
                    v-model="form.password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
                    id="grid-password"
                    type="password"
                    name="password"
                    placeholder="**************"
                    autocomplete="new-password"
                >
                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
            </div>

        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block  tracking-wide text-gray-700 text-xs font-bold mb-2 dark:text-gray-300" for="grid-email">
                    Email
                </label>
                <input
                    v-model="form.email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500"
                    id="grid-email"
                    type="text"
                    name="email"
                    placeholder="Email">
            </div>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-4">
            {{ button }}
        </button>
    </form>
</template>

<script setup lang="ts">
import {VueFinalModal} from 'vue-final-modal'
import {faXmark} from "@fortawesome/free-solid-svg-icons";
import {library} from "@fortawesome/fontawesome-svg-core";
import {Inertia} from "@inertiajs/inertia";
import {router} from "@inertiajs/vue3";

let props = defineProps<{
    title?: string,
    button?: string,
    user?: Object
}>()

library.add(faXmark)

const emit = defineEmits<{
    (e: 'confirm'): void
}>()

let form = {
    name: props.user ? props.user.name : '',
    email: props.user ? props.user.email : '',
    password: props.user ? props.user.password : ''
};

let submit = () => {
    props.user ?
        router.post(`/users/${props.user.id}`, form, {
            preserveState: true,
            // resetOnSuccess: false,
        })
        // Inertia.post(`/users/${props.user.id}`, form)
        :
        router.post('/users/store', form)

};
</script>

<style scoped>

</style>
