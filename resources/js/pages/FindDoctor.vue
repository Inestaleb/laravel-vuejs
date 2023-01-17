<template>
  <div>
    <Header></Header>
    <div class="content" style="margin-top: 50px">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
            <!-- Search Filter -->
            <div class="card search-filter">
              <div class="card-header">
                <h4 class="card-title mb-0">Praticien en Tunisie</h4>
              </div>
              <div class="card-body">
                <div class="filter-widget">
                  Spécialites:<select class="form-control" v-model="specialite">
                    <option :value="null" disabled>Spécialite</option>

                    <option v-for="(specialite, key) in specialites" :key="key">
                      {{ specialite.name }}
                    </option>
                  </select>
                </div>
                <div class="filter-widget">
                  <div>
                    Nom:<input
                      type="text"
                      class="form-control"
                      placeholder="Nom du professionnel de santé"
                      v-model.lazy="name"
                    />
                  </div>
                </div>
                <div class="filter-widget">
                  <div>
                    Ville<input
                      type="text"
                      class="form-control"
                      placeholder="Ville"
                      v-model.lazy="address"
                    />
                  </div>
                </div>
                <button
                  type="button"
                  class="btn btn-primary submit-btn"
                  @click="getResults"
                >
                  chercher
                </button>
              </div>
            </div>
            <!-- /Search Filter -->
          </div>

          <div class="col-md-12 col-lg-8 col-xl-9">
            <!-- Doctor Widget -->
            <div class="card" v-for="doctor in doc" :key="doctor.key">
              <div class="card-body">
                <div class="doctor-widget">
                  <div class="doc-info-left">
                    <div class="doctor-img">
                      <a href="doctor-profile.html">
                        <img
                          :src="'/images/doctor/' + doctor.image"
                          class="img-fluid"
                          alt="User Image"
                        />
                      </a>
                    </div>
                    <div class="doc-info-cont">
                      <h4 class="doc-name">
                        <a href="doctor-profile.html">Dr. {{ doctor.name }}</a>
                      </h4>
                      <p class="doc-speciality">{{ doctor.education }}</p>
                      <h5 class="doc-department">
                        <img
                          :src="'/images/specialite/' + doctor.specialite.image"
                          class="img-fluid"
                          alt="Speciality"
                        />{{ doctor.specialite.name }}
                      </h5>

                      <div class="clinic-details">
                        <p class="doc-location">
                          <i class="fas fa-map-marker-alt"></i
                          >{{ doctor.address }}
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="doc-info-right">
                    <div class="clini-infos">
                      <ul>
                        <li></li>
                        <li></li>
                        <li>
                          <i class="fas fa-map-marker-alt"></i>
                          {{ doctor.address }}
                        </li>
                        <li>
                          <i class="far fa-money-bill-alt"></i>
                          {{ doctor.price }} dt<i></i>
                        </li>
                      </ul>
                    </div>
                    <div class="clinic-booking">
                      <router-link
                        class="apt-btn"
                        :to="{
                          name: 'Appointement',
                          params: { id: doctor.id },
                        }"
                        :id="doctor.id"
                        ><button>Prendre rendez-vous</button></router-link
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <pre></pre>
    <Footer></Footer>
  </div>
</template>
<script>
import Header from "./Patient/Header.vue";
import Footer from "./Footer.vue";
export default {
  components: { Header, Footer },

  props: ["doctors"],
  data() {
    return {
      doc: JSON.parse(localStorage.getItem("doc")),
      specialites: [],
      name: "",
      specialite: "",
      address: "",
    };
  },
  mounted() {
    if (localStorage.getItem("doc")) {
      this.doc = JSON.parse(localStorage.getItem("doc"));
    }
  },
  watch: {
    specialite: "getResults",
    name: "getResults",
    address: "getResults",
  },
  async created() {
    this.loadData();
  },
  methods: {
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/getspecialite")
        .then((response) => {
          this.specialites = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.specialites = [];
        });
    },

    getResults() {
      this.axios
        .get("http://localhost:8000/api/search", {
          params: {
            name: this.name,
            specialite: this.specialite,
            address: this.address,
          },
        })
        .then((response) => {
          localStorage.setItem("doc", JSON.stringify(response.data));
          window.location.reload();
        })
        .catch((error) => {
          const res = error.response;
          if (res && res.status == 403) {
            alert("Vous n'avez pas sélectionné aucune recherche ! ");
          }
          if (res && res.status == 404) {
            this.$router.push("/404");
          }
        });
    },
  },
};
</script>
<style scoped>
.member-entry {
  border: 1px solid #ebebeb;
  padding: 15px;
  margin-top: 50px;
  margin-bottom: 30px;
  -moz-box-shadow: 0 1.5rem 4rem rgba(22, 28, 45, 0.1);
  -webkit-box-shadow: 0 1.5rem 4rem rgba(22, 28, 45, 0.1);
  box-shadow: 1 0 1.5rem 4rem rgba(22, 28, 45, 0.1);
  -moz-transition: all 300ms ease-in-out;
  -webkit-transition: all 300ms ease-in-out;
  -o-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
  -webkit-border-radius: 3px;
  -webkit-background-clip: padding-box;
  -moz-border-radius: 3px;
  -moz-background-clip: padding;
  border-radius: 3px;
  background-clip: padding-box;
  background: #fff;
  -webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2),
    0 6px 10px 0 rgba(0, 0, 0, 0.3);
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.3);
}
.member-entry:before,
.member-entry:after {
  content: " ";
  display: table;
}
.member-entry:after {
  clear: both;
}
.member-entry:hover {
  background: rgba(235, 235, 235, 0.3);
  -moz-box-shadow: 1px 1px 1px rgba(0, 1, 1, 0.06);
  -webkit-box-shadow: 1px 1px 1px rgba(0, 1, 1, 0.06);
  box-shadow: 1px 1px 1px rgba(0, 1, 1, 0.06);
}
.member-entry .member-img,
.member-entry .member-details {
  float: left;
}
.member-entry .member-img {
  position: relative;
  display: block;
  width: 10%;
}
.member-entry .member-img img {
  width: 100%;
  display: block;
  max-width: 100%;
  height: auto;
}
.member-entry .member-img i {
  position: absolute;
  display: block;
  left: 50%;
  top: 50%;
  margin-top: -12.5px;
  margin-left: -12.5px;
  color: #fff;
  font-size: 25px;
  zoom: 1;
  -webkit-opacity: 0;
  -moz-opacity: 0;
  opacity: 0;
  filter: alpha(opacity=0);
  -moz-transform: scale(0.5);
  -webkit-transform: scale(0.5);
  -ms-transform: scale(0.5);
  -o-transform: scale(0.5);
  transform: scale(0.5);
  -moz-transition: all 300ms ease-in-out;
  -webkit-transition: all 300ms ease-in-out;
  -o-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}
.member-entry .member-img:hover i {
  -moz-transform: scale(1);
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
  zoom: 1;
  -webkit-opacity: 1;
  -moz-opacity: 1;
  opacity: 1;
  filter: alpha(opacity=100);
}
.member-entry .member-details {
  width: 89.9%;
}
.member-entry .member-details h4 {
  font-size: 18px;
  margin-left: 20px;
}
.member-entry .member-details h4 a {
  -moz-transition: all 300ms ease-in-out;
  -webkit-transition: all 300ms ease-in-out;
  -o-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}
.member-entry .member-details .info-list {
  margin-left: 5px;
}
.member-entry .member-details .info-list > div {
  margin-top: 5px;
  font-size: 13px;
}
.member-entry .member-details .info-list > div a {
  -moz-transition: all 300ms ease-in-out;
  -webkit-transition: all 300ms ease-in-out;
  -o-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}
.member-entry .member-details .info-list > div i {
  -moz-transition: all 300ms ease-in-out;
  -webkit-transition: all 300ms ease-in-out;
  -o-transition: all 300ms ease-in-out;
  transition: all 300ms ease-in-out;
}
.member-entry .member-details .info-list > div:hover i {
  color: #4f5259;
}
@media screen and (max-width: 768px) {
  .member-entry .member-img {
    width: 18%;
  }
  .member-entry .member-details {
    width: 81.9%;
  }
  .member-entry .member-details h4 {
    margin-top: 0;
  }
}
@media screen and (max-width: 480px) {
  .member-entry .member-img {
    width: 100%;
    float: none;
    text-align: center;
    position: relative;
    background: #f8f8f8;
    margin-bottom: 15px;
    -webkit-border-radius: 3px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 3px;
    -moz-background-clip: padding;
    border-radius: 3px;
    background-clip: padding-box;
  }
  .member-entry .member-img img {
    width: auto;
    display: inline-block;
    -webkit-border-radius: 0;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 0;
    -moz-background-clip: padding;
    border-radius: 0;
    background-clip: padding-box;
  }
  .member-entry .member-details {
    width: 100%;
    float: none;
  }
  .member-entry .member-details h3,
  .member-entry .member-details .info-list {
    margin-left: 0;
  }
  .member-entry .member-details h3 > div,
  .member-entry .member-details .info-list > div {
    padding: 0;
  }
  .member-entry .member-details .info-list > div {
    margin-top: 10px;
  }
}
</style>