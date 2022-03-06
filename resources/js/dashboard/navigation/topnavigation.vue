

<template>

      <section class=""  >
        <div style="transform:rotate(0deg)">
          <main class="menu_bar_cover ">

              
                <nav class="d-flex  align-center" >
                     
                     <ul class="topnav_mainmenu mr-4"  v-for="menu in mainMenuList" :key="menu.id">
                         <li> <span class="menu_item_text">{{ menu.displayname}}  </span> </li>
                         
                         <li class="topnav_submenu_wrapper" v-if="hasChildrens(menu)">
                             <ul class="topnav_submenu">
                               <li class="mt-3" v-for="submenu in menu.childrens" :key="submenu.id">
                           
                                  <a class="top_nav_link" :href="submenu.link">{{submenu.displayname}} </a>
                               </li>
                            </ul>
                         </li>
                        </li>
                     </ul>
 

                </nav>

                 
            </main>

          



       </div>
      
      </section>




  </template>

  <script>

  import menutree from './menutree.vue';

    export default {

    props:{

    },
    components:{
        'menutree':menutree,

     

    },

    data: function () {
        return {
            mainMenuList:[
                   {
                    id:1,
                    type:'dropdown',
                    name:'blogs',
                    displayname:'BLOGS',


                    link:'',
                    childrens:[{
                              id:1.1,
                              type:'link',

                              name:'createnewblog',
                              displayname:'Create New Post',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                               {
                              id:1.2,
                              type:'link',

                              name:'recentblogs',
                              displayname:'Recent Posts',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                               {
                              id:1.3,
                              type:'link',

                              name:'popularposts',
                              displayname:'Popular Posts',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                               {
                              id:1.4,
                              type:'link',

                              name:'stockmarket',
                              displayname:'Stock Market News',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                                {
                              id:1.5,
                              type:'link',

                              name:'iponews',
                              displayname:'IPO News',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                                  {
                              id:1.6,
                              type:'link',

                              name:'iponews',
                              displayname:'Mutual Funds News',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                               ],

                    },
                    {
                    id:2,
                    type:'dropdown',

                    name:'customers',
                    displayname:'CUSTOMERS',
                    link:'',
                    showchilds:false,
                    childrens:[{
                              id:2.1,
                              type:'link',

                              name:'allcustomers',
                              displayname:'All Customers',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                               {
                              id:2.2,
                              type:'link',

                              name:'newcustomers',
                              displayname:'New Customers',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                                {
                              id:2.3,
                              type:'link',

                              name:'customergroups',
                              displayname:'Customer Groups',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                                 {
                              id:2.4,
                              type:'link',

                              name:'currentyearipo',
                              displayname:'Create Customer Group',
                              link:'http://127.0.0.1:8000/dashboard#/underconstruction',
                         
                              
                               },
                            
                               
                               ]

                    },
                      
                ],

           
          


   


            


          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {
    },
    methods:{
       
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

      
      
    },
    computed:{
        
       
        

    },
    watch:
    {
       
     

    },
    



}

</script>

<style scoped>
.topnav_mainmenu
{
    display: block; 
list-style-type: none;
margin-top:0; 
 margin-bottom: 0; 
 margin-left: 0; 
 margin-right: 0; 
 padding-left: 0px; 
 transform: rotate(0deg);

}

.topnav_mainmenu .menu_item_text
{
 color:#5729DA;
 font-size:18px;
 display: inline-block;
 font-weight: bold;
 padding:5px;


}

.topnav_mainmenu .topnav_submenu_wrapper
{
display: none; 


}
.topnav_mainmenu:hover .topnav_submenu_wrapper
{
display: block; 


}
.topnav_submenu_wrapper
{
  position: absolute;
   top:100%;
   left:0;

   padding-top:10px;



}
.topnav_submenu
{
  
   
   
   transform: rotate(0deg);
    min-width:300px;
   padding:25px;
   box-sizing: border-box;
   background-color: #5729DA;
   color:#fff;

   margin-top:0; 
   margin-bottom: 0; 
   margin-left: 5px; 
   margin-right: 0; 
   list-style-type: none;


}
.topnav_submenu::after
{
    content:'';
    width:0px;
    height:0px;
    position:absolute;
    top:0;
    left:0;
    
    transform: translate(100%,-100%);
    border-bottom:15px solid #5729DA;
  border-left:10px solid rgba(0,0,0,0);
    border-right:10px solid rgba(0,0,0,0);


    

}
.top_nav_link
{
    color:#fff;
    text-decoration: none;

}
.top_nav_link:hover
{
        color:#fff;

        text-decoration:underline;

}
.top_nav_link:active

{
    text-decoration: none;

}



</style>