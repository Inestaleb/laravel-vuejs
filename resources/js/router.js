import VueRouter from 'vue-router';
import Vue from 'vue';
import Auth from './Auth.js';

Vue.use(VueRouter);
import Home from './pages/Home.vue';
import Login from './pages/login.vue';
import Register from './pages/register.vue';
import Dashboard from './pages/Patient/dashboardPatient.vue';
import AdminDashboard from './pages/admin/Dashboard.vue'
import DashboardDoctor from './pages/Doctor/DashboardDoctor.vue'
import Specialite from './pages/admin/Specialite.vue';
import edit from './pages/admin/edit-Specialite.vue'
import AjoutSpecialite from './pages/admin/AjoutSpecialite.vue';
import RegisterDoctor from './pages/RegisterDoctor.vue';

import ListDoctor from './pages/admin/doctor.vue'
import FindDoctor from './pages/FindDoctor.vue';
import NotFound from './pages/404.vue';
import Appointement from './pages/Appointement.vue';
import bookingSucess from './pages/booking-sucess.vue';
import AppointementTab from './pages/Doctor/AppointementTab.vue'
import timing from './pages/Doctor/timing.vue'
import MyPatient from './pages/Doctor/MyPatient.vue';
import PatientProfil from './pages/Doctor/Patient-profile.vue';
import Addprescription from './pages/Doctor/add-prescription.vue';
import ChatApp from './components/ChatApp';
import profilSetting from './pages/Patient/profil-setting.vue';
import changePassword from './pages/Patient/change-password.vue';
import changePasswordDoctor from './pages/Doctor/change-password-doctor.vue';
import getInvoice from './pages/Doctor/Invoice.vue';
import ProfilSettingDoctor from './pages/Doctor/Profil-SettingDoctor.vue';
import Prescription from './pages/doctor/Prescription.vue';
import PresPatient from './pages/Patient/PresPatient.vue';
import Invoice from './pages/invoice.vue';
import Verification from './pages/Doctor/verif.vue'
import VideoChat from './components/VideoChat.vue';
import payement from './pages/payement.vue';
const routes = [

//
  {

    path: '/',
    component: Home,
    name: "Home"
  },
    {

        path: '/login',
        component: Login,
        name: "Login"
    },
    {
        path: '/register',
        component: Register,
        name: "Register"
    },
    {
      path: '/registerDoctor',
      component: RegisterDoctor,
      name: "RegisterDoctor"
  },
{
  path: '/404',
  name: '404',
  component:NotFound ,
},
{

  path: '/paye',
  component: payement,
  name: "payement",
  meta: {
    requiresAuth: true
}
  
  },
{

  path: '/find',
  component: FindDoctor,
  name: "FindDoctor",
  props: true,
  
  },

//patient
{

  path: '/appointement',
  component: Appointement,
  name: "Appointement",
  meta: {
    requiresAuth: true
}
  
  },
{

  path: '/book-sucess',
  component: bookingSucess,
  name: "bookingSucess",
  meta: {
    requiresAuth: true
}
  
},
{

  path: '/prescriptionPatient',
  component: PresPatient,
  name: "PresPatient",
  props: true ,
  meta: {
    requiresAuth: true
}
  
},
{

  path: '/profil-setting',
  component: profilSetting,
  name: "profilSetting",
  meta: {
    requiresAuth: true
}
  
},
{

  path: '/change-password',
  component: changePassword,
  name: "changePassword",
  meta: {
    requiresAuth: true
}
  
},
{

  path: '/chat',
  component: ChatApp,
  name: "ChatApp",
  meta: {
    requiresAuth: true
}
  
},
{

  path: '/videoCall',
  component: VideoChat,
  name: "VideoChat",

  
},
  
    {
        path: '/dashboard',
        component: Dashboard,
        name: "Dashboard",
        meta: {
            requiresAuth: true
        }

    },
    //doctor
     {
        path: '/DoctorDashboard',
        component:DashboardDoctor,
        name: "DashboardDoctor",
        meta: {
            requiresAuth: true
        }

  },

        {
        path: '/verif',
        component:Verification,
        name: "Verification",
        meta: {
            requiresAuth: true
        }

  },
     {
        path: '/inv',
        component:getInvoice,
        name: "getInvoice",
        meta: {
            requiresAuth: true
        }

  },
  
  {

  path: '/setting',
  component: ProfilSettingDoctor,
  name: "ProfilSettingDoctor",
  meta: {
    requiresAuth: true
}
  
},
  {

  path: '/prescreption',
  component: Prescription,
  name: "Prescription",
  meta: {
    requiresAuth: true
}
  
},
        {
        path: '/appointementtab',
        component:AppointementTab,
        name: "AppointementTab",
        meta: {
            requiresAuth: true
        }

  },
  {
        path: '/mypatient',
        component:MyPatient,
        name: "MyPatient",
        meta: {
            requiresAuth: true
        }

  },
   {
        path: '/add-prescription',
        component:Addprescription,
        name: "Addprescription",
        meta: {
            requiresAuth: true
        }

  },
   {
        path: '/invoice',
        component:Invoice,
        name: "invoice",
        meta: {
            requiresAuth: true
        }

  },
    
  {
        path: '/PatientProfil',
        component:PatientProfil,
        name: "PatientProfil",
        meta: {
            requiresAuth: true
        }

  },
  {

  path: '/change',
  component: changePasswordDoctor,
  name: "changePasswordDoctor",
  meta: {
    requiresAuth: true
}
  
},
        {
        path: '/timing',
        component:timing,
        name: "timing",
        meta: {
            requiresAuth: true
        }

  },    
// admin routes
    {
      path: '/adminDashboard',
      component: AdminDashboard,
      meta: {
        requiresAuth:true
      }
    },
    {
        path: '/specialite',
      name: 'specialite',
      component:  Specialite,
      meta: {
        requiresAuth:true
      } 
    },
  
  {
    path: '/listdoctor',
  name: 'ListDoctor',
  component: ListDoctor,
  meta: {
    requiresAuth:true
  } 
},
   
    {
        path: '/edit/:id?',
      name: 'edit',
      component:  edit,
      meta: {
        requiresAuth:true
      } 
    },
    
    {
      path: '/ajout',
    name: 'AjoutSpecialite',
    component:  AjoutSpecialite,
    meta: {
      requiresAuth:true
    } 
  },
];

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth) ) {
        if (Auth.check()) {
            next();
            return;
        } else {
            router.push('/login');
        }
    } else {
        next();
       
    }
});


export default router;