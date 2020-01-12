<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Benutzer verwalten</h3>
                        <div class="card-tools" v-if="$gate.isAdminOrAuthor()">
                           <button class="btn btn-success" @click="newModal()"> <i class="fas fa-user-plus fa-fw"></i> Neuen Benutzer erstellen</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
								<th>Benutzername</th>
                                <th>E-Mail</th>
                                <th>Typ</th>
								<th>Kreuzmich-Benutzername</th>
                                <th>Freigeschaltet</th>
                                <th>Registriert am</th>
                                <th v-if="$gate.isAdminOrAuthor()">Aktion</th>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
								<td>{{user.username}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type | upText}}</td>
								<td>{{user.bio}}</td>
								<td v-if="user.banned_at">gebanned</td>
                                <td v-else>{{user.manually_verified_at | approvedStatus(user.email_verified_at)}}</td>
                                <td>{{user.created_at | myDate}}</td>
                                <td v-if="$gate.isAdminOrAuthor()">
                                    <a href="javascript:void(0)" @click="editModal(user)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    /
									<a v-if="user.banned_at" href="javascript:void(0)" @click="revokeUser(user.id)" v-my-tooltip.bottom-center="'unban'">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
									<a v-else href="javascript:void(0)" @click="banUser(user.id)" v-my-tooltip.bottom-center="'ban'">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="deleteUser(user.id)" v-my-tooltip.bottom-center="'löschen'">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="approvedUser(user.id)" v-my-tooltip.bottom-center="'freischalten'">
                                        <i class="fas fa-check-square"></i>
                                    </a>
                                </td>
								<td v-else-if="user.manually_verified_at">
									<a href="javascript:void(0)" @click="unapproveUser(user.id)" v-my-tooltip.bottom-center="'Freischaltung zurückziehen'">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
								</td>	
								<td v-else>
									<a href="javascript:void(0)" @click="approvedUser(user.id)" v-my-tooltip.bottom-center="'freischalten'">
                                        <i class="fas fa-check-square"></i>
                                    </a>
								</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="users" :limit=5 @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!--<div v-if="!$gate.isAdminOrAuthor()">-->
            <!--<not-found></not-found>-->
        <!--</div>-->
        <!-- Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addNewModalLabel">Neuer Benutzer erstellen</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewModalLabel">Benutzerangaben aktualisieren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" id="name" placeholder="Vollständiger Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.username" type="text" name="username" id="username" placeholder="Benutzername" class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                                    <has-error :form="form" field="username"></has-error>
                                </div>

                                <div class="form-group">
                                    <input v-model="form.password" v-show="!editmode" type="password" name="password" id="password" placeholder="Passwort" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <!-- <input v-model="form.password" v-show="editmode" type="password" name="password" id="password1" placeholder="Passwort (leer lassen, wenn ungeändert bleiben sollte)" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"> -->
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input v-model="form.email" type="text" name="email" id="email" placeholder="E-Mail-Adresse" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                    <select v-model="form.type" name="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }" id="type">
                                         <option value="">Select User Role</option>
                                         <option value="admin">Admin</option>
                                         <option value="user">User</option>
                                        <option value="moderator">Moderator</option>
                                    </select>
                                    <has-error :form="form" field="type"></has-error>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="form.bio" type="text" name="bio" id="bio" placeholder="Kreuzmich-Benutzername" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                    <has-error :form="form" field="bio"></has-error>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Aktualisieren</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Erstellen</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Modal -->


    </div>
</template>

<script>
    export default {

        data(){
            return {

                editmode:false,
                users:{},
                 form : new Form({
                     id      :'',
                     name    :'',
                     email   :'',
                     username:'',
                     password:'',
                     type    :'',
                     bio     :'',
                     photo   :'',
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get(base_path+'/admin_api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            newModal(){
                this.editmode=false;
                this.form.reset();
                $('#addNewModal').modal('show');
            },
            editModal(user){
                this.editmode=true;
                this.form.reset();
                $('#addNewModal').modal('show');
                this.form.fill(user);
            },
            deleteUser(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Du kannst es nicht rückgängig machen!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, lösche es!'
                }).then((result) => {
                         if (result.value) {
						 
						 console.log(this);
						 
                             axios.delete(base_path+'/admin_api/user/'+id).then(()=>{
                                 swal(
                                     'Gelöscht!',
                                     'Benutzer wurde gelöscht.',
                                     'success'
                                 )
                                 Fire.$emit('AfterDelete')
                             }).catch(()=>{
                                 swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                             })

                         }
                })
            },


            approvedUser(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Du kannst es nicht rückgängig machen!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, schalte den Benutzer frei!'
                }).then((result) => {
                    if (result.value) {
                        axios.get(base_path+'/admin_api/approvedUser/'+id).then(()=>{
                            swal(
                                'Freigeschaltet!',
                                'Benutzer wurde erfolgreich freigeschaltet.',
                                'success'
                            )
                            Fire.$emit('AfterDelete')
                        }).catch(()=>{
                            swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                        })

                    }
                })
            },
			
			unapproveUser(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Dann wird der Benutzer keinen Zugriff mehr auf Protokolle haben!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, ziehe die Freischaltung zurück!'
                }).then((result) => {
                    if (result.value) {
                        axios.get(base_path+'/admin_api/unapproveUser/'+id).then(()=>{
                            swal(
                                'Freischaltung zurückgezogen!',
                                'Der Benutzer ist nicht mehr freigeschaltet.',
                                'success'
                            )
                            Fire.$emit('AfterDelete')
                        }).catch(()=>{
                            swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                        })

                    }
                })
            },

			banUser(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Nur ein Admin kann den Benutzer wieder entsperren!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, sperre den Benutzer!'
                }).then((result) => {
                    if (result.value) {
                        axios.get(base_path+'/admin_api/banUser/'+id).then(()=>{
                            swal(
                                'gebanned!',
                                'Benutzer wurde erfolgreich gesperrt.',
                                'success'
                            )
                            Fire.$emit('AfterDelete')
                        }).catch(()=>{
                            swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                        })

                    }
                })
            },
			
			revokeUser(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Du kannst es schon rückgängig. Ist aber doof",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, entsperre den Benutzer!'
                }).then((result) => {
                    if (result.value) {
                        axios.get(base_path+'/admin_api/revokeUser/'+id).then(()=>{
                            swal(
                                'gebanned!',
                                'Benutzer wurde erfolgreich entgesperrt.',
                                'success'
                            )
                            Fire.$emit('AfterDelete')
                        }).catch(()=>{
                            swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                        })

                    }
                })
            },
			
            loadUsers(){

                this.$Progress.start()
//                if(this.$gate.isAdminOrAuthor()) {
                    axios.get(base_path+'/admin_api/user').then(({data}) => (this.users = data));
             //   }
                this.$Progress.finish()
            },
           createUser(){
               this.$Progress.start()
               this.form.post(base_path+'/admin_api/user')
                   .then(()=>{
                       Fire.$emit('AfterCreate')
                       $('#addNewModal').modal('hide');
                       toast({
                           type: 'success',
                           title: 'Benutzer erfolgreich erstellt'
                       })
                       this.$Progress.finish()
                   })
                   .catch(()=>{
                       this.$Progress.fail()
                   })

           },
         updateUser(){
             this.$Progress.start()
             this.form.put(base_path+'/admin_api/user/'+this.form.id)
                 .then(()=>{
                     Fire.$emit('AfterCreate')
                     $('#addNewModal').modal('hide');
                     toast({
                         type: 'success',
                         title: 'Benutzer erfolgreich aktualisiert'
                     })
                     this.$Progress.finish()
                   })
                 .catch(()=>{
                     this.$Progress.fail()
                 })
          }
        },

        created(){
            Fire.$on('searching',()=>{
                let query=this.$parent.search;
                axios.get(base_path+'/admin_api/findUser?q='+ query)
                    .then((data)=>{
                       this.users = data.data;
                    })
                    .catch(()=>{

                    })
            })


            this.loadUsers()
            Fire.$on('AfterCreate',()=>{
                this.loadUsers()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadUsers()
            })
//              function () {
//
//                    }
           // setInterval(()=>this.loadUsers(), 3000)
        }
//        mounted() {
//            console.log('Component mounted.')
//        }
    }
</script>
