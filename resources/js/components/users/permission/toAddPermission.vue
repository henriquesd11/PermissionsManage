<template>
    <div class="container">
        <div class="input-group">
            <select class="form-select" v-model="permissionSelected" aria-label="Default select example">
                <option v-for="permission in permissionsList">{{ permission.name }}</option>
            </select>
            <button type="button" class="btn btn-success" v-on:click="addPermission">Adicionar</button>
        </div>
    </div>
</template>

<script>;

export default {
    name: "toAddPermission",
    data() {
        return {
            list: [],
            permissionsList: [],
            permissionSelected: null,
        }
    },
    props: {
        userId: Number,
        permissions: Array
    },
    watch: {
        'permissions': {
            handler: function (val, old) {
                this.permissionsList = this.treatPermissionIfUserAlreadyHad();
            }
        }
    },
    mounted() {
        this.getPermissions()
    },
    methods: {
        getPermissions() {
            axios.get('permissions')
                .then((res) => {
                    this.list = res.data.list
                    this.permissionsList = this.treatPermissionIfUserAlreadyHad();
                }).catch((e) => {
                alert("Ocorreu um erro inesperado!")
            })
        },
        addPermission() {
            if (this.permissionSelected == null) {
                alert("Processo interrompico, é necessário selecionar permissão!");
                return
            }
            axios.put(`users/${this.userId}/permission/${this.permissionSelected}`)
                .then((res) => {
                    this.permissions.push({name: this.permissionSelected});
                    this.permissionSelected = null
                    this.permissionsList = this.treatPermissionIfUserAlreadyHad();
                }).catch((e) => {
                alert("Ocorreu um erro inesperado!")
            })
        },
        treatPermissionIfUserAlreadyHad() {
            let newList = [];
            for (const listKey in this.list) {
                if (this.userPermissionHasPermissionList(this.list[listKey])) {
                    continue;
                }
                newList.push(this.list[listKey])
            }

            return newList
        },
        userPermissionHasPermissionList(permissionByList) {
            let hasPermission = false;
            for (const key in this.permissions) {
                if (permissionByList.name === this.permissions[key].name) {
                    hasPermission = true
                }
            }

            return hasPermission;
        }
    }
}
</script>

<style scoped>

</style>
