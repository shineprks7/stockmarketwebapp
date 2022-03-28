

<template>
  <div>

    <div v-if="elementType == 'text'">
       <div :style = "cellStylesText" v-if="displayAs == 'text'">

          {{value}}

       </div>
       <div   v-if="displayAs == 'html'" v-html ="value">

       </div>
    </div>
     <div v-else-if="elementType == 'button'">
 
          <v-btn :color = "this.cellAttributes.hasOwnProperty('color') ? this.cellAttributes.color : black ">  {{value}} </v-btn>

     </div>
     <div v-else-if="elementType == 'image'">
 
          <img class="cell_image_default" v-if="value !=''?true :false" :src="value" :style = "cellStylesText"/> 
          <img class="cell_image_default"  v-else  src="/images/photo.png" :style = "cellStylesText"/> 

     </div>

     <div v-else-if="elementType == 'editicon'">
 
          <img class="cell_icon_default" v-if = "iconurl !=''?true :false" :src="value" :style = "cellStylesText"/> 
          <img class="cell_icon_default"  v-else  src = "/images/edit.png" :style = "cellStylesText"/> 

     </div>
     <div v-else-if="elementType == 'linkicon'">
 
          <img class="cell_icon_default" v-if="iconurl !=''?true :false" :src="value" :style = "cellStylesText"/> 
          <img class="cell_icon_default"  v-else  src = "/images/open.png" :style = "cellStylesText"/> 

     </div>


    
  </div>
</template>

  <script>

export default {
  components: {
  },

  props: {
    elementType:String,
    displayAs:String,
    value:[Array,Number, String],
    iconurl:String,
    redirecturl:String,
    
    cellAttributes:Object,
  },

  data: function () {
    return {
      
      data:'',

        
      };

    
  },
 
  created() {},
  mounted() {},
  methods: {},
  computed: {

      cellStylesText() {

         let color = this.cellAttributes.hasOwnProperty('color') ? this.cellAttributes.color : 'inherit';
        

          return {
           color : color,   

          };


      }
  },
  watch: {},
};
</script>

<style scoped>
.cell_image_default
{
  width:40px;
  height:40px;
}
.cell_icon_default
{
  width:20px;
  height:20px;
}
</style>