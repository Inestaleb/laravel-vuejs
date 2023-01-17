<template>
  <div>
    <Header></Header>
    <div class="content success-page-cont">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <!-- Success Card -->
            <div class="card success-card">
              <div class="card-body">
                <div class="success-cont">
                  <i class="fas fa-check"></i>
                  <h3>Rendez-vous pris avec succès !</h3>
                  <p>
                    Rendez-vous pris avec<strong>{{ medecin.name }}</strong
                    ><br />
                    en
                    <strong>{{ time.date }} {{ time.time }}</strong>
                  </p>
                  <router-link
                    v-if="type == 'En vidéo'"
                    :to="{ name: 'invoice', params: { id: app_id } }"
                    class="btn btn-primary view-inv-btn"
                    >consulter facture</router-link
                  >
                </div>
              </div>
            </div>
            <!-- /Success Card -->
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>
<script>
import Header from "./Patient/Header.vue";
import Footer from "./Footer.vue";
export default {
  components: { Header, Footer },
  data() {
    return {
      time: {},
      medecin: JSON.parse(localStorage.getItem("medecin")),
      type: localStorage.getItem("type"),
      app_id: JSON.parse(localStorage.getItem("appointement_id")),
    };
  },

  created() {
    this.loadData();
    this.time_id = localStorage.getItem("time_id");
  },

  methods: {
    loadData() {
      this.time_id = localStorage.getItem("time_id");
      this.axios
        .get(`http://localhost:8000/api/time/${this.time_id}`)
        .then((response) => {
          this.time = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },

  created() {
    this.loadData();
  },
};
</script>

<style scoped>
</style>