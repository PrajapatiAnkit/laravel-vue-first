<script>
    import Navigation from './Navigation';
    import Sidebar from './Sidebar';
    import Footer from './Footer';

    export default {
        components:{
            Navigation,
            Sidebar,
            Footer,
        }
    }
</script>
<template>
    <div class="wrapper">
        <navigation/>
        <sidebar/>
        <div class="content-wrapper">
            <router-view/>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want2
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</template>
