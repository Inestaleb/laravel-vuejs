<template>
  <div>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="card-body">
            <div class="login-form">
              <div class="login100-form-title">
                <span class="login100-form-title-1"> Inscription </span>
              </div>
              <pre></pre>

              <div class="wrap-input100 validate-input">
                <input
                  type="text"
                  class="input100"
                  v-model="user.name"
                  placeholder="nom et prenom"
                  required
                />
              </div>
              <div class="wrap-input100 rs1 validate-input">
                <input
                  type="text"
                  class="input100"
                  v-model="user.phone_number"
                  placeholder="Numéro de mobile"
                  required
                />
              </div>
              <div class="wrap-input100 rs1 validate-input">
                <input
                  type="text"
                  class="input100"
                  v-model="user.email"
                  placeholder="Adresse email"
                  required
                />
              </div>
              <div class="wrap-input100 rs1 validate-input">
                <input
                  type="password"
                  class="input100"
                  v-model="user.password"
                  placeholder="mot de passe"
                  required
                />
              </div>
              <div class="wrap-input100 rs1 validate-input">
                <input
                  type="password"
                  class="input100"
                  v-model="user.password_confirmation"
                  placeholder="confirmer mot de passe "
                  required
                />
              </div>
              <button @click="register" type="button" class="login100-form-btn">
                Soumettre
              </button>

              <p class="text-center">
                avez vous un compte ?
                <strong class="switch-tologin-modal"
                  ><router-link to="/login">Connexion</router-link></strong
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
import Footer from "./Footer.vue";
export default {
  components: { Footer },
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        notifmsg: "",
      },
    };
  },

  methods: {
    async register() {
      console.log(this.user);
      this.axios
        .post("http://localhost:8000/api/register", this.user)
        .then(({ data }) => {
          this.$router.push("/login");
        })
        .catch((error) => {
          console.log(error);
          this.notifmsg = error.response.data;
        });
    },
  },
};
</script>