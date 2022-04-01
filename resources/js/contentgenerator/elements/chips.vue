

<template>

      <v-container class="" >

        
           <div class="d-flex">

               



           </div>



      </v-container>





  </template>

  <script>

  import theme1styles from  "../themes/themedata1.js";

    export default {

      components:{

        

   

    },
    mixins:[theme1styles],


    props:{
     value:'',
     items:{
         type:Array,
         required:true,
     },
     spacing:String,

     itemtype:String,
     itemExternal:Boolean,
     externalUrl:String,
     externalObjParsing:Object,


    },

    data: function () {
        return {

     
          




          forms:[],    
      
          
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {

    

    },
    methods:{

      
      
    },
    computed:{

       
     

    },
    watch:
    {
     
        

    },
    



}

</script>

<style scoped>


</style>