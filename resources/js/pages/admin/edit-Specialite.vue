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
              <div class="main-content">
                <div class="container-fluid">
                  <div class="row clearfix">
                    <h3>Modifier Spécialite</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="name" class="col-form-label">Nom:</label>
                          <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="name"
                            v-model="specialite.name"
                          />
                          <div class="form-group" v-if="specialite.image">
                            <img
                              :src="`${
                                `http://localhost:8000` +
                                '/images/specialite/' +
                                specialite.image
                              }`"
                              alt="image"
                              width="100"
                              height="100"
                            />
                          </div>
                          <div class="custum-file">
                            <input
                              type="file"
                              name="image"
                              class="custum-file-input"
                              id="validatedCustumFile"
                              v-on:change="OnChangeImage"
                            />
                            <label
                              class="custum-file-label"
                              for="validatedCustumFile"
                            ></label>
                          </div>
                          <router-link to="/specialite"
                            ><button
                              type="button"
                              class="btn btn-primary"
                              @click="UpdateSpecialite(specialite.id)"
                            >
                              Modifier
                            </button></router-link
                          >
                          <router-link
                            to="/specialite"
                            class="btn btn-secondary"
                            >Annuler</router-link
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
      specialite: {},
      name: "",
      image: "",
    };
  },
  methods: {
    loadData() {
      this.axios
        .get(
          `http://localhost:8000/api/getSpecialites/${this.$route.params.id}`
        )
        .then((response) => {
          this.specialite = response.data;
        });
    },

    UpdateSpecialite(id) {
      let formData = new FormData();
      formData.append("name", this.specialite.name);
      formData.append("image", this.image);
      this.axios
        .post(`http://localhost:8000/api/UpdateSpecialite/${id}`, formData)
        .then((response) => {});
    },

    OnChangeImage(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
  },

  created() {
    this.loadData();
    this.UpdateSpecialite();
  },
};
</script>
<style scoped>
</style>