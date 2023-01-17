<template>
    <div>
        <div class="wrapper ">
<sidebar></sidebar>
<navbar></navbar>
 <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row justify-content-md-center">
          <div class="col col-lg-8">
            <div class="card">
              <div class="card-header">
  <div class="main-content">
                    <div class="container-fluid">
                        <div class="row clearfix">
                         
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                      <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="fas fa-user" style="font-size:48px;color:green;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Patients</h6>
                                                <h6 class="font-extrabold mb-0">{{patient.length}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="fas fa-user" style="font-size:48px;color:blue;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Médecins</h6>
                                                <h6 class="font-extrabold mb-0">{{doctor.length}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="fas fa-calendar-alt" style="font-size:48px;color:lightblue;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Rendez-vous</h6>
                                                <h6 class="font-extrabold mb-0">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="fas fa-bars" style="font-size:48px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Specialites</h6>
                                                <h6 class="font-extrabold mb-0">{{specialites.length}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div></div></div></div></div></div></div></div></div>
<router-view></router-view>
</div>
</template>
<script>
import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';

export default ({
components:{Sidebar, Navbar},
      data() {
        return {
            patient: [],
            doctor:[],
            specialites:[]
        };
    },
    async mounted() {
        this.getpatient();
        this.getDoctor();
        this.loadData();
    },
    methods: {
        async getpatient() {
            await this.axios.get("http://localhost:8000/api/getPatient").then(response => {
                this.patient = response.data;
            }).catch(error => {
                console.log(error);
                this.patient = [];
            });
        },

           async getDoctor() {
            await this.axios.get("http://localhost:8000/api/getDoctor").then(response => {
                this.doctor = response.data;
            }).catch(error => {
                console.log(error);
                this.doctor = [];
            });
        },
         async loadData() {
            await this.axios.get("http://localhost:8000/api/specialites").then(response => {
                this.specialites = response.data;
            }).catch(error => {
                console.log(error);
                this.specialites = [];
            });
        },
    },
 
})

   

</script>
<style scoped>

</style>