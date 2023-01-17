<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <SideBar></SideBar>

          <div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
            <div class="card">
              <div class="card-body pt-0">
                <div class="tab-pane">
                  <div class="card card-table mb-0">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover table-center mb-0">
                          <thead>
                            <tr>
                              <th>Facture Num</th>
                              <th>Médecin</th>
                              <th>Montant</th>
                              <th>Payé en</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody v-for="inv in invoice" :key="inv.key">
                            <tr v-if="user.id == inv.rendezvous.doctor_id">
                              <td>
                                <a href="invoice-view.html"
                                  >#INV- {{ inv.id }}</a
                                >
                              </td>
                              <td>
                                <h2 class="table-avatar">
                                  <a
                                    href="doctor-profile.html"
                                    class="avatar avatar-sm mr-2"
                                  >
                                    <img
                                      class="avatar-img rounded-circle"
                                      :src="'/images/doctor/' + user.image"
                                      alt="User Image"
                                    />
                                  </a>
                                  <a href="doctor-profile.html">{{
                                    user.name
                                  }}</a>
                                </h2>
                              </td>
                              <td>{{ inv.amount }} dt</td>
                              <td>{{ inv.date }}</td>
                              <td class="text-right">
                                <div class="table-action">
                                  <router-link
                                    class="btn btn-sm bg-info-light"
                                    :to="{
                                      name: 'invoice',
                                      params: {
                                        id: inv.appointment_id,
                                      },
                                    }"
                                  >
                                    <i class="far fa-eye"></i> View
                                  </router-link>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
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

    <Footer></Footer>
  </div>
</template>
<script>
import SideBar from "./SideBar.vue";
import Header from "./Header.vue";

export default {
  components: { SideBar, Header },
  data() {
    return {
      invoice: [],
      user: this.auth.user,
    };
  },
  async created() {
    this.getinvoice();
  },
  methods: {
    printInvoice() {
      window.print();
    },

    async getinvoice() {
      await this.axios
        .get("http://localhost:8000/api/getinvoice")
        .then((response) => {
          this.invoice = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.invoice = [];
        });
    },
  },
};
</script>