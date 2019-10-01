Vue.component("question",{
`
<template>
<div>
  <br>
 {{ question.question }}
  <span v-if="Admin" style="margin-left:20px;"@click="deleteQuestions" > delete </span>
</div>
</template>
`
<script>
export default{
  props:['question'],
  data(){
    return{
      Admin:User.isAdmin()
    }
  },
  methods:{
    deleteQuestions(){
      axios.delete('/api/admin/question/'+this.question.id,{ data: { token: Storage.getToken() }})
      .then((response)=>{
        this.$Progress.finish();
        this.$parent.displayQuestions();
      })
      .catch((errors)=>{
        this.$Progress.fail();
      })
    }
  }
 }
</script>
});
