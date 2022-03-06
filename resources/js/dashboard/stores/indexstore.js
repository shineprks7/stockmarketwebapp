


const indexstore = {
   namespaced: true,

   state: () => ({


      sampledata: '',
      loginstatus: false,

      currentuser: '',
      role: '',
      showsidebarmenu: false,






   }),

   mutations: {
      samplemutation(state, payload) {
         state.sampledata = payload;
      },
      updatecurrentuser(state, payload) {
         state.currentuser = payload;
      },
      updateloginstatus(state, payload) {
         state.loginstatus = payload;
      },
      closeSideBarMenu(state) {
         state.showsidebarmenu = false;
      },
      toggleSideBarMenu(state) {
         if (state.showsidebarmenu == true) {
            state.showsidebarmenu = false;
         }
         else {
            state.showsidebarmenu = true;
         }
      }









   },
   getters: {
      dummy: (state, getters) => {



      },


   }

}

export default indexstore;