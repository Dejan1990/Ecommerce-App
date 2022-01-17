require('./bootstrap');

import Vue from 'vue'

import VueSwal from 'vue-swal';
Vue.use(VueSwal);

//Vue.component('attribute-values', require('./components/AttributeValues.vue').default);
Vue.component('attribute-values', require('./components/AttributeValues.vue').default);

const app = new Vue({
    el: '#app'
});
