

<template>
  <div>
    <div v-if="this.auth.user">
      <div v-if="this.auth.user.role_id == 3"><Header></Header></div>
      <div v-else-if="this.auth.user.role_id == 1"><Header1></Header1></div>
    </div>
    <div class="s003">
      <div class="row" id="row1">
        <div class="col">
          <h1>
            Bienvenue a <br />
            <span>QuickRdv</span>
          </h1>
          <h2 style="color: black">
            Planifiez une consultation physique ou vidéo avec un professionnel
            de la santé
          </h2>
        </div>

        <div class="row">
          <div class="w-100">
            <form>
              <div class="inner-form">
                <pre></pre>
                <pre></pre>
                <div class="input-field second-wrap">
                  <input
                    id="search"
                    type="text"
                    placeholder="Nom du professionnel de santé"
                    v-model="name"
                  />
                </div>
                <div class="input-field first">
                  <input
                    id="search"
                    type="text"
                    placeholder="Ville"
                    v-model="address"
                  />
                </div>
                <div>
                  <select class="input-field first-wrap" v-model="specialite">
                    <option :value="null" selected>Spécialité</option>

                    <option v-for="(specialite, key) in specialites" :key="key">
                      {{ specialite.name }}
                    </option>
                  </select>
                </div>
                <div class="input-field third-wrap">
                  <button class="btn-search" type="button" @click="getResults">
                    <svg
                      class="svg-inline--fa fa-search fa-w-16"
                      aria-hidden="true"
                      data-prefix="fas"
                      data-icon="search"
                      role="img"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                    >
                      <path
                        fill="currentColor"
                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"
                      ></path>
                    </svg>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from "./Patient/Header.vue";
import Header1 from "./Doctor/Header.vue";
import Footer from "./Footer.vue";
export default {
  components: { Header1, Header, Footer },
  name: "Home",
  data() {
    return {
      specialites: [],
      name: null,
      specialite: null,
      address: null,
      doctors: [],
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
    getResults() {
      this.axios
        .get("http://localhost:8000/api/search", {
          params: {
            name: this.name,
            specialite: this.specialite,
            address: this.address,
          },
        })
        .then((response) => {
          localStorage.setItem("doc", JSON.stringify(response.data));
          this.$router.push({
            name: "FindDoctor",
            params: {
              doctors: response.data,
            },
          });
        })
        .catch((error) => {
          const res = error.response;
          if (res && res.status == 403) {
            alert("Vous n'avez pas sélectionné aucune recherche ! ");
          }
          if (res && res.status == 404) {
            this.$router.push("/404");
          }
        });
    },
  },
};
</script>
<style >
#row1 {
  margin-left: 100px;
}
</style>