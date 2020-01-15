<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Prüfungen verwalten</h3>
                        <div class="card-tools" v-if="$gate.isAdminOrAuthor()">
                           <button class="btn btn-success" @click="newModal()"> <i class="fas fa-user-plus fa-fw"></i> Neue Prüfung erstellen</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
					<div class="card-body">
						<p>Die Protokolle MÜSSEN unbedingt auf pdf version 1.4 (Adobe 5.0) geändert werden, bevor man sie hochlädt!!!<br>
							Das kann man entweder mit Adobe Acrobat (aber nicht reader) oder mit einem online Tool machen.<br>
							Z.B. <a href="https://docupub.de/pdfconvert/">https://docupub.de/pdfconvert/"</a>
						</p>
						<p>VORSICHT! unbedingt darauf achten, dass der Name der Datei noch nicht gibt. z.B. Müller_Innere_M3.pdf<br>
							Wenn noch einer Müller gibt, muss man die Datei anders bennen. z.B. Müller_Vorname_Innere_M3.pdf<br>
							Sonst wird die erste Datei für den anderen ungültig gelöscht!
						</p>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
								<th>Position</th>
                                <th>Prüfung</th>
                                <!-- <th>Beschreibung</th> !-->
                                <th>Anzahl der Prüfer</th>
                                <th>Aktion</th>
                            </tr>
                            <tr v-for="test in tests.data" :key="test.id">
                                <td>{{test.id}}</td>
								<td>{{test.position}}</td>
                                <td>{{test.name}}</td>
                                <!-- <td>{{test.description}}</td> !-->
                                <td>{{test.no_of_examiner }}</td>
                                <td v-if="$gate.isAdminOrAuthor()">
                                    <a href="javascript:void(0)" @click="editModal(test)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="deleteTest(test.id)" v-my-tooltip.bottom-center="'löschen'">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="assignModal(test)" v-my-tooltip.bottom-center="'Protokoll hochladen'">
                                        <i class="fas fa-share"></i>
                                    </a>
                                </td>
								<td v-else>
									<a href="javascript:void(0)" @click="editModal(test)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="assignModal(test)" v-my-tooltip.bottom-center="'Protokoll hochladen'">
                                        <i class="fas fa-share"></i>
                                    </a>
								</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="tests" :limit=5 @pagination-change-page="getResults"></pagination>
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
                        <h5 v-show="!editmode" class="modal-title" id="addNewModalLabel">Neue Prüfung erstellen</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewModalLabel">Prüfungsangaben aktualisieren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateTest() : createTest()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input v-model="form.name" type="text" name="name" id="name" placeholder="Prüfungsname" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <select v-model="form.no_of_examiner" name="no_of_examiner" class="form-control" :class="{ 'is-invalid': form.errors.has('no_of_examiner') }" id="no_of_examiner">
                                        <option value="">Anzahl der Prüfer</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
										<!--
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
										!-->
                                    </select>
                                    <has-error :form="form" field="no_of_examiner"></has-error>
                                </div>
								<div class="form-group">
                                    <input type="number" v-model="form.position" name="position" class="form-control" :class="{ 'is-invalid': form.errors.has('position') }" id="position">
                                    <has-error :form="form" field="position"></has-error>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea v-model="form.description" type="text" name="description" id="description" placeholder="Beschreibung" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
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


        <!-- Modal -->
        <div class="modal fade" id="assignNewModal" tabindex="-1" role="dialog" aria-labelledby="assignNewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createAssignExaminerTest()" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select v-model="form.examiner_id" name="examiner_id"  class="form-control" :class="{ 'is-invalid': form.errors.has('examiner_id') }" id="examiner_id">
                                            <option value="" disabled>Prüfer auswählen</option>
                                            <option v-for="examiner in examiners" :value="examiner.id">
                                                {{ examiner.name }}
                                            </option>
                                        </select>
                                        <has-error :form="form" field="examiner_id"></has-error>
                                        <div v-if="errors && errors.examiner_id" class="text-danger">{{ errors.examiner_id[0] }}</div>
                                    </div>


                                    <div class="form-group">
                                            <input type="file" name="pdf" accept="application/pdf" class="form-control" :class="{ 'is-invalid': form.errors.has('pdf') }" id="pdf" style="padding-top: 0px; padding-left: 0px">
                                        <has-error :form="form" field="pdf"></has-error>
                                        <div v-if="errors && errors.pdf" class="text-danger">{{ errors.pdf[0] }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea v-model="form.about_pdf" type="text" name="about_pdf" id="about_pdf" placeholder="PDF-Info" class="form-control" :class="{ 'is-invalid': form.errors.has('about_pdf') }"></textarea>
                                        <has-error :form="form" field="about_pdf"></has-error>
                                        <div v-if="errors && errors.about_pdf" class="text-danger">{{ errors.about_pdf[0] }}</div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">Erstellen</button>
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
                errors: {},
                examiners:[],
                editmode:false,
                tests:{},
                 form : new Form({
                     id            :'',
					 position      :'',
                     name          :'',
                     no_of_examiner:'',
                     description   :'',
                     examiner_id   :'',
                     about_pdf     :'',
                     pdf           :'',
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get(base_path+'/admin_api/test?page=' + page)
                    .then(response => {
                        this.tests = response.data;
                    });
            },
            newModal(){
                this.editmode=false;
                this.form.reset();
                $('#addNewModal').modal('show');
            },
            editModal(test){
                this.editmode=true;
                this.form.reset();
                $('#addNewModal').modal('show');
                this.form.fill(test);
            },

            assignModal(test){
                this.form.reset();
                $('#assignNewModal').modal('show');
                this.form.fill(test);
            },

            deleteTest(id){
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
                             this.form.delete(base_path+'/admin_api/test/'+id).then(()=>{
                                 swal(
                                     'Gelöscht!',
                                     'Prüfung wurde gelöscht.',
                                     'success'
                                 )
                                 Fire.$emit('AfterDelete')
                             }).catch(()=>{
                                 swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                             })

                         }
                })
            },

            loadTests(){

                this.$Progress.start()
//                if(this.$gate.isAdminOrAuthor()) {
                    axios.get(base_path+'/admin_api/test').then(({data}) => (this.tests = data));
               // }
                this.$Progress.finish()
            },
           createTest(){
               this.$Progress.start()
               this.form.post(base_path+'/admin_api/test')
                   .then(()=>{
                       Fire.$emit('AfterCreate')
                       $('#addNewModal').modal('hide');
                       toast({
                           type: 'success',
                           title: 'Prüfung erfolgreich erstellt'
                       })
                       this.$Progress.finish()
                   })
                   .catch(()=>{
                       this.$Progress.fail()
                   })

           },
         updateTest(){
             this.$Progress.start()
             this.form.put(base_path+'/admin_api/test/'+this.form.id)
                 .then(()=>{
                     Fire.$emit('AfterCreate')
                     $('#addNewModal').modal('hide');
                     toast({
                         type: 'success',
                         title: 'Prüfung erfolgreich aktualisiert'
                     })
                     this.$Progress.finish()
                   })
                 .catch(()=>{
                     this.$Progress.fail()
                 })
          },
            createAssignExaminerTest(){
                this.errors = {};
                var formData = new FormData();
                var test_id=this.form.id;
                var examiner_id = $('#examiner_id').val();
                var pdf = document.querySelector('#pdf');
                var about_pdf = $('#about_pdf').val();
                formData.append("test_id", test_id);
                formData.append("examiner_id", examiner_id);
                formData.append("pdf", pdf.files[0]);
                formData.append("about_pdf", about_pdf);
                this.$Progress.start()
                axios.post(base_path+'/admin_api/testExaminer',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(()=>{
                        Fire.$emit('AfterCreate')
                        $('#assignNewModal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Protokoll für Prüfer-Prüfung erfolgreich erstellt'
                        })
                        this.$Progress.finish()
                    })
                    .catch(error=>{
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                        this.$Progress.fail()
                    })

            },
            loadExaminers(){
                axios.get(base_path+'/admin_api/examiners')
                    .then(response => this.examiners = response.data)
                    .catch(error=>console.log(error));
            }







        },



        created(){
            Fire.$on('searching',()=>{
                let query=this.$parent.search;
                axios.get(base_path+'/admin_api/findTest?q='+ query)
                    .then((data)=>{
                       this.tests = data.data;
                    })
                    .catch(()=>{

                    })
            })

           this.loadExaminers();
            this.loadTests()
            Fire.$on('AfterCreate',()=>{
                this.loadTests()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadTests()
            })
        },
//        mounted() {
//            this.loadCategories();
//        }
    }
</script>
