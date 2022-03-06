

<template>
  <v-container class="">
    <section v-if="!updatesuccess">
      <div class="ml-16 d-flex align-center">
        <div
          class="tab_status_default mr-5"
          v-on:click="activateNewAction(action)"
          v-bind:class="classBindingAction(action.name)"
          v-for="(action, index) in actionlist"
        >
          {{ action.displayname }}
        </div>
      </div>
      <footer style="margin-top: 200px">
        <div class="d-flex flex-row-reverse">
          <div
            class="status_button_default status_submit_button"
            v-on:click="updateAction()"
          >
            <span v-if="!updaterequest"> CONFIRM </span>
            <span v-if="updaterequest"> SAVING... </span>
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
    currentaction: String,
    id: Number,
  },

  data: function () {
    return {
      actionlist: [
        { id: 1, name: "buy", displayname: "BUY" },
        { id: 2, name: "sell", displayname: "SELL" },
      ],

      newaction: "",

      updaterequest: false,
      updatesuccess: false,
    };
  },
  created() {},
  mounted() {},
  methods: {
    updateAction: function () {
      this.updaterequest = true;
      axios
        .post("/api/updaterecommendationaction", {
          id: this.id,
          action: this.newActionComputed,
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

    activateNewAction: function (value) {
      this.newaction = value.name;
    },

    classBindingAction: function (value) {
      return this.newActionComputed == value
        ? "tab_status_active"
        : "tab_status_inactive";
    },

    closeEditor: function () {
      this.$store.commit("stockrecommendationsstore/invokeeditor", false);
    },
  },
  computed: {
    actionFromParent() {
      return this.currentaction;
    },
    newActionComputed: function () {
      if (this.newaction != "") {
        return this.newaction;
      } else {
        return this.actionFromParent;
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