import {AlertError, Form, HasError} from 'vform';
import Vue from "vue";

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
export default class VForm {
}
