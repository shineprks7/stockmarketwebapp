

<template>
  <v-container class="">
    <div class="d-flex align-center justify-center">
      <div class="wrapper_status_changer">
        <section v-if="!updatesuccess">
          <div class="header_info">
            <span class="title_text">CHANGE STATUS -</span>
            <span v-if="this.TabDisplayname()">
              {{ this.TabDisplayname() }} /
            </span>
            <span v-if="this.subTabDisplayname()">
              {{ this.subTabDisplayname() }} / </span
            >{{ this.scripname }}
          </div>
          <v-divider class="mt-3 mb-10"> </v-divider>

          <div class="d-flex align-center justify-space-between">
            <div
              class="tab_status_default"
              v-on:click="activateNewStatus(status)"
              v-bind:class="classBindingStatus(status.name)"
              v-for="(status, index) in statuslist"
            >
              {{ status.displayname }}
            </div>
          </div>
          <footer class="mt-10">
            <div class="d-flex flex-row-reverse">
              <div
                class="status_button_default status_submit_button"
                v-on:click="updateStatus()"
              >
                <span v-if="!updaterequest"> CONFIRM </span>
                <span v-if="updaterequest"> SAVING... </span>
              </div>
              <div
                class="status_button_default status_cancel_button"
                v-on:click="cancelStatusChanger()"
              >
                CANCEL
              </div>
            </div>
          </footer>
        </section>

        <section v-if="updatesuccess">SuccessFully Updated!</section>
      </div>
    </div>
  </v-container>
</template>

  <script>
export default {
  props: {
    currentstatus: String,
    id: Number,
    subtabname: String,
    tabname: String,
    scripname: String,
  },

  data: function () {
    return {
      statuslist: [
        { id: 1, name: "open", displayname: "Open" },
        { id: 2, name: "target1", displayname: "Target 1 Achieved" },
        { id: 3, name: "target2", displayname: "Target 2 Achieved" },
        { id: 4, name: "loss", displayname: "Loss" },
      ],

      newstatus: "",

      updaterequest: false,
      updatesuccess: false,
    };
  },
  created() {},
  mounted() {},
  methods: {
    updateStatus: function () {
      this.updaterequest = true;
      axios
        .post("/api/updatestatus", {
          id: this.id,
          status: this.newStatusComputed,
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
                    this.cancelStatusChanger();
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

    activateNewStatus: function (value) {
      this.newstatus = value.name;
    },

    classBindingStatus: function (value) {
      return this.newStatusComputed == value
        ? "tab_status_active"
        : "tab_status_inactive";
    },

    TabDisplayname: function () {
      var value = this.tabname;
      if (value == "intraday") {
        return "Intra Day";
      } else if (value == "shortterm") {
        return "Short Term";
      } else if (value == "futuresandoptions") {
        return "Futures and Options";
      } else {
        return "";
      }
    },
    subTabDisplayname: function () {
      var value = this.subtabname;
      if (value == "intradaycash") {
        return "Cash";
      } else if (value == "intradayderivatives") {
        return "Derivatives";
      } else if (value == "indexfutures") {
        return "Index Futures";
      } else if (value == "stockfutures") {
        return "Stock Futures";
      } else if (value == "indexoptions") {
        return "Index Options";
      } else if (value == "stockoptions") {
        return "Stock Options";
      } else {
        return "";
      }
    },
    cancelStatusChanger: function () {
      this.$store.commit("stockrecommendationsstore/invokestatuschange", false);
    },
  },
  computed: {
    statusFromParent() {
      return this.currentstatus;
    },
    newStatusComputed: function () {
      if (this.newstatus != "") {
        return this.newstatus;
      } else {
        return this.statusFromParent;
      }
    },
  },
  watch: {},
};
</script>

<style scoped>
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
.tab_status_default {
  width: 160px;
  padding: 5px;
  padding-top: 7px;
  padding-bottom: 7px;
  text-align: center;
  border-radius: 5px;
}
.tab_status_active {
  background-color: #fe5d26;
  color: #fff;
  border: 1.5px solid #fe5d26;
}
.tab_status_inactive {
  background-color: fff;
  color: #000;
  border: 1.5px solid #000;
}
.header_info {
  font-weight: bold;
  font-size: 18px;
  color: #197278;
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
}
.status_submit_button {
  background-color: #4340e1;
  color: #fff;
  border: 1.5px solid #4340e1;
}
</style>