<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
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
          </div>

          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title mb-0">Ajouter Ordonnance</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="biller-info">
                      <h4 class="d-block">Dr. {{ user.name }}</h4>
                      <span class="d-block text-sm text-muted"></span>
                      <span class="d-block text-sm text-muted">{{
                        user.address
                      }}</span>
                    </div>
                  </div>
                  <div class="col-sm-6 text-sm-right">
                    <div class="billing-info">
                      <span class="d-block text-muted">#INV0001</span>
                    </div>
                  </div>
                </div>

                <!-- Add Item -->
                <div class="add-more-item text-right">
                  <a href="javascript:void(0);" @click.prevent="add()"
                    ><i class="fas fa-plus-circle"></i> ajouter Item</a
                  >
                </div>
                <!-- /Add Item -->

                <!-- Prescription Item -->
                <p class="alert alert-success" v-if="success">
                  Ordonnance & Facture ajouter avec success
                </p>
                <div class="card card-table">
                  <div class="card-body">
                    <div>
                      <input type="hidden" v-model="date" />

                      <input type="hidden" v-model="appointment_id" />

                      <strong>Nom du maladie:</strong>
                      <input
                        style="width: 500px"
                        type="text"
                        class="form-control"
                        v-model="name_of_disease"
                      />
                    </div>

                    <diçv class="table-responsive">
                      <table class="table table-hover table-center">
                        <thead>
                          <tr>
                            <th style="min-width: 200px">Médicament</th>
                            <th style="min-width: 100px">
                              procédure d'utilisation
                            </th>

                            <th style="min-width: 80px"></th>
                          </tr>
                        </thead>

                        <tbody v-for="(input, key) in inputs" :key="key">
                          <tr>
                            <td>
                              <input
                                class="form-control"
                                type="text"
                                name="medicine"
                                v-model="medicine[key]"
                                :id="input.key"
                              />
                            </td>
                            <td>
                              <input
                                class="form-control"
                                type="text"
                                name="procedure_to_use_medicine"
                                v-model="procedure_to_use_medicine[key]"
                                :id="input.key"
                              />
                            </td>

                            <td>
                              <a
                                href="#"
                                class="btn bg-danger-light trash"
                                @click.prevent="remove(key)"
                                ><i class="far fa-trash-alt"></i
                              ></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </diçv>
                  </div>
                </div>
                <!-- /Prescription Item -->

                <!-- Signature -->
                <div class="row">
                  <div class="col-md-12 text-right">
                    <div class="signature-wrap">
                      <div class="sign-name">
                        <input type="hidden" v-model="signature" />
                        <span class="text-muted"
                          >Signature <br />
                          Dr.{{ user.name }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Signature -->

                <!-- Submit Section -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="submit-section">
                      <button @click.prevent="addPrescription">
                        <router-link
                          to="/mypatient"
                          class="btn btn-primary submit-btn"
                        >
                          Envoyer
                        </router-link>
                      </button>

                      <router-link
                        to="/mypatient"
                        class="btn btn-secondary submit-btn"
                        >Annuler</router-link
                      >
                    </div>
                  </div>
                </div>
                <!-- /Submit Section -->
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
  components: { Header, Footer },
  data() {
    return {
      appointement: JSON.parse(localStorage.getItem("appointement")),
      user: this.auth.user,
      inputs: [],

      medicine: [],
      procedure_to_use_medicine: [],
      name_of_disease: "",
      appointment_id: "",
      date: "",
      signature: "",

    
      success: false,
    };
  },
  mounted() {
    this.appointment_id = JSON.parse(localStorage.getItem("appointement")).id;

    this.date = JSON.parse(localStorage.getItem("appointement")).date;

    this.signature = JSON.parse(localStorage.getItem("user")).name;

    this.appointment_id = JSON.parse(localStorage.getItem("appointement")).id;
  },

  methods: {
    add() {
      this.inputs.push({
        medicine: "",
        procedure_to_use_medicine: "",
      });
    },
    remove(key) {
      this.inputs.splice(key, 1);
    },
    async addPrescription() {
      console.log(this.user);
      this.axios
        .post("http://localhost:8000/api/addPrescription", {
          medicine: this.medicine,
          procedure_to_use_medicine: this.procedure_to_use_medicine,
          name_of_disease: this.name_of_disease,

          signature: this.signature,
          date: this.date,
          appointment_id: this.appointment_id,
        })
        .then(({ data }) => {
          this.success = true;
        })

        .catch((error) => {
          console.log(error);
          this.notifmsg = error.response.data;
        });
    },
  },
};
</script>