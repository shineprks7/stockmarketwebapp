

<template>
  <div>

    <div v-if="elementType == 'text'">
       <div :style = "cellStylesText" v-if="displayAs == 'text'">

          {{value}}

       </div>
       <div :style = "cellStylesText"  v-if="displayAs == 'html'" v-html ="value">

       </div>
    </div>
     <div v-else-if="elementType == 'button'">
 
          <v-btn :color = "this.cellAttributes.hasOwnProperty('color') ? this.cellAttributes.color : black ">  {{value}} </v-btn>

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
</style>