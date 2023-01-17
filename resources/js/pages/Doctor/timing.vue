<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <SideBar></SideBar>
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card">
              <div class="card-body">
                <p class="alert alert-success" v-if="success">
                  horaire de travail ajouter avec success
                </p>
                <h4 class="card-title">Disponibilité</h4>
                <form>
                  <div class="card">
                    <div class="card-header">Choose date</div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <datepicker
                            class="my-datepicker"
                            calendar-class="my-datepicker_calendar"
                            :disabledDates="disabledDates"
                            :format="customDate"
                            v-model="times.date"
                            :inline="true"
                          ></datepicker>
                        </div>
                        <div class="col-sm-8">
                          <table style="width: 100%">
                            <tr>
                              <th>date</th>
                              <th>horaire</th>
                              <th>action</th>
                            </tr>
                            <tr v-for="t in temps" :key="t.key">
                              <td>{{ t.date }}</td>
                              <td>{{ t.time }}</td>
                              <td>
                                <a
                                  class="btn btn-sm bg-danger-light"
                                  @click="deletetime(t.id)"
                                  ><i class="fas fa-times"></i> supprimer</a
                                >
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header">
                      Choose AM time
                      <span style="margin-left: 700px"
                        >Check/Uncheck
                        <input
                          type="checkbox"
                          onclick=" for(c in document.getElementsByName('time')) document.getElementsByName('time').item(c).checked=this.checked "
                        />
                      </span>
                    </div>
                    <div class="card-body">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="08:00"
                              />08:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="08:30"
                              />08:30
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="09:00"
                              />09:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="09:30"
                              />09:30
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="10:00"
                              />10:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="10:30"
                              />10:30
                            </td>
                          </tr>

                          <tr>
                            <th scope="row">4</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="11:00"
                              />11:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="11:30"
                              />11:30
                            </td>
                          </tr>

                          <tr>
                            <th scope="row">5</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="12:00"
                              />12:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="12:30"
                              />12:30
                            </td>
                          </tr>

                          <tr>
                            <th scope="row">6</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="13:00"
                              />13:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="13:30"
                              />13:30
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">7</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="14:00"
                              />14:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="14:30"
                              />14:30
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">8</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="15:00"
                              />15:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="15:30"
                              />15:30
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">9</th>
                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="16:00"
                              />16:00
                            </td>

                            <td>
                              <input
                                type="checkbox"
                                name="time"
                                v-model="times.time"
                                value="16:30"
                              />16:30
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <button
                    type="button"
                    class="btn btn-primary float-end"
                    @click="setTime"
                  >
                    submit
                  </button>
                </form>
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
import SideBar from "./SideBar.vue";
import Header from "./Header.vue";

export default {
  components: { SideBar, Header, datepicker },
  data() {
    return {
      times: {
        date: "",
        time: [],
      },
      temps: [],
      disabledDates: {
        to: new Date(Date.now() - 86400000),
        days: [6, 0], // Disable Saturday's and Sunday'
      },
      success: false,
    };
  },
  async created() {
    this.loadData();
  },
  methods: {
    customDate(date) {
      this.times.date = moment(date).format("YYYY-MM-DD");
    },
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/time")
        .then((response) => {
          this.temps = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.temps = [];
        });
    },
    async setTime() {
      console.log(this.times);
      this.axios
        .post("http://localhost:8000/api/setTime", this.times)
        .then(({ data }) => {
          this.success = true;
          this.loadData();
        })

        .catch((error) => {
          console.log(error.response.data);
        });
    },
    deletetime(id) {
      if (
        confirm(
          "Êtes-vous sûr de vouloir annuler ce horaire de disponiblité  ?"
        )
      ) {
        this.axios
          .delete(`http://localhost:8000/api/deletetime/${id}`)
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
<style scoped>
.my-datepicker {
  color: rgb(44, 44, 252);
}
</style>