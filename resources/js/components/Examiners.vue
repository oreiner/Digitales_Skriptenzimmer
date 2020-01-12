<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Prüfer verwalten</h3>
                        <div class="card-tools">
                           <button class="btn btn-success" @click="newModal()"> <i class="fas fa-user-plus fa-fw"></i> Neuen Prüfer erstellen</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Fach</th>
                                <!-- <th>Registered At</th> !-->
                                <th>Aktion</th>
                            </tr>
                            <tr v-for="examiner in examiners.data" :key="examiner.id">
                                <td>{{examiner.id}}</td>
                                <td>{{examiner.name}}</td>
                                <td>{{examiner.description}}</td>
                                <!-- <td>{{examiner.created_at | myDate}}</td> !-->
                                <td v-if="$gate.isAdminOrAuthor()">
									<a href="javascript:void(0)" @click="editModal(examiner)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="deleteExaminer(examiner.id)" v-my-tooltip.bottom-center="'Delete'">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
								<td v-else>
									<a href="javascript:void(0)" @click="editModal(examiner)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>							
								</td>
                                    
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="examiners" :limit=5 @pagination-change-page="getResults"></pagination>
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
                        <h5 v-show="!editmode" class="modal-title" id="addNewModalLabel">Neuer Prüfer erstellen</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewModalLabel">Prüferangaben aktualisieren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateExaminer() : createExaminer()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" id="name" placeholder="Prüfername" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea v-model="form.description" type="text" name="description" id="description" placeholder="Fach" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                    <has-error :form="form" field="description"></has-error>
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
                examiners:{},
                 form : new Form({
                     id          :'',
                     name        :'',
                     description :''
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get(base_path+'/admin_api/examiner?page=' + page)
                    .then(response => {
                        this.examiners = response.data;
                    });
            },
            newModal(){
                this.editmode=false;
                this.form.reset();
                $('#addNewModal').modal('show');
            },
            editModal(examiner){
                this.editmode=true;
                this.form.reset();
                $('#addNewModal').modal('show');
                this.form.fill(examiner);
            },
            deleteExaminer(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Du kannst es nicht rückgängig machen!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                         if (result.value) {
                             this.form.delete(base_path+'/admin_api/examiner/'+id).then(()=>{
                                 swal(
                                     'Gelöscht!',
                                     'Prüfer wurde gelöscht.',
                                     'success'
                                 )
                                 Fire.$emit('AfterDelete')
                             }).catch(()=>{
                                 swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                             })

                         }
                })
            },
            loadExaminers(){

                this.$Progress.start()
//                if(this.$gate.isAdminOrAuthor()) {
                    axios.get(base_path+'/admin_api/examiner').then(({data}) => (this.examiners = data));
             //   }
                this.$Progress.finish()
            },
           createExaminer(){
               this.$Progress.start()
               this.form.post(base_path+'/admin_api/examiner')
                   .then(()=>{
                       Fire.$emit('AfterCreate')
                       $('#addNewModal').modal('hide');
                       toast({
                           type: 'success',
                           title: 'Prüfer wurde erstellt'
                       })
                       this.$Progress.finish()
                   })
                   .catch(()=>{
                       this.$Progress.fail()
                   })

           },
         updateExaminer(){
             this.$Progress.start()
             this.form.put(base_path+'/admin_api/examiner/'+this.form.id)
                 .then(()=>{
                     Fire.$emit('AfterCreate')
                     $('#addNewModal').modal('hide');
                     toast({
                         type: 'success',
                         title: 'Prüfer erfolgreich aktualisiert'
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
                axios.get(base_path+'/admin_api/findExaminer?q='+ query)
                    .then((data)=>{
                       this.examiners = data.data;
                    })
                    .catch(()=>{

                    })
            })


            this.loadExaminers()
            Fire.$on('AfterCreate',()=>{
                this.loadExaminers()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadExaminers()
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
