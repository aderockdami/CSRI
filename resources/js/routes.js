import VueRouter from "vue-router";

const routes=[{
  name:"root",
  path:"/",
  component:require("./components/index").default
},
{
  name:"home",
  path:"/home",
  component:require("./components/home").default
},
{
  name:"userHome",
  path:"/userHome",
  component:require("./components/userHome").default
},
{
  name:"login",
  path:"/login",
  component:require("./components/login").default
},
{
  name:"signup",
  path:"/signup",
  component:require("./components/signup").default
},
{
  name:"questions",
  path:"/questions",
  component:require("./components/questions").default,
  props:true
},
{
  name:"result",
  path:"/result",
  component:require("./components/result").default
}
];

const router = new VueRouter({
  routes
})

export default router;
