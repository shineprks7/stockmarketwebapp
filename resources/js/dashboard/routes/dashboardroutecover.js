import VueRouter from "vue-router";


const routes = [
    { path: '/admindashboard', name:'dashboardcover', component: () => import("../dashboardcomponents/dashboardcover.vue"),	 props: true,
    children: [

  { name:'underconstruction', path: '/underconstruction', component: () => import("../dashboardcomponents/underconstruction.vue") },
   
  
  { name:'createstockrecommendation', path: '/createstockrecommendation', component: () => import("../stockrecommendationcomponents/createstockrecommendation.vue") },
  
  
  { name:'stockrecommendationlist', path: '/recommendationlist', component: () => import("../stockrecommendationcomponents/recommendationlist.vue") },

  { name:'uploadscriptcash', path: '/uploadscriptcash', component: () => import("../stockrecommendationcomponents/uploadscriptcash.vue") },


  { name:'ipolists', path: '/ipolists/:ipotime', component: () => import("../ipo/ipolist.vue") },


  { name:'editipo', path: '/editipo', component: () => import("../ipo/updateipo.vue") },
  { name:'createleadmanager', path: '/createleadmanager', component: () => import("../ipo/createleadmanager.vue") },
  { name:'leadmanagerlist', path: '/leadmanagerlist', component: () => import("../../flextables/test/leadmanagerlist.vue") },

  

  { name:'createipoform', path: '/createipoform', component: () => import("../ipo/createipoform.vue") },

  { name:'createncdform', path: '/createncdform', component: () => import("../ncd/createncdform.vue") },

  { name:'createrightsform', path: '/createrightsform', component: () => import("../rights/createrightsform.vue") },

  




// Tests and Experiments

{ name:'dynocontent', path: '/dynocontent', component: () => import("../../contentgenerator/contentcreators/createcontenttest.vue") },
{ name:'tablecreator', path: '/tablecreator', component: () => import("../../test/multistep_updator/tablesimple.vue") },

{ name:'rowupdator', path: '/rowupdator', component: () => import("../../flextables/test/rowcover.vue") },
{ name:'customeditor', path: '/customeditor', component: () => import("../posts/editor.vue") },
{ name:'posteditor', path: '/posteditor', component: () => import("../posts/posteditor.vue") },
{ name:'formsinglepagetest', path: '/formsinglepagetest', component: () => import("../../forms/formcreator/formsingletestcover.vue") },

  { name:'formsinglepagetest2', path: '/formsinglepagetest2', component: () => import("../../forms/formcreator/formsinglepagetest2.vue") },

 
  ],
},

{ path: '/stafflogin', name:'stafflogin', component: () => import("../dashboardcomponents/adminlogin.vue"),	 props: true},

{ path: '/dynamicformtest', name:'dynamicformtest', component: () => import("../../test/multistep_form_creator/formdynamictest.vue"),	 props: true},








];


  
  // 3. Create the router instance and pass the `routes` option
  // You can pass in additional options here, but let's
  // keep it simple for now.
  const router = new VueRouter({
    routes // short for `routes: routes`
  })
  
  // 4. Create and mount the root instance.
  // Make sure to inject the router with the router option to make the
  // whole app router-aware.
  export default router;