
require('./bootstrap');

// window.Vue = require('vue');

import router from './router';
import Index from './components/Index';
import Vue from 'vue';
import store from './imports/store';
import progressbar from './imports/progressbar';
import sweetAlert from './imports/sweet-alert';
import VForm from './imports/VForm';


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

console.log("environment - "+ process.env.MIX_APP_ENV);
