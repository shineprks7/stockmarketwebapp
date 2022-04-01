export default {
  methods: {
    conditionalCheckElement:function (element, eltype) {

      if (element.type == "main" && element.eltype == eltype) {
        return true;
      }
      else if (element.type == "associate" && element.eltype == inputtype) {
        console.log("Form Field Associate Checking");
        if (element.hasOwnProperty('associateParentUid') && element.hasOwnProperty('displayIfParentValue')) {
          // console.log("Form Field Associate has parent id and Parent Value");

          var filterarr = this.elements.filter(abc => abc.uid == element.associateParentUid);

          // console.log("filter Array: " + filterarr);
          var parentFormField = filterarr.length > 0 ? filterarr[0] : null;

          // console.log("parent Form Field: " + parentElement);

          return parentElement != null ? (parentElement.value == element.displayIfParentValue ? true : false) : false;




        }
       
        else {
          // console.log("Form Field Associate does not have parent id and Parent Value");

          return false;
        }

      }
      else if(element.type == 'conditional' && formfield.eltype ==inputtype)
      {
        console.log("type of form is Conditional");

        if (element.hasOwnProperty('condition')) {

            
             console.log(" Has Condtional Property");

             console.log("Condition Form Data"+element.condition.apply(this.uids, []));

            return element.condition.apply(this.uids, []);

          

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




   
    messageReceivedFromTab: function (elementuid, value) {
      var filter = this.elements.filter((abc) => abc.uid == elementuid);

      if (filter.length > 0) {
        var index = this.elements.indexOf(filter[0]);

        this.elements[index].value = value;
      } else {
        // console.log("Form ID is not found");
      }
    },
    messageReceivedFromOptions: function (elementuid, value, validation) {
      var filter = this.elements.filter((abc) => abc.uid == elementuid);

      if (filter.length > 0) {
        var index = this.elements.indexOf(filter[0]);

        this.elements[index].value = value;
        this.elements[index].validation = validation;
      } else {
        // console.log("Form ID is not found");
      }
    },
    messageReceivedFromFilters: function (elementuid, value, validation) {
      var filter = this.elements.filter((abc) => abc.uid == elementuid);

      if (filter.length > 0) {
        var index = this.elements.indexOf(filter[0]);

        this.elements[index].value = value;
        this.elements[index].validation = validation;
      } else {
        // console.log("Form ID is not found");
      }
    },
    removeObjectProperties(tempobject, arr) {



    },

    associatedElementData: function (arr, element) {
      var resultarr = [];
      var resultobj = new Object();

      if (arr) {
        for (var i = 0; i < arr.length; i++) {

          var newobj = new Object();


          if (element) {
            var filterarr = elements.filter(abc => abc.uid == arr[i]);

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

    createUidData: function () {
      var resultobj = new Object();

      
        for (var i = 0; i < this.forms.length; i++) {

              resultobj["uid_" + this.elements[i].uid] = { value: this.elements[i].value ? this.elements[i].value :''};
            }
        this.uids = {...resultobj};

     },


  

},

  computed: {
    
  }

};