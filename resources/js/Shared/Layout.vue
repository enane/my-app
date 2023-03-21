<template>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <h1 class="font-bold text-lg">
                <input type="text" value="My App">
            </h1>
            <Nav/>
        </header>
    </section>
    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot/>
            Welcome back, {{ username }}!
        </div>
    </section>
</template>

<script>
import Nav from "../Shared/Nav.vue";
import { library } from '@fortawesome/fontawesome-svg-core'
import { faHatWizard } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export default {
    name: "Layout",
    components: {
        Nav,
    },
    computed: {
        username() {
            return this.$page.props.auth.user.username;
        }
    }
}


</script>

<style scoped>

</style>
