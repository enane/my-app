<template>
    <Link :class="{'bg-gray-100 dark:bg-gray-700': active}">
        <slot />
    </Link>
</template>

<script>
export default {
    name: "NavLink",
    props: {
        active: Boolean,

    }
}
</script>

<style scoped>

</style>
