<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="booking-doc-info">
                  <a href="doctor-profile.html" class="booking-doc-img">
                    <img
                      :src="'/images/doctor/' + med.image"
                      alt="User Image"
                    />
                  </a>
                  <div class="booking-info">
                    <h4>
                      <a href="doctor-profile.html">Dr.{{ med.name }}</a>
                    </h4>
                    <p class="text-muted mb-0">
                      <i class=""></i> {{ med.specialite.name }}
                    </p>
                    <p class="text-muted mb-0">
                      <i class="fas fa-map-marker-alt"></i> {{ med.address }}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div>
                <div class="row">
                  <div
                    class="col-md-12 offset-md-12 border p-4 shadow bg-white"
                  >
                    <div class="">
                      <h3
                        class="
                          fw-normal
                          text-secondary
                          fs-4
                          text-uppercase
                          mb-4
                        "
                      >
                        Prendre Rendez-vous
                      </h3>
                    </div>
                    <form action="">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <datepicker
                            class="my-datepicker"
                            calendar-class="my-datepicker_calendar"
                            :disabledDates="disabledDates"
                            :format="customDate"
                            v-model="date"
                            :inline="true"
                          ></datepicker>
                        </div>
                        <div v-if="errored">
                          <p style="color: red">n'est pas disponible</p>
                        </div>

                        <div v-else>
                          <div class="time-slot">
                            <ul>
                              <li
                                class="clearfix"
                                v-for="(t, key) in times"
                                :key="t.id"
                                v-bind:vale="t.id"
                              >
                                <div class="timing">
                                  <label>
                                    <input
                                      v-if="t.status == 1"
                                      type="radio"
                                      :value="t.id"
                                      v-model="time_id"
                                      :id="key"
                                      disabled />
                                    <input
                                      v-else-if="t.status == 0"
                                      type="radio"
                                      :value="t.id"
                                      v-model="time_id"
                                      :id="key" />
                                    <span>{{ t.time }}</span> <br
                                  /></label>
                                </div>
                                <pre></pre>
                              </li>
                            </ul>
                          </div>
                        </div>
                        <div class="col-12">
                          <select class="form-select" v-model="type">
                            <option selected>type</option>
                            <option>Au cabinet</option>
                            <option>En vidéo</option>
                          </select>
                        </div>
                        <input type="hidden" v-model="doctor_id" />

                        <input type="hidden" v-model="appointment_id" />
                        <div class="col-12 mt-5">
                          <button
                            v-if="type == 'Au cabinet'"
                            type="button"
                            class="btn btn-primary float-end"
                            @click="book"
                          >
                            prendre rendez-vous
                          </button>
                          <input type="hidden" v-model="amount" />
                          <router-link to="/paye"
                            ><button
                              v-if="type == 'En vidéo'"
                              type="button"
                              class="btn btn-primary float-end"
                              @click="paymeePost"
                            >
                              accéder au paiement
                            </button></router-link
                          >
                        </div>
                      </div>
                    </form>
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
import datepicker from "vuejs-datepicker";
import moment from "moment";
import Header from "./Patient/Header.vue";
export default {
  components: { Header, datepicker },
  data() {
    return {
      med: {},
      times: [],
      amount: "",
      appointment_id: "",
      errored: false,
      date: null,
      time_id: "",
      type: "",
      doctor_id: JSON.stringify(this.$route.params.id),
      disabledDates: {
        to: new Date(Date.now() - 86400000),
        days: [6, 0], // Disable Saturday's and Sunday'
      },
    };
  },

  mounted() {
    console.log(" component successfully mounted");
    this.amount = JSON.parse(localStorage.getItem("medecin")).price;
    this.appointment_id = JSON.parse(localStorage.getItem("appointement")).id;
    this.loadData();
  },

  watch: {
    date: "getResults",
    doctor_id: "getResults",
  },

  methods: {
    paymeePost() {
      localStorage.setItem("time_id", this.time_id);
      localStorage.setItem("date", this.date);
      localStorage.setItem("type", this.type);
      localStorage.setItem("doctor_id", this.doctor_id);
      this.amount = JSON.parse(localStorage.getItem("medecin")).price;
      this.axios
        .post("http://localhost:8000/api/paymeePost", { amount: this.amount })
        .then(function (response) {
          //console.log("dddddd", response.data.data.token);
          localStorage.setItem("tokenpaymee", response.data.data.token);
        })

        .catch((error) => {
          console.log(error);
        });
    },
    customDate(date) {
      this.date = moment(date).format("YYYY-MM-DD");
    },
    loadData() {
      this.axios
        .get(`http://localhost:8000/api/doctor/${this.$route.params.id}`)
        .then((response) => {
          this.med = response.data;

          localStorage.setItem("medecin", JSON.stringify(response.data));
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    async getResults() {
      await this.axios
        .get("http://localhost:8000/api/getTime", {
          params: {
            date: this.date,
            doctor_id: JSON.stringify(this.$route.params.id),
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
    book() {
      //console.log(this.appointement);
      localStorage.setItem("type", this.type);
      this.axios
        .post("http://localhost:8000/api/appointements", {
          date: this.date,
          time_id: this.time_id,
          type: this.type,
          doctor_id: this.doctor_id,
        })
        .then(function (response) {
          console.log(response);
          localStorage.setItem("appointement_id", response.data.id);
          window.location.replace("/book-sucess");
        })

        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.loadData();
  },
};
</script>
<style scoped>
.my-datepicker {
  color: rgb(44, 44, 252);
}
</style>