

<template>

      <div class="" >
            
        
          <div>

          <div class="">
                <div class="custom_label_style1">
                         {{labelNamefromParent}}
                </div>

            </div>

             <div class="mt-10 ml-6">

                 <img  class="image_upload_icon" :src="activeImageBind()" v-on:click="triggerFileUpload($event)"/>

                  <input type="file" class="ref_image_upload" accept="image/*" ref="image_file_upload" v-on:change="upload_image_icon()" name="" hidden>

             </div>
             



          </div> 

           



      </div>





  </template>

  <script>

    export default {

    props:{

        inputvalue:String,
        uploadurl:String,
        labelname:String,
        formuid:[Number,String],
        rerender:Boolean,



     
     



    },

    data: function () {
        return {
             thevalue:'',
             labname:'Enter Value Here',
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {
        this.thevalue = this.inputvalue;

    },
    methods:{
      asset(path) {
            var base_path = window._asset || '';
            return base_path + path;
        },
    triggerFileUpload:function(event)
        {


           var targetel = event.target.parentElement.querySelector(".ref_image_upload").click();
           console.log("Target Element:"+targetel);


    },
     sendDataToMainForm:function()
      {
           this.$emit('messageFromText',this.formuid,this.thevalue);
      },

      activeImageBind:function()
      {
          if(this.thevalue !="")
          {
              return this.thevalue;
          }
          else
          {
            
             return "/images/photo.png";
              
          }

      },

     upload_image_icon:function()
      {

       if(this.uploadurl)
       {

        console.log(this.uploadurl);
     
        //var  imageicon = this.$refs.image_file_upload.files[0];
          
           var imageicon = event.target.files[0];

         let formData = new FormData();
  
         formData.append('imageicon', imageicon);


         Object.keys(this.queryList).forEach(function(item, index)
         {

           formData.append(item, this.queryList[item]);

         }, this);




         
 
  
          console.log("query List"+formData);

       axios.post(this.uploadurl,
       formData,
       {
          headers: {
          'Content-Type': 'multipart/form-data'
                 }
       }
      
        )
            .then((response) => { 
          console.log("response:",response.data)
                  if(response.status==200)
                    {
       
                     
                    if(response.data[0]=="success")
                   {       

          

                      if(response.data[1])
                      {
                     
                        this.thevalue =  response.data[1];
                        

                      }

                   }

  
                   }
                   else
                   {
                         
                       console.log("Response :-"+response.data);
  
                    
  
  
  
  
                    }
  
            }, 
           
                  (error)=> {
                console.log(error)
  
  
              }
         
                 );
  
          }
        
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
      queryList()
        {
          return this.$route.query;
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
.image_wrapper
{
    

}
.image_upload_icon
{

    width:100px;
    height:100px;
   

}

.custom_label_style1
{
    color:rgb(80, 67, 67);
    font-size:16px;

    font-weight:600;

}

.hidden_input
{
      border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

</style>