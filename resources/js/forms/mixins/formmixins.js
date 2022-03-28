export default {
  methods: {
    conditionalCheckForm(formfield, inputtype) {

      if (formfield.type == "main" && formfield.inputtype == inputtype) {
        return true;
      }
      else if (formfield.type == "associate" && formfield.inputtype == inputtype) {
        console.log("Form Field Associate Checking");
        if (formfield.hasOwnProperty('associateParentUid') && formfield.hasOwnProperty('displayIfParentValue')) {
          // console.log("Form Field Associate has parent id and Parent Value");

          var filterarr = this.forms.filter(abc => abc.uid == formfield.associateParentUid);

          // console.log("filter Array: " + filterarr);
          var parentFormField = filterarr.length > 0 ? filterarr[0] : null;

          // console.log("parent Form Field: " + parentFormField);

          return parentFormField != null ? (parentFormField.value == formfield.displayIfParentValue ? true : false) : false;




        }
       
        else {
          // console.log("Form Field Associate does not have parent id and Parent Value");

          return false;
        }

      }
      else if(formfield.type == 'conditional' && formfield.inputtype ==inputtype)
      {
        console.log("type of form is Conditional");

        if (formfield.hasOwnProperty('condition')) {

            
             console.log(" Has Condtional Property");

             console.log("Condition Form Data"+formfield.condition.apply(this.uids, []));

            return formfield.condition.apply(this.uids, []);

          

        }
        else
        {
          console.log(" doesn't have Condtion Property");

          return false;

        }
      }
      else {
        return false;
      }

    },
    conditionalFilterForm(formfield) {

      if (formfield.type == "main") {
        return true;
      }
      else if (formfield.type == "associate") {
        // console.log("Form Field Associate Checking");
        if (formfield.hasOwnProperty('associateParentUid') && formfield.hasOwnProperty('displayIfParentValue')) {
          // console.log("Form Field Associate has parent id and Parent Value");

          var filterarr = this.forms.filter(abc => abc.uid == formfield.associateParentUid);

          // console.log("filter Array: " + filterarr);
          var parentFormField = filterarr.length > 0 ? filterarr[0] : null;

          // console.log("parent Form Field: " + parentFormField);

          return parentFormField != null ? (parentFormField.value == formfield.displayIfParentValue ? true : false) : false;




        }
        else {
          // console.log("Form Field Associate does not have parent id and Parent Value");

          return false;
        }

      }
      else if(formfield.type == 'conditional')
      {

        if (formfield.hasOwnProperty('condition')) {
            return formfield.condition.apply(this.uids, []);
        }
        else
        {
          console.log(" doesn't have Condtion Property");

          return false;

        }
      }
      else {
        return false;
      }

    },




    messageReceivedFromOption: function (formuid, optionval) {
      this.optionvaluereceived = optionval;

      var filter = this.forms.filter((abc) => abc.uid == formuid);

      if (filter.length > 0) {
        var index = this.forms.indexOf(filter[0]);

        this.forms[index].value = optionval;
      } else {
        // console.log("Form ID is not found");
      }
    },
    messageReceivedFromText: function (formuid, value) {
      var filter = this.forms.filter((abc) => abc.uid == formuid);

      if (filter.length > 0) {
        var index = this.forms.indexOf(filter[0]);

        this.forms[index].value = value;
      } else {
        // console.log("Form ID is not found");
      }
    },
    messageReceivedFromEmail: function (formuid, value, validation) {
      var filter = this.forms.filter((abc) => abc.uid == formuid);

      if (filter.length > 0) {
        var index = this.forms.indexOf(filter[0]);

        this.forms[index].value = value;
        this.forms[index].validation = validation;
      } else {
        // console.log("Form ID is not found");
      }
    },
    removeObjectProperties(tempobject, arr) {



    },

    associatedFormData: function (arr, form) {
      var resultarr = [];
      var resultobj = new Object();

      if (arr) {
        for (var i = 0; i < arr.length; i++) {

          var newobj = new Object();


          if (form) {
            var filterarr = form.filter(abc => abc.uid == arr[i]);

            if (filterarr.length > 0) {



              resultobj["uid_" + filterarr[0].uid] = { value: filterarr[0].value };

            }
            else {


            }

          }


        }
      }

      return resultobj;

    },

    associatedFormData: function (arr, form) {
      var resultarr = [];
      var resultobj = new Object();

      if (arr) {
        for (var i = 0; i < arr.length; i++) {

          var newobj = new Object();


          if (form) {
            var filterarr = form.filter(abc => abc.uid == arr[i]);

            if (filterarr.length > 0) {



              resultobj["uid_" + filterarr[0].uid] = { value: filterarr[0].value };

            }
            else {


            }

          }


        }
      }

      return resultobj;

    },
    fireRequiredFieldError:function(forminfo)
      {

        return forminfo.required == true && forminfo.value =="" && this.requiredfieldmsg ? true : false;
           

      },
        fireValidationError:function(forminfo)
      {

        return forminfo.value !="" && this.validationfailedmsg && (forminfo.hasOwnProperty('validation') ? !forminfo.validation  : false )  ? true : false;

      },
    createUidData: function () {
      var resultobj = new Object();

      
        for (var i = 0; i < this.forms.length; i++) {

              resultobj["uid_" + this.forms[i].uid] = { value: this.forms[i].value };
            }
        this.uids = {...resultobj};

     },


  


  meetRequiredFieldsByPage: function () {

    let parsedpagenum = this.parsedPageNumber;

    let formdata = this.formConditionallyFiltered;

    var filter = formdata.filter(abc => abc.page == parsedpagenum && abc.required == true && abc.value == "");

    if (filter.length > 0) {


      return false;
    }
    else {
      for (let i = 0; i < formdata.length; i++) {
        if (this.forms[i].hasOwnProperty('validation')) {

          if (this.forms[i].validation == false) {
            this.validationfailedmsg = true;
            return false;

          }
        }

      }

      this.validationfailedmsg = false;

      return true;

    }


  },
  meetRequiredFields: function () {

    let formdata = this.formConditionallyFiltered;


    var filter = formdata.filter(abc => abc.required == true && abc.value == "");

    if (filter.length > 0) {


      return false;
    }
    else {
      for (let i = 0; i < formdata.length; i++) {
        if (formdata.hasOwnProperty('validation')) {

          if (formdata.validation == false) {
            this.validationfailedmsg = true;
            return false;

          }
        }

      }

      this.validationfailedmsg = false;

      return true;

    }


  },
},

  computed: {
    formConditionallyFiltered() {
      let filter = this.forms.filter(abc => this.conditionalFilterForm(abc));

      return filter;

    },
  }

};