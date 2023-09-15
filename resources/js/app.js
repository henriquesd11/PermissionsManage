import './bootstrap';
import { createApp } from "vue";


import Login from "./components/login.vue";
import Users from "./components/users/users.vue";


createApp({
    components: {
        Login,
        Users,
    },
}).mount('#app');

