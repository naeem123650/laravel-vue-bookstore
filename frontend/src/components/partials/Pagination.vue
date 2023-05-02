<template>
  <div class="row">
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li class="page-item" :class="[page <= 1 ? 'disabled' : '']">
          <router-link
            class="page-link"
            :to="{ name: 'Dashboard', query: { page: page - 1 } }"
            aria-label="Previous"
          >
            <span aria-hidden="true">Previous</span>
          </router-link>
        </li>

        <li class="page-item" :class="[hasMorePages ? 'disabled' : '']">
          <router-link
            class="page-link"
            :to="{ name: 'Dashboard', query: { page: page + 1 } }"
            aria-label="Next"
          >
            <span aria-hidden="true">Next</span>
          </router-link>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  props: ["page", "totalPage", "perPage"],
  name: "Pagination",
  computed: {
    hasMorePages() {
      const check = Math.ceil(this.totalPage / this.perPage);

      return this.page >= check;
    },
  },
};
</script>
