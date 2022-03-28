

<template>
  <v-container class="">
    <section >
    <div class="post_editor_toolbar d-flex align-center ">
      <div
        class="embed_toolbar_wrap mr-5"
        v-on:click="createcustomspan('www.google.com')"
      >
           <div class="toolbar_item d-flex align-center">
             
              <div>
                <img class=""  src="/images/table.png" />
              </div>
              <div class="ml-2">
                 Embed Table 
              </div>

            </div>
      </div>

      <ul
        class="embed_toolbar_wrap mr-5"
      
      >
          <li class="toolbar_item d-flex align-center">
             
              <div>
                <img class=""  src="/images/youtube.png" />
              </div>
              <div class="ml-2">
                 Embed YouTube
              </div>

            </li>
            <li class="embedtip ">
             
             <div class="embedtip_right_plot flex-row-reverse">
                </div>
             <div class="d-flex justify-center align-center">
               <v-text-field
                 class="mt-2"
                color="black"
                style="width:200px"
                v-model= "dataYoutubeCode"
              >
 
                </v-text-field>
            
                <v-btn style="font-size:15px" class="ml-5" v-on:click="embedyoutube()" > Embed </v-btn> 
              </div>

            
            </li>

            

      </ul>
      <ul
        class="embed_toolbar_wrap mr-5"
      >
          
          <li class="toolbar_item d-flex align-center">
             
              <div>
                <img class=""  src="/images/twitter1.png" />
              </div>
              <div class="ml-2">
                 Embed Twitter 
              </div>

          </li>
          <li class="embedtip ">
             
             <div class="embedtip_right_plot flex-row-reverse">
                </div>
             <div class="d-flex justify-center align-center">
               <v-text-field
                 class="mt-2"
                color="black"
                style="width:200px"
                v-model= "dataTweetCode"
              >
 
                </v-text-field>
            
                <v-btn style="font-size:15px" class="ml-5" v-on:click="embedtweet()" > Embed </v-btn> 
              </div>

            
            </li>


      </ul>

      <div
        class="embed_toolbar_wrap mr-5"
        v-on:click="previewPost()"
        v-show="!this.preview"
      >
            <div class="toolbar_item d-flex align-center">
             
              <div>
                <img class=""  src="/images/visibility.png" />
              </div>
              <div class="ml-2">
                 Preview
              </div>

           </div>

      </div>
      <div
        class="embed_toolbar_wrap mr-5"
        v-on:click="closePreview()"
        v-show="this.preview"

      >
               <div class="toolbar_item d-flex align-center">
             
              <div>
                <img class=""  src="/images/visibilityhide.png" />
              </div>
              <div class="ml-2">
                Hide Preview
              </div>

             </div>
      </div>
     
    
    </div>
    <main v-show = "!this.preview">

         <div ref="editor" v-html="value"></div>
    </main>
    <main  v-show = "this.preview"  >
                
          this is preview    


    </main>

    </section>
  </v-container>
</template>

  <script>
import Quill from "quill";
import Parchment from 'parchment';





import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";

export default {
  props: {
    value: {
      type: String,
      default: "",
    },
  },

  data: function () {
    return {
      editor: null,
      tweetcode:'',
      youtubecode:'',
      preview:false,
      previewhtml:'',
    };
  },
  created() {},
  mounted() {
    

const InlineBlot = Quill.import("blots/inline");

const Embed = Quill.import("blots/embed");


class NamedLinkBlot extends InlineBlot {
  static create(value) {
    const node = super.create(value);

    node.setAttribute("href", value);
    node.setAttribute("target", "_blank");
    return node;
  }
}
class YoutubeEmbed extends Embed {
	static create(value) {
		const node = super.create(value);
		node.setAttribute("style", "display:flex;justify-content:center;align-items:center;padding:15px");

    node.setAttribute('data-alert', value.value);
    node.innerHTML = value.text;
		
		return node;
	}

	static value(node) {
        return {
          value: node.attributes.dataAlert,
          text: node.innerHTML,
          style: node.attributes.style,
        }
    }
}

YoutubeEmbed.blotName = "youtubeEmbed";
YoutubeEmbed.tagName = "div";
YoutubeEmbed.className = "youtube-embed";



NamedLinkBlot.blotName = "namedlink";
NamedLinkBlot.tagName = "A";

Quill.register("formats/namedlink", NamedLinkBlot);
Quill.register(YoutubeEmbed, true);


 
    this.editor = new Quill(this.$refs.editor, {
      modules: {
        toolbar: [
          [{ header: [1, 2, 3, 4, false] }],
          ["bold", "italic", "underline"],
          [{ list: "ordered" }, { list: "bullet" }],
          ["namedlink","youtubeEmbed"],
        ],
      },
      theme: "bubble",
      formats: [
        "bold",
        "underline",
        "header",
        "italic",
        "list",
        "namedlink",
        "color",
        "youtubeEmbed"
      ],
    });

    this.editor.root.innerHTML = this.value;

    this.editor.on("text-change", () => this.update());
  },
  methods: {
    update() {
      this.$emit(
        "input",
        this.editor.getText() ? this.editor.root.innerHTML : ""
      );
      this.previewhtml = this.editor.root.innerHTML;

    },
    changeformatoftext: function (link) {
      console.log("formatting text");
      this.editor.insertEmbed(0, 'youtubeEmbed', {text : '<iframe width="560" height="315" src="https://www.youtube.com/embed/KrhJncelbZg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>', value : 'value'},'api');
    },
     embedtweet: function () {
      console.log("formatting text");
      var index = this.editor.getSelection(true).index;
      if(this.dataTweetCode !="")
      {
        var parsedstring = this.dataTweetCode.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,'');
      this.editor.insertEmbed(index, 'youtubeEmbed', {text : parsedstring, value : 'value'},'api');
      }
    },
    embedyoutube: function () {
      console.log("formatting text");
        var index = this.editor.getSelection(true).index;

      if(this.dataYoutubeCode !="")
      {
      this.editor.insertEmbed(index, 'youtubeEmbed', {text : this.dataYoutubeCode, value : 'value'},'api');
      }
    },
    
    previewPost:function()
    {
      this.preview = true;

    },
    closePreview:function()
    {
      this.preview = false;

    },
    
   
    

  

    createcustomspan: function (classname) {},
  },
  computed: {

    dataTweetCode:
    {
      get()
      {
        return this.tweetcode;
      },
      set(value)
      {
        this.tweetcode = value;
      }
    },
    dataYoutubeCode:
    {
      get()
      {
        return this.youtubecode;
      },
      set(value)
      {
        this.youtubecode = value;
      }
    }

  },
  watch: {},
};
</script>

<style scoped>
.post_editor_toolbar
{
  z-index: 1000;
}
.embed_toolbar_wrap
{

padding:5px;
list-style-type: none;

overflow: visible;

transform: rotate(0deg);
  z-index: 5000;




}

.embedtip
{
  display: none;
  position:absolute;
    padding:5px;
  
  padding-top:30px;

  display: none;
  background:#fff;
  color:#1B4AC5;
  box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.25);
}
.toolbar_item
{
  padding:5px;
  padding-bottom:7px;
  border-bottom:2px solid #ddd;

}
.embed_toolbar_wrap:hover .embedtip
{
  display: block;
}
.embed_toolbar_wrap:hover .toolbar_item
{
  border-bottom:2px solid blue;
}

.embedtip_right_plot
{
  position:absolute;
  right:5px;
  top:5px;

} 
.toolbar_item img
{
 width:20px;
 height:20px;
}
</style>