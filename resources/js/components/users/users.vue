<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-autogestor text-center">USUÁRIOS</div>
                    <div class="card-body">
                        <table class="table table-responsive text-start">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(user, index) in users">
                                <td v-if="!user.edit">
                                    <input type="text" class="form-control" v-model="user.name" disabled>
                                </td>
                                <td v-else>
                                    <input type="text" class="form-control" v-model="user.name">
                                </td>
                                <td v-if="!user.edit">
                                    <input type="email" class="form-control" v-model="user.email" disabled>
                                </td>
                                <td v-else>
                                    <input type="email" class="form-control" v-model="user.email">
                                </td>
                                <td>
                                    <button v-if="!user.edit" class="btn btn-warning btn-sm" v-on:click="editUser(index)">
                                        <strong>
                                            Editar
                                        </strong>
                                    </button>
                                    <button v-else class="btn btn-success btn-sm" v-on:click="saveUser(index)">
                                        Salvar
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <permissions/>
</template>

<script>

import Permissions from "./permissions.vue";

export default {
    name: "users",
    components: {
        Permissions,
    },
    data () {
        return {
            users: [],
            permissionsList: [],
        }
    },
    mounted() {
        this.getListUsers();
    },
    methods: {
        getListUsers()
        {
            axios.get('users/list')
                .then((res) => {
                    this.users = res.data.list
                    for (const key in this.users) {
                        this.users[key].edit = false
                    }
                    this.users.set()
                }).catch((e) => {
                    console.log(e);
            })
        },
        editUser(key)
        {
            this.users[key].edit = true
        },
        saveUser(key)
        {
            this.users[key].edit = false
        }
        // getPermissions()
        // {
        //     axios.get('permissions')
        //         .then((res) => {
        //             this.permissionsList = res.data.list
        //         }).catch((e) => {
        //             console.log(e)
        //     })
        // },
    }
}
</script>

<style scoped>

</style>
