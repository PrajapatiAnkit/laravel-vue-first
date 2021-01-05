<template>
    <div class="login-box">
        <div class="login-logo">
            <a href="javaScript:void(0);"><b>Lara </b>Vue</a>
        </div>
        <div class="card">
            <div class="alert alert-danger" v-if="loginFailed">
                Login Failed, Please try again !
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form @submit.prevent="login()">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" v-model="credentials.email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" v-model="credentials.password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary d-none">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="#">I forgot my password</a>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                credentials:{
                    email:"",
                    password:"",
                },
                loginFailed:false,
            }
        },
        mounted(){
            if (this.$store.state.token !== ''){
                axios.post('/api/checktoken',{ token:this.$store.state.token })
                    .then(response => {
                        if (response){
                            this.$router.push("/home").catch(()=>{});
                        }
                    })
                    .catch(res => {
                        this.$store.commit('clearToken')
                    })
            }else{
                console.log("token not found");
            }
        },
        methods:{
            login(){
                this.$Progress.start();
                let endPoint = `http://codingbirdsonline.com/work/lara-vue/public`;
               axios.post(`${endPoint}/api/login`,this.credentials)
                .then(response => {
                    if (response.data.success){
                        this.$store.commit('setToken',response.data.access_token);
                        //this.$store.commit('setUser',response.data.user);
                        this.$store.dispatch('setLoggedInUser',response.data.user);
                        this.$Progress.finish();
                        this.loginFailed = false;
                        this.$router.push("/home");
                    }
                })
                .catch(error => {
                    console.log(error);
                    this.loginFailed = true;
                    this.$Progress.finish();
                })
            }
        }
    }
</script>
