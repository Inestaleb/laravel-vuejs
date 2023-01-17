<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <SideBar></SideBar>
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="appointments">
              <!-- Appointment List -->
              <div
                class="appointment-list"
                v-for="appointent in appointement"
                :key="appointent.key"
              >
                <div class="profile-info-widget">
                  <a href="patient-profile.html" class="booking-doc-img">
                    <img
                      :src="'/images/patients/' + appointent.patient.image"
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
                        <i class="far fa-clock"></i> {{ appointent.date }},
                        {{ appointent.temps.time }}
                      </h5>
                      <h5>
                        <i class="fas fa-map-marker-alt"></i
                        >{{ appointent.patient.address }}
                      </h5>
                      <h5>
                        <i class="fas fa-envelope"></i>
                        {{ appointent.patient.email }}
                      </h5>
                      <h5 class="mb-0">
                        <i class="fas fa-phone"></i>
                        {{ appointent.patient.phone_number }}
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="appointment-action">
                  <router-link
                    v-if="appointent.status == 1"
                    :to="{
                      name: 'PatientProfil',
                      params: { id: appointent.id },
                    }"
                    class="btn btn-sm bg-info-light"
                    data-toggle="modal"
                    data-target="#appt_details"
                  >
                    <i class="far fa-eye"></i> Voir facture & ordonnance
                  </router-link>
                  <i v-if="appointent.status == 2" class="bg-danger-light">
                    Refuser
                  </i>
                  <a
                    v-if="appointent.status == 0"
                    href="javascript:void(0);"
                    class="btn btn-sm bg-success-light"
                    @click="Accepter(appointent.id)"
                  >
                    <i class="fas fa-check"></i> Accepter
                  </a>
                  <a
                    v-if="appointent.status == 0"
                    href="javascript:void(0);"
                    class="btn btn-sm bg-danger-light"
                    @click="Refuser(appointent.id)"
                  >
                    <i class="fas fa-times"></i> Refuser
                  </a>
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
        .get("http://localhost:8000/api/AllAppointement")
        .then((response) => {
          this.appointement = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.appointement = [];
        });
    },

    Accepter(id) {
      this.success = false;
      let formData = new FormData();
      formData.append("status", this.appointement.status);

      this.axios
        .post(`http://localhost:8000/api/AccepterAppointement/${id}`, formData)

        .then((response) => {
          this.success = true;
          this.loadData();
        });
    },
    Refuser(id) {
      this.success = false;
      let formData = new FormData();
      formData.append("status", this.appointement.status);

      this.axios
        .post(`http://localhost:8000/api/RefuserAppointement/${id}`, formData)

        .then((response) => {
          this.success = true;
          this.loadData();
        });
    },
  },
};
</script>
