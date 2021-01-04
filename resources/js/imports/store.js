import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    state:{
        token:localStorage.getItem('token') || '',
        loggedInUser : localStorage.getItem("loggedInUser"),
    },
    getters:{
        token: state => {
            return state.token;
        },
        loggedInUser: state => {
            return JSON.parse(state.loggedInUser);
        }
    },
    actions:{
        setToken({commit},token){
            commit('setToken',token);
        },
        clearToken({commit}){
            commit('clearToken');
        },
        setLoggedInUser({commit},user){
            commit('setLoggedInUser',JSON.stringify(user));
        }
    },
    mutations:{
        setToken(state,token){
            state.token = token;
            localStorage.setItem('token',token);
        },
        setLoggedInUser(state,user){
            state.loggedInUser = user;
            localStorage.setItem("loggedInUser",user);
        },
        clearToken(state) {
            state.token = '';
            state.user = '';
            localStorage.removeItem('token');
            localStorage.removeItem('user');
        },
    }
});
