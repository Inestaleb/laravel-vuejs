<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <SideBar></SideBar>
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="row">
              <div class="col-md-12">
                <div class="card dash-card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-8 col-lg-6">
                        <div class="dash-widget dct-border-rht">
                          <img
                            src="images/icon-01.png"
                            class="img-fluid"
                            alt="patient"
                          />

                          <div class="dash-widget-info">
                            <h6>Nombre Total des patients</h6>
                            <h3>{{ app.length }}</h3>
                            <p class="text-muted">Jusqu'à aujourd'hui</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-8 col-lg-6">
                        <div class="dash-widget">
                          <img
                            src="images/icon-03.png"
                            class="img-fluid"
                            alt="Patient"
                          />

                          <div class="dash-widget-info">
                            <h6>Rendez-vous</h6>
                            <h3>{{ appointement.length }}</h3>
                            <p class="text-muted"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import SideBar from "./SideBar.vue";
import Header from "./Header.vue";

export default {
  components: { SideBar, Header },
  data() {
    return {
      appointement: [],
      app: [],
      user: this.auth.user,
    };
  },
  async created() {
    this.loadData();
    this.load();
  },
  methods: {
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/AllAppointement")
        .then((response) => {
          this.appointement = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.appointement = [];
        });
    },
    async load() {
      await this.axios
        .get("http://localhost:8000/api/getAppointement")
        .then((response) => {
          this.app = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.app = [];
        });
    },
  },
};
</script>
