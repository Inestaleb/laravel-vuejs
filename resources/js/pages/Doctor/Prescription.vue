<template>
  <div
    class="card-body"
    style="background-color: white; width: 1000px; margin-left: 300px"
  >
    <div class="row">
      <div class="col-sm-6">
        <div class="biller-info" style="background-color: aquamarine">
          <br />
          <br />
          <br />
          <br />
          <br />
          <h4 class="d-block">Dr.{{ pres.signature }}</h4>
          <span class="d-block text-sm text-muted">{{ user.education }}</span>
          <span class="d-block text-sm text-muted">{{ user.address }}</span>
        </div>
      </div>
      <div class="col-sm-6 text-sm-right">
        <br />
        <br />
        <br />
        <br />
        <br />
        <div class="billing-info">
          <h4 class="d-block">{{ pres.date }}</h4>
        </div>
      </div>
    </div>

    <!-- brscription Item -->
    <div>
      <div>
        <div class="table-responsive">
          <table class="table table-center">
            <thead>
              <tr>
                <th style="width: 200px">médicament</th>
                <th style="width: 100px">procédure d'utilisation</th>

                <th style="width: 80px"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <p>{{ pres.medicine }}</p>
                </td>
                <td>
                  <p>{{ pres.procedure_to_use_medicine }}</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /brscription Item -->

    <!-- Signature -->
    <div class="row">
      <div class="col-md-12 text-right">
        <div class="signature-wrap">
          <div class="sign-name">
            <span class="text-muted">Signature</span>
            <p class="mb-0">Dr. {{ pres.signature }}</p>
          </div>
        </div>
      </div>
    </div>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
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
      user: this.auth.user,
      pres: {},
    };
  },
  methods: {
    printme() {
      window.print();
    },
    loadData() {
      this.axios
        .get(
          `http://localhost:8000/api/getprescreption/${this.$route.params.id}`
        )
        .then((response) => {
          this.pres = response.data;
        });
    },
  },
  created() {
    this.loadData();
  },
};
</script>
<style scoped>
p {
  white-space: pre;
}
</style>