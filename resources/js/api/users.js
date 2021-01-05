/*
    Imports the Roast API URL from the config.
*/
import { BASE_URL } from '../config';

export default {
    loadUsers:function () {
        this.$Progress.start();
        return axios.get(BASE_URL.API_URL+'users/get',{token:this.$store.state.token}).then((response) => {
            this.users = response.data.data;
            this.$Progress.finish();
        })
    }
}
