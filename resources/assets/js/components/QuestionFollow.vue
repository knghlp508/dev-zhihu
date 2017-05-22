<template>
  <div class="panel-heading question-follow">
    <h2>{{ count }}</h2>
    <span>关注者</span>
  </div>
</template>

<script>
  export default{
    props: ['question'],
    mounted(){
      this.refresh();
    },
    data(){
      return {
        count: 0
      }
    },
    methods: {
      refresh(){
        this.$http.get('/api/question/follow-count/' + this.question).then(response => {
          this.count = response.data.count;
        })
      }
    }
  }
</script>