<template>
    <div class="newRate text-left float-right col-md-8">
        <form action="" @submit="checkForm" ref="myForm" id="datos">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h2><strong>Solicita Garantía</strong></h2>
                        <br />
                        <strong>Tu correo, aqui te responderemos:</strong>
                        <input
                            required
                            type="email"
                            name="client_email"
                            class="form-control col-xs-12 col-sm-12 col-md-4"
                            autocomplete="new-password"
                            placeholder="Nombre del Cliente"
                            v-model="user.email"
                        />
                    </div>
                </div>
                
                     <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        
                        <strong>Número de contacto:</strong> Formato: 123-123-1234
                        <input
                            
                            required
                            type="tel"
                            name="tel_number"
                            class="form-control col-xs-12 col-sm-12 col-md-4" 
                            
                            autocomplete="new-password"
                            placeholder="123-123-1234 Número a 10 dígitos"
                            minlength="12"
                            maxlength="12"
                             pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                        />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cuerpo del mensaje:</strong>
                        <textarea
                            class="form-control"
                            name="body"
                            autocomplete="new-password"
                            placeholder="Describe el fallo o problema con el producto. "
                            rows="6"
                            required
                        ></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h5>
                            <strong
                            >¿Como encontrar los datos de fabricación de mi producto?</strong
                        >

                        
                        </h5>
                        <button type="button" class="btn btn-outline-primary btn-round" v-on:click="viewInfo" >Click aquí</button>
                    

                       
                    </div>
                </div>

                 <datalist id="manufacturers" >
                                <div v-for="(item,index) in manufacturers" :key="index ">
                                    <option v-bind:value="item.name"></option>
                  

                                </div>
                                
                </datalist>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong
                            >Selecciona el fabricante o marca del
                            producto:</strong
                        >
                        <input
                            list="manufacturers"
                            required
                            type="text"
                            name="manufacturer"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Marca"
                        />
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Modelo del producto</strong>
                        <input
                            required
                            type="text"
                            name="model"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Modelo"
                        />
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Número de serie</strong>
                        <input
                            required
                            type="text"
                            name="serial_number"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Ejemplo: 0123456789"
                        />
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Código del producto</strong>
                        <input
                            required
                            type="text"
                            name="code"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Ejemplo: NBKCDP180"
                        />
                    </div>
                </div>

                 <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Fecha exacta de compra o la más cercana</strong>
                        <input
                            required
                            type="date"
                            name="date_pay"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Ejemplo: NBKCDP180"
                        />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> Mándanos tu factura o nota de compra</strong>
                        <br />
                        Adjuntar archivos:

                        <input multiple v-on:change='setFileName' name="a_file[]"  type="file" />
                         <button class="btn btn-primary btn-round">Seleccionar archivos</button>
                         <label >
                             {{archivos}}
                         </label>
                        <div class="spinner" v-if="spin" >
                            Cargando ...
                        </div>
                    </div>
                </div>

                <div
                    class="col-xs-12 col-sm-12 col-md-12 text-center"
                    id="contactos"
                >
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                </div>
            </div>
        </form>

        <!-- Button trigger modal -->

        <!-- Modal -->
          <div
            class="modal fade"
            id="info-product"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Sistema de solicitudes
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="/info-product.jpg" alt="" width="100%">
                   </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="alert-send"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Sistema de solicitudes
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Gracias {{ user.name }} hemos recibido tu solicitud con
                        <strong> éxito </strong>, en breve te responderemos.
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            OK
                        </button>
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
            user: {},
            archivos:"",
            manufacturers:[] ,
            spin: false,
            myFormData: null,
        };
    },
    methods: {
        checkForm: function (e) {
            this.myFormData = new FormData(this.$refs.myForm);
            this.spin = true;
            axios({
                method: "post",
                url: "/client/warranty",
                data: this.myFormData,
                config: { headers: { "Content-Type": "multipart/form-data" } },
            }).then((response) => {
                console.log(response.data);
                this.spin = false;
                $("#alert-send").modal("show");

                //var user = JSON.parse(response.data.user_n);

                //document.getElementById("firma").src = user.url_photo;
                //console.log(this.user);
            });
            e.preventDefault();
        },

        setFileName: function (event) {
            //get the file name
            try {
                let files=event.target.files;
                //console.log(files);
               // alert(files.toString());

                for (let index = 0; index < files.length; index++) {
                       var fileName = files[index].name;
                //console.log(fileName);
                this.archivos=this.archivos+" "+fileName;
                //alert(this.archivos); 
                
                    
                }
              
                  
               
            } catch (error) {
                console.log(error);
            }
        

            //replace the "Choose a file" label
            // $(this).next('.custom-file-label').html(fileName);
        },
        viewInfo: function(){
              $("#info-product").modal("show");
        }
    },
    mounted() {},
    created() {
        axios.get("/user").then((res) => {
            this.user = res.data.data;

            console.log(this.user);
            console.log("ok");
        });

         axios.get("/manufacturer").then((res) => {
            this.manufacturers = res.data.data;

            console.log(this.manufacturers);
            console.log("ok");
        });
    },
};
</script>
