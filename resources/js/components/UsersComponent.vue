<template>
  <div class="users">
 <div class="alert alert-warning" role="alert">
  Esta seccion esta en modo de pruebas
</div>
    <div class="container-fluid">
      <div class="row">
        <div class="card text-center col-md-12">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a v-bind:class="'nav-link '+tapU" v-on:click="activeU" href="#">Equipo de trabajo</a>
              </li>
              <li class="nav-item">
                <a
                  v-bind:class="'nav-link '+tapC"
                  v-on:click="activeC"
                  
                >Clientes registrados</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="user-team float-left  col-md-4 " v-if="bandera">
              <div v-for="(item,index) in users" :key="index" class="i-user">
                <ul class="list-group  " v-if="check(item.role)">
                  <a class="btn btn-outline-info" v-on:click="edit(item)">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img v-bind:src="item.url_firm" class="profile-icon" alt=":)" />
                      <strong>{{item.name}}</strong>

                      <span class="badge badge-primary badge-pill"></span>
                    </li>
                  </a>
                </ul>
              </div>
            </div>

            <div class="user-client float-left  col-md-4 " v-if="!bandera">
              <div v-for="(item,index) in users" :key="index" class="i-client">
                <ul class="list-group " v-if="!check(item.role)">
                  <a class="btn btn-outline-info"  v-on:click="edit(item,e)">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <img v-bind:src="profileIcon" class="profile-icon" alt=":)" />
                      <strong>{{item.name}}</strong>

                      <span class="badge badge-primary badge-pill">email</span>
                    </li>
                  </a>
                </ul>
              </div>
            </div>

            <edit-user-component v-if="user!=null" :data=user></edit-user-component>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["data"],
  data() {
    return {
      user: null,
      users: [],
      selectU: "list-group-item-primary",
      profileIcon: "android-chrome-96x96.png",
      bandera: true,
      tap: "clientes",
      tapC: "",
      tapU: "active"
    };
  },
  methods: {
    edit: function(user) {
      this.user = user;
    },
    activeU: function() {
      this.tapC = "";
      this.tapU = "active";
      this.tap = "usuarios";
      this.bandera = true;
    },
    activeC: function() {
      this.tapC = "active";
      this.tapU = "clientes";
      this.bandera = false;
    },
    check: function(rol) {
      return rol == "Admin";
    }
  },
  computed: {},
  mounted: function() {
    if (this.user != null) {
      alert("ok");
    }
  },
  created() {
    axios.get("/users/all").then(res => {
      this.users = res.data.data;

      console.log(this.users);
      console.log("ok");
    });
  }
};
</script>

<style >
.profile-icon {
  height: 43px;
  width: 43px;
}
</style>


