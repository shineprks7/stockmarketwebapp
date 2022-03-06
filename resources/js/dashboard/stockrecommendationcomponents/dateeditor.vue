

<template>
  <v-container class="">
    <section v-if="!updatesuccess">
      <div class="d-flex align-center justify-center">
        <div class="">
          <v-text-field
            outlined
            dense
            color="black"
            v-model="dataRecommendationdate"
            type="date"
          >
            <template v-slot:label>
              <span style="color: black"> ENTER DATE</span>
            </template>
          </v-text-field>
        </div>
      </div>
      <footer class="mt-10">
        <div class="d-flex flex-row-reverse">
          <div
            class="status_button_default status_submit_button"
            v-on:click="updateRecommendationDate()"
          >
            <span v-if="!updaterequest"> UPDATE </span>
            <span v-if="updaterequest"> Updating... </span>
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
    recommendationdate: String,
    id: Number,
  },

  data: function () {
    return {
      actionlist: [
        { id: 1, name: "buy", displayname: "BUY" },
        { id: 2, name: "sell", displayname: "SELL" },
      ],

      newaction: "",

      newrecommendationdate: "",

      updaterequest: false,
      updatesuccess: false,
    };
  },
  created() {},
  mounted() {
    this.onloadData();
  },
  methods: {
    updateRecommendationDate: function () {
      this.updaterequest = true;
      axios
        .post("/api/updaterecommendationdate", {
          id: this.id,
          recommendationdate: this.dataRecommendationdate,
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

    closeEditor: function () {
      this.$store.commit("stockrecommendationsstore/invokeeditor", false);
    },
    onloadData: function () {
      if (this.recommendationdate != "") {
        var newdate = new Date(this.recommendationdate);

        var n = newdate.toISOString().substr(0, 10);
        this.newrecommendationdate = n;
      }
    },
  },
  computed: {
    dataRecommendationdate: {
      get() {
        return this.newrecommendationdate;
      },
      set(value) {
        this.newrecommendationdate = value;
      },
    },
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