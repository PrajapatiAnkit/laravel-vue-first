import Vue from 'vue';

import VueRouter from "vue-router";
import Home from './components/pages/Home';
import User from './components/pages/User';
import Login from './components/Login';
import App from './components/App'
import Index from './components/Index'

Vue.use(VueRouter);


export default new VueRouter({
    mode:'history',
    routes: [
        {
            path:'/',
            component: Index,
            children:[
                {
                    path: '',
                    component: Login,
                    name:'login'
                },
            ]
        },
        {
            path: '/',
            component: App,
            children: [
                {
                    path:'home',
                    name:'home',
                    component: Home,
                    meta: {
                        authGuard: true
                    },
                },
                {
                    path:'/users',
                    name:'user',
                    component: User,
                    meta: {
                        authGuard: true
                    },
                },
            ]
        },
    ]
});
