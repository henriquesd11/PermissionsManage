<template>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-sm-2">
                <button type="button" class="btn bg-autogestor" v-on:click="goToCreateUser">Novo Usuário</button>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-autogestor text-center">USUÁRIOS</div>
                    <div class="card-body">
                        <table class="table table-responsive text-center">
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
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button v-if="!user.edit" class="btn btn-warning btn-sm"
                                                    v-on:click="editUser(index)">
                                                <strong>
                                                    Editar
                                                </strong>
                                            </button>
                                            <button v-else class="btn btn-success btn-sm"
                                                    v-on:click="saveUser(index, user.id)">
                                                Salvar
                                            </button>
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                v-on:click="permissionsUser(user, index)"
                                            >
                                                <strong>
                                                    Permissões
                                                </strong>
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                    v-on:click="removeUser(user.id)">
                                                Remover
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <permissions
                            v-if="permissionsShow"
                            :user-id="userInfo.id"
                            :permissions="userInfo.permissions"
                        />
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div v-if="alert" class="alert alert-success" role="alert">
                    <strong>{{ messageResponse }}</strong>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Permissions from "./permission/permissions.vue";

export default {
    name: "users",
    components: {
        Permissions,
    },
    data() {
        return {
            users: [],
            permissionsList: [],
            alert: false,
            messageResponse: '',
            permissionsShow: false,
            userInfo: {},
            currentIndexUser: null,
        }
    },
    mounted() {
        this.getListUsers();
    },
    methods: {
        getListUsers() {
            axios.get('users/list')
                .then((res) => {
                    this.users = res.data.list
                    for (const key in this.users) {
                        this.users[key].edit = false
                    }
                }).catch((e) => {
                alert("Ocorreu um erro inesperado!")
            })
        },
        editUser(key) {
            this.users[key].edit = true
        },
        saveUser(key, userId) {
            this.users[key].edit = false
            axios.put(`users/${userId}`, this.users[key])
                .then((res) => {
                    this.messageResponse = res.data.message
                    this.alert = true
                    setTimeout(this.hideAlert, 3000)
                }).catch((e) => {
                alert("Ocorreu um erro inesperado!")
            })
        },
        removeUser(userId)
        {
            axios.delete(`users/${userId}`)
                .then((res) => {
                    this.getListUsers()
                }).catch((e) => {
                alert("Ocorreu um erro inesperado!")
            })
        },
        hideAlert() {
            this.alert = false;
        },
        permissionsUser(user, index)
        {
            this.userInfo = user
            this.permissionsShow = true
            this.currentIndexUser = index
        },
        goToCreateUser()
        {
            window.location.href = "users/create";
        }
    }
}
</script>

<style scoped>

</style>
