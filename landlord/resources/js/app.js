import './bootstrap';
import '../css/app.css';
import 'aos/dist/aos.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createI18n } from 'vue-i18n';
import { defaultLocale, languages } from './i18n';

const i18n = createI18n({
    locale: defaultLocale,
    fallbackLocale: defaultLocale,
    messages: Object.assign(languages),
    legacy: false
});

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'sightcms';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(i18n)
            .mount(el);
    },
    progress: {
        color: '#37B779',
    },
});
