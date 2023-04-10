<template>
    <header>
        <Nav/>
    </header>
    <Side/>
    <div class="p-4 sm:ml-64">
        <div class="p-4 dark:border-gray-700 mt-14">
            <section class="p-6">
                <div class="max-w-3xl mx-auto">
                    <slot/>
<!--                    Welcome back, {{ username }}!-->
                </div>
            </section>
            <ModalsContainer />
        </div>
    </div>
</template>

<script>
import Nav from "../Shared/Nav.vue";
import { ModalsContainer } from 'vue-final-modal'
import 'vue-final-modal/style.css'
import { useDark, useToggle } from '@vueuse/core';
import Side from "../Shared/Side.vue";
import 'flowbite'

export default {
    name: "Layout",
    components: {
        Side,
        Nav,
        ModalsContainer,
    },
    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    },
    setup() {
        const isDark = useDark();
        const toggleDark = useToggle(isDark);

        return {
            isDark,
            toggleDark,
        };
    },
}

</script>

<style scoped>

</style>
