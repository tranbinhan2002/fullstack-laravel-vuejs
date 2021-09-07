

require('./bootstrap');

import Vue from 'vue'
import App from './App.vue';

//call Api
import common from './common';
Vue.mixin(common);

//Element Ui
import Element from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(Element)

//Vue-SweetAlert2
import VueSweetAlert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetAlert2);

//Vue form 
import { Form } from 'vform';
window.Form = Form;

//vue pagination 
Vue.component('pagination', require('laravel-vue-pagination'));

//vue-router
import router from './router';

//CKEditor
import CKEditor from 'ckeditor4-vue';
Vue.use( CKEditor );

const app = new Vue({
    render: h => h(App),
    router,
}).$mount('#app');