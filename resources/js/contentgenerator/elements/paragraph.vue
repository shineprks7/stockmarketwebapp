

<template>


      <div>
       <p :style = "createStylesFromPresets()" :class = "this.classes ? this.classes :''" >

          {{this.text}}
      
       </p>

       </div>








  </template>

  <script>

  import theme1styles from  "../themes/themedata1.js";

    import merge from 'lodash/merge';

      import isobject from "lodash/isObject";



    export default {

      components:{

        

   

    },
    mixins:[theme1styles],


    props:{

     value:String,
     elementid:[Number, String],
     presets:String,
     styles:String,
     classes:String,
     indent:'',

    },

    data: function () {
        return {

     
          

            presetdata:'',
            text:'',
            activetheme:'theme1',


      
          
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {
         
         if(this.presets)
         {
           this.presetdata = this.presets;

         }
         if(this.value)
         {
           this.text = this.value;
         }
    

    },
    methods:{

      itemPresets() {
      let emptyarr = [];

      if (this.presetdata != "") {
        return this.presets.split(",");
      } else {
        return emptyarr;
      }
    },

    createStylesFromPresets: function () {
      
        let presetsarray = this.itemPresets();

        var styleobject = new Object();

        var getPresetFontColor = function (preset) {
          var colorspreset = { ...this.theme1.colors };

          if (colorspreset.hasOwnProperty(preset)) {
            styleobject["color"] = colorspreset[preset];
          } else {
          }
        };

        var getPresetFontSize = function (preset) {
          var fontpresets = { ...this.theme1.fontsizes };

          if (fontpresets.hasOwnProperty(preset)) {
            styleobject["fontSize"] = fontpresets[preset];
          } else {
            console.log("Doen't have font presets " + preset);
          }
        };
        var getPresetStyle = function (preset) {
          let genpresets = this[this.activetheme].general;

          if (genpresets.hasOwnProperty(preset)) {
            if (isobject(genpresets[preset])) {
              for (var key of Object.keys(genpresets[preset])) {
                styleobject[key] = genpresets[preset][key];
              }
            }
          }
        };

        if (presetsarray.length > 0) {
          for (var i = 0; i < presetsarray.length; i++) {
            getPresetFontColor.call(this, presetsarray[i].trim());

            getPresetFontSize.call(this, presetsarray[i].trim());
            getPresetStyle.call(this, presetsarray[i].trim());
          }
        }

         if(this.indent)
        {
        styleobject['textIndent'] = this.indent;
        }

       if(this.styles)
       {

        var mergedstyle = isobject(this.styles) ? merge(styleobject, this.styles) : styleobject;

        return mergedstyle;



       }

        return styleobject;
      
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


</style>