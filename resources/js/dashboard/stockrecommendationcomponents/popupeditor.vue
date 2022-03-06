

<template>
  <v-container class="">
    <div class="d-flex align-center justify-center">
      <div class="wrapper_editor">
        <nav class="topbar_editor">
          <span> Edit </span>
          <span class="close_button" v-on:click="closeEditor()"
            ><img src="images/close_button_white.png"
          /></span>
        </nav>
        <section class="editor_body mt-4">
          <div class="nav_tabs">
            <div class="d-flex align-center justify-space-between">
              <div
                class="tab_nav_default"
                v-on:click="activateTab(tab.id)"
                v-bind:class="classBindingTab(tab.id)"
                v-for="(tab, index) in tablists"
                :key="index"
              >
                {{ tab.name }}
              </div>
            </div>
          </div>
          <v-divider class="mt-3 mb-10"> </v-divider>

          <valueseditor
            v-if="activetab == 1"
            :id="editingdata.id"
            :scrip="editingdata.scrip"
            :entryprice="editingdata.entryprice"
            :target1="editingdata.target1"
            :target2="editingdata.target2"
            :lotsize="editingdata.lotsize"
            :stoploss="editingdata.stoploss"
            :tabname="editingdata.tabname"
          >
          </valueseditor>

          <categoryeditor
            v-if="activetab == 4"
            :id="editingdata.id"
            :tabname="editingdata.tabname"
            :subtabname="editingdata.subtabname"
          >
          </categoryeditor>

          <actioneditor
            v-if="activetab == 2"
            :id="editingdata.id"
            :currentaction="editingdata.action"
          >
          </actioneditor>

          <dateeditor
            v-if="activetab == 3"
            :id="editingdata.id"
            :recommendationdate="editingdata.recommendationdate"
          >
          </dateeditor>
        </section>
      </div>
    </div>
  </v-container>
</template>

  <script>
import valueseditor from "./valueseditor.vue";
import categoryeditor from "./categoryeditor.vue";
import actioneditor from "./actioneditor.vue";
import dateeditor from "./dateeditor.vue";

export default {
  components: {
    valueseditor: valueseditor,
    categoryeditor: categoryeditor,
    actioneditor: actioneditor,
    dateeditor: dateeditor,
  },

  props: {
    editingdata: Object,
  },

  data: function () {
    return {
      newScrip: "",
      newEntryprice: "",
      newTarget1: "",
      newTarget2: "",

      newStoploss: "",
      newLotsize: "",

      activetab: 1,

      tablists: [
        { id: 1, name: "Values" },
        { id: 2, name: "Action" },
        { id: 3, name: "Date" },
        { id: 4, name: "Category" },
      ],

      updatesuccess: false,
    };
  },
  created() {},
  mounted() {},
  methods: {
    activateTab: function (value) {
      this.activetab = value;
    },

    classBindingTab: function (value) {
      return this.activetab == value ? "tab_nav_active" : "tab_nav_inactive";
    },

    closeEditor: function () {
      this.$store.commit("stockrecommendationsstore/invokeeditor", false);
    },
  },
  computed: {},
  watch: {},
};
</script>

<style scoped>
.wrapper_editor {
  height: 500px;
  padding: 0px;

  border: 2px solid #1327dc;
  border-radius: 10px;
  background: #fff;
  font-family: "Poppins", sans-serif;
  min-width: 880px;
  max-width: 900px;
}
.topbar_editor {
  background-color: #1327dc;
  font-size: 22px;

  padding: 5px;
  padding-top: 8px;
  padding-bottom: 8px;
  color: #fff;
  transform: rotate(0deg);
}
.editor_body {
  padding-left: 30px;
  padding-right: 30px;
  box-sizing: border-box;
}
.title_text {
  font-size: 20px;
  color: #fff;
  font-weight: bold;
}

.tab_nav_default {
  border-radius: 10px;
  width: 160px;
  padding: 5px;
  padding-top: 7px;
  padding-bottom: 7px;
  text-align: center;
}
.tab_nav_active {
  background-color: #8753f8;
  color: #fff;
  border: 1.5px solid #8753f8;
}
.tab_nav_inactive {
  background-color: #dddddd;
  color: #c57f7f;
}

.header_info {
  font-weight: bold;
  font-size: 18px;
  color: #197278;
}

.close_button {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translate(0, -50%);
}
</style>