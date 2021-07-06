<template>
    <div class="rate">
        <div     class="modal fade"
                    id="notiEnviarModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="enviarModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    id="enviarModalLabel"
                                >
                                    Notificación de acción
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

                               <h3>La cotización se envío correctamente </h3>
                                <div v-if="typeof (mensaje.file)!=undefined ">
                                        
                                    <a  v-bind:href="'/cotizaciones/'+mensaje.file" target="_blank" >
                                        {{mensaje.file}}
                                    </a>

                                    
                                <!--   </div> -->
                                    </div>
                                    
                                
                            </div>
                            <div class="modal-footer">
                                
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Cerrar
                                </button>
                              
                            </div>
                        </div>
                    </div>
                </div>

         <div     class="modal fade"
                    id="notiGuardarModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="enviarModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    id="enviarModalLabel"
                                >
                                    Notificación de acción
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

                               <h3>La cotización se guardo correctamente </h3>
                                <div v-if="typeof (mensaje.file)!=undefined ">
                                        
                                    <a  v-bind:href="'/cotizaciones/'+mensaje.file" target="_blank" >
                                        {{mensaje.file}}
                                    </a>

                                    
                                <!--   </div> -->
                                    </div>
                                    
                                
                            </div>
                            <div class="modal-footer">
                                
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Cerrar
                                </button>
                              
                            </div>
                        </div>
                    </div>
                </div>


                <div     class="modal fade"
                    id="notiVistaModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="enviarModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    id="enviarModalLabel"
                                >
                                    Notificación de acción
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

                               <h3>Cotización vista previa </h3>
                                    <div v-if="typeof (mensaje.file)!=undefined ">
                                        
                                    <a  v-bind:href="'/rate/vista-previa/'+mensaje.file" target="_blank" >
                                        {{mensaje.file}}
                                    </a>

                                    
                                <!--   </div> -->
                                    </div>
                                    
                                
                            </div>
                            <div class="modal-footer">
                                
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    Cerrar
                                </button>
                              
                            </div>
                        </div>
                    </div>
                </div>
        <div
                    class="modal fade"
                    id="enviarModal"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="enviarModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5
                                    class="modal-title"
                                    id="enviarModalLabel"
                                >
                                    Enviar Cotización
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
                                        <strong>Email</strong>
                                        <input
                                            required
                                            type="text"
                                            name="cliente_m"
                                            class="form-control"
                                            autocomplete="new-password"
                                            placeholder="Email"
                                            v-model="clientSelect.email"
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
                                            v-model="mensaje.body"
                                        >
                                            
                                        </textarea>
                                        
                                    </div>
                               

                               
                                    <div v-if="typeof (mensaje.file)!=undefined ">
                                          <!-- <div
                                            v-for="(file,
                                            index) in solicitud.files"
                                            :key="index"
                                        > -->
                                    <a  v-bind:href="'/cotizaciones/'+mensaje.file" target="_blank" >
                                        {{mensaje.file}}
                                    </a>

                                    
                                <!--   </div> -->
                                    </div>

                                    
                                
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-info"
                                    data-dismiss="modal"
                                    v-on:click="enviarEmail"
                                 
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
        <!--    -->

        <div class="card">
            <div class="card-header">
                Cliente
            </div>
            <div class="card-body">
                <client-crud-component
                    v-on:saveclient="getClient"
                    v-on:selectclient="getClient"
                ></client-crud-component>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Datos Cotización
            </div>
            <div class="card-body">
                <!--  <form action="{{ route('rate.store') }}" id="datosForm" target="print_popup"
                            onsubmit="window.open('about:blank','print_popup','width=1000,height=800');" method="POST">
                            @csrf -->
                <div class="form-group row">
                    <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Vigencia:</label
                    >
                    <div class="col-md-6">
                        <input
                            type="date"
                            required
                            name="validation"
                            class="form-control"
                            autocomplete="new-password"
                            v-model="from_data.vigencia"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <datalist id="condiciones">
                        <option value="donde indique el cliente"></option>
                        <option
                            value="la existencia puede variar según el tiempo de compra"
                        ></option>
                    </datalist>
                    <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Condiciones de entrega:</label
                    >
                    <div class="col-md-6">
                        <input
                            type="text"
                            list="condiciones"
                            required
                            name="place_delivery"
                            class="form-control"
                            autocomplete="new-password"
                            v-model="from_data.entrega"
                        />
                    </div>
                </div>
                <div class="form-group row">
                    <datalist id="plazo">
                        <option
                            value="la existencia puede variar según el tiempo de compra"
                        ></option>
                    </datalist>
                    <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Plazo de entrega:</label
                    >
                    <div class="col-md-6">
                        <input
                            type="text"
                            list="plazo"
                            required
                            name="time_delivery"
                            class="form-control"
                            autocomplete="new-password"
                            v-model="from_data.plazo"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <datalist id="garantia">
                        <option value="La que el fabricante indique"></option>
                    </datalist>
                    <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Garantia:</label
                    >
                    <div class="col-md-6">
                        <input
                            type="text"
                            list="garantia"
                            required
                            name="guarantee"
                            class="form-control"
                            autocomplete="new-password"
                            v-model="from_data.garantia"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <datalist id="modo">
                        <option value="de contado"></option>
                        <option value="contraentrega"></option>
                        <option value="credito 20 dias naturales"></option>
                        <option
                            value="a partir de la entrada del producto"
                        ></option>
                    </datalist>
                    <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Condiciones de pago:</label
                    >
                    <div class="col-md-6">
                        <input
                            type="text"
                            list="modo"
                            required
                            name="pay_mode"
                            class="form-control"
                            autocomplete="new-password"
                            v-model="from_data.pago"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <datalist id="divisa">
                        <option
                            value="pesos mexicanos, ya incluye IVA"
                        ></option>
                        <option
                            value="dolares estadounidenses, ya incluye IVA"
                        ></option>
                    </datalist>
                    <label
                        for="name"
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Divisa:</label
                    >
                    <div class="col-md-6">
                        <input
                            type="text"
                            list="divisa"
                            required
                            name="type_currency"
                            class="form-control"
                            autocomplete="new-password"
                            v-model="from_data.divisa"
                        />
                    </div>
                </div>
            </div>

            <!--   </form> -->
        </div>
        <div class="card">
            <div class="card-header">
                Seleccionar Productos y Kits
            </div>
            <div class="card-body">
                <products-kits-component
                    v-on:cotizacionConceptos="fillConceptos"
                >
                </products-kits-component>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Finalizando cotización
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center" v-if="spin">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                        <div class="form-group">
                            <button type="button" v-on:click="vistapreviaC" class="btn btn-primary">
                                Vista previa del pdf
                            </button>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                        <div class="form-group">
                            <button type="button" v-on:click="guardar" class="btn btn-primary">
                                Guardar cotización
                            </button>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                        <div class="form-group">
                            <button
                                type="button"
                                v-on:click="guardarEnviar"
                                class="btn btn-primary"
                            >
                                Guardar y enviar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            mensaje:{file:"",body:""},
            clientSelect: { name: "", address: "", city: "" },
            from_data: {
                vigencia: "",
                entrega: "",
                plazo: "",
                garantia: "",
                pago: "",
                divisa: "",
            },
            conceptos_data: [],
            spin: false,
            myFormData: null,
        };
    },
    methods: {
        guardarEnviar: function () {
            var conceptos_aux = [];

            this.conceptos_data.forEach((concepto) => {
                conceptos_aux.push({
                    id: concepto.id,
                    type: concepto.type,
                    cantidad: concepto.cantidad,
                    envio: concepto.costo_envio.replace(",", ""),
                    total: concepto.total.replace(",", ""),
                    utilidad: concepto.utilidad.replace(",", ""),
                    precio: concepto.price.replace(",", ""),
                    unitario: concepto.precio_unitario.replace(",", ""),
                    descuento: concepto.descuento,
                    description: concepto.label,
                });
            });
            console.log(conceptos_aux);
            this.myFormData = {
                client: this.clientSelect,
                inputs: this.from_data,
                conceptos: conceptos_aux,
            };

            this.spin = true;
            axios({
                method: "post",
                url: "/rate/saveAndSend",
                data: this.myFormData,
                config: { headers: { "Content-Type": "application/json" } },
            }).then((response) => {
                console.log(response.data);
                var res=response.data;
                this.mensaje.file=res.url_pdf;
                this.spin = false;
                 $("#enviarModal").modal("show");

               // alert("OK");
            });
            e.preventDefault();
        },
        guardar: function () {
            var conceptos_aux = [];

            this.conceptos_data.forEach((concepto) => {
                conceptos_aux.push({
                    id: concepto.id,
                    type: concepto.type,
                    cantidad: concepto.cantidad,
                    envio: concepto.costo_envio.replace(",", ""),
                    total: concepto.total.replace(",", ""),
                    utilidad: concepto.utilidad.replace(",", ""),
                    precio: concepto.price.replace(",", ""),
                    unitario: concepto.precio_unitario.replace(",", ""),
                    descuento: concepto.descuento,
                    description: concepto.label,
                });
            });
            console.log(conceptos_aux);
            this.myFormData = {
                client: this.clientSelect,
                inputs: this.from_data,
                conceptos: conceptos_aux,
            };

            this.spin = true;
            axios({
                method: "post",
                url: "/rate/saveAndSend",
                data: this.myFormData,
                config: { headers: { "Content-Type": "application/json" } },
            }).then((response) => {
                console.log(response.data);
                var res=response.data;
                this.mensaje.file=res.url_pdf;
                this.spin = false;
                 $("#notiGuardarModal").modal("show");

               // alert("OK");
            });
            e.preventDefault();
        },


        vistapreviaC: function () {
            var conceptos_aux = [];

            this.conceptos_data.forEach((concepto) => {
                conceptos_aux.push({
                    id: concepto.id,
                    type: concepto.type,
                    cantidad: concepto.cantidad,
                    envio: concepto.costo_envio.replace(",", ""),
                    total: concepto.total.replace(",", ""),
                    utilidad: concepto.utilidad.replace(",", ""),
                    precio: concepto.price.replace(",", ""),
                    unitario: concepto.precio_unitario.replace(",", ""),
                    descuento: concepto.descuento,
                    description: concepto.label,
                });
            });
            console.log(conceptos_aux);
            this.myFormData = {
                client: this.clientSelect,
                inputs: this.from_data,
                conceptos: conceptos_aux,
            };

            this.spin = true;
            axios({
                method: "post",
                url: "/rate/vista-previa-crete",
                data: this.myFormData,
                config: { headers: { "Content-Type": "application/json" } },
            }).then((response) => {
                console.log(response);
                var res=response.data;
                this.mensaje.file=res.url_pdf;
                this.spin = false;
                 $("#notiVistaModal").modal("show");

               // alert("OK");
            });
            e.preventDefault();
        },
        enviarEmail: function () {
           
            this.myFormData = {
                client_email: this.clientSelect.email,
                body: this.mensaje.body,
                tel_number:"9611933971",
                a_file: this.mensaje.file,
            };

            this.spin = true;
            axios({
                method: "post",
                url: "/rate/mailSend",
                data: this.myFormData,
                config: { headers: { "Content-Type": "application/json" } },
            }).then((response) => {
                console.log(response);
               
                this.spin = false;
                 $("#notiEnviarModal").modal("show");

               // alert("OK");
            });
            e.preventDefault();
        },

        fillConceptos(conceptos) {
            this.conceptos_data = conceptos;
        },
        getClient(item) {
            this.clientSelect = {
                id: item.id,
                name: item.name,
                number: item.number,
                email: item.email,
                rfc: item.rfc,
                address: item.address,
                country: item.country,
                state: item.state,
                city: item.city,
            };
        },
    },
    mounted() {},
    created() {},
};
</script>
