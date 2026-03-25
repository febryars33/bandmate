import 'bootstrap';
import '@lottiefiles/dotlottie-wc';
import { createInertiaApp } from '@inertiajs/vue3';
import {createBootstrap} from 'bootstrap-vue-next/plugins/createBootstrap'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createApp, h } from 'vue';

// import '../scss/app.scss';
import DefaultLayout from './layouts/default.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => {
        const page = resolvePageComponent(`./pages/${name}.vue`, import.meta.glob("./pages/**/*.vue"));

        page.then((module) => {
            module.default.layout = module.default.layout || DefaultLayout;
        });

        document.getElementById('app')?.classList.add('d-flex', 'flex-column', 'min-vh-100')

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin, createBootstrap())
            .mount(el);
    },
    progress: false
    // progress: {
    //     color: '#F63049',
    // },
});
