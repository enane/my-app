<template>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{ from }}</span>
                to
                <span class="font-medium">{{ to }}</span>
                of
                <span class="font-medium">{{ total }}</span>
                results
            </p>
        </div>
        <div>
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <Component
                    :is="link.url ? 'Link' : 'span'"
                    v-for="link in links"
                    :href="link.url"
                    v-html="link.label"
                    aria-current="page"
                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold"
                    :class="[link.url ? 'text-gray-900' : 'text-gray-500 cursor-default', link.active ? 'z-10 bg-indigo-600 text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0']"
                    preserve-scroll>
                </Component>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array,
        from: Number,
        to: Number,
        total: Number,
    }
}
</script>

<style scoped>

</style>
