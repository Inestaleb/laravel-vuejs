<template>
  <div>
    <div class="limiter">
      <pre></pre>
      <pre></pre>
      <pre></pre>
      <div class="container-login100">
        <div class="wrap-login100">
          <div class="card-body">
            <div class="login-form">
              <div class="login100-form-title">
                <span class="login100-form-title-1">
                  Vous êtes praticien ?
                </span>
              </div>
              <pre></pre>
              <pre></pre>

              <div class="wrap-input100 validate-input">
                <input
                  type="text"
                  class="form-control"
                  v-model="email"
                  placeholder="Adresse email"
                  required
                />
              </div>
              <div class="wrap-input100 validate-input">
                <input
                  type="text"
                  class="form-control"
                  v-model="phone_number"
                  placeholder="Numéro de mobile"
                  required
                />
              </div>

              <div class="wrap-input100 validate-input">
                <input
                  type="text"
                  class="form-control"
                  v-model="name"
                  placeholder="nom et prenom"
                  required
                />
              </div>
              <div class="wrap-input100 rs1 validate-input">
                <input
                  type="text"
                  class="form-control"
                  v-model="address"
                  placeholder="Adresse"
                  required
                />
              </div>

              <div class="wrap-input100 rs1 validate-input">
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  placeholder="mot de passe"
                  required
                />
              </div>
              <div class="wrap-input100 validate-input">
                <input
                  type="password"
                  class="form-control"
                  v-model="password_confirmation"
                  placeholder="confirmer mot de passe "
                  required
                />
              </div>
              Specialite:
              <select class="form-select" v-model="specilaity_id">
                <option selected>Choisissez votre spécialité</option>

                <option
                  v-for="specialite in specialites"
                  :key="specialite.id"
                  v-bind:value="specialite.id"
                >
                  {{ specialite.name }}
                </option>
              </select>
              <pre></pre>
              <div class="wrap-input100 rs1 validate-input">
                <p>
                  Pour assurer de la pertinence des données sur notre
                  plateforme, nous vous prions de nous envoyer une photo de
                  votre carte de visite tamponnée ou bien votre permis
                  d'exercice.
                </p>
                <input
                  class="form-control form-control-lg"
                  id="formFileLg"
                  type="file"
                  v-on:change="saveImage"
                />
              </div>
              <pre></pre>
              <center>
                <button @click="register" type="button" class="btn btn-primary">
                  Soumettre
                </button>
              </center>
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
      name: "",
      email: "",
      phone_number: "",
      address: "",
      password: "",
      specilaity_id: "",
      password_confirmation: "",

      apptitude: "",
      specialites: [],
    };
  },
  async created() {
    this.loadData();
  },
  methods: {
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/getspecialite")
        .then((response) => {
          this.specialites = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.specialites = [];
        });
    },
    async register() {
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("address", this.address);
      formData.append("password", this.password);
      formData.append("password_confirmation", this.password_confirmation);
      formData.append("specilaity_id", this.specilaity_id);
      formData.append("phone_number", this.phone_number);
      formData.append("apptitude", this.apptitude);

      console.log(this.user);
      this.axios
        .post("http://localhost:8000/api/inscription", formData)
        .then(({ data }) => {
          this.$router.push("/login");
        })
        .catch((error) => {
          console.log(error);
        });
    },
    saveImage(e) {
      this.apptitude = e.target.files[0];
      console.log(this.apptitude);
    },
  },
};
</script>