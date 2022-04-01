

<template>

      <div class="" >

        
           <div class="tab_default">

            <div class="d-flex align-items-center">
                <div class="tabitem_default mr-10"  :class="classBinding(tab)" v-on:click="activateTab(tab), buttonEffect($event)" v-for="tab in tabs" :key="tab.id">
                     
                      {{tab.displayname}}


                    
                        <div class="btn_effect"  >

                         </div>

                     
                </div>

                 

            </div>


             



           </div>



      </div>





  </template>

  <script>

  import theme1styles from  "../themes/themedata1.js";


    export default {

      components:{

        

   

    },
    mixins:[theme1styles],


    props:{
     value:String,
     elementid:[Number, String],
     items:{
         type:Array,
         required:true,
     },
     spacing:String,

     tabTheme:'',


    },

    data: function () {
        return {

     
          




          tabs:[],  

          activetab:'',  

         
      
          
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {

       if(this.items)
       {
         this.tabs = this.items;

       }
       if(this.value)
       {
         this.activetab = this.value;
       }

    

    },
    methods:{
       sendDataToParent:function()
      {
           this.$emit('messageFromTab',this.elementid,this.activetab);
      },
      activateTab:function(tab)
      {
           this.activetab = tab.name;
      },
      classBinding:function(tab)
      {
        if(tab.name == this.activetab)
        {

            return "tabitem_default_active";

        }
        else
        {
            return "tabitem_default_inactive";

        }
           
      },
      buttonEffect:function(event)

      {
        var el, effectel, x, y, left, top;
            el = event.currentTarget;

            effectel = el.querySelector(".btn_effect");

        

            x = event.x;
            y = event.y;
            left = el.getBoundingClientRect().left;
            top = el.getBoundingClientRect().top;

            effectel.style.top = ((y - top) - (25))+'px';

            effectel.style.left = ((x - left) - (25))+'px';

            effectel.style.display = 'block';

            setTimeout(function()
            {

            effectel.style.display = 'none';

            }.bind(this),1000);




      }
      
      
    },
    computed:{

      

     
     

    },
    watch:
    {

      activetab:function(oldvalue, newvalue)
      {
          this.sendDataToParent();

      },
     
        

    },
    



}

</script>

<style scoped>
.tab_default
{
  overflow:scroll;
  
}
.tabitem_default
{
 
  min-width:200px;
  padding:5px 4px;

  border-radius: 8px;
  text-align: center;

  transform: rotate(0deg);
  

}
.tabitem_default_inactive
{
   background-color:#B0BAC9;
  color:#000;

  box-shadow: 0px 8px 10px rgba(48, 79, 254, 0.14), 0px 3px 14px rgba(48, 79, 254, 0.12),0px 4px 5px rgba(48, 79, 254, 0.2);
  

}
.tabitem_default_active
{
   background-color:#0026CA;

  color:#fff;
    box-shadow: 0px 8px 10px rgba(48, 79, 254, 0.14), 0px 3px 14px rgba(48, 79, 254, 0.12),0px 4px 5px rgba(48, 79, 254, 0.2);

  
}

.tab_default::-webkit-scrollbar {
  width: 0px;
}

.btn_effect
{
  position:absolute;
  width:50px;
  height:50px;
  display: none;
  background:rgba(255, 255, 255, 0.7);
  border-radius:50%;
  transform-origin: center;

  animation: btn_effect  0.5s linear 1;
  opacity: 0;
  
 

}
@keyframes btn_effect
{
  from {
    transform: scale(0);
      opacity: 1;

  }
 
  to{
       opacity: 0;
      transform: scale(1);

  }

}



</style>