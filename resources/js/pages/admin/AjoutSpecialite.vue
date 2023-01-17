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
                    <h3>Ajouter Spécialite</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <form @submit.prevent="AddSpecialite">
                          <div class="mb-3">
                            <label for="name" class="col-form-label"
                              >Nom:</label
                            >
                            <input
                              type="text"
                              name="name"
                              class="form-control"
                              id="name"
                              v-model="specialite.name"
                            />
                            <div class="custum-file">
                              <input
                                type="file"
                                name="image"
                                class="custum-file-input"
                                id="validatedCustumFile"
                                v-on:change="saveImage"
                              />
                              <label
                                class="custum-file-label"
                                for="validatedCustumFile"
                              ></label>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary">
                            Ajouter
                          </button>
                          <router-link
                            to="/specialite"
                            class="btn btn-secondary"
                            >Annuler</router-link
                          >
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
    AddSpecialite() {
      let formData = new FormData();
      formData.append("name", this.specialite.name);
      formData.append("image", this.image);
      this.axios
        .post("http://localhost:8000/api/save_Specialites", formData)
        .then((response) => {
          this.$router.push("/specialite");
        });
    },
    saveImage(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
  },
};
</script>
