import '../css/app.css';
import { createApp } from 'vue';

import { initializeTheme } from './composables/useAppearance';

// import { createVfm } from 'vue-final-modal';
import App from './components/AppShell.vue';
import { TailwindPagination } from 'laravel-vue-pagination';

const app = createApp(App);
/* My Imported Components */
// for later
//const vfm = createVfm()
//app.use(vfm).mount('#app')

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';


// This will set light / dark mode on page load...
initializeTheme();

