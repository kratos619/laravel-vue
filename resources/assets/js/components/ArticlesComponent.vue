<template>
    <div>
        <h2>article</h2>
        <div class="card card-body m-3" v-for="article in articles" v-bind:key="article.id">
            <h3>{{ article.title }}</h3>
            <p class="lead">{{article.body}}</p>
        </div>
    </div>
</template>

<script>
//import Vue from 'vue'
export default {
  data() {
    return {
      articles: [],
      article: {
        id: '',
        title: '',
        body: ''
      },
      article_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles() {
      fetch('api/articles')
        .then(res => res.json())
        .then(res => {
          this.articles = res.data;
        });
    }
  }
};
</script>
