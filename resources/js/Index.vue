<template>
  <div id="app" style="background-color: azure">
    <nav
      class="navbar navbar-expand-lg navbar-light bg-light fixed-top"
      style="height: 5px"
      v-if="!this.auth.user"
    >
      <div class="container">
        <router-link class="navbar-brand" to="/" style="color: black"
          ><span>QuikRDV</span></router-link
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
          aria-controls="navbarResponsive"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <router-link class="nav-link" to="/" style="color: black"
                >Accueil
              </router-link>
            </li>

            <li class="nav-item register-btn reg-login-btn">
              <router-link
                class="btn btn-info nav-link"
                to="/registerDoctor"
                v-if="!this.auth.user"
                >Etes vous professionnels de santé?</router-link
              >
            </li>
            <li v-if="!this.auth.user" class="nav-item reg-login-btn">
              <router-link
                class="btn btn-primary text-weight nav-link"
                to="/login"
                >Se connecter</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <router-view :key="$route.fullPath"></router-view>
  </div>
</template>

<script>
import Auth from "./Auth.js";
export default {
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
        .post("http://127.0.0.1:8000/api/logout")
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