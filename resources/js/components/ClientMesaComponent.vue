<template>
    <div class="client-mesa">
        <div class="container-fluid">
            <div class="row">
                <div
                    class="modal fade"
                    id="solicitudModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="solicitudModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    id="solicitudModalLabel"
                                >
                                    Solicitud
                                </h5>
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="close"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                        <strong>Número de contacto</strong>
                                        <input
                                            required
                                            type="tel"
                                            name="tel_number"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Número de contacto"
                                            v-model="solicitud.tel_number"
                                        >
                                            
                                       
                                        
                                    </div>
                                <div class="form-group">
                                        <strong>Cuerpo del mensaje</strong>
                                        <textarea
                                            required
                                            type="text"
                                            name="body"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Cuerpo del mensaje"
                                            v-model="solicitud.body"
                                        >
                                            
                                        </textarea>
                                        
                                    </div>
                               

                                <div
                                    v-if="
                                        typeof solicitud.manufacturer_name !=
                                        'undefined'
                                    "
                                >
                                    <div class="form-group">
                                        <strong>Marca</strong>
                                        <input
                                            required
                                            type="text"
                                            name="manufacturer"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Marca"
                                            :value="solicitud.manufacturer_name"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <strong>Modelo del producto</strong>
                                        <input
                                            required
                                            type="text"
                                            name="model"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Modelo"
                                            :value="solicitud.model"
                                        />
                                    </div>

                                    <div class="form-group">
                                        <strong
                                            >Código o numero del
                                            producto</strong
                                        >
                                        <input
                                            required
                                            type="text"
                                            name="code"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Código"
                                            :value="solicitud.code"
                                        />
                                    </div>

                                    <div class="form-group">
                                        <strong>Numero de serie</strong>
                                        <input
                                            required
                                            type="text"
                                            name="serial_number"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Numero de serie"
                                            :value="solicitud.serial_number"
                                        />
                                    </div>

                                    <div class="form-group">
                                        <strong>Fecha de compra</strong>
                                        <input
                                            required
                                            type="text"
                                            name="pay_date"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Fecha de compra"
                                            :value="solicitud.date_pay"
                                        />
                                    </div>
                                </div>
                                    <div v-if="typeof (solicitud.files)!=undefined ">
                                          <div
                                            v-for="(file,
                                            index) in solicitud.files"
                                            :key="index"
                                        >
                                    <a  v-bind:href="'/uploads/'+file.name" target="_blank" >
                                        {{file.name}}
                                    </a>

                                    
                                  </div>
                                    </div>

                                     <div class="form-group">
                                        <strong>Responder: </strong>
                                        <textarea
                                            required
                                            type="text"
                                            name="body"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Responder aquí al cliente"
                                            v-model="solicitud.respuesta"
                                        >
                                            
                                        </textarea>
                                        
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    data-dismiss="modal"
                                    v-bind:disabled="isFill(solicitud.respuesta)"
                                >
                                    Responder
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Cerrar
                                </button>
                                <button type="button" class="btn btn-primary">
                                    OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-12">
                    <div class="card-header">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div
                                        v-for="(item, index) in users"
                                        :key="index"
                                    >
                                        <div
                                            class="card-header"
                                            :id="'heading' + item.id"
                                        >
                                            <h6 class="mb-0">
                                                <button
                                                    class="btn btn-link"
                                                    type="button"
                                                    data-toggle="collapse"
                                                    :data-target="
                                                        '#collapse' + item.id
                                                    "
                                                    aria-expanded="true"
                                                    :aria-controls="
                                                        'collapse' + item.id
                                                    "
                                                >
                                                    {{ item.name }}
                                                    <span
                                                        class="badge badge-primary badge-pill"
                                                        >{{
                                                            item.client.aplications
                                                                .length +
                                                            item.client.warranties
                                                                .length
                                                        }}</span
                                                    >
                                                </button>
                                            </h6>
                                        </div>
                                        <div
                                            v-for="(aplication,
                                            index2) in item.client.aplications"
                                            :key="index2"
                                        >
                                            <div
                                                :id="'collapse' + item.id"
                                                class="collapse"
                                                :aria-labelledby="
                                                    'heading' + item.id
                                                "
                                                data-parent="#accordionExample"
                                            >
                                                <div class="card-body">
                                                    <div class="solicitudes">
                                                        <div class="row">
                                                            <div
                                                                class="date col-md-3"
                                                            >
                                                                Fecha:
                                                                <span
                                                                    class="badge badge-pill badge-info"
                                                                    >{{
                                                                        formate(
                                                                            aplication.created_at
                                                                        )
                                                                    }}</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="type col-md-3"
                                                            >
                                                                Tipo de
                                                                solicitud:
                                                                <span
                                                                    class="badge badge-pill badge-primary"
                                                                    >Cotización</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="status col-md-3"
                                                            >
                                                                Estado:
                                                                <span
                                                                    class="badge badge-pill badge-warning"
                                                                    >{{
                                                                        getStatus(
                                                                            aplication.status
                                                                        )
                                                                    }}</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="accion col-md-3"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary btn-sm"
                                                                    v-on:click="
                                                                        ver(
                                                                            aplication
                                                                        )
                                                                    "
                                                                >
                                                                    ver
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            v-for="(warranty,
                                            index3) in item.client.warranties"
                                            :key="index3"
                                        >
                                            <div
                                                :id="'collapse' + item.id"
                                                class="collapse"
                                                :aria-labelledby="
                                                    'heading' + item.id
                                                "
                                                data-parent="#accordionExample"
                                            >
                                                <div class="card-body">
                                                    <div class="solicitudes">
                                                        <div class="row">
                                                            <div
                                                                class="date col-md-3"
                                                            >
                                                                Fecha:
                                                                <span
                                                                    class="badge badge-pill badge-info"
                                                                    >{{
                                                                        formate(
                                                                            warranty.created_at
                                                                        )
                                                                    }}</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="type col-md-3"
                                                            >
                                                                Tipo de
                                                                solicitud:
                                                                <span
                                                                    class="badge badge-pill badge-primary"
                                                                    >Garantía</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="status col-md-3"
                                                            >
                                                                Estado:
                                                                <span
                                                                    class="badge badge-pill badge-warning"
                                                                    >{{
                                                                        getStatus(
                                                                            warranty.status
                                                                        )
                                                                    }}</span
                                                                >
                                                            </div>
                                                            <div
                                                                class="accion col-md-3"
                                                            >
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary btn-sm"
                                                                    v-on:click="
                                                                        ver(
                                                                            warranty
                                                                        )
                                                                    "
                                                                >
                                                                    ver
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            user: null,
            solicitud: {},
            users: [],
        };
    },
    methods: {
        formate(date) {
            let date1 = new Date(date);
            // moment.locale("es");

            let date2 = moment(date1, "YYYYMMDD").locale("es").format("LL");

            // alert(date1+"  "+date2);
            return date2;
        },
        getStatus(status) {
            //hard code no optimization
            let value = "Pendiente";
            /*   if(status==""){
                return value;
            }
            if(status==false){
                return value;
            } */
            if (status == true) {
                value = "Atendido";
            }
            return value;
        },
        ver(id) {
            // alert(id);
            //mal diseño del db vamos a parchar un poco aqui ambos tipos de solicitudes deberian tener en comun un campo body
            
            if(typeof (id.description)!='undefined'){
                id.body=id.description;
            }

             if(typeof (id.files)!='undefined'){
                 console.log(id.files);
                 console.log(typeof (id.files)+"hola" );
                   if( typeof (id.files)!='object'){
                        id.files=JSON.parse(id.files);
                    } 
                    // id.files=JSON.parse(id.files)
                console.log(id.files);
            }
           
            this.solicitud = id;
            console.log(id)
            $("#solicitudModal").modal("show");
        },
        isFill(){
            let value=true;
            let respuesta=this.solicitud.respuesta;
            if(respuesta!='' && typeof (respuesta)!='undefined' && respuesta!=null){
                console.log(typeof respuesta)
                value=respuesta.length<4;
            }
            return value;
        }

    },
    computed: {},
    mounted: function () {},
    created() {
        axios.get("/users/solicitudes").then((res) => {
            this.users = res.data;

            console.log(this.users);
            
            //console.log("ok");
            // alert(this.users);
        });
    },
};
</script>

<style>
.profile-icon {
    height: 43px;
    width: 43px;
}
.solicitudes {
    background-color: antiquewhite;
    border-radius: 1em/5em;
}
</style>
