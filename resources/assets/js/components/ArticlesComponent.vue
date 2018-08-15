<template>
    <div>
        <h2>article</h2>
  
  <form @submit.prevent="addArticle" class="mb-3">
    <div class="form-group">
      <input type="text" v-model="article.title" placeholder="Title" class="form-control">
    </div>
    <div class="form-group">
      <textarea type="text" v-model="article.body" placeholder="body" class="form-control"></textarea>
    </div>
    <button class="btn btn-success" type="submit">Submit</button>
  </form>
  
        <nav aria-label="Page navigation example">
  
  <ul class="pagination">
      <!-- disable if there is no previous page -->
    <li v-bind:class="[{disabled: !pagination.pre_page_url}]" class="page-item">
        <a class="page-link" href="#" @click="fetchArticles(pagination.pre_page_url)">Previous</a>
        </li>
    <li class="page-item disabled">
        <a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a>
    </li>

    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
        <a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a>
    </li>
  </ul>
</nav>
        <div class="card card-body m-3" v-for="article in articles" v-bind:key="article.id">
            <h3>{{ article.title }}</h3>
            <p class="lead">{{article.body}}</p>
            <hr>
            <button @click="deleteArtical(article.id)" class="btn btn-danger mb-2">Delete</button>
            
            <button @click="editArticle(article)" class="btn btn-warning">Edit</button>
        
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
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || '/api/articles';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.articles = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },

    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        pre_page_url: links.prev
      };

      this.pagination = pagination;
    },
    deleteArtical(id) {
      if (confirm('Are Aou Sure?')) {
        fetch(`api/article/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Artical Remove');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    addArticle() {
      if (this.edit == false) {
        // add
        fetch('api/article', {
          method: 'post',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            (this.article.title = ''), (this.article.body = '');
            alert('Artical Added');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      } else {
        //update
        // add
        fetch('api/article', {
          method: 'put',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            (this.article.title = ''), (this.article.body = '');
            alert('Artical Update');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    editArticle(article) {
      this.edit = true;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.title = article.title;
      this.article.body = article.body;
    }
  }
};
</script>
