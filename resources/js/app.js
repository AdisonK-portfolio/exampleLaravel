import EditContact from './components/EditContact.vue';
import { createApp } from 'vue';

const app = createApp({});

app.component('edit-contact', EditContact);

// Mount the app to an element in your Blade file
//app.mount('#app');