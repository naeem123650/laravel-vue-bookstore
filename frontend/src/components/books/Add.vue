<template>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Add New Book</h5>
        </div>
        <div class="card-body">
          <form @submit.prevent="addBook" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="title">Title</label>
                  <input
                    type="text"
                    class="form-control"
                    id="title"
                    aria-describedby="titleHelp"
                    v-model="form.title"
                  />
                  <span class="text-danger" v-if="errors.title"
                    >{{ errors.title[0] }}
                  </span>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="author">Author</label>
                  <input
                    type="text"
                    class="form-control"
                    id="author"
                    aria-describedby="authorHelp"
                    v-model="form.author"
                  />
                  <span class="text-danger" v-if="errors.author">{{
                    errors.author[0]
                  }}</span>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="genre">Genre</label>
                  <input
                    type="text"
                    class="form-control"
                    id="genre"
                    aria-describedby="genreHelp"
                    v-model="form.genre"
                  />
                  <span class="text-danger" v-if="errors.genre">{{
                    errors.genre[0]
                  }}</span>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="description"
                    >Description</label
                  >
                  <textarea
                    class="form-control"
                    id="description"
                    cols="10"
                    rows="3"
                    v-model="form.description"
                    aria-describedby="descriptionHelp"
                  ></textarea>
                  <span class="text-danger" v-if="errors.description">{{
                    errors.description[0]
                  }}</span>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="isbn">Isbn</label>
                  <input
                    type="text"
                    class="form-control"
                    id="isbn"
                    aria-describedby="isbnHelp"
                    v-model="form.isbn"
                  />
                  <span class="text-danger" v-if="errors.isbn">{{
                    errors.isbn[0]
                  }}</span>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="image">Image</label>
                  <input
                    type="file"
                    class="form-control"
                    id="image"
                    aria-describedby="imageHelp"
                    @change="onImageChange"
                  />
                  <span class="text-danger" v-if="errors.image">{{
                    errors.image[0]
                  }}</span>
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    v-model="form.published"
                    id="published"
                  />
                  <label class="custom-control-label" for="published"
                    >Want to publish ?</label
                  >
                </div>
              </div>
              <div class="col-sm-6 mt-3">
                <div class="form-group fill">
                  <label class="floating-label" for="publisher"
                    >Publisher</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="publisher"
                    aria-describedby="publisherHelp"
                    v-model="form.publisher"
                  />
                  <span class="text-danger" v-if="errors.publisher">{{
                    errors.publisher[0]
                  }}</span>
                </div>
              </div>
              <div class="col-sm-12 mt-4">
                <button type="submit" class="btn btn-primary btn-sm has-ripple">
                  Add Book
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Add",
  data() {
    return {
      form: {},
    };
  },
  computed: {
    errors() {
      return this.$store.getters.getError;
    },
  },
  methods: {
    onImageChange(e) {
      this.form.image = e.target.files[0];
    },
    addBook() {
      this.$store.dispatch("storeBook", this.form);
      // if (this.$store.state.errors && this.errors.length > 0) {
      //   this.$router.push({ name: "Books" });
      // }
    },
  },
};
</script>
