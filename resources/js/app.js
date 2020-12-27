
require('./bootstrap');

// window.Vue = require('vue');

import router from './router';
import Index from './components/Index';
import Vue from 'vue';
import store from './store';
import progressbar from './progressbar';
import sweetAlert from './sweet-alert';
import VForm from './VForm';


/**
 * Protencting public access
 */
router.beforeEach((to, from, next) => {
    if (to.fullPath !== '/') {
        if (!store.getters.token) {
            next('/');
        }
    }
    next();
});

const app = new Vue({
    el:'#main',
    components:{Index},
    router,
    store,
    sweetAlert,
    progressbar,
    VForm
});

