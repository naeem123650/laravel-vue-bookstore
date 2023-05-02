<template>
  <!-- [ Main Content ] start -->
  <div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card text-center shadow mt-2">
          <div class="card-body">
            <h5 class="card-title">Global Book Search</h5>
            <div class="card-text">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="search"
                  aria-describedby="helpId"
                  placeholder="Search by Title, Author, Publication date, ISBN, Genre"
                  v-model="search"
                />
                <small id="helpId" class="form-text text-muted"
                  >Search Book Collection</small
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
    <div class="row" v-if="books && books.data.length > 0">
      <div class="col-md-6 col-xl-4" v-for="book in books.data" :key="book">
        <router-link
          :to="{
            name: 'ViewBook',
            params: { id: book.id },
          }"
        >
          <div class="card mb-3">
            <img
              style="height: 100px; width: 400px"
              class="img-fluid card-img-top"
              :src="book.image"
              :alt="book.title"
            />
            <div class="card-body">
              <h5 class="card-title">{{ book.title }}</h5>
              <p class="card-text">
                {{ book.description }}
              </p>
              <p class="card-text">
                <small class="text-muted">{{ book.author }}</small>
              </p>
            </div>
          </div>
        </router-link>
      </div>
    </div>
    <hr />

    <div class="row">
      <Bootstrap4Pagination
        :data="books"
        @pagination-change-page="getResults($event)"
      />
    </div>
  </div>
  <!-- [ Main Content ] end -->
</template>

<script>
import Breadcrumb from "../partials/Breadcrumb.vue";
import { watchEffect } from "vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";

export default {
  components: { Breadcrumb, Bootstrap4Pagination },
  name: "Dashboard",
  data() {
    return {
      search: "",
    };
  },
  computed: {
    books() {
      return this.$store.getters.getAllBooks;
    },
  },
  methods: {
    getResults(e) {
      const searchBookObj = {
        search: this.search,
        pageIndex: e,
      };
      this.$store.dispatch("getBooks", searchBookObj);
    },
  },
  created() {
    watchEffect(() => {
      this.$store.dispatch("getBooks", this.search);
    });
  },
};
</script>
