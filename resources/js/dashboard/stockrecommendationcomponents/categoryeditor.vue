

<template>
  <v-container class="">
    <section style="transform: rotate(0deg)" v-if="!updatesuccess">
      <header class="title_text">CATEGORY</header>

      <v-divider class="mt-3 mb-4"> </v-divider>

      <v-row class="">
        <v-col
          class="tab_input_default"
          v-on:click="activateMaintab(tab)"
          v-bind:class="classBindingMaintab(tab.name)"
          v-for="(tab, index) in tablist"
          :key="index"
        >
          {{ tab.displayname }}
        </v-col>
      </v-row>

      <div v-if="toggleSubcategory()">
        <header class="mt-5 title_text">SUBCATEGORY</header>

        <v-divider class="mt-3 mb-4"> </v-divider>
      </div>

      <v-row v-if="togglecheckIntradaySubTab()" class="">
        <v-col
          class="tab_input_default"
          v-on:click="activateIntradaytab(intratab)"
          v-bind:class="classBindingIntradaytab(intratab.name)"
          v-for="(intratab, index) in intradaytabs"
          :key="index"
        >
          {{ intratab.displayname }}
        </v-col>
      </v-row>

      <v-row v-if="togglecheckFutureSubTab()" class="">
        <v-col
          class="tab_input_default"
          v-on:click="activateFuturestab(futuretab)"
          v-bind:class="classBindingFuturestab(futuretab.name)"
          v-for="(futuretab, index) in futurestabs"
          :key="index"
        >
          {{ futuretab.displayname }}
        </v-col>
      </v-row>

      <div></div>

      <footer class="mt-10">
        <div class="d-flex flex-row-reverse">
          <div
            v-if="meetValidationSelectedFields()"
            class="status_button_default status_submit_button"
            v-on:click="updateValues()"
          >
            <span v-if="!updaterequest"> UPDATE </span>
            <span v-if="updaterequest"> UPDATING... </span>
          </div>

          <div
            v-if="!meetValidationSelectedFields()"
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
    id: Number,

    tabname: String,
    subtabname: String,
  },

  data: function () {
    return {
      tablist: [
        { id: 1, name: "intraday", displayname: "Intra Day" },
        { id: 2, name: "shortterm", displayname: "Short Term" },
        {
          id: 3,
          name: "futuresandoptions",
          displayname: "Futures and Options",
        },
      ],

      intradaytabs: [
        { id: 1, name: "intradaycash", displayname: "IntraDay Cash" },
        {
          id: 1,
          name: "intradayderivatives",
          displayname: "Intra Day Derivatives",
        },
      ],

      futurestabs: [
        { id: 1, displayname: "Index Futures", name: "indexfutures" },
        { id: 2, displayname: "Stock Futures", name: "stockfutures" },
        { id: 3, displayname: "Index Options", name: "indexoptions" },
        { id: 4, displayname: "Stock Options", name: "stockoptions" },
      ],

      activemaintab: "",

      activeintradaytab: "",

      activefuturestab: "",

      newstatus: "",

      updaterequest: false,
      updatesuccess: false,
    };
  },
  created() {},
  mounted() {
    this.onloadData();
  },
  methods: {
    onloadData: function () {
      this.activemaintab = this.tabname;

      if (this.tabname == "intraday") {
        this.activeintradaytab = this.subtabname;
      } else if (this.tabname == "futuresandoptions") {
        this.activefuturestab = this.subtabname;
      }
    },
    updateValues: function () {
      this.updaterequest = true;
      axios
        .post("/api/updaterecommendationtabs", {
          id: this.id,
          tabname: this.activemaintab,
          subtabname: this.dataSubTab,
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

    activateMaintab: function (value) {
      this.activemaintab = value.name;
    },
    activateIntradaytab: function (value) {
      this.activeintradaytab = value.name;
    },
    activateFuturestab: function (value) {
      this.activefuturestab = value.name;
    },
    toggleSubcategory: function () {
      return this.activemaintab != "shortterm" ? true : false;
    },
    togglecheckIntradaySubTab: function () {
      return this.activemaintab == "intraday" ? true : false;
    },
    togglecheckFutureSubTab: function () {
      return this.activemaintab == "futuresandoptions" ? true : false;
    },

    classBindingMaintab: function (value) {
      return this.activemaintab == value
        ? "tab_input_active"
        : "tab_input_inactive";
    },
    classBindingIntradaytab: function (value) {
      return this.activeintradaytab == value
        ? "tab_input_active"
        : "tab_input_inactive";
    },

    classBindingFuturestab: function (value) {
      return this.activefuturestab == value
        ? "tab_input_active"
        : "tab_input_inactive";
    },

    closeEditor: function () {
      this.$store.commit("stockrecommendationsstore/invokeeditor", false);
    },

    meetValidationSelectedFields: function () {
      if (this.activemaintab != "") {
        if (this.activemaintab == "intraday") {
          return this.activateIntradaytab != "" ? true : false;
        } else if (this.activemaintab == "futuresandoptions") {
          return this.activefuturestab != "" ? true : false;
        } else if (this.activemaintab == "shortterm") {
          return true;
        }
      } else {
        return false;
      }
    },
  },
  computed: {
    dataSubTab: function () {
      if (this.activemaintab == "intraday") {
        return this.activeintradaytab;
      } else if (this.activemaintab == "futuresandoptions") {
        return this.activefuturestab;
      } else {
        return "";
      }
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
  width: 130px;
  padding: 5px;
  padding-top: 7px;
  padding-bottom: 7px;
  text-align: center;
  border-radius: 5px;
  margin-right: 20px;
  font-size: 16px;
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