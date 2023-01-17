<template>
  <div
    class="card-body"
    style="background-color: white; width: 1000px; margin-left: 300px"
  >
    <div class="row" v-for="invoice in invoice" :key="invoice.key">
      <div class="col-sm-6" v-for="app in app" :key="app.key">
        <div class="biller-info" style="background-color: aqua">
          <br />
          <br />
          <br />
          <br />
          <br />
          <h4 class="d-block">Facture de</h4>
          <h4 class="d-block">Dr.{{ app.doctor.name }}</h4>
          <span class="d-block text-sm text-muted">{{
            app.doctor.education
          }}</span>
        </div>
      </div>
      <div class="col-sm-6 text-sm-right" v-for="app in app" :key="app.key">
        <br />
        <br />
        <br />
        <br />
        <br />
        <div class="billing-info">
          <h4 class="d-block">Facture a</h4>
          <h4 class="d-block">{{ app.patient.name }}</h4>
          <h4 class="d-block">{{ app.patient.address }}</h4>
          <h4 class="d-block">{{ app.date }}</h4>
        </div>
      </div>

      <!-- brscription Item -->
      <div>
        <div>
          <div class="table-responsive">
            <table class="table table-center">
              <thead>
                <tr>
                  <th style="width: 200px">description</th>
                  <th style="width: 100px">total</th>

                  <th style="width: 80px"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <p>Réservation appel védio</p>
                  </td>
                  <td>
                    <p>{{ invoice.amount }}</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /brscription Item -->
    </div>
    <!-- Signature -->
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <hr style="margin-top: 100px; border: solid" />
    <div class="row">
      <div class="col-md-12 text-right">
        <div class="signature-wrap"></div>
      </div>
    </div>

    <a href="" @click.prevent="printme" target="_blank" class="btn btn-default"
      ><i class="fa fa-print"></i> Print</a
    >
    <!-- /Signature -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      invoice: {},
      app: {},
      user: this.auth.user,
    };
  },
  created() {
    this.loadData();
    this.getAppointement();
  },
  methods: {
    printme() {
      window.print();
    },
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/invoice", {
          params: {
            app_id: this.$route.params.id,
          },
        })
        .then((response) => {
          this.invoice = response.data;
        });
    },
    async getAppointement() {
      await this.axios
        .get("http://localhost:8000/api/getAppointementID", {
          params: {
            app_id: this.$route.params.id,
          },
        })
        .then((response) => {
          this.app = response.data;
        })
        .catch((error) => {
          console.log(error);
          this.app = [];
        });
    },
  },
};
</script>
<style scoped>
p {
  white-space: pre;
}
</style>