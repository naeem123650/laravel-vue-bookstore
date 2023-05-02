<template>
  <div>
    <notifications position="top right" />
    <!-- [ navigation menu ] start -->
    <Navbar />
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <Header />
    <!-- [ Header ] end -->
    <div class="pcoded-main-container">
      <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <Breadcrumb />
        <!-- [ breadcrumb ] end -->
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumb from "@/components/partials/Breadcrumb.vue";
import Header from "@/components/partials/Header.vue";
import Loader from "@/components/partials/Loader.vue";
import Navbar from "@/components/partials/Navbar.vue";

export default {
  name: "App",
  components: { Loader, Navbar, Header, Breadcrumb },
};
</script>

<style>
.vue-notification {
  margin: 0 5px 5px;
  padding: 10px;
  font-size: 12px;
  color: #9e0303;
}
</style>
