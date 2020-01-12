<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Prüfungsstatistik ansehen</h3>
                    </div>
                    <!-- /.card-header -->
					<div class="card-body">
						<p>Derzeit ist der Zeitraum leider nicht einstellbar. Dargestellt wird die Statistik für die letzte 6 Monate bis Heute</p>
						<form @submit.prevent>
								<div class="input-group date" id="datepickers">
								<label for="rangeStart">Zeitspanne-Beginn: <input v-model="form.rangeStart" type="date" name="rangeStart" id="rangeStart" value="2019-10-01" class="form-control" :class="{ 'is-invalid': form.errors.has('rangeStart') }"></label>
								<label for="rangeEnd">Zeitspanne-Ende:<input v-model="form.rangeEnd" type="date" name="rangeEnd" id="rangeEnd" value="new Date()" class="form-control" :class="{ 'is-invalid': form.errors.has('rangeEnd') }"> </label>
								<has-error :form="form" field="rangeStart"></has-error><has-error :form="form" field="rangeEnd"></has-error>
								<label for="refreshStats">aktualisieren: <br>&nbsp<button type="submit" @click="loadStats()" id='refreshStats'><i class="fa fa-refresh"></i></button></label>
							</div>
						</form>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Prüfung</th>
                                <th>Protokoll-Anfragen</th>
								<th>Protokoll-Abgaben</th>
								<th>Prozentanteil-Abgaben</th>
                            </tr>
                            <tr v-for="stat in stats.data" :key="stat.id">
                                <td>{{stat.id}}</td>
                                <td>{{stat.name}}</td>
								<td>{{stat.downloaded}}</td>
								<td>{{stat.uploaded}}</td>
								<td>{{((stat.uploaded/stat.downloaded)*100).toFixed(1)}}%</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <pagination :data="stats" :limit=5 @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


    </div>
</template>

<script>
    export default {

        data(){
            return {
                errors: {},
                editmode:false,
				stats:{},
                 form : new Form({
                     id            :'',
                     name          :'',
                     semester	   :'',
					 downloaded	   :'',
					 uploaded	   :'',
					 quota	   :'',
                 })
            }
        },
        methods:{
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get(base_path+'/admin_api/statistik?page=' + page)
                    .then(response => {
                        this.stats = response.data;
                    });
            },

			loadStats(){
                this.$Progress.start()
                    axios.get(base_path+'/admin_api/statistik').then(({data}) => (this.stats = data));
                this.$Progress.finish()
            },
			
			reloadStats(){
                this.$Progress.start()
                    this.form.put(base_path+'/admin_api/statistik').then(({data}) => (this.stats = data))
                this.$Progress.finish()
            },
			
        },



        created(){
            this.loadStats()
            Fire.$on('AfterCreate',()=>{
                this.loadStats()
            })
            Fire.$on('AfterDelete',()=>{
                this.loadStats()
            })
        },

    }
</script>
