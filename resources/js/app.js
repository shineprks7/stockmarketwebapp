require('./bootstrap');

import Vue from 'vue';

import store from './dashstoreloader'; 
import router from './dashboard/routes/dashboardroutecover'; 

import Vuetify from "vuetify";
import VueRouter from 'vue-router'


import "vuetify/dist/vuetify.min.css";

import debounce from 'lodash/debounce';

import throttle from 'lodash/throttle';



Vue.use(Vuetify);

Vue.use(VueRouter);

Vue.component('appcover', require('./dashboard/dashboardcomponents/appcover.vue').default);




new Vue({
    
store,
router,
  
 vuetify: new Vuetify({
  theme: { disable: true },

})
  }).$mount('#app')