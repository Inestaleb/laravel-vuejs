<template>
  <div>
    <Header></Header>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-lg-8">
            <div class="card">
              <div class="card-body">
                <div class="card booking-card">
                  <div class="card-header">
                    <h4 class="card-title">détail de consultation</h4>
                  </div>
                  <div class="card-body">
                    <!-- Booking Doctor Info -->
                    <div class="booking-doc-info">
                      <a href="doctor-profile.html" class="booking-doc-img">
                        <img
                          :src="'/images/doctor/' + medecin.image"
                          alt="User Image"
                        />
                      </a>
                      <div class="booking-info">
                        <h4>
                          <a href="doctor-profile.html"
                            >Dr. {{ medecin.name }}</a
                          >
                        </h4>

                        <div class="clinic-details">
                          <p class="doc-location">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ medecin.address }}
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- Booking Doctor Info -->

                    <div class="booking-summary">
                      <div class="booking-item-wrap">
                        <ul class="booking-date">
                          <li>
                            Date <span>{{ time.date }} </span>
                          </li>
                          <li>
                            Horaire <span>{{ time.time }} </span>
                          </li>
                        </ul>
                        <ul class="booking-fee">
                          <li>
                            Montant<span>{{ medecin.price }}</span>
                          </li>
                        </ul>
                        <div class="booking-total">
                          <ul class="booking-total-list">
                            <li>
                              <span>Total</span>
                              <span class="total-cost">{{
                                medecin.price
                              }}</span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <iframe
                  :src="iframe.src"
                  id="myIFrame"
                  width="100%"
                  height="480"
                  frameborder="0"
                  v-show="iframe.loaded"
                >
                </iframe>

                <!-- /Checkout Form -->
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
    <Footer></Footer>
  </div>
</template>
  <script>
import Header from "./Patient/Header.vue";
import Footer from "./Footer.vue";
export default {
  components: { Header, Footer },
  data() {
    return {
      token: "",
      medecin: JSON.parse(localStorage.getItem("medecin")),
      time: {},
      iframe: {
        src: "", //DIV HERE #EDITOR
        loaded: false,
      },
      time_id: "",
      date: "",
      type: "",
      doctor_id: "",
    };
  },

  created() {
    this.token = localStorage.getItem("tokenpaymee");
    this.iframe.src = `https://sandbox.paymee.tn/gateway/${this.token}`;

    this.loadData();
  },
  mounted() {
    //var myIFrame = document.getElementById("myIFrame");
    this.iframe.loaded = true;

    window.addEventListener(
      "message",
      async function (event) {
        if (event.data.event_id === "paymee.complete") {
          this.time_id = localStorage.getItem("time_id");
          this.date = localStorage.getItem("date");
          this.type = localStorage.getItem("type");
          this.doctor_id = localStorage.getItem("doctor_id");
          await this.axios
            .post("http://localhost:8000/api/appointements", {
              date: this.date,
              time_id: this.time_id,
              type: this.type,
              doctor_id: this.doctor_id,
            })
            .then(function (response) {
              localStorage.setItem("appointement_id", response.data.id);
              console.log(response);
            });

          this.date = localStorage.getItem("date");
          this.appointment_id = localStorage.getItem("appointement_id");
          this.amount = JSON.parse(localStorage.getItem("medecin")).price;
          await this.axios
            .post("http://localhost:8000/api/store", {
              appointment_id: this.appointment_id,
              date: this.date,
              amount: this.amount,
            })
            .then(function (response) {
              console.log(response);
            });
          window.location.replace("/book-sucess");
        } else {
          this.token = localStorage.getItem("tokenpaymee");
          window.location.replace(
            `https://sandbox.paymee.tn/api/v1/payments/${this.token}/check`
          );
        }
      },
      false
    );
  },
  methods: {
    loadData() {
      this.time_id = localStorage.getItem("time_id");
      this.axios
        .get(`http://localhost:8000/api/time/${this.time_id}`)
        .then((response) => {
          this.time = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>