import { createApp, h } from 'vue'
import {createInertiaApp, Link, Head} from '@inertiajs/vue3'
import Layout from "./Shared/Layout.vue";
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import { createVfm } from 'vue-final-modal'
import 'flowbite';
const vfm = createVfm()

createInertiaApp({
    progress: {
        // The delay after which the progress bar will appear
        // during navigation, in milliseconds.
        delay: 250,

        // The color of the progress bar.
        color: "red",

        // Whether to include the default NProgress styles.
        includeCSS: true,

        // Whether the NProgress spinner will be shown.
        showSpinner: true,
    },
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue', { eager: false }))
        .then((module) => {
            let page = module;
            page.default.layout = page.default.layout || Layout
            return page;
        }),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Head', Head)
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(vfm)
            .mount(el)
    },
    title: title => `My App | ${title}`
})
