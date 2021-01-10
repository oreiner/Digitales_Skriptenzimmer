<template>
    <div class="container">
	
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Empfangene Protokolle verwalten</h3>
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
                                <th>Benutzer</th>
								<th>Benutzername</th>
                                <th>Prüfung</th>
                                <th>Semester</th>
                                <th>Zusätzliche Informationen</th>
                                <th>Note</th>
                                <th>Protokoll zurückgegeben?</th>
                                <th>Abgegebenes Protokoll</th>
								<th>Aktualisiert am</th>
                            </tr>

                            <tr v-for="userToTest in userToTests.data" :key="userToTest.id">
                                <td>{{userToTest.id}}</td>
								<td>{{userToTest.user.username}}</td>
                                <td>{{userToTest.user.name}}</td>
                                <td>{{userToTest.test.name}}</td>
                                <td>{{userToTest.semester_session}}</td>
                                <td>{{userToTest.extra_information}}</td>
                                <td>{{userToTest.grade}}</td>
                                <td>{{userToTest.feedback_status | feedbackStatus }}</td>
                                <td>
                                    <a href="javascript:void(0)" @click="testDetailByUser(userToTest.id, parseInt(userToTest.feedback_status), userToTest.test_id)" v-my-tooltip.bottom-center="'Info'">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <span v-show="userToTest.feedback_status==0">/</span>
                                    <a v-show="userToTest.feedback_status==0" href="javascript:void(0)" @click="unlockUser(userToTest.id)" v-my-tooltip.bottom-center="'freischalten'">
                                        <i class="fas fa-unlock-alt"></i>
                                    </a>
                                    <!--<a href="javascript:void(0)" @click="deleteTestExaminer(userToTest.id)">-->
                                        <!--<i class="fas fa-trash"></i>-->
                                    <!--</a>-->
                                </td>
								<td>{{userToTest.updated_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="userToTests" :limit=5 @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!--<div v-if="!$gate.isAdminOrAuthor()">-->
            <!--<not-found></not-found>-->
        <!--</div>-->
        <!-- Modal Change Examiners / Delete Protocols -->
        <div class="modal fade" id="userTestDetail" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
						<h5 v-show="!feedbackstatus" class="modal-title" id="addNewModalLabel">Ausstehende Protokolle</h5>
                        <h5 v-show="feedbackstatus" class="modal-title" id="editNewModalLabel">Abgegebene Protokolle</h5>	
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent=" changeExaminer()" enctype="multipart/form-data" name="mailPdfForm">
						<!-- ausstehende Protokolle !-->
						<div class="modal-body" v-if="!feedbackstatus">
							<div class="row">
								<div class="card-body table-responsive p-0">
									<table class="table table-hover">
										<tbody>
											<div class="form-group">	
												<tr>
													<th >ID</th>
													<th >Prüfer</th>
												</tr>
												<tr v-for="(mailPdf,i) in mailPdfs" :key="mailPdf.id">
													<td>{{mailPdf.id}}</td>
													<td>
														<select v-model="form.examiner_id[i]" name="examiner_id[i]"  class="form-control" :class="{ 'is-invalid': form.errors.has('examiner_id') }" id="examiner_id" :value="mailPdf.examiner.id">
														<!--<select name="examiner_id"  class="form-control" id="examiner_id"> debugger !-->
															<option value="" disabled>Prüfer auswählen</option>
															<option :value="mailPdf.examiner.id">{{mailPdf.examiner.name}} - aktueller Prüfer</option>
															<option v-for="testExaminer in filteredTestExaminer" :value="testExaminer.examiner.id">
																{{ testExaminer.examiner.name }}
															</option> 
															<has-error :form="form" field="examiner_id"></has-error>
															<div v-if="errors && errors.examiner_id" class="text-danger">{{ errors.examiner_id[0] }}</div>
														</select> 
													</td>
												</tr>
											</div>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- abgegebene Protokolle einsehen bzw. löschen !-->
						<div class="modal-body"  v-else-if="feedbackstatus">
							<div class="row">
								<div class="card-body table-responsive p-0">
									<table class="table table-hover">
										<tbody>
										<tr>
											<th>ID</th>
											<th>Prüfer</th>
											<th>Protokoll</th>
											<th>Fragen</th>
											<th>Antworten</th>
											<th>Tipps</th>
											<th v-if="$gate.isAdminOrAuthor()">Löschen</th>
										</tr>
										<tr v-for="mailPdf in mailPdfs" :key="mailPdf.id">
											<td>{{mailPdf.id}}</td>
											<td>{{mailPdf.examiner.name}}</td>
											<td>{{mailPdf.mailpdf}}</td>
											<td>{{mailPdf.questions}}</td>
											<td>{{mailPdf.answers}}</td>
											<td>{{mailPdf.personal_extra}}</td>
											<!--<td v-if="$gate.isAdminOrAuthor()">!--> <td>
												<!--<a href="javascript:void(0)" @click="testDetailByUser(mailPdf.id)">-->
													<!--<i class="fas fa-info-circle"></i>-->
												<!--</a>-->
												<a href="javascript:void(0)" @click="deleteUserComment(mailPdf.id)" v-my-tooltip.bottom-center="'löschen'">
													<i class="fas fa-trash"></i>
												</a>
											</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="modal-footer">		
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
								<button v-show="!feedbackstatus" type="submit" class="btn btn-success">Aktualisieren</button>
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
                mailPdfs:{},
				testExaminers:{},
                userToTests:{},
				testid:-9,
				feedbackstatus:0,
				form : new Form({
                     id            	:'',
                     examiner_id   	:[],
                 }),
				 errors: {}
            }
        },
		computed:{
			filteredTestExaminer: function(){
				return this.testExaminers.data.filter((testExaminer) => {
					return testExaminer.test_id == this.testid
				});
            }
		},
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                this.$Progress.start()
                axios.get(base_path+'/admin_api/userToTest?page=' + page)
                    .then(response => {
                        this.userToTests = response.data;
                        this.$Progress.finish()
                    }).catch(error=>{
                    this.$Progress.fail()
                });
            },

            testDetailByUser(usertestid, feedbackstatus, testid){
				//this.usertestid=usertestid;
				this.feedbackstatus=feedbackstatus;
				this.testid=testid;
				this.form.id = usertestid;
                this.$Progress.start()
                axios.get(base_path+'/admin_api/testDetailByUser/'+usertestid)
                    .then(response => {
                        this.mailPdfs = response.data;
                        $('#userTestDetail').modal('show');
						this.form.examiner_id = []; //reset the examiners from any previous open testDetailByUser
						Object.values(this.mailPdfs).forEach(item => this.form.examiner_id.push(item.examiner_id)); //add the old examiners as default
                        this.$Progress.finish()
                    }).catch(error=>{
                    this.$Progress.fail()
                });	
            },

			changeExaminer(){
                this.$Progress.start()
                this.form.put(base_path+'/admin_api/userToTest/'+this.form.id)
					 .then(()=>{
						 Fire.$emit('AfterCreate')
						 $('#userTestDetail').modal('hide');
						 toast({
							 type: 'success',
							 title: 'Prüfer erfolgreich aktualisiert und eine neue E-Mail wurde versendet'
						 })
						 this.$Progress.finish()
					   })
					 .catch(()=>{
						 this.$Progress.fail()
					 })
            },
			
            unlockUser(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Der Benutzer sollte auf der Webseite ein Protokoll abgeben! Bitte sichern, dass er zumindest ein per Hand abgegeben hat.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ja, freischalten!'
                }).then((result) => {
                    if (result.value) {
                        axios.get(base_path+'/admin_api/unlockUser/'+id).then(()=>{
                            swal(
                                'Freigeschaltet!',
                                'Der Benutzer wurde erfolgreich freigeschaltet.',
                                'success'
                            )
                            Fire.$emit('AfterDelete')
                        }).catch(()=>{
                            swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                        })

                    }
                })
            },


            deleteUserComment(id){
                swal({
                    title: 'Bist du sicher?',
                    text: "Du kannst es nicht rückgängig machen!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ja, lösche es!'
                }).then((result) => {
                         if (result.value) {
						 
							axios.get(base_path+'/admin_api/deleteComment/'+id).then(()=>{
                                 swal(
                                     'Gelöscht!',
                                     'Das Einzel-Protokoll wurde gelöscht.',
                                     'success'
                                 )
                                 Fire.$emit('AfterDelete')
                             }).catch(()=>{
                                 swal('Fehlgeschlagen!', 'Oops, etwas ist schief gelaufen!', 'warning')
                             })

                         }
                })
            },
			
            loadUserToTest(){
                this.$Progress.start()
//                if(this.$gate.isAdminOrAuthor()) {
                    axios.get(base_path+'/admin_api/userToTest').then(({data}) => (this.userToTests = data));
              //  }
                this.$Progress.finish()
            },
			
			loadTestExaminers(){
                this.$Progress.start()
                axios.get(base_path+'/admin_api/testExaminerDisplyAll').then(({data}) => (this.testExaminers = data));
                this.$Progress.finish()
            }
		
        },

        created(){
            Fire.$on('searching',()=>{
                let query=this.$parent.search;
                axios.get(base_path+'/admin_api/findFeedback?q='+ query)
                    .then((data)=>{
                       this.userToTests = data.data;
                    })
                    .catch(()=>{

                    })
            })

			this.loadTestExaminers();
            this.loadUserToTest()
            Fire.$on('AfterCreate',()=>{
                this.loadUserToTest()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadUserToTest()
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
