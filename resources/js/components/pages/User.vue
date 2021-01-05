<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">User</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users List</h3>
                                <div class="card-tools">
                                    <a href="javaScript:void(0)" @click="openUserModal" class="btn btn-success btn-circle"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in users">
                                        <td>1</td>
                                        <td>{{user.name|capitalize }}</td>
                                        <td>{{user.email}}</td>
                                        <td>{{user.contact}}</td>
                                        <td>{{user.created_at}}</td>
                                        <td>
                                            <a href="javaScript:void(0)" @click="deleteUser(user.id)">Delete</a>
                                            <a href="javaScript:void(0)" @click="editUser(user.id)">Edit</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="userModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form @submit.prevent="saveUser" @keydown="form.onKeydown($event)">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{editMode?"Edit":"Add"}} User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" v-model="form.name" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('name') }"
                                       placeholder="Enter name">
                                <has-error :form="form" field="name"></has-error>

                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" v-model="form.email" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('email') }"
                                       placeholder="Enter email">
                                <has-error :form="form" field="email"></has-error>

                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="contact" v-model="form.contact" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('contact') }"
                                       placeholder="Enter contact" maxlength="10">
                                <has-error :form="form" field="contact"></has-error>

                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" v-model="form.password" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('password') }"
                                       placeholder="Password">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="userId" v-model="form.userId">
                            <button type="submit" :disabled="form.busy" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { BASE_URL } from '../../config';
    export default {
        data(){
            return {
                editMode: false,
                users: {},
                form: new Form({
                    name: '',
                    email: '',
                    contact: '',
                    password: '',
                    userId: '',
                })
            }
        },
        mounted() {
            this.loadUsers();
        },
        methods: {
            openUserModal(){
                this.form.reset();
                this.form.clear();
                this.editMode = false;
                $("#userModal").modal('show');
            },
            saveUser() {
                this.form.post(BASE_URL.API_URL+'users/create')
                    .then(({ data }) => {
                        Toast.fire({
                            icon: 'success',
                            title: 'User '+(this.editMode?"updated":"created") +" successfully",
                        });
                        this.form.reset();
                        $("#userModal").modal('hide');
                        this.loadUsers();
                    })
                    .catch(error => {
                        console.error('There was an error!', error);
                    });
            },
            loadUsers(){
                this.$Progress.start();
                axios.get(BASE_URL.API_URL+'users/get',{token:this.$store.state.token}).then((response) => {
                    this.users = response.data.data;
                    this.$Progress.finish();
                })
            },
            editUser(userId){
                this.$Progress.start();
                axios.get(BASE_URL.API_URL+'users/info/'+userId).then((response) => {
                    let user = response.data.data;
                    this.openUserModal();
                    this.editMode = true;
                    this.form.userId = this.userId =  user.id;
                    this.form.name = user.name;
                    this.form.email = user.email;
                    this.form.contact = user.contact;
                    this.$Progress.finish();
                })
                .catch(error => {
                    this.$Progress.fail();
                    console.error('There was an error!', error);
                });
            },
            deleteUser(userId){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post(BASE_URL.API_URL+'users/delete',{
                            userId:userId,
                        }).then((response) => {
                            Toast.fire({
                                icon: 'success',
                                title: 'User deleted successfully'
                            });
                            this.loadUsers();
                        });
                    }
                });
            }
        },
        filters:{
            capitalize: function (value) {
                if (!value) return '';
                value = value.toString();
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        }
    }
</script>
