import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";
import AppLayout from "@/shared/AppLayout.vue";
import { ZiggyVue } from "ziggy-js";
import PageTitle from "@/components/PageTitle.vue";
import NavLink from "@/components/NavLink.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./pages/**/*.vue", { eager: true });
        let page = pages[`./pages/${name}.vue`];
        page.default.layout = page.default.layout || AppLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Link", Link)
            .component("Head", Head)
            .component("NavLink", NavLink)
            .component("PageTitle", PageTitle)
            .mount(el);
    },
    title: (title) => (title ? `${title} - CHMS` : "CHMS"),
    progress: {
        color: "#ea580c",
    },
});
