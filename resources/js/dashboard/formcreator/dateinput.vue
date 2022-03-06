

<template>
  <div class="">
    <v-text-field
      dense
      color="black"
      v-model="dataValue"
      type="date"
      :label="labelNamefromParent"
    >
      <template v-slot:label="{ label }">
        <span style="color: black"> {{ label }} </span>
      </template>
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
    if (this.inputvalue) {
      this.thevalue = this.inputvalue;
    } else {
      this.onloaddate();
    }
  },
  methods: {
    sendDataToMainForm: function () {
      this.$emit("messageFromText", this.formuid, this.thevalue);
    },
    onloaddate: function () {
      const date = new Date();
      date.setDate(date.getDate());

      var n = date.toISOString().substr(0, 10);

      this.thevalue = n;
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
</style>