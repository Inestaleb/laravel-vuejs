<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <SideBar></SideBar>
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="row row-grid">
              <div
                class="col-md-6 col-lg-4 col-xl-3"
                v-for="appointent in appointement"
                :key="appointent.key"
              >
                <div class="card widget-profile pat-widget-profile">
                  <div class="card-body">
                    <div class="pro-widget-content">
                      <div class="profile-info-widget">
                        <a href="#" class="booking-doc-img">
                          <img
                            :src="
                              '/images/patients/' + appointent.patient.image
                            "
                            alt="User Image"
                          />
                        </a>
                        <div class="profile-det-info">
                          <h3>
                            <a href="patient-profile.html">{{
                              appointent.patient.name
                            }}</a>
                          </h3>

                          <div class="patient-details">
                            <h5>
                              <b>Patient ID :</b> P00{{ appointent.patient.id }}
                            </h5>
                            <h5 class="mb-0">
                              <i class="fas fa-map-marker-alt"></i>
                              {{ appointent.patient.address }}
                            </h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="patient-info">
                      <ul>
                        <li>
                          numéro du téléphone
                          <span>{{ appointent.patient.phone_number }}</span>
                        </li>
                        <li>
                          Date de naissance
                          <span>{{ appointent.patient.date_birth }}</span>
                        </li>
                        <li>
                          Antécédant
                          <span>{{ appointent.patient.antecedant }}</span>
                        </li>
                      </ul>
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
      user: this.auth.user,
    };
  },
  async created() {
    this.loadData();
  },
  methods: {
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/getAppointement")
        .then((response) => {
          this.appointement = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.appointement = [];
        });
    },
  },
};
</script>
