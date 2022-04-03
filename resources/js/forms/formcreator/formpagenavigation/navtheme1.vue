

<template>

      <div class="" >


              <div class="d-flex justify-space-around">
                    <div class="page_title_wrap" :style ="pageItemStyle" v-for="page,index in this.pageData" :key="page.page">
                        <div>
                           <div v-if="metPageRequirement(index)"  v-on:click="goToParticularPage(page.page)" class="page_circle d-flex justify-center align-center" v-bind:class="page.page == activePageNUmber ? 'page_circle_active':'page_circle_inactive'"> <span>{{page.page }}</span> </div>

                           <div v-if="!metPageRequirement(index)"  class="page_circle page_circle_disabled d-flex justify-center align-center" > <span>{{page.page }}</span> </div>

                           
                        </div>
                        <div v-if="pages < 6"  class="mt-4 page_title_default" v-bind:class="page.page == activePageNUmber ? 'page_title_active':'page_title_inactive'">
                            {{page.title}}
                              
                        </div>
                        <div v-if="pages > 5 && parsedPageNumber == page.page"  class="mt-4 page_title_default" v-bind:class="page.page == activePageNUmber ? 'page_title_active':'page_title_inactive'">
                            {{page.title}}
                              
                        </div>



                    </div>


              </div>

        

         

          


        </div>

       








  </template>

  <script>


    

    export default {

      components:{

     

    },
    mixins:[],


    props:{
     pages:[String, Number],

     pageData:Array,
     activePageNUmber:Number,




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

     goToParticularPage:function(pagenum)
     {

         this.$emit("changePageRequest", pagenum);

     },
     metPageRequirement:function(index)
      {

        
    
        var res = this.pageData[index].meetRequiredField;


        return res;

         

             
      },

       

      
      
    },
    computed:{
        
        queryList()
        {
          return this.$route.query;
        },
         parsedPageNumber()
        {
              return parseInt(this.queryList.page);
        },
        pageItemStyle()
        {

            var calculatedwidth = ((100 / this.pages) -1 ) + '%'; 



            return {
               width:calculatedwidth,

            }

             
            
        }
        
       
       




    },
    watch:
    {
     
        

    },
    



}

</script>

<style scoped>


.page_circle
{
  width:35px;
  height:35px;
  font-size:16px;
  line-height: 18px;
  border-radius:50%;
  margin-left:auto;
  margin-right:auto;

 }
 .page_circle_disabled
 {
   background-color:#EFF0F6;
color:#6E7191;

  box-shadow: 0px 8px 10px rgba(217, 221, 243, 0.14), 0px 3px 14px rgba(199, 205, 238, 0.12),0px 4px 5px rgba(183, 188, 211, 0.2);

 }
 .page_circle_active
 {

background-color:#4A3AFF;
color:#fff;
  box-shadow: 0px 6px 8px rgba(48, 79, 254, 0.14), 0px 1.5px 7px rgba(48, 79, 254, 0.12),0px 2px 2.5px rgba(48, 79, 254, 0.2);


 }
 .page_circle_inactive
 {
background-color:#91ac49;
color:#fff;
  box-shadow: 0px 8px 10px rgba(254, 206, 48, 0.14), 0px 3px 14px rgba(254, 233, 48, 0.12),0px 4px 5px rgba(240, 254, 48, 0.2);


 }
 .page_title_default
 {
   text-align:center;
   font-size:16px;
   

 }
 .page_title_active
 {
   color:#3325D3;
   

 }
 .page_title_inactive
 {
   color:#6F6C90;
   
 }

</style>