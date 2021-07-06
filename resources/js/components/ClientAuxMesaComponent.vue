<template>
    <div class="client-mesa">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-md-12">
                    <div class="card-header">
                        <div class="card-body">
                           <!--  <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h6 class="mb-0">
                                            <button
                                                class="btn btn-link"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseOne"
                                                aria-expanded="true"
                                                aria-controls="collapseOne"
                                            >
                                                Rogelio Beristain Pelayes
                                                 <span
                                            class="badge badge-primary badge-pill">2</span>
                                            </button>
                                        </h6>
                                    </div>

                                    <div
                                        id="collapseOne"
                                        class="collapse "
                                        aria-labelledby="headingOne"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                           <div class="solicitudes" >
                                               <div class="row">
                                                     <div class="date col-md-3">
                                                   Fecha:  <span class="badge badge-pill badge-info">26/06/2020</span>
                                               </div>
                                                <div class="type col-md-3">
                                                    Tipo de solicitud: <span class="badge badge-pill badge-primary">Cotización</span>
                                                </div>
                                                <div class="status col-md-3">
                                                    Estado: <span class="badge badge-pill badge-warning">Pendiente</span>
                                                </div>
                                                <div class="accion col-md-3">
                                                    
                                                          <button type="button" class="btn btn-primary btn-sm">ver</button>
                                                    
                                                    
                                                </div>

                                               </div>
                                             
                                           
                                               
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                  <div class="card">
                                    <div class="card-header" id="heading">
                                        <h6 class="mb-0">
                                            <button
                                                class="btn btn-link"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapse"
                                                aria-expanded="true"
                                                aria-controls="collapse"
                                            >
                                                Rogelio Beristain Pelayes
                                                 <span
                                            class="badge badge-primary badge-pill">2</span>
                                            </button>
                                        </h6>
                                    </div>

                                    <div
                                        id="collapse"
                                        class="collapse "
                                        aria-labelledby="heading"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                           <div class="solicitudes" >
                                               <div class="row">
                                                     <div class="date col-md-3">
                                                   Fecha:  <span class="badge badge-pill badge-info">27/06/2020</span>
                                               </div>
                                                <div class="type col-md-3">
                                                    Tipo de solicitud: <span class="badge badge-pill badge-primary">Cotización</span>
                                                </div>
                                                <div class="status col-md-3">
                                                    Estado: <span class="badge badge-pill badge-warning">Pendiente</span>
                                                </div>
                                                <div class="accion col-md-3">
                                                    
                                                          <button type="button" class="btn btn-primary btn-sm">ver</button>
                                                    
                                                    
                                                </div>

                                               </div>
                                             
                                           
                                               
                                              
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div> -->

                            
                         <div class="description">
		<h4 class="info-title">Aun no tienes respuesta a tu solicitud</h4>
		<p> Aquí puedes consultar el estado de tu solicitud y tambien responderemos en el correo que nos proporcionaste.</p>
		
	</div>
                        
                        
                        </div>
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
            new_rate: true,
            new_warranty: false,
            user: null,
            users: [],
            selectU: "list-group-item-primary",
            profileIcon: "/android-chrome-96x96.png",
            bandera: true,
            tap: "clientes",
            tapC: "",
            tapU: "active",
        };
    },
    methods: {
        activeU: function () {
            this.tapC = "";
            this.tapU = "active";
            this.tap = "usuarios";
            this.bandera = true;
            this.new_warranty = false;
            this.new_rate = true;
        },
        activeC: function () {
            this.tapC = "active";
            this.tapU = "clientes";
            this.bandera = false;
            this.new_warranty = true;
            this.new_rate = false;
        },
    },
    computed: {},
    mounted: function () {},
    created() {},
};
</script>

<style>
.profile-icon {
    height: 43px;
    width: 43px;
}
.solicitudes{
    background-color: antiquewhite;
    border-radius: 1em/5em;
}
</style>
