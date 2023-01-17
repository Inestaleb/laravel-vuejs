<template>
  <div>
    <sidebar></sidebar>
    <navbar></navbar>

    <div class="panel-header panel-header-sm"></div>
    <div class="content">
      <div class="row justify-content-md-center">
        <div class="col col-lg-8">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title"><center>Liste de Médecin</center></h4>
            </div>
            <div class="table">
              <table class="table">
                <thead class="text-primary">
                  <th>#</th>
                  <th>image</th>
                  <th>Nom & Prénom</th>
                  <th>Specialite</th>
                  <th>Aptitude</th>
                  <th>Etat</th>
                </thead>
                <tbody v-if="doctor.length > 0">
                  <tr v-for="(doctor, key) in doctor" :key="key">
                    <td>&nbsp;</td>
                    <td>
                      <img
                        :src="'/images/doctor/' + doctor.image"
                        width="100"
                        class="avatar border-gray"
                      />
                    </td>
                    <td>Dr.{{ doctor.name }}</td>
                    <td>{{ doctor.specialite.name }}</td>
                    <td>
                      <button
                        class="btn btn-sm bg-info-light"
                        data-toggle="modal"
                        data-target="#exampleModalCenter"
                        @click="getapptitude(doctor.id)"
                      >
                        <i class="far fa-eye"></i> View
                      </button>
                    </td>
                    <td>
                      <label class="switch">
                        <input
                          type="checkbox"
                          v-model="doctor.status"
                          :id="doctor.id"
                          @click="UpdateDoctor(doctor.id)"
                        />
                        <span class="slider round"></span>
                      </label>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color: aqua">
            <h5 class="modal-title" id="exampleModalLongTitle">Apptitude</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img :src="'/images/apptitude/' + app.apptitude" alt="Photo " />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "./Navbar.vue";
import Sidebar from "./Sidebar.vue";

export default {
  components: { Sidebar, Navbar },
  data() {
    return {
      doctor: [],
      app: [],
    };
  },

  methods: {
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/getDoctor")
        .then((response) => {
          this.doctor = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.doctor = [];
        });
    },
    UpdateDoctor(id) {
      let formData = new FormData();
      formData.append("status", this.doctor.status);

      this.axios
        .post(`http://localhost:8000/api/DoctorUpdate/${id}`, formData)
        .then((response) => {});
    },
    async getapptitude(id) {
      await this.axios
        .get(`http://localhost:8000/api/getapptitude/${id}`)
        .then((response) => {
          this.app = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.app = [];
        });
    },
  },
  async created() {
    this.loadData();
  },
};
</script>

<style scoped>
.img {
  width: 50px;
  height: 50px;
}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgb(207, 28, 28);
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

input:checked + .slider {
  background-color: #0ae715;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.avatar {
  width: 70px;
  height: 70px;
  border-radius: 70%;
}
</style>
