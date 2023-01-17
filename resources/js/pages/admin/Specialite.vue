<template>
<div>
<sidebar></sidebar>
<navbar></navbar>
   
<center>

  <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row justify-content-md-center">
          <div class="col col-lg-8">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Specialite
                 <router-link to="/ajout" type="button"  class="btn float-right" data-toggle="modal" data-target="#exampleModal" >
ajouter
</router-link> 
              </h4>
              </div>
            
              <div class="card" >
                <div class="table">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>#</th>
                      <th>image</th>
                      <th>Nom</th>
                      <th>Action</th>
                
                    </thead>
                    <tbody v-if="specialites.length > 0">

                      <tr v-for="(specialite,key) in specialites" :key="key">
                        <td>{{specialite.id}}</td>
                        <td><img  :src="'/images/specialite/'+specialite.image"  alt="Photo " class="img"></td>
                        <td>{{specialite.name}}</td>
                        
                        <td> <router-link :to="{name: 'edit', params: { id: specialite.id }}" class="btn btn-primary mt-4">Modifier</router-link> </td>
                        
                   
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                </div></div>
              </div>
              </div>
              </div>
              </center>
            </div>
        

 
 
</template>
<script>

import Navbar from './Navbar.vue';
import Sidebar from './Sidebar.vue';



 export default ({
    components:{Sidebar, Navbar},
    data() {
        return {
            specialites: []
        };
    },
  
    methods: {
        async loadData() {
            await this.axios.get("http://localhost:8000/api/specialites").then(response => {
                this.specialites = response.data;
            }).catch(error => {
                console.log(error);
                this.specialites = [];
            });
        },
    },
   async created() {
        this.loadData();
    },
})
</script>

<style scoped>
.img {
width : 50px;
height : 50px;
}
</style>