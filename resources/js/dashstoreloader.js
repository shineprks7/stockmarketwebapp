import Vuex from 'vuex';
import Vue from 'vue';

import indexstore from './dashboard/stores/indexstore'; 
import stockrecommendationsstore from './dashboard/stores/stockrecommendationsstore'; 



Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        indexstore,
        stockrecommendationsstore,
      
	
    
	
  }
 
 
});

/*
store.registerModule("dashstore",dashstore);
store.registerModule("simpleconfigurationstore",simpleconfigurationstore);
store.registerModule("miscsubproductinfostore",miscsubproductinfostore);
store.registerModule("menucategorystore",menucategorystore);
*/

export default store;