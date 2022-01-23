require('./bootstrap');

import Vue from 'vue'

import VueSwal from 'vue-swal';
Vue.use(VueSwal);

Vue.component('product-detail', require('./components/ProductDetail.vue').default);

const app = new Vue({
    el: '#site',
    created: function() {
        console.log('Site Loaded');
    }
});
