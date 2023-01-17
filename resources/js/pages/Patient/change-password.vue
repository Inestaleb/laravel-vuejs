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
                <!--- -->
                <p class="alert alert-success" v-if="success">
                  Modifié avec success
                </p>
                <div class="form-group">
                  <label>ancien mot de passe</label>
                  <input
                    type="password"
                    class="form-control"
                    v-model="old_password"
                  />
                </div>
                <div class="form-group">
                  <label>nouveau mot de passe</label>
                  <input
                    type="password"
                    class="form-control"
                    v-model="new_password"
                  />
                </div>
                <div class="form-group">
                  <label>Confirmez le mot de passe</label>
                  <input
                    type="password"
                    class="form-control"
                    v-model="confirm_password"
                  />
                </div>
                <div class="submit-section">
                  <button
                    type="button"
                    class="btn btn-primary submit-btn"
                    @click="Change"
                  >
                    changer
                  </button>
                </div>

                <!-- - -->
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

      old_password: "",
      new_password: "",
      confirm_password: "",

      success: false,
    };
  },
  methods: {
    async Change() {
      this.success = false;
      this.axios
        .post("http://localhost:8000/api/change-password", {
          old_password: this.old_password,
          new_password: this.new_password,
          confirm_password: this.confirm_password,
        })
        .then(({ data }) => {
          this.success = true;
        })

        .catch((error) => {
          console.log(error);
          const res = error.response;
          if (res && res.status == 403) {
            alert("votre ancien mot de passe incorrect! ");
          }
          if (res && res.status == 400) {
            alert(
              "Veuillez entrer un mot de passe qui n'est pas similaire au mot de passe actuel"
            );
          }
        });
    },
  },

  created() {},
};
</script>