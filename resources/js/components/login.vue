<style>
#inputLogin input {
    border:solid 1px #ccc;
    border-radius: 7px;
    width: 100%;
    height: 35px;
}
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 offset-3 my-3" style="border: none">
                <img
                    src="https://autogestor.net/wp-content/uploads/2022/08/logo_autogestor.svg"
                    alt="Logo AutoGestor"
                    width="250"
                >
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-autogestor">
                        LOGIN AUTOGESTOR
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div id="inputLogin">
                                <div class="mb-4 col-md-10 offset-1">
                                    <label for="password">Email</label>
                                    <input type="email" v-model="user.email" placeholder="exemplo@gmail.com" />
                                    <p v-for="val in errors.email" class="text-danger">
                                        {{ val }}
                                    </p>
                                </div>
                                <div class="mb-4 col-md-10 offset-1">
                                    <label for="password">Senha</label>
                                    <input type="password" v-model="user.password" placeholder="********" />
                                    <p v-for="val in errors.password" class="text-danger">
                                        {{ val }}
                                    </p>
                                </div>
                            </div>
                            <button type="button" class="btn btn-block bg-btn-login" v-on:click="doLogin">
                                <strong>ACESSAR</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "login",
    data () {
        return {
            user: {
                email: null,
                password: '',
            },
            errors: {
              email: null,
              password: null,
            }
        }
    },
    methods: {
        doLogin(){
            axios.post('login', this.user)
                .then((data) => {
                window.location.href = 'users';
            }).catch((e) => {
                this.errors.password = null;
                this.errors.email = null;
                let error = e.response.data.errors
                for (const key in error) {
                    if (this.errors.hasOwnProperty(key)) {
                        this.errors[key] = error[key]
                    }
                }
            })
        }
    }
}
</script>
