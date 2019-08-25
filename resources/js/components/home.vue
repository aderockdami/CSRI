Vue.component("index",{
`
<template>
<div style="text-align:center">
  HOME PAGE
</div>
</template>
`
<script>
//import eventcard from './eventcard.vue';
export default{
  components: {

  },
  data(){
    return{

    }
  },
  created(){
    if(!User.loggedIn()){
      this.$router.push({ path:`/index`});
    }
  },
  methods:{

    }
 }
</script>
});
