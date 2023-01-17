<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div
            class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft"
          >
            <!-- Profile Widget -->
            <div class="card widget-profile pat-widget-profile">
              <div class="card-body">
                <div class="pro-widget-content">
                  <div class="profile-info-widget">
                    <a href="#" class="booking-doc-img">
                      <img
                        :src="'/images/patients/' + appointement.patient.image"
                        alt="User Image"
                      />
                    </a>
                    <div class="profile-det-info">
                      <h3>{{ appointement.patient.name }}</h3>

                      <div class="patient-details">
                        <h5>
                          <b>Patient ID :</b> PT00{{ appointement.patient.id }}
                        </h5>
                        <h5 class="mb-0">
                          <i class="fas fa-map-marker-alt"></i
                          >{{ appointement.patient.address }}
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="patient-info">
                  <ul>
                    <li>
                      numéro du téléphone<span>{{
                        appointement.patient.phone_number
                      }}</span>
                    </li>
                    <li>
                      Date de naissance<span>{{
                        appointement.patient.date_birth
                      }}</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- /Profile Widget -->

            <!-- Last Booking -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Liste de rendez vous</h4>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="media align-items-center">
                    <div class="mr-3">
                      <img
                        alt="Image placeholder"
                        :src="'/images/doctor/' + user.image"
                        class="avatar rounded-circle"
                      />
                    </div>
                    <div class="media-body">
                      <h5 class="d-block mb-0">Dr.{{ user.name }}</h5>
                      <span class="d-block text-sm text-muted"></span>
                      <span class="d-block text-sm text-muted"
                        >{{ appointement.date }}
                        {{ appointement.temps.time }}</span
                      >
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /Last Booking -->
          </div>

          <div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
            <div class="card">
              <div class="card-body pt-0">
                <div class="user-tabs">
                  <ul
                    class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap"
                  >
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        href="#pat_appointments"
                        data-toggle="tab"
                        >Rendez-vous</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#pres" data-toggle="tab"
                        ><span>Ordonnances</span></a
                      >
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <!-- Appointment Tab -->
                  <div id="pat_appointments" class="tab-pane fade show active">
                    <div class="card card-table mb-0">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-center mb-0">
                            <thead>
                              <tr>
                                <th>Médecin</th>
                                <th>Date du rendez-vous</th>

                                <th>Montant</th>

                                <th>Status</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                  <h2 class="table-avatar">
                                    <a
                                      href="doctor-profile.html"
                                      class="avatar avatar-sm mr-2"
                                    >
                                      <img
                                        class="avatar-img rounded-circle"
                                        :src="'/images/doctor/' + user.image"
                                        alt="User Image"
                                      />
                                    </a>
                                    <a href="doctor-profile.html"
                                      >Dr. {{ appointement.doctor.name }}</a
                                    >
                                  </h2>
                                </td>
                                <td>
                                  {{ appointement.date }}
                                  <span class="d-block text-info">{{
                                    appointement.temps.time
                                  }}</span>
                                </td>

                                <td>{{ appointement.doctor.price }}</td>

                                <td>
                                  <span
                                    class="badge badge-pill bg-success-light"
                                    >Confirm</span
                                  >
                                </td>
                                <td class="text-right">
                                  <div class="table-action">
                                    <a
                                      href="javascript:void(0);"
                                      class="btn btn-sm bg-success-light"
                                    >
                                      <i class="far fa-edit"></i> Edit
                                    </a>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!--Prescription-->
                  <div class="tab-pane fade" id="pres">
                    <div class="text-right">
                      <router-link to="/add-prescription" class="add-new-btn"
                        >Ajouter Ordonnance</router-link
                      >
                    </div>
                    <div class="card card-table mb-0">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-center mb-0">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Nom</th>
                                <th>Créer par</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody v-for="pres in prescreption" :key="pres.key">
                              <tr v-if="appointement.id == pres.appointment_id">
                                <td>{{ appointement.date }}</td>
                                <td>ID00{{ pres.id }}</td>
                                <td>
                                  <h2 class="table-avatar">
                                    <a
                                      href="doctor-profile.html"
                                      class="avatar avatar-sm mr-2"
                                    >
                                      <img
                                        class="avatar-img rounded-circle"
                                        :src="'/images/doctor/' + user.image"
                                        alt="User Image"
                                      />
                                    </a>
                                    <a href="doctor-profile.html"
                                      >Dr. {{ user.name }}</a
                                    >
                                  </h2>
                                </td>
                                <td class="text-right">
                                  <div class="table-action">
                                    <router-link
                                      href="javascript:void(0);"
                                      class="btn btn-sm bg-info-light"
                                      :to="{
                                        name: 'Prescription',
                                        params: { id: pres.id },
                                      }"
                                    >
                                      <i class="far fa-eye"></i> View
                                    </router-link>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
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

    <Footer></Footer>
  </div>
</template>
<script>
import Footer from "../Footer.vue";
import Header from "./Header.vue";
export default {
  components: { Footer, Header },
  data() {
    return {
      appointement: [],
      prescreption: [],
      user: this.auth.user,
    };
  },
  async created() {
    this.loadData();
    this.load();
    this.getinvoice();
  },
  methods: {
    printInvoice() {
      window.print();
    },
    async load() {
      await this.axios
        .get("http://localhost:8000/api/getprescreption")
        .then((response) => {
          this.prescreption = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.prescreption = [];
        });
    },

    async loadData() {
      await this.axios
        .get(`http://localhost:8000/api/appointement/${this.$route.params.id}`)
        .then((response) => {
          this.appointement = response.data;
          localStorage.setItem("appointement", JSON.stringify(response.data));
        })
        .catch((error) => {
          console.log(error);
          this.appointement = [];
        });
    },
  },
};
</script>