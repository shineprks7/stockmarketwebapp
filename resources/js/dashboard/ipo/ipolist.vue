

<template>

      <section class=" d-flex justify-center align-center" style="width:100%; height:100%;">

        <main class="rclist_wrapper" v-if="validateIpoTimeParam()">
            <nav class="d-flex align-baseline justify-space-between">
               <div class="d-flex align-center">

                  
                  <div  class="mr-4 main_tab_default"  v-on:click="changeMainTab(tab)" v-bind:class="classbindingMainTab(tab)" v-for="tab in tabsList" :key="tab.id"> 

                    {{tab.displayname}}


                  </div>


              </div>

              <div class="">

                 <div class="export_button" v-on:click="exportAsCSV()"> Export Data </div>

              </div>

             </nav>

            <div class="d-flex mt-8 align-center">

               <div class="tab_title mr-5">


               </div>

              
              


            </div>

            <div class="mt-2">

               <section class="table_header_wrap">
                  <div class="d-flex align-center">
                       <div class="table_col_default col_string" >Company </div>

                       <div class="table_col_default col_date">Open Date </div>
                       <div class="table_col_default col_date ">Close Date </div>
                    
                       <div class="table_col_default  col_number"  >Lot Size</div>

                       <div class="table_col_default col_number"   >Issue Price</div>

                       <div class="table_col_default col_number"  >Issue Size </div>




                  </div>
               </section>

                <section class="table_row_wrap"  v-for="list,index in recievedDataExternal" :key="index" >
                  <div>
                     <div class="d-flex align-center">
                       <div class="table_col_default col_string" >{{list.company_name}} </div>

                       <div class="table_col_default col_date scrip_detail ">{{getArrayElementData(list.ipo_details,0,'open_date')}} </div>
                       <div class="table_col_default col_date ">{{getArrayElementData(list.ipo_details,0,'close_date') }}</div>
                    
                       <div class="table_col_default col_number "  >{{getArrayElementData(list.ipo_lot_informations,0,'lots')}}</div>

                       <div class="table_col_default col_number"   >{{getArrayElementData(list.ipo_details,0,'issue_price')}}</div>

                       <div class="table_col_default col_number"  > - </div>
                                           

                     </div>

                     

                  </div>

                  <div class="floating_plot_right">
                       <div class="floating_wrapper d-flex align-center">
                            <div    > <img src="images/edit.png" v-on:click="goToEditPage(list.id)"/> </div>
                             <div class="ml-4"> <img src="images/open.png" /> </div>

                       </div>

                   </div>

                  <v-divider class="mt-3 mb-1"> </v-divider> 
               </section>




            </div>



  





        </main>

        <div  class="error_page d-flex justify-center align-center" v-if="!validateIpoTimeParam()"> 

              <div class="error_page_message"> Requested Page is not available! </div>

        </div>

      
      
      </section>




  </template>

  <script>


     import moment from 'moment';

    export default {
    components:{

     

    },

    data: function () {
        return {

            tabsList:[{id:1,name:'upcomingipos',displayname:'Upocoming IPO'},{id:2,name:'pastipos',displayname:'Past IPO'}, {id:3,name:'currentyearipos',displayname:'Current Year IPO'},{id:4,name:'nextyearipos',displayname:'Next Year IPO'}],
            recievedDataExternal:[],

            pullUrlExternal:'/api/ipoListingAll',

            activetab:'upcoming',

            validparamsipotime:['upcomingipos','pastipos','currentyearipos','nextyearipos']

          


   


            


          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {
        this.getExternalData();
    },
    methods:{

       formatIndianCurrency:function(value)
       {

           return value.toLocaleString("en-in", {style:"currency", currency:"INR"});

       },
       formattedDate:function(value)
       {
               return moment(value).format("Do MMM, YY");
       },
       classbindingMainTab:function(value)
        {

           return this.routeparamIpotime == value.name ? 'main_tab_active': 'main_tab_inactive';

        },
        changeMainTab:function(value)
        {
          if(this.routeparamIpotime != value.name)
          {
            this.$router.push({ path: '/ipolists/'+value.name });

          }


        },
         goToEditPage:function(value)
        {
         
         var id  = value;
          console.log("company id- "+id);

          

             var newqueryobj  = new Object();
              
              newqueryobj.companyid = id;
              newqueryobj.page =1;

            this.$router.push({ path: '/editipo', query:newqueryobj});
        

          


        },
       getArrayElementData:function(arr, index, value)
       {

           if(arr.length>index)
           {
                if(arr[index].hasOwnProperty(value))
                {
                    return arr[index][value];
                }
                else
                {
                    return "-";
                }
           }
           else
           {
               return "-";
           }



           
       },
       getExternalData:function()
       {
           if(this.routeparamIpotime)
           {
          axios.post(this.pullUrlExternal,
          {  
          
           ipotime:this.routeparamIpotime,
           

           }
          )
          .then((response) => { 
          console.log("response:",response.data)
               if(response.status==200)
                 {
    

                    if(response.data[0]=="success")
                   {       

                       console.log("Success ");   

                       this.recievedDataExternal = response.data[1];   
                   }
                   
                 

                }
                else
                {


                  console.log("Your request is Unsuccessfull");   

                      
                 }
    
            }, 
        
               (error)=> {
             console.log(error)

              }
      
              )
        .catch(error => {
         console.log(error.response)
        });
  
           }

           else
           {
               console.log("Ipo Time is Missing");
           }

       },
       
        exportAsCSV:function()
         {

            //define the heading for each row of the data
             var csv = 'Date,Scrip,Action,Entry Price,Lot Size,Target 1,Target 2,Stop Loss,Status\n';
    
                 //merge the data with CSV
                 /*
                    csvFileData.forEach(function(row) {
                     csv += row.join(',');
                      csv += "\n";
                   });

                   */

                if(this.recievedDataExternal.length>0)
                 {
                 
                   for(var i=0;i<this.externaldata.length;i++)
                   {
                        csv += this.recievedDataExternal[i].recommendationdate+',';
                        csv += this.recievedDataExternal[i].scrip +',';
                        csv += this.recievedDataExternal[i].action +',';
                        csv += this.recievedDataExternal[i].entryprice+ ',';
                        csv += this.recievedDataExternal[i].lotsize +',';
                        csv += this.recievedDataExternal[i].target1+',';
                        csv += this.recievedDataExternal[i].target2+',';

                        csv += this.recievedDataExternal[i].stoploss+',';
                        csv += this.recievedDataExternal[i].status+',';
                        csv += "\n";


                   }
                 }

 
                 //display the created CSV data on the web browser 
                 /*
                    document.write(csv);
                  */
   
                 var hiddenElement = document.createElement('a');
                 hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
                 hiddenElement.target = '_blank';
    
                //provide the name for the CSV file to be downloaded
                 hiddenElement.download = 'TradingCalls.csv';
                 hiddenElement.click();

         },

         validateIpoTimeParam:function()
         {

             var index = this.validparamsipotime.indexOf(this.routeparamIpotime);

             if(index > -1)
             {
                 return true;
             }
             else
             {
                 return false;
             }

              
         }

         


       
      
       
       


      
      
    },
    computed:{
        
         routeparamIpotime()
         {
             return this.$route.params.ipotime;
         },
        

    },
    watch:
    {
         routeparamIpotime: function (newData, oldData) {

            this.getExternalData();
           },
     

    },
    



}

</script>

<style scoped>
.rclist_wrapper
{
 min-width:1000px;

}
.export_button
{
font-family: Poppins;
text-align:center;
width:150px;

font-size: 12px;

background-color: #827CCE;
color:#fff;
padding:5px;

}

.main_tab_default
{
   


}
.main_tab_inactive
{
font-family: Poppins;

font-weight: normal;
font-size: 14px;
line-height: 16px;

color: #C5A4A4;

}
.main_tab_active
{
font-family: Poppins;

font-weight: 600;
font-size: 14px;
line-height: 16px;
color: #827CCE;


}
.main_tab_active::after
{
 top:-100%;
 transform:translate(0,-110%);
 width:100%;
 height:1.5px;
 background-color:#827CCE;


}

.tab_title
{
font-family: Roboto;
font-style: normal;
font-weight: 600;
font-size: 17px;
line-height: 20px;

color: #000000;
}
.checkbox_default
{
    position:relative;
    top:3px;
    
}
.subtab_default
{
font-weight: normal;
font-size: 14px;
line-height: 16px;

color: #744F4F;
}

.table_header_wrap
{
padding:5px;
padding-top:8px;
padding-bottom:8px;

background: #C3EEEE;

border-radius: 10px;  
box-sizing:border-box;
}
.table_row_wrap
{
 padding:5px;
padding-top:8px;
padding-bottom:8px;

background: #fff;
color:#000;
box-sizing:border-box;
transform:rotate(0deg);

}

.table_col_default
{
font-weight: normal;
font-size: 14px;
line-height: 16px;

color: #533232;

}
.col_date
{
 width:120px;
}
.col_number
{
 width:100px;
}
.col_string
{
    width:200px;
}
.scrip_detail
{

color:#8753F8;
font-weight:bold; 
}
.subtab_name_default
{
    border-radius:5px;
    padding:4px;
    padding-top:6px;
    padding-bottom:6px;
    width:120px;
    font-size:14px;
    display:inline-block;
    text-align:center;
    

}
.subtab_name_style1
{
   background-color:#fe5d26; 
   color:#fff;
}
.subtab_name_style2
{
   background-color:#283D3B; 
   color:#fff;
}
.subtab_name_style3
{
   background-color:#197278; 
   color:#fff;
}
.subtab_name_style4
{
       background-color:#197278; 

       color: #fff;
}
.floating_plot_right
{
    position:absolute;
    right:-10px;
    top:50%;
}
.floating_wrapper
{
    width:auto;
    padding-left:5px;
    transform:translate(101%,-70%);

}
.overflay_effect
{
    background-color:rgba(255,255,255,0.7);
}
.overflay_full
{
   width:100vw;
   height:100vh;
   position:fixed;
   z-index:1000; 
   top:0;
   left:0;
}

.error_page
{
  width:100%;
  height:100vh;
  
}
.error_page_message
{
  font-size:25px;
  font-weight:bold;
  color:blue;
}

</style>