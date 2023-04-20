import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Layout from '@/Layouts/Layout.vue';
import HeadMeta from '@/Components/HeadMeta.vue';

// const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'sightcms';
const appColor = window.document.head.querySelector('meta[name=theme-color]')?.attributes['content'].value || '#22b573';

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('Layout', Layout)
            .component('HeadMeta', HeadMeta)
            .mount(el);
    },
});

InertiaProgress.init({ color: appColor });
