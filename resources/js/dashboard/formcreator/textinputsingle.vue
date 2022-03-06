

<template>
  <div class="">
    <div class="">
      <div class="custom_label_style1">
        {{ labelNamefromParent }}
      </div>
    </div>
    <v-text-field class="mt-2" color="black" v-model="dataValue">
    </v-text-field>
  </div>
</template>

  <script>
export default {
  props: {
    inputvalue: String,
    labelname: String,
    formuid: Number,
  },

  data: function () {
    return {
      thevalue: "",
      labname: "Enter Value Here",
    };
  },
  created() {},
  mounted() {
    this.thevalue = this.inputvalue;
  },
  methods: {
    sendDataToMainForm: function () {
      this.$emit("messageFromText", this.formuid, this.thevalue);
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
  },
};
</script>

<style scoped>
.v-text-field--outlined >>> fieldset {
  border-color: #000;
}
.custom_label_style1 {
  color: #f64444;
  font-size: 21px;
}
</style>