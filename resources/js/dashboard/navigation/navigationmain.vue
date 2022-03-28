

<template>

      <section class=""  >
        <div style="transform:rotate(0deg)">
          <main class="menu_bar_cover ">

              
                <nav class="navmenu" >
                     
                     <menutree  :menuList ="mainMenuList"  >  </menutree>
 

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
                    name:'tradingcalls',
                    displayname:'TRADING CALLS',


                    link:'',
                    childrens:[{
                              id:1.1,
                              type:'link',

                              name:'createnew',
                              displayname:'CREATE TRADING CALL',
                              link:'http://127.0.0.1:8000/dashboard#/createstockrecommendation',
                         
                              
                               },
                               {
                              id:1.2,
                              type:'link',

                              name:'allcalls',
                              displayname:'ALL TRADING CALLS',
                              link:'http://127.0.0.1:8000/dashboard#/recommendationlist',
                         
                              
                               },
                               {
                              id:1.3,
                              type:'link',

                              name:'intraday',
                              displayname:'INTRADAY CALLS',
                              link:'',
                         
                              
                               },
                               {
                              id:1.4,
                              type:'link',

                              name:'futures',
                              displayname:'FUTURES AND OPTIONS',
                              link:'',
                         
                              
                               },
                                {
                              id:1.5,
                              type:'link',

                              name:'shorterm',
                              displayname:'SHORT TERM CALLS',
                              link:'',
                         
                              
                               },
                               ],

                    },
                    {
                    id:2,
                    type:'dropdown',

                    name:'ipos',
                    displayname:'IPOs',
                    link:'',
                    showchilds:false,
                    childrens:[{
                              id:2.1,
                              type:'link',

                              name:'createnew',
                              displayname:'CREATE NEW IPO',
                              link:'http://127.0.0.1:8000/dashboard#/createipoform?page=1',
                         
                              
                               },
                               {
                              id:2.2,
                              type:'link',

                              name:'upcomingipos',
                              displayname:'UPCOMING IPOS',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/upcomingipos',
                         
                              
                               },
                                {
                              id:2.3,
                              type:'link',

                              name:'pastipos',
                              displayname:'PAST IPOS',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/pastipos',
                         
                              
                               },
                                 {
                              id:2.4,
                              type:'link',

                              name:'currentyearipo',
                              displayname:'CURRENT YEAR IPO',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/currentyearipos',
                         
                              
                               },
                                 {
                              id:2.5,
                              type:'link',

                              name:'nextyearipo',
                              displayname:'NEXT YEAR IPO',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/nextyearipos',
                         
                              
                               },
                                {
                              id:2.6,
                              type:'link',

                              name:'nextyearipo',
                              displayname:'CREATE IPO LEAD MANAGER',
                              link:'http://127.0.0.1:8000/dashboard#/createleadmanager?page=1',
                         
                              
                               },
                                {
                              id:2.7,
                              type:'link',

                              name:'nextyearipo',
                              displayname:'IPO LEAD MANAGERS',
                              link:'http://127.0.0.1:8000/dashboard#/createleadmanager?page=1',
                         
                              
                               },
                               
                               ]

                    },
                    {
                     id:3,
                     type:'dropdown',
                     
                     name:'rightsissue',
                     displayname:'Rights Issue',
                     link:'',
                     showchilds:false,

                     childrens:[{
                              id:3.1,
                              type:'link',

                              name:'createnew',
                              displayname:'CREATE NEW RIGHTS ISSUE',
                              link:'http://127.0.0.1:8000/dashboard#/createrightsform?page=1',
                         
                              
                               },
                               {
                              id:3.2,
                              type:'link',

                              name:'upcomingipos',
                              displayname:'UPCOMING RIGHTS ISSUES',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/upcomingipos',
                         
                              
                               },
                                {
                              id:3.3,
                              type:'link',

                              name:'pastipos',
                              displayname:'PAST RIGHTS ISSUES',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/pastipos',
                         
                              
                               },
                                 {
                              id:3.4,
                              type:'link',

                              name:'currentyearipo',
                              displayname:'CURRENT YEAR RIGHTS ISSUE',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/currentyearipos',
                         
                              
                               },
                                 {
                              id:3.5,
                              type:'link',

                              name:'nextyearipo',
                              displayname:'NEXT YEAR RIGHTS ISSUE',
                              link:'http://127.0.0.1:8000/dashboard#/ipolists/nextyearipos',
                         
                              
                               },
                               
                               ],
                     },
                     {
                      id:4,
                      type:'dropdown',

                      name:'ncdissue',
                      displayname:'NCD ISSUE',
                      link:'',
                      },
                       {
                      id:5,
                      type:'dropdown',

                      name:'brokers',
                      displayname:'BROKERS',
                      link:'',
                      },
                       {
                      id:6,
                      type:'dropdown',

                      name:'portfoliomanager',
                      displayname:'PORTFOLIO MANAGERS',
                      link:'',
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
.menu_bar_cover
{
    width:260px;
    max-height:100vh;
    min-height:100vh;
    overflow:scroll;




    border-right:1px solid brown;
    border-bottom:1px solid brown;



    padding:20px;

    padding-left:0px;
    
    
    background:#000;
    color:#fff;
    font-size:14px;
    

}
.menu_bar_cover::-webkit-scrollbar {
  width: 4px;
}
 
.menu_bar_cover::-webkit-scrollbar-track {
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
}
 
.menu_bar_cover::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}

.navmenu
{

}

</style>