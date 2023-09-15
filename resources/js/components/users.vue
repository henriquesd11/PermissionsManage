<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-autogestor text-center">USUÁRIOS</div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Permissões</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm">Ver</button>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-block">Salvar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "users",
    data () {
        return {
            users: [],
            permissions: [],
        }
    },
    mounted() {
        this.getListUsers();
        this.getPermissions();
    },
    methods: {
        getListUsers()
        {
            axios.get('users/list')
                .then((res) => {
                    this.users = res.data.list
                    console.log(res.data.list)
                }).catch((e) => {
                    console.log(e);
            })
        },
        getPermissions()
        {
            axios.get('permissions')
                .then((res) => {
                    this.permissions = res.data.list
                }).catch((e) => {
                    console.log(e)
            })
        }
    }
}
</script>

<style scoped>

</style>
