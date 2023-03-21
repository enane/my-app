<template>
    <nav>
        <ul class="flex list-none space-x-4 list-inside">
            <li>
                <NavLink href="/" :active="$page.component==='Home'">Home</NavLink>
            </li>
            <li>
                <NavLink href="/users" :active="$page.component==='Users'">Users</NavLink>
            </li>
            <li>
                <NavLink href="/settings" :active="$page.component==='Settings'">Settings</NavLink>
            </li>
            <li>
                <Link href="/logout" method="POST" as="button">Logout</Link>
            </li>
        </ul>
    </nav>
</template>

<script>
import NavLink from "../Shared/NavLink.vue";
export default {
    name: "Nav",
    components: { NavLink }
}
</script>

<style scoped>

</style>
