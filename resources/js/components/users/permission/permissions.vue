<template>
    <div class="card">
        <div class="card-header bg-autogestor text-center">
            Lista de Permissões
        </div>
        <div class="card-body">
            <div
                v-if="permissions.length <= 0"
                class="alert alert-warning text-center">
                Usuário não tem permissões configuradas!
                <div class="col-sm-6 offset-3">
                    <to-add-permission
                        :user-id="userId"
                        :permissions="permissions"
                    />
                </div>
            </div>
            <div v-if="permissions.length > 0">
                <to-add-permission
                    :user-id="userId"
                    :permissions="permissions"
                />
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(permission, index) in permissions">
                        <td>{{ permission.name }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                v-on:click="removePermission(index, permission)"
                            >
                                Remover
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

import ToAddPermission from "@/js/components/users/permission/toAddPermission.vue";

export default {
    name: "permissions",
    components: {ToAddPermission},
    data() {
        return {
        }
    },
    props: {
        userId: Number,
        permissions: Array,
    },
    methods: {
        removePermission(key, permission) {
            this.permissions.splice(key, 1)
            this.remove(permission)
        },
        remove(permission) {
            axios.delete(`users/${this.userId}/permission/${permission.name}`)
                .then((res) => {
                }).catch((e) => {
                alert("Ocorreu um erro inesperado!")
            })
        },
    }
}
</script>

<style scoped>

</style>
