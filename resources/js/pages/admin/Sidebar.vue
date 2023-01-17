<template>
    <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
        
        </a>
        <a href="#" class="simple-text logo-normal">
         Admin
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li >
            <router-link to="/adminDashboard">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </router-link>
          </li>
         <li>
            <router-link to="/listdoctor">
              <i class="now-ui-icons users_single-02"></i>
              <p>Liste des médecins</p>
            </router-link>
          </li>
          <li>
            <router-link to="/specialite">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Liste des Spécialites</p>
            </router-link>
          </li>
         
        </ul>
      </div>
    </div>
   
        
</template>
<script>


export default ({
   name:'Sidebar'
})
</script>
