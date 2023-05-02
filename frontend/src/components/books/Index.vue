<template>
  <div>
    <div class="col-xl-12 col-md-12">
      <div class="card table-card">
        <div class="card-header">
          <div class="d-flex">
            <div class="mr-auto p-2">
              <h5>Books Details</h5>
            </div>
            <div class="pr-5">
              <router-link
                :to="{ name: 'AddBook' }"
                class="btn btn-primary btn-sm has-ripple"
              >
                Add New Book
              </router-link>
            </div>
          </div>

          <div class="card-header-right">
            <div class="btn-group card-option"></div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Genre</th>
                  <th>ISBN</th>
                  <th>Published</th>
                  <th class="text-center" colspan="3">Actions</th>
                </tr>
              </thead>
              <tbody v-if="books && books.data.length > 0">
                <tr v-for="book in books.data" :key="book">
                  <td>
                    <img :src="book.image" alt="" style="height: 20px" />
                  </td>
                  <td>{{ book.title }}</td>
                  <td>{{ book.author }}</td>
                  <td>{{ book.genre }}</td>
                  <td>{{ book.isbn }}</td>
                  <td class="text-right">
                    <label
                      class="badge"
                      :class="
                        book.published
                          ? 'badge-light-success'
                          : 'badge-light-danger'
                      "
                    >
                      {{
                        book.published ? "Published" : "Not Published"
                      }}</label
                    >
                  </td>
                  <td>
                    <router-link
                      :to="{
                        name: 'EditBook',
                        params: { id: book.id },
                      }"
                      class="btn btn-primary btn-sm has-ripple"
                    >
                      Edit<span
                        class="ripple ripple-animate"
                        style="
                          height: 86.375px;
                          width: 86.375px;
                          animation-duration: 0.7s;
                          animation-timing-function: linear;
                          background: rgb(255, 255, 255);
                          opacity: 0.4;
                          top: -31.3594px;
                          left: 5.8125px;
                        "
                      ></span>
                    </router-link>
                  </td>
                  <td>
                    <button
                      @click="deleteBook(book.id)"
                      class="btn btn-danger btn-sm has-ripple"
                    >
                      Delete<span
                        class="ripple ripple-animate"
                        style="
                          height: 86.375px;
                          width: 86.375px;
                          animation-duration: 0.7s;
                          animation-timing-function: linear;
                          background: rgb(255, 255, 255);
                          opacity: 0.4;
                          top: -31.3594px;
                          left: 5.8125px;
                        "
                      ></span>
                    </button>
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <tr class="text-center">
                  <th colspan="6">No Books Found.</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-12 col-lg-12">
          <Bootstrap4Pagination
            :data="books"
            @pagination-change-page="getResults($event)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { watchEffect } from "vue";
import { Bootstrap4Pagination } from "laravel-vue-pagination";
export default {
  name: "Index",
  components: { Bootstrap4Pagination },
  methods: {
    deleteBook(id) {
      this.$store.dispatch("deleteBook", id);
    },
    getResults(e) {
      const searchBookObj = {
        pageIndex: e,
      };
      this.$store.dispatch("getBooks", searchBookObj);
    },
  },
  computed: {
    books() {
      return this.$store.getters.getAllBooks;
    },
  },
  created() {
    watchEffect(() => {
      const searchBookObj = {
        search: "",
        pageIndex: 1,
      };
      this.$store.dispatch("getBooks", searchBookObj);
    });
  },
};
</script>
