<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Skripte verwalten</h3>
                        <div class="card-tools">
                           <button class="btn btn-success" @click="newModal()"> <i class="fas fa-user-plus fa-fw"></i> Skript hochladen</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Titel</th>
                                <th>Semester</th>
								<th>Fach</th>
                                <th>PDF-Name</th>
                                <th>Registriert am</th>
                                <th>Aktion</th>
                            </tr>
                            <tr v-for="uploadPdf in uploadPdfs.data" :key="uploadPdf.id">
                                <td>{{uploadPdf.id}}</td>
                                <td>{{uploadPdf.title}}</td>
                                <td>{{uploadPdf.category}}</td>
								<td>{{uploadPdf.description}}</td>
                                <td>{{uploadPdf.upload_pdf}}</td>
                                <td>{{uploadPdf.created_at | myDate}}</td>
                                <td v-if="$gate.isAdminOrAuthor()">
                                    <a href="javascript:void(0)" @click="editModal(uploadPdf)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    /
                                    <a href="javascript:void(0)" @click="deleteUploadPdf(uploadPdf.id)" v-my-tooltip.bottom-center="'löschen'">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
								<td v-else>
									<a href="javascript:void(0)" @click="editModal(uploadPdf)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
								</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="uploadPdfs" @pagination-change-page="getResults"></pagination>
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
                        <h5 v-show="!editmode" class="modal-title" id="addNewModalLabel">Skript hochladen</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewModalLabel">Skrip aktualisieren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUploadPdf() : createUploadPdf()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input v-model="form.title" type="text" name="title" id="title" placeholder="Titel" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                    <has-error :form="form" field="title"></has-error>
                                    <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.category" type="text" name="category" id="category" placeholder="Semester" class="form-control" :class="{ 'is-invalid': form.errors.has('category') }">
                                    <has-error :form="form" field="category"></has-error>
                                    <div v-if="errors && errors.category" class="text-danger">{{ errors.category[0] }}</div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" name="upload_pdf" accept="application/pdf" class="form-control" :class="{ 'is-invalid': form.errors.has('upload_pdf') }" id="upload_pdf" style="padding-top: 0px; padding-left: 0px">
                                    <has-error :form="form" field="upload_pdf"></has-error>
                                    <div v-if="errors && errors.upload_pdf" class="text-danger">{{ errors.upload_pdf[0] }}</div>
                                </div>
                                <div class="form-group">
                                    <textarea v-model="form.description" type="text" name="description" id="description" placeholder="Fach" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                    <has-error :form="form" field="description"></has-error>
                                    <div v-if="errors && errors.description" class="text-danger">{{ errors.description[0] }}</div>
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
                errors: {},
                editmode:false,
                uploadPdfs:{},
                 form : new Form({
                     id          :'',
                     category    :'',
                     title       :'',
                     description :''
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get(base_path+'/admin_api/uploadPdf?page=' + page)
                    .then(response => {
                        this.uploadPdfs = response.data;
                    });
            },
            newModal(){
                this.errors = {};
                this.editmode=false;
                this.form.reset();
                $('#addNewModal').modal('show');
            },
            editModal(uploadPdf){
                this.errors = {};
                this.editmode=true;
                this.form.reset();
                $('#addNewModal').modal('show');
                this.form.fill(uploadPdf);
            },
            deleteUploadPdf(id){
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
                             this.form.delete(base_path+'/admin_api/uploadPdf/'+id).then(()=>{
                                 swal(
                                     'Gelöscht!',
                                     'Das Skript wurde gelöscht.',
                                     'success'
                                 )
                                 Fire.$emit('AfterDelete')
                             }).catch(()=>{
                                 swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                             })

                         }
                })
            },
            loadUploadPdfs(){

                this.$Progress.start()
//                if(this.$gate.isAdminOrAuthor()) {
                    axios.get(base_path+'/admin_api/uploadPdf').then(({data}) => (this.uploadPdfs = data));
               // }
                this.$Progress.finish()
            },


            createUploadPdf(){
                this.errors = {};
                var formData = new FormData();
                var id=this.form.id;
                var title =$('#title').val();
                var category =$('#category').val();



                var upload_pdf = document.querySelector('#upload_pdf');
                var description = $('#description').val();
                formData.append("id", id);
                formData.append("title", title);
                formData.append("category", category);
                formData.append("upload_pdf", upload_pdf.files[0]);
                formData.append("description", description);
                this.$Progress.start()
                axios.post(base_path+'/admin_api/uploadPdf',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(()=>{
                        Fire.$emit('AfterCreate')
                        $('#addNewModal').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Skript erfolgreich hochgeladen.'
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
         updateUploadPdf(){
             var formData = new FormData();
             var id=this.form.id;
             var title =$('#title').val();
             var category =$('#category').val();
             var upload_pdf = document.querySelector('#upload_pdf');
             var description = $('#description').val();
             formData.append("id", id);
             formData.append("title", title);
             formData.append("category", category);
             formData.append("upload_pdf", upload_pdf.files[0]);
             formData.append("description", description);
             this.$Progress.start()
             axios.post(base_path+'/admin_api/updateUploadPdf',formData,{
                 headers: {
                     'Content-Type': 'multipart/form-data'
                 }
             })
                 .then(()=>{
                     Fire.$emit('AfterCreate')
                     $('#addNewModal').modal('hide');
                     toast({
                         type: 'success',
                         title: 'Skript erfolgreich aktualisiert.'
                     })
                     this.$Progress.finish()
                 })
                 .catch(error=>{
                     if (error.response.status === 422) {
                         this.errors = error.response.data.errors || {};
                     }
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

            this.loadUploadPdfs()
            Fire.$on('AfterCreate',()=>{
                this.loadUploadPdfs()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadUploadPdfs()
            })
        }
    }
</script>
