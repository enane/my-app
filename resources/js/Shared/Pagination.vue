<template>
    <div class="md:flex md:flex-1 md:items-center md:justify-between mt-2 mb-2">
        <div class="">
            <p class="text-sm text-gray-700 dark:text-gray-300">
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

            <nav aria-label="Page navigation example w-fit">
                <ul class="inline-flex items-center -space-x-px">
                    <li v-for="link in links">
                        <Component
                            :is="link.url ? 'Link' : 'span'"
                            :href="link.url"
                            v-html="link.label"
                            aria-current="page"
                            class="px-3 py-2 leading-tight border"
                            :class="[
                                link.url ? 'text-gray-900' : 'text-gray-500 cursor-default',
                                link.label.includes('Previous') ? 'rounded-l-lg' : '',
                                link.label.includes('Next') ? 'rounded-r-lg' : '',
                                link.active ? 'z-10 text-blue-600 border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white  ' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white']"
                            preserve-scroll>
                        </Component>
                    </li>
                </ul>
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
        last_page: Number,
    }
}
</script>

<style scoped>

</style>
