<template>
  <nav class="pcoded-navbar menu-light">
    <div class="navbar-wrapper">
      <div class="navbar-content scroll-div">
        <div class=""></div>

        <ul class="nav pcoded-inner-navbar">
          <li class="nav-item pcoded-menu-caption">
            <label>Dashboad</label>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Dashboard' }" class="nav-link">
              <span class="pcoded-micon pl-2">
                <i class="feather icon-home"></i>
              </span>
              <span class="pcoded-mtext ml-3">Book Collection</span>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Books' }" class="nav-link">
              <span class="pcoded-micon pl-2">
                <i class="feather icon-lock"></i>
              </span>
              <span class="pcoded-mtext ml-3">Manage Books</span>
            </router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
};
</script>
