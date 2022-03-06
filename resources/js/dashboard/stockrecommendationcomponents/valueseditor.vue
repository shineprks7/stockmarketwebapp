

<template>
  <v-container class="">
    <section v-if="!updatesuccess">
      <v-row>
        <v-col cols="4">
          <v-text-field outlined dense color="black" v-model="dataScrip">
            <template v-slot:label>
              <span style="color: black"> Scrip Name</span>
            </template>
          </v-text-field>
        </v-col>

        <v-col cols="4">
          <v-text-field outlined dense color="black" v-model="dataEntryprice">
            <template v-slot:label>
              <span style="color: black"> Entry Price</span>
            </template>
          </v-text-field>
        </v-col>

        <v-col cols="4">
          <v-text-field outlined dense color="black" v-model="dataTarget1">
            <template v-slot:label>
              <span style="color: black"> Target 1</span>
            </template>
          </v-text-field>
        </v-col>

        <v-col cols="4">
          <v-text-field outlined dense color="black" v-model="dataTarget2">
            <template v-slot:label>
              <span style="color: black"> Target 2</span>
            </template>
          </v-text-field>
        </v-col>
        <v-col cols="4">
          <v-text-field outlined dense color="black" v-model="dataStoploss">
            <template v-slot:label>
              <span style="color: black"> Stop Loss</span>
            </template>
          </v-text-field>
        </v-col>
        <v-col cols="4" v-if="tabname == 'futuresandoptions'">
          <v-text-field outlined dense color="black" v-model="dataLotsize">
            <template v-slot:label>
              <span style="color: black"> Lot Size</span>
            </template>
          </v-text-field>
        </v-col>
      </v-row>

      <div>
        {{ this.meetValidationFields() }}
      </div>

      <footer class="mt-10">
        <div class="d-flex flex-row-reverse">
          <div
            v-if="meetValidationFields()"
            class="status_button_default status_submit_button"
            v-on:click="updateValues()"
          >
            <span v-if="!updaterequest"> UPDATE </span>
            <span v-if="updaterequest"> UPDATING... </span>
          </div>

          <div
            v-if="!meetValidationFields()"
            class="status_button_default status_submit_button_inactive"
          >
            UPDATE
          </div>

          <div
            class="status_button_default status_cancel_button"
            v-on:click="closeEditor()"
          >
            CANCEL
          </div>
        </div>
      </footer>
    </section>

    <section v-if="updatesuccess">SuccessFully Updated!</section>
  </v-container>
</template>

  <script>
export default {
  props: {
    currentstatus: String,
    id: Number,
    scrip: String,
    entryprice: Number,
    target1: Number,
    target2: Number,
    stoploss: Number,
    lotsize: Number,

    tabname: String,
  },

  data: function () {
    return {
      newScrip: "",
      newEntryprice: "",
      newTarget1: "",
      newTarget2: "",
      newStoploss: "",
      newLotsize: "",

      validation: {
        newScrip: false,
        newEntryprice: false,
        newTarget1: false,
        newTarget2: false,
        newStoploss: false,
        newLotsize: false,
      },

      updaterequest: false,
      updatesuccess: false,
    };
  },
  created() {},
  mounted() {
    this.onloadData();
  },
  methods: {
    updateValues: function () {
      this.updaterequest = true;
      axios
        .post("/api/updaterecommendationvalues", {
          id: this.id,
          scrip: this.dataScrip,
          entryprice: this.dataEntryprice,
          target1: this.dataTarget1,
          target2: this.dataTarget2,
          stoploss: this.dataStoploss,
          lotsize: this.dataLotsize,
        })
        .then(
          (response) => {
            console.log("response:", response.data);
            this.updaterequest = false;

            if (response.status == 200) {
              if (response.data[0] == "success") {
                console.log("Success ");
                this.updatesuccess = true;

                setTimeout(
                  function () {
                    this.closeEditor();
                  }.bind(this),
                  1000
                );
              } else {
              }
            } else {
              console.log("Your request is Unsuccessfull");
            }
          },

          (error) => {
            console.log(error);
          }
        )
        .catch((error) => {
          console.log(error.response);
        });
    },
    validateFields: function () {
      this.validation.newScrip = this.newScrip != "" ? true : false;
      this.validation.newEntryprice = this.newEntryprice != "" ? true : false;
      this.validation.newTarget1 = this.newTarget1 != "" ? true : false;
      this.validation.newTarget2 = this.newTarget2 != "" ? true : false;
      this.validation.newStoploss = this.newStoploss != "" ? true : false;
      this.validation.newLotsize = this.newLotsize != "" ? true : false;
    },
    meetValidationFields: function () {
      if (this.tabname == "futuresandoptions") {
        if (
          this.validation.newLotsize &&
          this.validation.newScrip &&
          this.validation.newStoploss &&
          this.validation.newEntryprice &&
          this.validation.newTarget1 &&
          this.validation.newTarget2
        ) {
          return true;
        } else {
          return false;
        }
      } else if (this.tabname == "shortterm" || this.tabname == "intraday") {
        if (
          this.validation.newScrip &&
          this.validation.newStoploss &&
          this.validation.newEntryprice &&
          this.validation.newTarget1 &&
          this.validation.newTarget2
        ) {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    },

    closeEditor: function () {
      this.$store.commit("stockrecommendationsstore/invokeeditor", false);
    },
    onloadData: function () {
      this.newScrip = this.scrip;
      this.newEntryprice = this.entryprice;
      this.newTarget1 = this.target1;
      this.newTarget2 = this.target2;
      this.newStoploss = this.stoploss;
      this.newLotsize = this.lotsize;

      this.validateFields();
    },
  },
  computed: {
    dataScrip: {
      get() {
        this.validation.newScrip = this.newScrip != "" ? true : false;

        return this.newScrip;
      },
      set(value) {
        this.newScrip = value;
      },
    },
    dataEntryprice: {
      get() {
        this.validation.newEntryprice = this.newEntryprice != "" ? true : false;

        return this.newEntryprice;
      },
      set(value) {
        this.newEntryprice = value;
      },
    },
    dataTarget1: {
      get() {
        this.validation.newTarget1 = this.newTarget1 != "" ? true : false;

        return this.newTarget1;
      },
      set(value) {
        this.newTarget1 = value;
      },
    },
    dataTarget2: {
      get() {
        this.validation.newTarget2 = this.newTarget2 != "" ? true : false;

        return this.newTarget2;
      },
      set(value) {
        this.newTarget2 = value;
      },
    },
    dataStoploss: {
      get() {
        this.validation.newStoploss = this.newStoploss != "" ? true : false;
        return this.newStoploss;
      },
      set(value) {
        this.newStoploss = value;
      },
    },
    dataLotsize: {
      get() {
        this.validation.newLotsize = this.newLotsize != "" ? true : false;

        return this.newLotsize;
      },
      set(value) {
        this.newLotsize = value;
      },
    },
  },
  watch: {},
};
</script>

<style scoped>
.v-text-field--outlined >>> fieldset {
  border-color: #000;
}

.wrapper_status_changer {
  height: 300px;
  padding: 50px;
  border: 2px solid black;
  border-radius: 10px;
  background: #fff;
  font-family: "Poppins", sans-serif;
  min-width: 800px;
}
.title_text {
  font-size: 20px;
  color: #4340e1;
  font-weight: bold;
}
.tab_input_default {
  width: 160px;
  padding: 5px;
  padding-top: 7px;
  padding-bottom: 7px;
  text-align: center;
  border-radius: 5px;
}
.tab_input_active {
  background-color: #fe5d26;
  color: #fff;
  border: 1.5px solid #fe5d26;
}
.tab_input_inactive {
  background-color: fff;
  color: #000;
  border: 1.5px solid #000;
}

.status_button_default {
  width: 140px;
  padding: 5px;
  padding-top: 7px;
  padding-bottom: 7px;
  text-align: center;
  border-radius: 5px;
  font-size: 18px;
}
.status_cancel_button {
  background-color: fff;
  color: #d67114;
  border: 1.5px solid #d67114;
  margin-right: 30px;
  cursor: pointer;
}
.status_submit_button {
  background-color: #4340e1;
  color: #fff;
  border: 1.5px solid #4340e1;
  cursor: pointer;
}
.status_submit_button_inactive {
  background-color: #4340e1;
  color: #fff;
  border: 1.5px solid #4340e1;
  opacity: 0.6;
  cursor: not-allowed;
}
</style>