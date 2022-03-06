

<template>

      <div>
         
         <div> Dashboard </div>


         <dashboardcover>

         </dashboardcover>

      </div>




  </template>

  <script>

import dashboardcover from './dashboardcover.vue';

    export default {

        components:{
   'dashboardcover':dashboardcover,

    },

    data: function () {
        return {
            
          
        }
    },
    created()
    {
      
       
    },
    methods:{
      
      
    }
    ,
    computed:{

        routesubmenu()
        {
         return this.$route.params.submenu;
  
        },
       

    }



}

</script>

<style scoped>


</style>