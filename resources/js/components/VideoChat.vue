<template>
  <div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-7 col-lg-8 col-xl-9">
            <div class="appointments" v-if="this.auth.user.role_id == 3">
              <!-- Appointment List -->
              <div
                class="appointment-list"
                v-for="autre in autre"
                :key="autre.doctor_id"
              >
                <div class="profile-info-widget">
                  <a href="patient-profile.html" class="booking-doc-img">
                    <img
                      :src="'/images/doctor/' + autre.doctor.image"
                      alt="User Image"
                    />
                  </a>
                  <div class="profile-det-info">
                    <h3>
                      <a href="patient-profile.html">{{ autre.doctor.name }}</a>
                    </h3>
                    <div class="patient-details">
                      <h5>
                        <i class="far fa-clock"></i> {{ autre.date }},
                        {{ autre.temps.time }}
                      </h5>

                      <h5>
                        <i class="fas fa-envelope"></i>
                        {{ autre.doctor.email }}
                      </h5>
                      <h5 class="mb-0">
                        <i class="fas fa-phone"></i>
                        {{ autre.doctor.phone_number }}
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="appointment-action">
                  <button
                    @click="startVideoChat(autre.doctor_id)"
                    class="btn btn-sm bg-info-light"
                    data-toggle="modal"
                    data-target="#appt_details"
                  >
                    démarrer téléconsultation {{ autre.doctor.name }}
                  </button>
                </div>
              </div>
            </div>

            <div class="appointments" v-if="this.auth.user.role_id == 1">
              <!-- Appointment List -->
              <div
                class="appointment-list"
                v-for="other in others"
                :key="other.patient_id"
              >
                <div class="profile-info-widget">
                  <a href="patient-profile.html" class="booking-doc-img">
                    <img
                      :src="'/images/patients/' + other.patient.image"
                      alt="User Image"
                    />
                  </a>
                  <div class="profile-det-info">
                    <h3>
                      <a href="patient-profile.html">{{
                        other.patient.name
                      }}</a>
                    </h3>
                    <div class="patient-details">
                      <h5>
                        <i class="far fa-clock"></i> {{ other.date }},
                        {{ other.temps.time }}
                      </h5>
                      <h5>
                        <i class="fas fa-map-marker-alt"></i
                        >{{ other.patient.address }}
                      </h5>
                      <h5>
                        <i class="fas fa-envelope"></i>
                        {{ other.patient.email }}
                      </h5>
                      <h5 class="mb-0">
                        <i class="fas fa-phone"></i>
                        {{ other.patient.phone_number }}
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="appointment-action">
                  <button
                    @click="startVideoChat(other.patient_id)"
                    class="btn btn-sm bg-info-light"
                    data-toggle="modal"
                    data-target="#appt_details"
                  >
                    démarrer téléconsultation {{ other.patient.name }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Call Wrapper -->
      <div class="call-wrapper">
        <div class="call-main-row">
          <div class="call-main-wrapper">
            <div class="call-view">
              <div class="call-window">
                <!-- Call Header -->
                <div class="fixed-header">
                  <div class="navbar">
                    <div class="user-details">
                      <div class="user-info float-left">
                        <a href="patient-profile.html"><span></span></a>
                      </div>
                    </div>
                    <ul class="nav float-right custom-menu">
                      <li class="nav-item dropdown dropdown-action">
                        <a
                          href="#"
                          class="nav-link dropdown-toggle"
                          data-toggle="dropdown"
                          aria-expanded="false"
                          ><i class="fa fa-cog"></i
                        ></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /Call Header -->

                <!-- Call Contents -->
                <div class="call-contents">
                  <div class="call-content-wrap">
                    <div class="user-video">
                      <video
                        ref="video-there"
                        class="video-there"
                        autoplay
                        fullscreen
                      ></video>
                    </div>
                    <div class="my-video">
                      <ul>
                        <li>
                          <video
                            class="video-here"
                            ref="video-here"
                            autoplay
                            fullscreen
                          ></video>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- Call Contents -->

                <!-- Call Footer -->
                <div class="call-footer">
                  <div class="call-icons">
                    <ul class="call-items">
                      <li>
                        <span href="#" title="Mute Audio"></span>
                      </li>
                      <li class="call-item">
                        <span href="#"></span>
                      </li>
                    </ul>
                    <div class="end-call">
                      <button
                        class="btn btn-danger"
                        v-if="user.role_id == 1"
                        @click="endCall()"
                      >
                        Fin appel
                      </button>
                      <button
                        v-if="user.role_id == 3"
                        @click="endCall()"
                        class="btn btn-danger"
                      >
                        Fin appel
                      </button>
                    </div>
                  </div>
                </div>
                <!-- /Call Footer -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Call Wrapper -->
    </div>
  </div>
</template>
<script>
import Pusher from "pusher-js";
import Peer from "simple-peer";

export default {
  data() {
    return {
      channel: null,
      others: [],
      autre: [],
      pusherKey: process.env.MIX_PUSHER_APP_KEY,
      pusherCluster: process.env.MIX_PUSHER_APP_CLUSTER,
      user: this.auth.user,
      stream: null,
      callPlaced: false,
      peers: {},
    };
  },
  mounted() {
    this.loadData();
    this.load();
    this.setupVideoChat();
  },
  methods: {
    async loadData() {
      await this.axios
        .get("http://localhost:8000/api/GetOthers")
        .then((response) => {
          this.others = response.data;
        })
        .catch((error) => {
          console.log(error.data);
          this.others = [];
        });
    },
    async load() {
      await this.axios
        .get("http://localhost:8000/api/Others")
        .then((response) => {
          this.autre = response.data;
        })
        .catch((error) => {
          console.log(error.data);
          this.autre = [];
        });
    },
    startVideoChat(userId) {
      (this.callPlaced = true), this.getPeer(userId, true);
    },
    //créez une nouvelle connexion
    getPeer(userId, initiator) {
      if (this.peers[userId] === undefined) {
        let peer = new Peer({
          initiator,
          stream: this.stream,
          trickle: false,
        });
        peer
          .on("signal", (data) => {
            this.channel.trigger(`client-signal-${userId}`, {
              userId: this.user.id,
              data: data,
            });
          })
          .on("stream", (stream) => {
            console.log("test", stream);
            const videoThere = this.$refs["video-there"];
            videoThere.srcObject = stream;
          })
          .on("close", () => {
            const peer = this.peers[userId];
            if (peer !== undefined) {
              peer.destroy();
            }
            delete this.peers[userId];
          });
        this.peers[userId] = peer;
      }
      return this.peers[userId];
    },
    async setupVideoChat() {
      // To show pusher errors
      Pusher.logToConsole = true;
     //accédez aux appareils
      const stream = await navigator.mediaDevices.getUserMedia({
        video: true,
        audio: true,
      });
      // const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
      const videoHere = this.$refs["video-here"];
      videoHere.srcObject = stream;
      this.stream = stream;
      const pusher = this.getPusherInstance();
      this.channel = pusher.subscribe("presence-video-chat");
      this.channel.bind(`client-signal-${this.user.id}`, (signal) => {
        const peer = this.getPeer(signal.userId, false);
        peer.signal(signal.data);
      });
    },
    //instancier l'instance Pusher
    getPusherInstance() {
      return new Pusher(this.pusherKey, {
        authEndpoint: "http://localhost:8000/api/video_chat",
        cluster: this.pusherCluster,
        auth: {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        },
      });
    },
    endCall() {
      if (this.auth.user.role_id == 3) {
        this.$router.push("/dashboard");
        window.location.reload();
      } else if (this.auth.user.role_id == 1) {
        this.$router.push("/DoctorDashboard");
        window.location.reload();
      }
    },
  },
};
</script>
<style>
.video-container {
  width: 500px;
  height: 380px;
  margin: 8px auto;
  border: 3px solid #000;
  position: relative;
  box-shadow: 1px 1px 1px #9e9e9e;
}
.video-here {
  width: 130px;
  position: absolute;
  left: 10px;
  bottom: 16px;
  border: 1px solid #000;
  border-radius: 2px;
  z-index: 2;
}
.video-there {
  width: 100%;
  height: 100%;
  z-index: 1;
}
.text-right {
  text-align: right;
}
</style>