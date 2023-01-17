<template>
  <div class="main-wrapper">
    <!-- Header -->
    <header class="header">
      <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
          <a id="mobile_btn" href="javascript:void(0);">
            <span class="bar-icon">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </a>

          <router-link class="navbar-brand logo" to="/" style="color: black"
            ><span>
              <pre></pre>
              <pre></pre>
              QuikRDV</span
            ></router-link
          >
        </div>
        <div class="main-menu-wrapper">
          <div class="menu-header">
            <router-link class="menu-logo" to="/" style="color: black"
              ><span>
                <pre></pre>
                <pre></pre>
                QuikRDV</span
              ></router-link
            >

            <a id="menu_close" class="menu-close" href="javascript:void(0);">
              <i class="fas fa-times"></i>
            </a>
          </div>
          <ul class="main-nav">
            <li>
              <router-link to="/">Home</router-link>
            </li>
          </ul>
        </div>
        <ul class="nav header-navbar-rht" style="margin-left: 1270px">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">
              <li class="nav-item dropdown has-arrow logged-item">
                <a
                  href="#"
                  class="dropdown-toggle nav-link"
                  data-toggle="dropdown"
                >
                  <span class="user-img">
                    <img
                      class="rounded-circle"
                      :src="'/images/doctor/' + user.image"
                      width="31"
                    />
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="user-header">
                    <div class="avatar avatar-sm">
                      <img
                        :src="'/images/doctor/' + user.image"
                        class="avatar-img rounded-circle"
                      />
                    </div>
                    <div class="user-text">
                      <h6>{{ user.name }}</h6>
                      <p class="text-muted mb-0">Doctor</p>
                    </div>
                  </div>
                  <router-link class="dropdown-item" to="/DoctorDashboard"
                    >Dashboard</router-link
                  >
                  <router-link
                    class="dropdown-item"
                    to="/doctor-profile-settings"
                    >Profile Settings</router-link
                  >
                  <a class="dropdown-item" @click="logout">Déconnexion</a>
                </div>
              </li>
              <p>
                <span class="d-lg-none d-md-block">Account</span>
              </p>
            </a>
          </li>

          <!-- /User Menu -->
        </ul>
      </nav>
    </header>
    <div class="breadcrumb-bar">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-md-12 col-12">
            <nav aria-label="breadcrumb" class="page-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <router-link to="/">Home</router-link>
                </li>
                /
                <li class="breadcrumb-item active" aria-current="page">
                  <router-link to="/DoctorDashboard">Dashboard</router-link>
                </li>
              </ol>
            </nav>
            <h2 class="breadcrumb-title">Dashboard</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Auth from "../../Auth";
export default {
  data() {
    return {
      user: this.auth.user,
    };
  },
  created() {
    // console.log(this.auth.user);
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
