<template>
  <div class="col-xl-12 col-md-12">
    <div class="card latest-update-card">
      <div class="card-header">
        <h5>Book Detail : {{ form.title }}</h5>
      </div>
      <div class="card mb-3">
        <img
          class="img-fluid card-img-top"
          :src="form.image"
          :alt="form.title"
        />
        <div class="card-body">
          <hr />

          <h5 class="card-title">{{ form.title }}</h5>
          <hr />

          <p class="card-text">
            {{ form.description }}
          </p>
          <hr />

          <p class="card-text">
            <span
              :class="
                form.published != null
                  ? 'badge badge-success'
                  : 'badge badge-danger'
              "
            >
              {{ form.published != null ? "Published" : "Not published yet" }}
            </span>
          </p>
          <hr />
          <p class="card-text">
            {{ form.published != null ? form.publisher : "" }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "../partials/Breadcrumb.vue";
export default {
  components: { Breadcrumb },
  props: ["id"],
  name: "View",
  computed: {
    form() {
      return this.$store.getters.getSingleBook;
    },
  },
  created() {
    this.$store.dispatch("findBook", this.id);
  },
};
</script>
