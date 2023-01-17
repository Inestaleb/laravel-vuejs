require("./bootstrap");
import Vue from "vue";
import VueToast from 'vue-toast-notification';
import axios from "axios";
import VueAxios from "vue-axios";
import Auth from "./Auth.js";

Vue.prototype.auth = Auth;
Vue.use(VueAxios, axios);
Vue.use(VueToast);
import Index from "./Index.vue";
import router from "./router";

const app = new Vue({
    el: "#app",
    router,
    render: (h) => h(Index),
});
