

<template>
  <section
    class="d-flex justify-center align-center"
    style="width: 100%; height: 100%"
  >
    <main class="">
      <header class="header_scrip_cash_upload mb-14">
        Upload Scrip Names for Equity/Cash
      </header>

      <div
        v-if="!successrequest"
        class="upload_card d-flex justify-center align-center"
        v-on:click="triggerFileUpload()"
      >
        <div>
          <div class="image_upload_wrapper">
            <img class="image_upload" src="images/cloud_upload_blue.png" />

            <input
              type="file"
              accept=".csv"
              ref="scrip_csv_file_upload"
              v-on:change="uploadcsv_file_scrip_cash()"
              name=""
              id="file_upload_scrip_cash"
              hidden
            />
          </div>
          <div v-if="!createrequest" class="upload_text">
            Upload CSV file Here/Cash
          </div>
          <div v-if="createrequest" class="d-flex align-center">
            <div class="mr-4"><span class="loading_text">UPLOADing</span></div>
            <div><img src="/images/Ellipsis_loader2.gif" /></div>
          </div>
        </div>
      </div>

      <div
        v-if="successrequest"
        class="upload_card d-flex justify-center align-center"
      >
        <div>
          <div class="success_imgwrap">
            <img src="/images/success_check.png" />
          </div>
          <div class="mt-6 success_text">SUCCESSFULLY Uploaded</div>
        </div>
      </div>
    </main>
  </section>
</template>

  <script>
import moment from "moment";

export default {
  components: {},

  data: function () {
    return {
      createrequest: "",
      successrequest: "",
    };
  },
  created() {},
  mounted() {},
  methods: {
    triggerFileUpload: function () {
      document.getElementById("file_upload_scrip_cash").click();
    },
    csvfile_scrip_uploadchange() {
      this.imagefile = this.$refs.scrip_csv_file_upload.files[0];
    },
    changescripuploadcsv: function () {},
    uploadcsv_file_scrip_cash: function () {
      this.createrequest = true;
      var thecsvfile = this.$refs.scrip_csv_file_upload.files[0];

      let formData = new FormData();

      formData.append("csvfile", thecsvfile);

      axios
        .post("api/csvuploadscripcashnames", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(
          (response) => {
            console.log("response:", response.data);
            if (response.status == 200) {
              console.log("Response :-" + response.data);

              this.successrequest = true;
            } else {
              console.log("Response :-" + response.data);
            }
          },

          (error) => {
            console.log(error);
          }
        );
    },
  },
  computed: {},
  watch: {},
};
</script>

<style scoped>
.header_scrip_cash_upload {
  font-size: 25px;
  text-align: center;
}
.upload_card {
  width: 600px;
  height: 300px;
  background-color: #fdf0f0;
}
.upload_text {
  font-family: Poppins;
  font-style: normal;
  font-weight: 600;
  font-size: 25px;
  line-height: 52px;
  text-align: center;

  color: #0e1941;
}
.image_upload_wrapper {
  text-align: center;
}
.image_upload {
  width: 100px;
  height: 100px;
}
</style>