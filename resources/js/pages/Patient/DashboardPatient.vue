<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <Sidebar></Sidebar>
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card">
              <div class="card-body pt-0">
                <!-- Tab Menu -->
                <nav class="user-tabs mb-4">
                  <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                    <li class="nav-item">
                      <a
                        class="nav-link active"
                        href="#pat_appointments"
                        data-toggle="tab"
                        >Liste Rendez-vous</a
                      >
                    </li>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        href="#pat_prescriptions"
                        data-toggle="tab"
                        >Ordonnances
                      </a>
                    </li>
                  </ul>
                </nav>

                <div class="tab-content pt-0">
                  <!-- Appointment Tab -->
                  <div id="pat_appointments" class="tab-pane fade show active">
                    <div class="card card-table mb-0">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-center mb-0">
                            <thead>
                              <tr>
                                <th>Médecin</th>
                                <th>Date de rendez_vous</th>
                                <th>date de réservation</th>
                                <th>Tarif</th>

                                <th>Status</th>
                                <th>Action</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="appointent in appointement"
                                :key="appointent.key"
                              >
                                <td>
                                  <h2 class="table-avatar">
                                    <a
                                      href="doctor-profile.html"
                                      class="avatar avatar-sm mr-2"
                                    >
                                      <img
                                        class="avatar-img rounded-circle"
                                        :src="
                                          '/images/doctor/' +
                                          appointent.doctor.image
                                        "
                                        alt="User Image"
                                      />
                                    </a>
                                    <a href="doctor-profile.html"
                                      >Dr. {{ appointent.doctor.name }}
                                      <span></span
                                    ></a>
                                  </h2>
                                </td>
                                <td>
                                  {{ appointent.date }}
                                  <span class="d-block text-info">{{
                                    appointent.temps.time
                                  }}</span>
                                </td>
                                <td>{{ appointent.created_at }}</td>
                                <td>{{ appointent.doctor.price }} dt</td>

                                <td v-if="appointent.status == 0">
                                  <span
                                    class="badge badge-pill bg-warning-light"
                                    >en attente</span
                                  >
                                </td>
                                <td v-if="appointent.status == 2">
                                  <span class="badge badge-pill bg-danger-light"
                                    >refuser</span
                                  >
                                </td>
                                <td v-if="appointent.status == 1">
                                  <span
                                    class="badge badge-pill bg-success-light"
                                    >confirmer</span
                                  >
                                </td>

                                <td class="text-right">
                                  <div class="table-action">
                                    <router-link
                                      class="btn btn-sm bg-info-light"
                                      :to="{
                                        name: 'invoice',
                                        params: {
                                          id: appointent.id,
                                        },
                                      }"
                                    >
                                      <i class="far fa-eye"></i> View
                                    </router-link>
                                    <button
                                      href="javascript:void(0);"
                                      v-if="appointent.status == 0"
                                      class="btn btn-sm bg-primary-light"
                                      @click="deleteAppointment(appointent.id)"
                                    >
                                      <i class="fas fa-"></i> Annuler
                                    </button>
                                    <button
                                      class="btn btn-sm bg-info-light"
                                      v-if="appointent.status == 0"
                                      data-toggle="modal"
                                      data-target="#exampleModalCenter"
                                      @click="getAppointement(appointent.id)"
                                    >
                                      <i class="far fa-"></i> modifier
                                    </button>
                                    <div
                                      class="modal fade"
                                      id="exampleModalCenter"
                                      tabindex="-1"
                                      role="dialog"
                                      aria-labelledby="exampleModalCenterTitle"
                                      aria-hidden="true"
                                    >
                                      <div
                                        class="
                                          modal-dialog modal-dialog-centered
                                        "
                                        role="document"
                                      >
                                        <div class="modal-content">
                                          <div
                                            class="modal-header"
                                            style="background-color: aqua"
                                          >
                                            <h5
                                              class="modal-title"
                                              id="exampleModalLongTitle"
                                            >
                                              Modifier Rendez-vous
                                            </h5>
                                            <button
                                              type="button"
                                              class="close"
                                              data-dismiss="modal"
                                              aria-label="Close"
                                            >
                                              <span aria-hidden="true"
                                                >&times;</span
                                              >
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="form-group">
                                              <div class="col-auto">
                                                <label>date </label
                                                ><input
                                                  type="date"
                                                  v-model="app.date"
                                                  class="form-control"
                                                />
                                              </div>
                                              <pre></pre>

                                              <div class="col-auto">
                                                <div class="time-slot">
                                                  <ul>
                                                    <li
                                                      class="clearfix"
                                                      v-for="(t, key) in times"
                                                      :key="t.id"
                                                      v-bind:vale="t.id"
                                                    >
                                                      <div
                                                        class="timing"
                                                        v-if="
                                                          app.date == t.date &&
                                                          app.doctor_id ==
                                                            t.doctor_id
                                                        "
                                                      >
                                                        <label>
                                                          <input
                                                            v-if="t.status == 1"
                                                            type="radio"
                                                            :value="t.id"
                                                            v-model="
                                                              app.time_id
                                                            "
                                                            :id="key"
                                                            disabled />
                                                          <input
                                                            v-else-if="
                                                              t.status == 0
                                                            "
                                                            type="radio"
                                                            :value="t.id"
                                                            v-model="
                                                              app.time_id
                                                            "
                                                            :id="key" />
                                                          <span>{{
                                                            t.time
                                                          }}</span>
                                                          <br
                                                        /></label>
                                                      </div>
                                                      <pre></pre>
                                                    </li>
                                                  </ul>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button
                                              type="button"
                                              class="btn btn-secondary"
                                              data-dismiss="modal"
                                            >
                                              Fermer
                                            </button>
                                            <button
                                              type="button"
                                              class="btn btn-primary"
                                              @click="
                                                AppointementUpdate(app.id)
                                              "
                                            >
                                              Modifier
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pat_prescriptions">
                    <div class="card card-table mb-0">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover table-center mb-0">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Nom</th>
                                <th>Creér par</th>
                                <th>Ordonnances</th>
                              </tr>
                            </thead>
                            <tbody v-for="pres in prescreption" :key="pres.key">
                              <tr v-if="user.id == pres.rendezvous.patient_id">
                                <td>{{ pres.date }}</td>
                                <td>ID00{{ pres.id }}</td>
                                <td>
                                  <h2 class="table-avatar">
                                    <a href="doctor-profile.html"
                                      >Dr. {{ pres.signature }} <span></span
                                    ></a>
                                  </h2>
                                </td>
                                <td class="text-right">
                                  <div class="table-action">
                                    <router-link
                                      class="btn btn-sm bg-info-light"
                                      :to="{
                                        name: 'PresPatient',
                                        params: {
                                          id: pres.id,
                                        },
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
import Sidebar from "./Sidebar.vue";
import Header from "./Header.vue";
import Footer from "../Footer.vue";

export default {
  components: { Sidebar, Header, Footer },

  data() {
    return {
      appointement: [],
      app: {
        date: "",
        doctor_id: "",
        time_id: "",
      },

      user: this.auth.user,
      times: [],
      prescreption: [],
      invoice: [],
    };
  },
  watch: {
    date: "getResults",
    doctor_id: "getResults",
  },

  async created() {
    this.loadData();
    this.getResults();
    this.load();
  },
  methods: {
    printInvoice() {
      window.print();
    },
    async load() {
      await this.axios
        .get("http://localhost:8000/api/prescreption")
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
        .get("http://localhost:8000/api/Appointement")
        .then((response) => {
          this.appointement = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.appointement = [];
        });
    },

    async getAppointement(id) {
      await this.axios
        .get(`http://localhost:8000/api/getAppointement/${id}`)
        .then((response) => {
          this.app = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.app = [];
        });
    },

    async getResults() {
      await this.axios
        .get("http://localhost:8000/api/getTime", {
          params: {
            date: this.app.date,
            doctor_id: this.app.doctor_id,
          },
        })
        .then((response) => {
          this.times = response.data;
          this.errored = false;
        })
        .catch((error) => {
          this.errored = true;
          console.log(error);
        });
    },
    AppointementUpdate(id) {
      this.success = false;
      let formData = new FormData();
      formData.append("date", this.app.date);
      formData.append("time_id", this.app.time_id);

      this.axios
        .post(`http://localhost:8000/api/AppointementUpdate/${id}`, formData)

        .then((response) => {
          window.location.reload();
          this.success = true;
        });
    },
    deleteAppointment(id) {
      if (confirm("Êtes-vous sûr de vouloir annuler ce rendez-vous ?")) {
        this.axios
          .delete(`http://localhost:8000/api/deleteAppointment/${id}`)
          .then((response) => {
            this.loadData();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>
