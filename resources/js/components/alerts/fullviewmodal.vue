

<template>

      <div class="modal_default_wrapper d-flex justify-center align-center" >


                <div class="modal_alert" >
                    <div class="close_button"> </div>

                        <slot>

                        </slot>




                </div>


          

        



      </div>





  </template>

  <script>

    export default {

    props:{


        

 



    },

    data: function () {
        return {
             
          
        }
    },
    directives: {
    display: {
    // directive definition
    bind: function (el, binding, vNode) {
      el.style.display = binding.value;
      }
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

.modal_default_wrapper
{
    position:fixed;

    background-color:rgba(0,0,0,0.75);

    margin:0;
    width:100vw;
    height:100vh;
    z-index:100000;
    top:0;
    left:0;
}
.modal_alert
{
    min-width:500px;
    min-height:250px;
    
    background:#fff;
    transform: perspective(1300px) rotateX(0);
    opacity: 1;
    transform-origin: 50% 0 0;
    transition: transform .3s,opacity .3s;
    box-shadow: 0 1px 1px 0 rgb(0 0 0 / 5%), 0 1px 2px 0 rgb(0 0 0 / 10%), 0 2px 20px 0 rgb(0 0 0 / 20%);
    }
</style>