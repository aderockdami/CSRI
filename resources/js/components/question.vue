Vue.component("question",{
`
<template>
<div style="text-align:center">
  <br>
  Question : {{ question.question }}
</div>
</template>
`
<script>
export default{
  props:['question']
 }
</script>
});
