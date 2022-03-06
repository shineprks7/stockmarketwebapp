

<template>

      <div>

          <div class="underconst_container d-flex justify-center align-center">

               <div class="underconst_wrapper">
                     <div> <img  style="max-height:350px; max-width:350px" src="images/brick-wall.png" /> </div>

                     <div class="mt-16 message_construction"> The Requested Feature/Page is Under Construction. </div>


               </div>



          </div>
         


      </div>




  </template>

  <script>

   
    export default {
      

    data: function () {
        return {

            
          
        }
    },
    created()
    {
      
       
    },
    mounted()
    {
    },
    methods:{
  
    
      

      
      
    }
    ,
    computed:{

      
       

    }



}

</script>

<style scoped>
.underconst_container
{
    width:100vw;
    min-height: calc(100vh - 100px);
}

.underconst_wrapper
{
    max-width:800px;
    height:auto;
    text-align: center;
}
.message_construction
{
 font-size:22px;
 color:mediumblue;

}


</style>