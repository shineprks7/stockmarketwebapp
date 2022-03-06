


const stockrecommendationsstore = {
   namespaced: true,

   state: () => ({


      statuschangerinvoked: false,
      editorinvoked: false,






   }),

   mutations: {
      invokestatuschange(state, payload) {
         state.statuschangerinvoked = payload;
      },
      invokeeditor(state, payload) {
         state.editorinvoked = payload;
      },









   },
   getters: {
      dummy: (state, getters) => {



      },


   }

}

export default stockrecommendationsstore;