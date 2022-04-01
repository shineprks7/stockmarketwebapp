

<template>
  <v-container class="">
    <div v-for="(el, index) in elements" :key="el.uid">
      <textitems
        :items="el.items"
        :elementid="el.uid"
        v-if="(el.eltype = 'textitems')"
      />
      <paragraph
        :items="el.items"
        :elementid="el.uid"
        v-else-if="(el.eltype = 'paragraph')"
      />
      <textblock
        :items="el.items"
        :elementid="el.uid"
        v-else-if="(el.eltype = 'textblock')"
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

export default {
  components: {
    chips: chips,
    tabs: tabs,
    heading: heading,
    paragraph: paragraph,
    textitems: textitems,
  },
  mixins: [],

  props: {
    elementdata: {
      type: Array,
      required: true,
    },
    dynamicQueryFields: {
      type: Array,
      required: true,
    },

    requiredQueryForPreLoad: {
      type: Array,
      required: true,
    },
    preLoadUrl: String,
  },

  data: function () {
    return {
      externaldata: {},

      satisfypreload: "",

      elements: [],
    };
  },
  created() {},
  mounted() {
    if (this.elementdata) {
      this.elements = this.elementdata;
    }
    this.preLoadData();
  },
  methods: {
    satisfyPreloadQuery: function () {
      var satisfypreload = "";
      for (var i = 0; i < this.requiredQueryForPreLoad.length; i++) {
        if (this.queryList.hasOwnProperty(this.requiredQueryForPreLoad[i])) {
          satisfypreload = true;
        } else {
          satisfypreload = false;
          break;
        }
      }

      return satisfypreload;
    },
    preLoadData: function () {
      if (this.satisfyPreloadQuery()) {
        //request

        if (this.preLoadUrl) {
          // Axios request

          var requestprops = new Object();
          requestprops.query = this.queryList;

          axios
            .post(this.preLoadUrl, requestprops)
            .then(
              (response) => {
                console.log("response:", response.data);
                this.updaterequest = false;

                if (response.status == 200) {
                  if (response.data[0] == "success") {
                    this.externaldata = { ...response.data[1] };


                    setTimeout(function () {}.bind(this), 1000);
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
        }
      } else {
        this.preLoadComplete = true;
      }
    },
  },
  computed: {},
  watch: {},
};
</script>

<style scoped>
</style>