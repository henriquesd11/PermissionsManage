import './bootstrap';
import { createApp } from "vue";


import Login from "./components/login.vue";
import Users from "./components/users/users.vue";
import CreateUser from "./components/users/createUser.vue";


createApp({
    components: {
        Login,
        Users,
        CreateUser
    },
}).mount('#app');

