<template>
  <div>
    <ul class="navbar-nav">
      <li class="nav-item" style="margin-left: 1000px">
        <a class="nav-link" href="javascript:void(0)">
          <i class="fas fa-sign-out-alt" @click="logout"></i>
          <p>
            <span class="d-lg-none d-md-block">Account</span>
          </p>
        </a>
      </li>
    </ul>

    <div class="content success-page-cont">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <!-- Success Card -->
            <div class="card success-card">
              <div class="card-body">
                <div class="success-cont">
                  <i class="fas fa-check"></i>
                  <h3>Attendez la confirmation de l'administrateur de site!</h3>
                  <p>
                    Bienvenue parmi nous <strong>{{ user.name }}</strong
                    ><br />
                  </p>
                </div>
              </div>
            </div>
            <!-- /Success Card -->
          </div>
        </div>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
        <pre></pre>
      </div>
    </div>
    <Footer></Footer>
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

  created() {},

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