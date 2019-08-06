<style>
   .widget-user .widget-user-header{
       height: 250px !important;
   }
   .widget-user .widget-user-image {
        top: 115px;
    }
</style>
<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white"  :style="{ backgroundImage: 'url(\'' + image + '\')' }" >
                            <h3 class="widget-user-username">Profile Detail</h3>
                            <h5 class="widget-user-desc">Profile Img</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" :src="getProfilePhoto()"  alt="User Avatar">
                        </div>
                        <!--<div class="card-footer">-->
                            <!--<div class="row">-->
                                <!--<div class="col-sm-4 border-right">-->
                                    <!--<div class="description-block">-->
                                        <!--<h5 class="description-header">3,200 </h5>-->
                                        <!--<span class="description-text">SALES </span>-->
                                    <!--</div>-->
                                    <!--&lt;!&ndash; /.description-block &ndash;&gt;-->
                                <!--</div>-->
                                <!--&lt;!&ndash; /.col &ndash;&gt;-->
                                <!--<div class="col-sm-4 border-right">-->
                                    <!--<div class="description-block">-->
                                        <!--<h5 class="description-header">13,000</h5>-->
                                        <!--<span class="description-text">FOLLOWERS </span>-->
                                    <!--</div>-->
                                    <!--&lt;!&ndash; /.description-block &ndash;&gt;-->
                                <!--</div>-->
                                <!--&lt;!&ndash; /.col &ndash;&gt;-->
                                <!--<div class="col-sm-4">-->
                                    <!--<div class="description-block">-->
                                        <!--<h5 class="description-header">35 </h5>-->
                                        <!--<span class="description-text">PRODUCTS </span>-->
                                    <!--</div>-->
                                    <!--&lt;!&ndash; /.description-block &ndash;&gt;-->
                                <!--</div>-->
                                <!--&lt;!&ndash; /.col &ndash;&gt;-->
                            <!--</div>-->
                            <!--&lt;!&ndash; /.row &ndash;&gt;-->
                        <!--</div>-->
                    </div>
                    <!-- /.widget-user -->
                </div>



            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input v-model="form.name" type="text" name="name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" id="name" placeholder="Name">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <input v-model="form.email" type="text" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" id="email" placeholder="Email">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio" class="col-sm-2 control-label">Bio</label>
                                        <div class="col-sm-12">
                                            <textarea v-model="form.bio"  name="bio" class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" id="bio" placeholder="Experience"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                        <div class="col-sm-12">
                                          <input type="file" name="photo" @change="updateProfile" class="form-control"  id="photo">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password"  class="col-sm-4 control-label">Password (leave empty if not changing)</label>
                                        <div class="col-sm-12">
                                            <input v-model="form.password" type="password" name="password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" id="password" placeholder="Password">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>

            </div>
    </div>
</template>

<script>
    export default {
        data(){
           return {
               image:base_path+'/img/user_cover.png',
               form : new Form({
                   id      :'',
                   name    :'',
                   email   :'',
                   password:'',
                   type    :'',
                   bio     :'',
                   photo   :'',
               })
           }
        },
        mounted() {
            console.log('Component mounted.')
        },

        methods : {

           updateProfile(element){

              // window.alert('working');s
               let file = element.target.files[0];
               let reader = new FileReader();
               if (file['size'] < 2111775) {
                  // $('#photo').val(file['name']);
                   reader.onloadend = (file) => {
                        console.log('RESULT', reader.result)
                       this.form.photo = reader.result;
                   }
                   reader.readAsDataURL(file);

               }else{
                   $('#photo').val();
                   swal({
                       type:'error',
                       title: 'Oops...',
                       text:'You are trying to upload large file.'
                       })
               }

           // return true;
           },
            updateInfo(){
                this.$Progress.start()
               this.form.put(base_path+'/admin_api/profile')
                    .then(()=>{
                        Fire.$emit('AfterCreate')
                        this.$Progress.finish()
                        swal(
                            'Saved!',
                            'Profile has been updated',
                            'success'
                        )
                    })
                    .catch(()=>{
                        this.$Progress.fail()
                    });

            },
            // if(this.form.photo.length > 100 ) {
            getProfilePhoto(){
                    let photo = (this.form.photo.length > 200) ? this.form.photo : base_path+"/img/profile/" + this.form.photo ;
                    return photo;

            },
        },




        created(){
            this.$Progress.start()
           let id= this.$gate.userId()
            axios.get(base_path+'/admin_api/profile/'+id).then(({ data }) => (this.form.fill(data)));
            this.getProfilePhoto();
            this.$Progress.finish()

            Fire.$on('AfterCreate',()=>{
                axios.get(base_path+'/admin_api/profile/'+id).then(({ data }) => (this.form.fill(data)));
                this.getProfilePhoto();
            })


        }
    }
</script>
