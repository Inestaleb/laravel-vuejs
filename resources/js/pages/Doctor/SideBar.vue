<template>
  <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
      <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
          <a href="#" class="booking-doc-img">
            <img :src="'/images/doctor/' + user.image" />
          </a>
          <div class="profile-det-info">
            <h3>Dr. {{ user.name }}</h3>

            <div class="patient-details">
              <h5 class="mb-0">{{ user.education }}</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="dashboard-widget">
        <nav class="dashboard-menu">
          <ul>
            <li>
              <a href="/DoctorDashboard">
                <i class="fas fa-columns"></i>
                <span>tableau de board</span>
              </a>
            </li>
            <li>
              <router-link to="/appointementtab">
                <i class="fas fa-calendar-check"></i>
                <span>Liste de rendez-vous</span>
              </router-link>
            </li>
            <li>
              <router-link to="/mypatient">
                <i class="fas fa-user-injured"></i>
                <span>liste de patient</span>
              </router-link>
            </li>
            <li>
              <router-link to="/timing">
                <i class="fas fa-hourglass-start"></i>
                <span>Calendrier des horaires</span>
              </router-link>
            </li>
            <li>
              <router-link to="/inv">
                <i class="fas fa-file-invoice"></i>
                <span>Facture</span>
              </router-link>
            </li>
            <li>
              <router-link to="/videoCall">
                <i class="fa fa-video-camera"></i>
                <span>Téléconsultation</span>
              </router-link>
            </li>
            <li>
              <router-link to="/chat">
                <i class="fas fa-comments"></i>
                <span>Message</span>

                <small class="badge badge-success"> {{ Total }}</small>
              </router-link>
            </li>
            <li>
              <router-link to="/setting">
                <i class="fas fa-user-cog"></i>
                <span>Paramètres de profil</span>
              </router-link>
            </li>

            <li>
              <router-link to="/change">
                <i class="fas fa-lock"></i>
                <span>changer mot de passe</span>
              </router-link>
            </li>
            <li>
              <a href="javascript:void(0)" @click="logout()">
                <i class="fas fa-sign-out-alt"></i>
                <span>Deconnexion</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
import Auth from "../../Auth";
export default {
  data() {
    return {
      contacts: [],
      user: this.auth.user,
    };
  },
  created() {
    // console.log(this.auth.user);
  },
  computed: {
    sortedContacts() {
      return _.sortBy(this.contacts, [
        (contact) => {
          if (contact == this.selected) {
            return Infinity;
          }
          return contact.unread;
        },
      ]).reverse();
    },
    Total() {
      return this.contacts.reduce((acc, item) => {
        return acc + item.unread;
      }, 0);
    },
  },
  mounted() {
    Echo.private(`messages.${this.user.id}`).listen("NewMessage", (e) => {
      this.handleIncoming(e.message);
    });

    axios
      .get("http://localhost:8000/api/contact-list/" + this.user.id)
      .then((response) => {
        this.contacts = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    async logout() {
      await this.axios
        .post("http://localhost:8000/api/logout")
        .then(({ data }) => {
          Auth.logout();
          this.$router.push("/");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
</script>