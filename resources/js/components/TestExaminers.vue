<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Protokolle (Verknüpfung Prüfer-Prüfung) verwalten</h3>
                        <div class="card-tools">
                           <!--<button class="btn btn-success" @click="newModal()"> <i class="fas fa-user-plus fa-fw"></i> Add New</button>-->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Prüfung</th>
                                <th>Prüfer</th>
                                <th>PDF-Name</th>
                                <th>PDF-info</th>
                                <th>Registriert am</th>
                                <th v-if="$gate.isAdminOrAuthor()">Aktion</th>
                            </tr>
                            <tr v-for="testExaminer in testExaminers.data" :key="testExaminer.id">
                                <td>{{testExaminer.id}}</td>
                                <td>{{testExaminer.test.name}}</td>
                                <td>{{testExaminer.examiner.name}}</td>
                                <td>{{testExaminer.pdf }}</td>
                                <td>{{testExaminer.about_pdf }}</td>
                                <td>{{testExaminer.created_at | myDate}}</td>
                                <td v-if="$gate.isAdminOrAuthor()">
                                    <!--<a href="javascript:void(0)" @click="editModal(testExaminer)">-->
                                        <!--<i class="fas fa-edit"></i>-->
                                    <!--</a>-->
                                    <!--/-->
                                    <a href="javascript:void(0)" @click="deleteTestExaminer(testExaminer.id)" v-my-tooltip.bottom-center="'löschen'">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="testExaminers" @pagination-change-page="getResults"></pagination>
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
                        <h5 v-show="!editmode" class="modal-title" id="addNewModalLabel">Add New</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewModalLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateTest() : createTest()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" id="name" placeholder="Enter Name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <select v-model="form.no_of_examiner" name="no_of_examiner" class="form-control" :class="{ 'is-invalid': form.errors.has('no_of_examiner') }" id="no_of_examiner">
                                        <option value="">No of examiner(s)</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    <has-error :form="form" field="no_of_examiner"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea v-model="form.description" type="text" name="description" id="description" placeholder="Enter Description" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
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
                testExaminers:{},
                 form : new Form({
                     id            :'',
                     name          :'',
                     no_of_examiner:'',
                     description   :'',
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                this.$Progress.start()
                axios.get(base_path+'/admin_api/testExaminer?page=' + page)
                    .then(response => {
                        this.testExaminers = response.data;
                        this.$Progress.finish()
                    }).catch(error=>{
                    this.$Progress.fail()
                });
            },
            newModal(){
                this.editmode=false;
                this.form.reset();
                $('#addNewModal').modal('show');
            },
            editModal(testExaminer){
                this.editmode=true;
                this.form.reset();
                $('#addNewModal').modal('show');
                this.form.fill(testExaminer);
            },
            deleteTestExaminer(id){
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
                             this.form.delete(base_path+'/admin_api/testExaminer/'+id).then(()=>{
                                 swal(
									 'Gelöscht!',
                                     'Protokoll wurde gelöscht.',
                                     'success'
                                 )
                                 Fire.$emit('AfterDelete')
                             }).catch(()=>{
                                 swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                             })

                         }
                })
            },
            loadTestExaminers(){

                this.$Progress.start()
//                if(this.$gate.isAdminOrAuthor()) {
                    axios.get(base_path+'/admin_api/testExaminer').then(({data}) => (this.testExaminers = data));
               // }
                this.$Progress.finish()
            },
           createTestExaminer(){
               this.$Progress.start()
               this.form.post(base_path+'/admin_api/testExaminer')
                   .then(()=>{
                       Fire.$emit('AfterCreate')
                       $('#addNewModal').modal('hide');
                       toast({
                           type: 'success',
                           title: 'Protokoll erfolgreich erstellt'
                       })
                       this.$Progress.finish()
                   })
                   .catch(()=>{
                       this.$Progress.fail()
                   })

           },
         updateTestExaminer(){
             this.$Progress.start()
             this.form.put(base_path+'/admin_api/testExaminer/'+this.form.id)
                 .then(()=>{
                     Fire.$emit('AfterCreate')
                     $('#addNewModal').modal('hide');
                     toast({
                         type: 'success',
                         title: 'Protokoll erfolgreich aktualisiert'
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
                axios.get(base_path+'/admin_api/findTestExaminer?q='+ query)
                    .then((data)=>{
                       this.testExaminers = data.data;
                    })
                    .catch(()=>{

                    })
            })


            this.loadTestExaminers()
            Fire.$on('AfterCreate',()=>{
                this.loadTestExaminers()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadTestExaminers()
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
