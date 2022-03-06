

<template>
  <div>
    <div>Stock Recommendation</div>

    <div></div>
  </div>
</template>

  <script>
export default {
  data: function () {
    return {};
  },
  created() {},
  methods: {},
  computed: {
    routesubmenu() {
      return this.$route.params.submenu;
    },
  },
};
</script>

<style scoped>
.label_style1 {
  font-family: Poppins;
  font-style: normal;
  font-weight: 800;
  font-size: 20px;
  line-height: 30px;

  color: #47ad63;
}
.textboxwrapper {
  width: 241px;
  height: 37px;
  border: 1px solid #47ad63;
  box-sizing: border-box;
  border-radius: 30px;
}
.textbox_style1 {
}
</style>