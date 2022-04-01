

<template>
  <v-container class="">
    <div v-for="(el, index) in elements" :key="el.uid">
      <textitems
        :items="el.items"
        :elementid="el.uid"
        v-if = "conditionalCheckElement(el, 'textitems')"
      />
      <paragraph
        :items="el.items"
        :elementid="el.uid"
        v-else-if = "conditionalCheckElement(el, 'paragraph')"
      />
      <textblock
        :items="el.items"
        :elementid="el.uid"
        v-else-if = "conditionalCheckElement(el, 'textblock')"
      />
      <tabs
        :items="el.items"
        :elementid="el.uid"
        :value="el.value"
        v-on:messageFromTab = " messageReceivedFromTab "
        v-else-if = "conditionalCheckElement(el, 'tab')"
      />
      <rowgroup
        :elementid="el.uid"
        :rowData="el.rowdata"
        :columnData="el.columns"
        :preLoad="el.preLoad"
        :preLoadUrl="el.preLoadUrl"
        :requiredQueryForPreLoad="el.requiredQueryForPreLoad"
        v-else-if = "conditionalCheckElement(el, 'rowgroup')"
      />
    </div>
  </v-container>
</template>
  

  <script>
import chips from "../elements/chips.vue";
import tabs from "../elements/tabs.vue";
import heading from "../elements/heading.vue";
import paragraph from "../elements/paragraph.vue";
import textitems from "../elements/textitems.vue";
import rowgroup from "../elements/rowgroup.vue";

import contentmixin from "../mixins/contentmixin.vue";

export default {
  components: {
    chips: chips,
    tabs: tabs,
    heading: heading,
    paragraph: paragraph,
    textitems: textitems,
    rowgroup: rowgroup,
  },
  mixins: [contentmixin],

  props: {
    elementdata: "",
  },

  data: function () {
    return {
      elements: [
        {
          uid: 1,
          type: "main",
          eltype: "tab",
          value: "info",
          items: [
            { id: 1, name: "info", displayname: "IPO Company Information" },

            { id: 2, name: "timetable", displayname: "IPO Time Table" },

            { id: 3, name: "subscriptiondata", displayname: "Subscription" },
          ],
        },

        {
          uid: 2,
          type: "associate",
          eltype: "rowgroup",

          associateParentUid:1,
          displayIfParentValue:'timetable',

          preLoadUrl: "/api/ipoListingByCompany",
          preLoad: true,
          requiredQueryForPreLoad: ["companyid"],

          columns: [
            { id: 1, style: { width: "200px" } },
            { id: 2, style: { width: "20px" } },
            { id: 3, style: { width: "350px" } },
          ],

          rowdata: [
            {
              columndata: [
                { text: "Open Date", presets: "secondary, bold,medium" },

                { text: ":", presets: "secondary, bold,medium" },

                {
                  type: "text",
                  external: "ipo_time_tables[0].open_date",
                  format: "date",
                  default: "-",
                  presets: "dark, medium",
                },
              ],
            },
            {
              columndata: [
                { text: "Close Date", presets: "secondary, bold,medium" },
                { text: ":", presets: "secondary, bold,medium" },

                {
                  type: "text",
                  external: "ipo_time_tables[0].close_date",
                  format: "date",
                  default: "-",
                  presets: "dark, medium",
                },
              ],
            },
            {
              columndata: [
                { text: "Listing Date", presets: "secondary, bold,medium" },
                { text: ":", presets: "secondary, bold,medium" },

                {
                  type: "text",
                  external: "ipo_time_tables[0].listing_date",
                  format: "date",
                  default: "-",
                  presets: "dark, medium",
                },
              ],
            },
            {
              columndata: [
                { text: "Allotment Date", presets: "secondary, bold,medium" },

                { text: ":", presets: "secondary, bold,medium" },

                {
                  type: "text",
                  external: "ipo_time_tables[0].allotment_date",
                  format: "date",
                  default: "-",
                  presets: "dark, medium",
                },
              ],
            },
            {
              columndata: [
                {
                  text: "Refund Initiation Date",
                  presets: "secondary, bold,medium",
                },

                { text: ":", presets: "secondary, bold,medium" },

                {
                  type: "text",
                  external: "ipo_time_tables[0].refund_initiation",
                  format: "date",
                  default: "-",
                  presets: "dark, medium",
                },
              ],
            },
            {
              columndata: [
                {
                  text: "Shares to Demat Date",
                  presets: "secondary, bold,medium",
                },

                { text: ":", presets: "secondary, bold,medium" },

                {
                  type: "text",
                  external: "ipo_time_tables[0].shares_to_demat",
                  format: "date",
                  default: "-",
                  presets: "dark, medium",
                },
              ],
            },
          ],
        },
      ],
    };
  },
  created() {},
  mounted() {},
  methods: {
    conditionalCheckElement: function (element, eltype) {
      if (element.type == "main" && element.eltype == eltype) {
        return true;
      } else if (element.type == "associate" && element.eltype == eltype) {
        console.log("Form Field Associate Checking");
        if (
          element.hasOwnProperty("associateParentUid") &&
          element.hasOwnProperty("displayIfParentValue")
        ) {
          // console.log("Form Field Associate has parent id and Parent Value");

          var filterarr = this.elements.filter(
            (abc) => abc.uid == element.associateParentUid
          );

          // console.log("filter Array: " + filterarr);
          var parentElement = filterarr.length > 0 ? filterarr[0] : null;

          // console.log("parent Form Field: " + parentElement);

          return parentElement != null
            ? parentElement.value == element.displayIfParentValue
              ? true
              : false
            : false;
        } else {

          return false;
        }
      } else if (
        element.type == "conditional" &&
        formfield.eltype == eltype
      ) {

        if (element.hasOwnProperty("condition")) {
          console.log(" Has Condtional Property");

        

          return element.condition.apply(this.uids, []);
        } else {

          return false;
        }
      } else {
        return false;
      }
    },
    messageReceivedFromTab: function (elementuid, value) {
      var filter = this.elements.filter((abc) => abc.uid == elementuid);

      if (filter.length > 0) {
        var index = this.elements.indexOf(filter[0]);

        this.elements[index].value = value;
      } else {
      }
    },
  },
  computed: {},
  watch: {},
};
</script>

<style scoped>
</style>