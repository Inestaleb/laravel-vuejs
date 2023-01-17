<template>
  <div>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="card-body">
            <div class="login-form">
              <div class="login100-form-title">
                <span class="login100-form-title-1"> Connexion </span>
                <pre></pre>
              </div>
              <div class="alert alert-danger" v-if="has_error && !success">
                <p v-if="error == 'login_error'">Validation Errors.</p>
                <p v-else>
                  Erreur, impossible de se connecter avec ces identifiants.
                </p>
              </div>
              <form autocomplete="off" @submit.prevent="login" method="post">
                <input
                  type="email"
                  class="input100"
                  v-model="user.email"
                  placeholder="Email"
                />
                <span class="focus-input100-1"> </span>
                <span class="focus-input100-2"></span>

                <input
                  type="password"
                  class="input100"
                  v-model="user.password"
                  placeholder="Mot de passe"
                />
                <span class="focus-input100-1"></span>
                <span class="focus-input100-2"></span>

                <div class="container-login100-form-btn m-t-20">
                  <button class="login100-form-btn" type="submit">
                    Connexion
                  </button>
                </div>
              </form>

              <p class="text-center">
                <router-link class="switch-toregister-modal" to="/register"
                  >créer un compte</router-link
                >
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>
<script>
import Auth from "../Auth.js";
import Footer from "./Footer.vue";

export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      success: false,
      has_error: false,
      error: "",
    };
  },
  methods: {
    login() {
      this.axios
        .post("http://localhost:8000/api/login", this.user)
        .then(({ data }) => {
          Auth.login(data.access_token, data.user);
          this.success = true;
          if (data.user.role_id == 3) {
            this.$router.push("/dashboard");
          } else if (data.user.role_id == 2) {
            this.$router.push("/adminDashboard").catch(() => {});
          } else if (data.user.status == 0 && data.user.role_id == 1) {
            this.$router.push("/verif").catch(() => {});
          } else if (data.user.status == 1 && data.user.role_id == 1) {
            this.$router.push("/DoctorDashboard").catch(() => {});
          }
        })
        .catch((error) => {
          this.has_error = true;
          this.error = error.response.data.errors;
        });
    },
  },
  components: { Footer },
};
</script>