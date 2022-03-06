

<template>

      <div class="" >

        
            <div v-if="editcontent" class="tabledata_paste mt-16 mb-16"  @input="innerHtmlChange($event)" :contenteditable="editcontent">
            
            </div>





            <div  v-if="this.tabletype">
                   
             <table class="table_default" >
               <tr  v-for="row in tablerows"   >
                   <td   v-bind:class="bindClassColumn(col)" :colspan="col.colspan" v-for="col in row.columns">
                
                                {{col.value}}
                    

                   </td>
                </tr>

              </table>


            </div>

            <div  v-if="!this.tabletype">
              <div  class="d-flex ">
               <div  class="d-flex flex-column row_default" v-for="theindex in maxcolumns"   >
                   <div   v-if="col.index == theindex" class="column_default" v-bind:class="bindClassColumn(col)"  v-for="col in tablecolumnsall">
                
                                {{col.value}}
                    
                   <v-divider class="mt-4 mb-4" > </v-divider>

                   </div>
                </div>
              </div>


            </div>

            
            <div class="mt-16" > 
            
               <v-btn color="blue" class="mr-4" > Column Groups </v-btn>

               <v-btn color="red" class="mr-4"  v-on:click="parseTableTags()"> Table Rows </v-btn>
               <v-btn color="green" class="mr-4" > Table Cells By Row </v-btn>


            </div>




      </div>





  </template>

  <script>

    export default {

    props:{

        inputvalue:[String,Array,Number],
        labelname:String,
        formuid:Number,



     
     



    },

    data: function () {
        return {
             editcontent:true,
             thevalue:'',
             width:"1000",
             
             labname:'Enter Value Here',
             maxcolumns:0,
             tabletype:false,

             headerstyle:'pivot',
        

             tablerows:[],
             tablecolumnsall:[],
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {


        
        
        

    },
    methods:{
     calculateColumnWidh:function(widthratio)
     {
         
         return widthratio+"%";



     },
     bindClassColumn:function(column)
     {
         if(column.rowindex == 1  )
         {
             return "header_column "+column.class;
         }
         else if(column.index == 1 && this.headerstyle == "pivot")
         {
             return "header_column "+column.class;;

         }
         else
         {
             return "normal_column "+column.class;
         }
        

     },
     getPosition:function(value)
     {

     },
     sendDataToMainForm:function()
      {
           this.$emit('messageFromText',this.formuid,this.thevalue);
      },

      parseTableTags:function()
      {
          var executebleelement = document.querySelector('.tabledata_paste');

          var hastable = executebleelement.querySelector('table');

          var hasrows = executebleelement.querySelector('tr');

          this.tablerows = [];

           if(hastable && hasrows)
           {

               var rows = hastable.querySelectorAll('tr');

              

               for(let i=0; i<rows.length;i++)
               {
                   var newobj = new Object();

                   var cols = rows[i].querySelectorAll('td');

                   newobj.index =  i;

                   newobj.numofcols =  cols.length;
                        if(cols.length>this.maxcolumns)
                        {
                            this.maxcolumns = cols.length;
                        }

                   newobj.rowwidth = rows[i].clientWidth;
  
                   newobj.columns = [];

                   this.width =rows[i].clientWidth+"px";
                    if(i==0)
                    {
                    newobj.header = true;
                    }
        
                    if(cols)
                    {
                        for(let j=0;j<cols.length; j++)
                        {
                           var childobj = new Object();

                           childobj.value = cols[j].innerText;
                           childobj.colspan  = cols[j].colSpan;
                           childobj.index = (j+1);
                           childobj.rowindex = (i+1);

                           childobj.class  = 'col_'+ (j+1);

                           if(cols[j].colSpan >1)
                           {
                               this.tabletype = true;
                           }
                           if(j==0)
                            {
                             childobj.header = true;


                             }
                           this.tablecolumnsall.push(childobj);
                           newobj.columns.push(childobj);
                           

                        }
                    }

                  this.tablerows.push(newobj);

               }


            console.log("Table Created Success fully");

              this.editcontent = false;
    

           }
           else
           {
             console.log("Not in Table Format");

           }
            


      },
      innerHtmlChange:function()
      {
          this.parseTableTags();
          
          

      },
      

       
       

      
      
    },
    computed:{


      labelNamefromParent()
      { 
          if(this.labelname)
          {
              return this.labelname;
          }
          else
          {
              return "Enter Value Here";
          }

      },
      dataValue:
      {
          get()
          {

             return this.thevalue;
          },
          set(value)
          {
              this.thevalue = value;
          }

      }, 




    },
    watch:
    {
          thevalue: function (newData, oldData) {

            this.sendDataToMainForm();
           },
        

    },
    



}

</script>

<style scoped>

.v-text-field--outlined >>> fieldset
{
    border-color:#000;
}
.tabledata_paste
{
    width:800px;
    overflow:scroll;
    font-size:16px;
}
.table_flex_row
{
    display: flex; flex-flow: row nowrap; margin-top: 10px;
}
.table_flex_column
{
    display: flex; flex-flow: row nowrap; margin-top: 10px;
}
.header_column
{
    color:blue;
    padding:5px;
    
}
.normal_column
{
    color:#000;
    padding:5px;

}
.row_default
{
-ms-flex: 1; /* IE 10 */
  flex: 1;
}
.column_default
{

}
.table_default 
{
 border-collapse: collapse;
 border:1px solid black;

}
.table_default td
{
 border:1px solid black;

}

.tabledata_paste 
{
  width:500px;
  height:500px;
  background:#ddd;
  border:0px;
  margin-left:auto;
  margin-right:auto;



}

</style>