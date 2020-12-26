<script>
    import Navigation from './layouts/Navigation';
    import Sidebar from './layouts/Sidebar';
    import Footer from './layouts/Footer';

    export default {
        components:{
            Navigation,
            Sidebar,
            Footer,
        },
        methods:{
            toggleBodyClass(action){
                const el = document.body;
                if (action === 'remove'){
                    el.classList.remove("login-page");
                }else{
                    el.classList.add("login-page");
                }
            }
        },
        mounted() {
            this.toggleBodyClass('remove');
        },
        destroyed() {
            this.toggleBodyClass('add');
        },
        watch:{
            active: function () {
                document.body.style.height =  '';
            }
        }
    }
</script>
<template>
    <div class="wrapper">
        <navigation/>
        <sidebar/>
        <div class="content-wrapper">
            <router-view/>
            <vue-progress-bar></vue-progress-bar>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want2
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</template>
