import VueProgressBar from 'vue-progressbar';
import Vue from "vue";
const options = {
    color: '#16eab7',
    failedColor: '#e32c43',
    thickness: '3px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};
Vue.use(VueProgressBar, options);
export default class progressbar {
}
