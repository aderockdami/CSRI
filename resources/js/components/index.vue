Vue.component("index",{
`
<template>
<div style="text-align:center">
  <h1>PLESE LOGIN TO CONTINUE</h1>
</div>
</template>
`
<script>

export default{
  data(){
    return{

    }
  },
  created(){
    this.$root.$data.show = true;
  },
  methods:{

    }
 }
</script>
});
