
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform'
window.Form = Form

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import swal from 'sweetalert2'
window.swal = swal
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
})

let routes = [
    {
        path: '/admin', component: require('./components/Dashboard.vue'),
        meta: { title: 'Skriptenzimmer Köln | Startseite' }
    },
    {
        path: '/admin/users', component: require('./components/Users.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Benutzer' }
    },
    {
        path: '/admin/tests', component: require('./components/Tests.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Prüfungen' }
    },
    {
        path: '/admin/examiners', component: require('./components/Examiners.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Prüfer' }
    },
    {
        path: '/admin/testexaminers', component: require('./components/TestExaminers.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Verknüpfung Prüfer-Prüfung' }
    },
	{
        path: '/admin/reminders', component: require('./components/Reminders.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Erinnerungs-E-mails' }
    },
    {
        path: '/admin/usertotests', component: require('./components/UserToTests.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Empfangene Protokolle' }
    },
    {
        path: '/admin/uploadpdfs', component: require('./components/UploadPdfs.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Skript hochladen' }
    },
    {
        path: '/admin/developer', component: require('./components/Developer.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Developer' }
    },
    { path: '/admin/profile', component: require('./components/Profile.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Profile' }

    },
    {
        path: '/admin.*', component: require('./components/NotFound.vue'),
        meta: { title: 'Skriptenzimmer Köln  | Not Found' }
    }

]

import { VTooltip } from 'v-tooltip'

Vue.directive('my-tooltip', VTooltip)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));


const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

Vue.filter('upText',function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('myDate',function (created_at) {
   return moment(created_at).format('MMMM Do YYYY');
})

Vue.filter('approvedStatus',function (email_verified_at) {
    return email_verified_at ? 'Yes' : 'No';
})

Vue.filter('feedbackStatus',function (feedback_status) {
    if(feedback_status=='1')
      return  'Yes'
      return  'No'
})




window.Fire = new Vue();



Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue')
);



const app = new Vue({
    el: '#app',
    router,
    data:{
        search:'',
    },
    methods:{
        searchit: _.debounce(()=>{
            Fire.$emit('searching');
        },1000)

        // searchit() {
        //    Fire.$emit('searching');
        // }
    }
});

