<template>
  <div class="main-panel" id="main-panel">
    <!-- Navbar -->
    <nav
      class="
        navbar navbar-expand-lg navbar-transparent
        bg-primary
        navbar-absolute
      "
    >
      <div class="container-fluid">
        <div class="navbar-wrapper">
          <div class="navbar-toggle">
            <button type="button" class="navbar-toggler">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </button>
          </div>
        </div>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navigation"
          aria-controls="navigation-index"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
          <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navigation"
        >
          <form>
            <div class="input-group no-border"></div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item"></li>

            <li class="nav-item">
              <a class="nav-link" @click="logout">
                <i class="fas fa-sign-out-alt" v-if="this.auth.user"></i>
                <p>
                  <span class="d-lg-none d-md-block">Account</span>
                </p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import Auth from "../../Auth";
export default {
  name: "Navbar",
  data() {
    return {
      loggedUser: this.auth.user,
    };
  },
  mounted() {
    console.log(this.auth.user);
  },
  methods: {
    logout() {
      this.axios
        .post("http://localhost:8000/api/logout")
        .then(({ data }) => {
          Auth.logout();
          this.$router.push("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
</style>