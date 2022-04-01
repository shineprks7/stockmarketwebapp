

<template>
  <div class="">
    <section v-if = "checkcellDataType() == 'array'? true : false">

    <div v-for="(item, index) in this.itemlists" :key="index" >
      <div
        :class="item.class"
        :style="createStylesFromPresets(item)"
        v-if="conditionalText(item, 'text')"
      >
        {{ item.text }}
      </div>
      <div :class="item.class" v-else-if="conditionalText(item, 'preIconText')">
        <div class="d-flex">
          <div>
            <img
              style="width: 1.2em; height: 1.2em"
              :style="createStylesFromPresetsForIcon(item)"
              :src="item.preicon"
            />
          </div>
          <div :style="createStylesFromPresets(item)">{{ item.text }}</div>
        </div>
      </div>
      <div
        :class="item.class"
        v-else-if="conditionalText(item, 'postIconText')"
      >
        <div class="d-flex">
          <div :style="createStylesFromPresets(item)">{{ item.text }}</div>
          <div>
            <img
              style="width: 1.2em; height: 1.2em"
              :style="createStylesFromPresetsForIcon(item)"
              :src="item.posticon"
            />
          </div>
        </div>
      </div>

      <div
        :class="item.class"
        v-else-if="conditionalText(item, 'externaltext')"
      >
        External Text
      </div>
      <div
        :class="item.class"
        v-else-if="conditionalText(item, 'externalhtml')"
      >
        External Html
      </div>
    </div>

    </section>

        <section v-else-if = "checkcellDataType() == 'object'? true : false">


      <div
       :class="item.class ? item.class :''"

        :style="createStylesFromPresets(item)"
        v-if="conditionalText(item, 'text')"
      >
        {{ item.text }}
      </div>
      <div         :class="item.class ? item.class :''"  v-else-if="conditionalText(item, 'preIconText')">
        <div class="d-flex">
          <div>
            <img
              style="width: 1.2em; height: 1.2em"
              :style="createStylesFromPresetsForIcon(item)"
              :src="item.preicon"
            />
          </div>
          <div :style="createStylesFromPresets(item)">{{ item.text }}</div>
        </div>
      </div>
      <div
        :class="item.class ? item.class :''"
        v-else-if="conditionalText(item, 'postIconText')"
      >
        <div class="d-flex">
          <div :style="createStylesFromPresets(item)">{{ item.text }}</div>
          <div>
            <img
              style="width: 1.2em; height: 1.2em"
              :style="createStylesFromPresetsForIcon(item)"
              :src="item.posticon"
            />
          </div>
        </div>
      </div>

      <div
        :class="item.class ? item.class :''"

        :style="createStylesFromPresets(item)"
        v-else-if="conditionalText(item, 'externaltext')"
      >
         {{parseExternalData(item)}}
      </div>
      <div
        :class="item.class ? item.class :''"
        :style="createStylesFromPresets(item)"
        v-else-if="conditionalText(item, 'externalhtml')"
      >
            {{parseExternalData(item)}}

      </div>

    </section>

  </div>
</template>

  <script>
import theme1styles from "../themes/themedata1.js";

import isobject from "lodash/isObject";
import moment from "moment";

import get from 'lodash/get';


export default {
  components: {},
  mixins: [theme1styles],

  props: {
    cellData: [Object, Array],
    elementid: [String, Number],
    externalData: [Object, Array],

    theme: String,
  },

  data: function () {
    return {
      itemlists: [],

      item: {},

      iconspacing: "10px",

      activetheme: "theme1",

      mounted: false,
    };
  },
  created() {},
  mounted() {
    if (Array.isArray(this.cellData)) {
      this.itemlists = this.cellData;
    } else if (isobject(this.cellData)) {
      this.item = this.cellData;
    } else {
    }

    this.mounted = true;

    if (this.theme) {
      this.activetheme = this.theme;
    }
  },
  methods: {

    format:function(value, format, formattype)
    {
     var defaultdateformat = "Do MMM, YY";

    var  formatIndianCurrency = function (value) {
       return value.toLocaleString("en-in", {
        style: "currency",
        currency: "INR",
      });
    };

     var formatDate = function (value) {
         if(formattype)
          {
          return moment(value).format(formattype);
          }
          else
          {
            return moment(value).format(defaultdateformat);

          }
      }
       
       if(format === 'currrency')

       {
               return formatIndianCurrency();
       }
       else if(format === 'date')
       {

                return formatDate();
       }
       else
       {
         return value;
       }
     


    },
    parseExternalData:function(item)
    {
      var val =   get(this.externalData, item.external);


      if(item.hasOwnProperty('format'))
      {
        let args = [val];

        let formats = item.format.split(",");

            formats.forEach(function (el,index){
               args.push(el.trim());
            });

           return this.format.apply(null, args);

         

      }
      else
      {
        return val;
      }
    },

    checkcellDataType: function () {
      if (Array.isArray(this.cellData)) {
          
          return 'array';

      } else if (isobject(this.cellData)) {
        
        return 'object';
      } else {

        return 'other';
      }
    },
    textType: function (item) {
      if (item.hasOwnProperty("text") && item.hasOwnProperty("preicon")) {
        return "preIconText";
      } else if (
        item.hasOwnProperty("text") &&
        item.hasOwnProperty("posticon")
      ) {
        return "postIconText";
      } else if (item.hasOwnProperty("text")) {
        return "text";
      } else if (
        item.hasOwnProperty("external") &&
        item.hasOwnProperty("type")
      ) {
        if (item.type == "text") {
          return "externaltext";
        } else if (item.type == "html") {
          return "externalhtml";
        } else {
          return "null";
        }
      } else {
        return "null";
      }
    },
    conditionalText: function (item, type) {
      let texttype = this.textType(item);

      if (texttype == type) {
        return true;
      } else {
        return false;
      }
    },
    itemPresets(item) {
      let emptyarr = [];

      if (item.hasOwnProperty("presets")) {
        return item.presets.split(",");
      } else {
        return emptyarr;
      }
    },

    createStylesFromPresets: function (item) {
      if (this.mounted) {
        let presetsarray = this.itemPresets(item);

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

        return styleobject;
      }
    },
    createStylesFromPresetsForIcon: function (item) {
      if (this.mounted) {
        let presetsarray = this.itemPresets(item);

        var styleobject = new Object();

        var getPresetStyle = function (preset) {
          let genpresets = this[this.activetheme].icon;

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
            getPresetStyle.call(this, presetsarray[i].trim());
          }
        }

        return styleobject;
      }
    },
  },
  computed: {},
  watch: {},
};
</script>

<style scoped>
</style>