<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <Sidebar></Sidebar>
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="card">
              <div class="card-body">
                <!-- Profile Settings Form -->
                <p class="alert alert-success" v-if="success">
                  Modifié avec success
                </p>
                <div class="row form-row">
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <div class="change-avatar">
                        <div class="profile-img" v-if="user.image">
                          <img
                            :src="`${
                              `http://localhost:8000` +
                              '/images/Patients/' +
                              user.image
                            }`"
                            alt="User Image"
                          />
                        </div>
                        <div class="upload-img">
                          <div class="change-photo-btn">
                            <span
                              ><i class="fa fa-upload"></i> Changer Photo</span
                            >
                            <input
                              type="file"
                              class="upload"
                              v-on:change="OnChangeImage"
                            />
                          </div>
                          <small class="form-text text-muted"
                            >Allowed JPG, GIF or PNG. Max size of 2MB</small
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Nom</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="user.name"
                      />
                    </div>
                  </div>

                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <div class="cal-icon">
                        <input
                          type="text"
                          class="form-control datetimepicker"
                          v-model="user.date_birth"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Email ID</label>
                      <input
                        type="email"
                        class="form-control"
                        v-model="user.email"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Numero du téléphone</label>
                      <input
                        type="text"
                        v-model="user.phone_number"
                        class="form-control"
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Antecedant</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="user.antecedant"
                      />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Adresse</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="user.address"
                      />
                    </div>
                  </div>
                </div>
                <div class="submit-section">
                  <button
                    type="button"
                    class="btn btn-primary submit-btn"
                    @click="UpdateProfil"
                  >
                    Modifier
                  </button>
                </div>

                <!-- /Profile Settings Form -->
              </div>
            </div>
          </div>
          <Footer></Footer>
        </div>
      </div>
    </div>
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
      user: this.auth.user,

      success: false,
    };
  },
  methods: {
    UpdateProfil() {
      this.success = false;
      let formData = new FormData();
      formData.append("name", this.user.name);
      formData.append("image", this.image);
      formData.append("date_birth", this.user.date_birth);
      formData.append("email", this.user.email);
      formData.append("phone_number", this.user.phone_number);
      formData.append("antecedant", this.user.antecedant);
      formData.append("address", this.user.address);

      this.axios
        .post(
          `http://localhost:8000/api/UpdateProfil/${this.auth.user.id}`,
          formData
        )

        .then((response) => {
          localStorage.setItem("user", JSON.stringify(response.data));
          this.success = true;
        });
    },

    OnChangeImage(e) {
      this.image = e.target.files[0];
      console.log(this.image);
    },
  },

  created() {},
};
</script>