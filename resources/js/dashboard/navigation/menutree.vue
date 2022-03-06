

<template>

      <section class=""  >

              
                <nav class="navmenu"  >
                      <ul class="ul_main_menu mt-5" v-for="menu in menuList" :key="menu.id">

                          <li  v-if="menu.type== 'link'" v-on:click="closeNavMenu()">
                            
                            <div class="d-flex align-center">
                                  <div class="mr-2">
                                     <img class="dropdown_icon" src="/images/minus_white.png" /> 
         
                                  </div>
                                  <div>
                                   <a class="nav_anchor" :href="menu.link" >
                                   {{menu.displayname}}
                                     </a>
                                  </div>
                            </div>

                          </li>
                           <li  v-else-if="menu.type== 'dropdown'" v-on:click="toggleChilds($event)">
                                   <div class="d-flex align-center " > 
                                   <div> {{menu.displayname}} </div> 
                                
                                   <div class="ml-2">
                                     <img class="dropdown_icon" src="/images/expandmore_white.png" /> 
         
                                   </div>

                                </div>
                               <div class="sub_menu_wrapper" v-if="hasChildrens(menu)">
                                    <thenavmenu  :menuList="menu.childrens" >  

                                 
                               
                               
                                      </thenavmenu>
                               </div>



                            </li>
                          
                       </ul>
 

                </nav>

                      
      </section>




  </template>

  <script>



    export default {

    name:'thenavmenu',
    props:{

     menuList:[Array],
     showChildren:Boolean,
    },
    components:{

     

    },

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
         closeNavMenu:function(arg1)
      {
                
        this.$store.commit('indexstore/closeSideBarMenu')


      },
       
        changeMainTab:function(value)
        {
          
            this.$router.push({ path: '/ipolists/'+value.name });

          


        },
        hasChildrens:function(obj)
        {

           if(obj.hasOwnProperty('childrens'))
           {
               if(Array.isArray(obj.childrens))
               {

                   return obj.childrens.length>0? true :false;

               }

           }
           
        },
        toggleChilds:function(event)
        {
            
          
             let closestlist = event.target.closest('li'); // (1)


             if(closestlist)
             {
                 var submenuwrap = closestlist.querySelector('.sub_menu_wrapper');

               if(submenuwrap)
               {
                 var clientheight = submenuwrap.clientHeight;
                 var scrollheight = submenuwrap.scrollHeight;

                 if(clientheight == 0)
                 {

                    submenuwrap.style.maxHeight = scrollheight+"px";
                 }
                 else
                 {
                    submenuwrap.style.maxHeight = "0px";

                 }


             
                 console.log("Scroll Height: "+scrollheight);
                 console.log("Client Height: "+clientheight);

               }

             }
             else
             {
                 alert("Cannot Find Submenu");
             }
                   

              

        },

      
      
    },
    computed:{
        
       
        

    },
    watch:
    {
        
     

    },
    



}

</script>

<style scoped>

.ul_main_menu
{
display: block; 
list-style-type: none;
 margin-top:0; 
 margin-bottom: 0; 
 margin-left: 0; 
 margin-right: 0; 
 padding-left: 15px;
}
.list_item
{
    display: block;	
}
.dropdown_icon
{
    width:12px;
    height:12px;
}
.sub_menu_wrapper
{
    max-height:0;
    overflow:hidden;
    transition: max-height 0.3s;
}
.nav_anchor
{
color: #fff;
 text-decoration:none;

}
.nav_anchor:active
{
 color: #fff;

 text-decoration:underline;

}
.nav_anchor:hover
{
color: #fff;

}

</style>