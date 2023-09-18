<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-autogestor text-center">CRIAR USUÁRIO</div>
                    <div class="card-body">
                        <label for="name">Nome</label>
                        <input v-model="user.name" id="name" type="text" class="form-control" placeholder="Ex: Maria Aparecida">
                        <p v-for="val in errors.name" class="text-danger">
                            {{ val }}
                        </p>
                        <label for="email">E-mail</label>
                        <input v-model="user.email" type="email" id="email" class="form-control" placeholder="Ex: maria.p@gmail.com">
                        <p v-for="val in errors.email" class="text-danger">
                            {{ val }}
                        </p>
                        <label for="password">Senha</label>
                        <input v-model="user.password" type="password" id="password" class="form-control" placeholder="************">
                        <p v-for="val in errors.password" class="text-danger">
                            {{ val }}
                        </p>
                        <div class="col-sm-6 offset-3 text-center mt-3">
                            <button type="button" class="btn bg-autogestor" v-on:click="create">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "createUser",
    data() {
        return {
            user: {
                name: null,
                email: null,
                password: null,
            },
            errors: {}
        }
    },
    methods: {
        create() {
            axios.post('store', this.user)
                .then((res) => {
                    this.errors = {}
                    setTimeout(history.back(), 3000)
                    console.log(res)
                }).catch((e) => {
                console.log(e)
                this.errors = {}
                let error = e.response.data.errors
                for (const key in error) {
                    this.errors[key] = error[key]
                }

                console.log(error)
                console.log(this.errors)
            })
        }
    }

}
</script>

<style scoped>

</style>
