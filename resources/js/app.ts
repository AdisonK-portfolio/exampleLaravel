import '../css/app.css';

/* For non-inertia parts of site and components used in other vue components */
import { createApp } from 'vue';
// import { Bootstrap4Pagination } from 'laravel-vue-pagination';
// import { Bootstrap5Pagination } from 'laravel-vue-pagination';
// import { TailwindPagination } from 'laravel-vue-pagination';

// //import IndexContacts from './pages/IndexContacts.vue';

// const nonInertiaApp = createApp({});
// nonInertiaApp.component("tailwind-pagination", TailwindPagination);

// nonInertiaApp.mount('#app'); //const mountedApp = app.mount('#app');



import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { h } from 'vue';
import { initializeTheme } from './composables/useAppearance';

import { createVfm } from 'vue-final-modal';
import App from './components/AppShell.vue';
import { TailwindPagination } from 'laravel-vue-pagination';

const app = createApp(App);
/* My Imported Components */
const vfm = createVfm()
//app.use(vfm).mount('#app')

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("tailwind-pagination", TailwindPagination)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
