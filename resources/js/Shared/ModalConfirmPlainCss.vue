<template>
        <VueFinalModal
            class="confirm-modal"
            content-class="confirm-modal-content"
            overlay-transition="vfm-fade"
            content-transition="vfm-fade"
            content-style="padding: 0"
        >
            <div class="dark:text-gray-100 dark:bg-gray-900 p-5 rounded">
                <div class="flex justify-between mb-5">
                    <h1>{{ title }}</h1>
                    <p>
                        <button @click="emit('close')">
                            <font-awesome-icon icon="xmark" class="pl-2 pr-3"/>
                        </button>
                    </p>
                </div>
                <slot :emit="emit"/>
            </div>
        </VueFinalModal>
</template>
<script setup lang="ts">
import {VueFinalModal} from 'vue-final-modal'
import {faXmark} from "@fortawesome/free-solid-svg-icons";
import {library} from "@fortawesome/fontawesome-svg-core";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps<{
    title?: string,
}>()

library.add(faXmark)

const emit = defineEmits<{
    (e: 'close'): void,
    (e: 'confirm'): void
}>()

</script>
<style>
.confirm-modal {
    display: flex;
    justify-content: center;
    align-items: center;
}

.confirm-modal-content {
    display: flex;
    flex-direction: column;
    padding: 1rem;
    background: #fff;
    border-radius: 0.5rem;
}

.confirm-modal-content > * + * {
    margin: 0.5rem 0;
}

.confirm-modal-content h1 {
    font-size: 1.375rem;
}

/*.confirm-modal-content button {*/
/*    margin: 0.25rem 0 0 auto;*/
/*}*/

.dark .confirm-modal-content {
    background: #000;
}
</style>
