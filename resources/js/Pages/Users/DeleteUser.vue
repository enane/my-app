<template>
        <p class="max-w-md">Are you sure you want to delete user {{user.name}}? You cannot undo this action!</p>
        <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-4 mr-5">
            {{ button }}
        </button>
        <button @click.prevent="emit('close')" class="bg-red-500 hover:bg-red-700 text-white font-bold rounded py-2 px-4">
            Cancel
        </button>
        </div>
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
    (e: 'close'): void,
    (e: 'confirm'): void
}>()

let submit = () => {
    Inertia.delete('/users')
};

</script>

<style scoped>

</style>
