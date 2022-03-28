

<template>
  <div class="">
    <v-select
      v-model="dataValue"
      :items="copyOptions"
      :item-text="(item) => item.displayname"
      :item-value="(item) => item.name"
      outlined
      dense
      :label="labelNamefromParent"
    >
      <template v-slot:label="{ label }">
        <span class="input__label">{{ label }} </span>
      </template>
    </v-select>


    <div></div>
  </div>
</template>

  <script>
import get from "lodash/get";

import isobject from "lodash/isObject";

export default {
  props: {
    options: Array,

    inputvalue: [String, Number],
    labelname: String,
    formuid:[Number,String],
    optionconditions: Array,

    uids: [Array, Object],
    rerender:Boolean,
    required:Boolean,

  },

  data: function () {
    return {
      thevalue: "",
      labname: "Enter Value Here",

      copyOptions: [],
      copyOptionConditions: [],
    };
  },
  created() {},
  mounted() {
    this.thevalue = this.inputvalue;
    this.copyOptions = this.options;
    if (this.optionconditions) {
      this.copyOptionConditions = this.optionconditions;
    }
  },
  methods: {
    setToDefault:function()
      {
               this.thevalue = "";

      },
    sendDataToMainForm: function () {
      this.$emit("messageFromText", this.formuid, this.thevalue);
    },

    checkCondition: function (arr) {
      let value1 = arr[0];
      let op = arr[1];
      let value2 = arr[2];
      if (value1 != "" && value2 != "") {
        switch (op) {
          case ">":
            return value1 > value2;
          case "<":
            return value1 < value2;
          case ">=":
            return value1 >= value2;
          case "<=":
            return value1 <= value2;
          case "=":
            return value1 == value2;
          case "!=":
            return value1 != value2;
          case "!==":
            return value1 !== value2;
        }
      } else {
        return null;
      }
    },
     checkConditionMultiple: function (arr1, arr2,arr3) {
     
          if(this.checkCondition !=null)
          {
           return   this.checkCondition(arr1) ? this.checkCondition(arr2) : this.checkCondition(arr3) ;
          }
          else
          {
              return null;
          }
    },
    parseGet(obj, itemobj) {
      if (obj.hasOwnProperty("get")) {
        return get(this.uids, obj.get);
      } else if (obj.hasOwnProperty("getEl")) {
        return get(itemobj, obj.getEl);
      } else {
        return null;
      }
    },
    loopThroughConditions:function(conditionarr, itemobj)
    {

          var parsedCondition = [];

      for (var j = 0; j < conditionarr.length; j++) {
        if (isobject(conditionarr[j])) {
         

          var tempcond = this.parseGet(
            { ...conditionarr[j] },
            itemobj
          );

          parsedCondition.push(tempcond);
        } else {
          parsedCondition.push(conditionarr[j]);
        }
      }

      return parsedCondition;

    },
    executeConditionsFilter: function (itemobj,i) {
    
          let filtercondition =   this.loopThroughConditions(this.copyOptionConditions[i].condition,itemobj);

        return this.checkCondition(filtercondition);
    },

    executeConditionsIfThen: function (itemobj,i) {
      
          let condition =   this.loopThroughConditions(this.copyOptionConditions[i].condition,itemobj);

          let pass =   this.loopThroughConditions(this.copyOptionConditions[i].true,itemobj);
          let fail =   this.loopThroughConditions(this.copyOptionConditions[i].false,itemobj);

          console.log("conditions Array -:"+condition);
          console.log("conditions Array -:"+pass);
          console.log("conditions Array -:"+fail);

        return this.checkConditionMultiple(condition, pass, fail);
    },

    compareConditions: function (itemobj) {
      if (this.copyOptionConditions) {

        let condtionres = [];
        for (let i = 0; i < this.copyOptionConditions.length; i++) {

          if (this.copyOptionConditions[i].type == "filter") {
               console.log("condition check filter -" +itemobj.name);

            

            condtionres.push(this.executeConditionsFilter(itemobj,i));
          } 
           else if (this.copyOptionConditions[i].type == "ifthen") {
               console.log("condition check if then -" +itemobj.name);
              let conditioncheck = this.executeConditionsIfThen(itemobj,i);

            condtionres.push(conditioncheck);
          }else {
          }
        }

        console.log("condtionres -:" + condtionres);
        var indexconditionres = condtionres.indexOf(false);

        return indexconditionres > -1 ? false : true;
      } else {
        return true;
      }
    },

    conditionedItems: function () {
      let newarray = [];
      for (let i = 0; i < this.options.length; i++) {
        var arrobj = { ...this.options[i] };

        if (this.compareConditions(arrobj)) {
          newarray.push(arrobj);
        }
      }

      this.copyOptions = newarray;

      return newarray;
    },
  },
  computed: {
    labelNamefromParent() {
      if (this.labelname) {
        return this.labelname;
      } else {
        return "Enter Value Here";
      }
    },
    dataValue: {
      get() {
        return this.thevalue;
      },
      set(value) {
        this.thevalue = value;
      },
    },
  },
  watch: {
    thevalue: function (newData, oldData) {
      this.sendDataToMainForm();
    },
    uids: function (newdata, olddata) {
      this.copyOptions = [];
      this.conditionedItems();
    },
     rerender:function(data, oldData)
        {
             if(data != oldData)
             {
                 this.setToDefault();
             }

        },
  },
};
</script>

<style scoped>
.v-text-field--outlined >>> fieldset {
  border-color: #000;
}
</style>