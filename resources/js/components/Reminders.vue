<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Erinnerungs-E-Mails verwalten</h3>
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
                                <th>Erster Termin</th>
								<th>Letzter Termin</th>
                                <th>Prüfungszeitraum</th>
                                <th>erste Erinnerungs-E-Mail</th>
								<th>zweite Erinnerungs-E-Mail</th>
								<th>Aktion</th>
                            </tr>
                            <tr v-for="reminder in reminders.data" :key="reminder.id">
                                <td>{{reminder.id}}</td>
                                <td>{{reminder.test.name}}</td>
                                <td>{{reminder.rangeStart}}</td>
								<td>{{reminder.rangeEnd}}</td>
								<td>{{reminder.multi ? "Zeitspanne" : "Einzeltermin" }}</td>
								<td>{{reminder.mailTiming ? reminder.mailTiming  : "-"}}</td>
								<td>{{reminder.mailTiming2 ? reminder.mailTiming2  : "-"}}</td>
								<td>
									<a href="javascript:void(0)" @click="editModal(reminder)" v-my-tooltip.bottom-center="'aktualisieren'">
                                        <i class="fas fa-edit"></i>
                                    </a>
								</td>
                            </tr> 
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="reminders" :limit=5 @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
		
		<!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="editModalLabel">Erinnerungs-E-Mail erstellen</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewModalLabel">Erinnerungs-E-Mail aktualisieren</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateReminder() : createReminder()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
								<label>Zeitspanne oder Einzeltermin?</label>
								<div class="form-group">
									<input v-model="form.multi" type="checkbox" name="multi" id="multi" class="form-control" :class="{ 'is-invalid': form.errors.has('multi') }">					
                                   <label for="multi">{{ form.multi ? "Zeitspanne" : "Einzeltermin"}} </label>
								   <has-error :form="form" field="multi"></has-error>
                                </div>
								
								<div class="form-group">
									<div class="input-group date" id="datepicker1">
									<label for="rangeStart">Zeitspanne-Beginn: 
										<input v-model="form.rangeStart" type="date" name="rangeStart" id="rangeStart" class="form-control" :class="{ 'is-invalid': form.errors.has('rangeStart') }">
										</label>
										<has-error :form="form" field="rangeStart"></has-error>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								
								<div class="form-group">
									<div class="input-group date" id="datepicker2">
										<label for="rangeEnd">Zeitspanne-Ende:
										<input v-model="form.rangeEnd" type="date" name="rangeEnd" id="rangeEnd" class="form-control" :class="{ 'is-invalid': form.errors.has('rangeEnd') }"> </label>
										<has-error :form="form" field="rangeEnd"></has-error>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
                                <div class="form-group">
									<label for="mailTiming">Erinnerungs-E-Mails (Tage nach Prüfung): </label>
									<div class="input-group date" id="mailer1">
										<input v-model="form.mailTiming" type="number" name="mailTiming" id="mailTiming" class="form-control" :class="{ 'is-invalid': form.errors.has('mailTiming') }">
										<has-error :form="form" field="mailTiming"></has-error>
									</div>
								</div>
								<div class="form-group">
									<label for="mailTiming">ggf. zweite E-Mail: </label>
									<div class="input-group date" id="mailer2">
										<input v-model="form.mailTiming2" type="number" name="mailTiming2" id="mailTiming2" class="form-control" :class="{ 'is-invalid': form.errors.has('mailTiming2') }">
										<has-error :form="form" field="mailTiming2"></has-error>
									</div>
								</div>
                            </div>
                            <div class="col-md-8">
								<p>Nutzer sollten bei Physikum, Kinderheilkunde und M3 ihre persönlichen Prüfungstermin auswählen. Dafür sollte man eine Zeitspanne einstellen.</p>
								<p>Allerdings bei der M3 gibt's ein Logikproblem: die Prüflinge kriegen erst deren Prüfer und erst später deren Termin. Das heißt, sie können den Termin nicht eingeben, wenn sie das Protokoll runterladen.<br>Die Lösung zurzeit: M3 als Einzeltermin eingeben und "Zeitspanne-Beginn" und "Zeitspanne-Ende" in der Mitte der echten Zeitspanne eigeben (i.d.R. nach einem Monat). Die erste E-Mail sollte 1 sein, die Zweite berechnet um 3 Tage nach dem echten Ende (i.d.R. ca 33).  So kriegen die hälfte der Prüflinge die Erinnerung zu früh, aber das wird im E-Mail-Text berücksichtigt.<br>z.B. die echte Zeitspanne ist 01.06.-01.08., dann Zeitspanne auf 01.07. setzen mit 1 und 33.</p>
								<p>Bei den Anatomie Testaten ist die Zeitspanne überflüssig: checkbox leer lassen und "Zeitspanne-Ende" wie "Zeitspanne-Beginn" einstellen. (später wird das automatisch für euch gemacht, Zurzeit musst ihr das noch selber einstellen) </p>
								<p>Alle Nutzer kriegen eine Erinnerungs-E-Mail nach dem Prüfungstermin. Zeitpunkt ist in Tage nach Termin eingestellt (z.B. 3 eingeben für 3 Tage nach der Prüfung)</p>
								<p>Wenn eine zweite Erinnerung erwünscht ist, einfach eine Zahl in die zweite Box eingeben. sonst leer lassen</p>
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
                reminders:{},
                 form : new Form({
                     id            :'',
                     test_id       :'',
                     rangeStart    :'',
					 rangeEnd      :'',
					 mailTiming    :'',
					 mailTiming2   :'',
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                this.$Progress.start()
                axios.get(base_path+'/admin_api/reminder?page=' + page)
                    .then(response => {
                        this.reminders = response.data;
                        this.$Progress.finish()
                    }).catch(error=>{
                    this.$Progress.fail()
                });
            ;},

			editModal(reminder){
                this.editmode=true;
                this.form.reset();
                $('#editModal').modal('show');
                this.form.fill(reminder);
            },
			
			updateReminder(){
             this.$Progress.start()
             this.form.put(base_path+'/admin_api/reminder/'+this.form.id)
                 .then(()=>{
                     Fire.$emit('AfterCreate')
                     $('#editModal').modal('hide');
                     toast({
                         type: 'success',
                         title: 'Erinnerungs-E-Mail erfolgreich aktualisiert'
                     })
                     this.$Progress.finish()
                   })
                 .catch(()=>{
                     this.$Progress.fail()
                 })
			},
			
            loadReminders(){
                this.$Progress.start()
                    axios.get(base_path+'/admin_api/reminder').then(({data}) => (this.reminders = data));
                this.$Progress.finish()
            },
	
			setReminders(){

                this.$Progress.start()
                    axios.post(base_path+'/admin_api/reminder').then(({data}) => (this.reminders = data));
                this.$Progress.finish()
            }
		},

        created(){
            Fire.$on('searching',()=>{
                let query=this.$parent.search;
                axios.get(base_path+'/admin_api/findReminder?q='+ query)
                    .then((data)=>{
                       this.reminders = data.data;
                    })
                    .catch(()=>{

                    })
            })

            this.loadReminders()
            Fire.$on('AfterCreate',()=>{
                this.loadReminders()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadReminders()
            })
        },

    }
</script>

