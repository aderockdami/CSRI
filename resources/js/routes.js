import VueRouter from "vue-router";

const routes=[{
  path:"/",
  component:require("./components/index").default
},
{
  path:"/home",
  component:require("./components/home").default
},
{
  name:"login",
  path:"/login",
  component:require("./components/login").default
}
];

const router = new VueRouter({
  routes,
  hashbang:false,
  mode: 'history'
})

export default router;
