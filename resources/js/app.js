

require('./bootstrap');

window.Vue = require('vue');

import router from './router';

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-master', require('./components/backend/Master.vue').default);

// vform
import { Form, HasError, AlertError } from 'vform'
 
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

// Fire event ($emit,$on)
window.Fire = new Vue();

// vuex
import Vuex from 'vuex'

Vue.use(Vuex)

// sweet alert
import Swal from 'sweetalert2'
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast = Toast;


const app = new Vue({
    el: '#app',
    router
});
