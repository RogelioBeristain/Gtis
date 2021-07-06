<template>
    <div class="newRate text-left float-right col-md-8">
        <form action="" @submit="checkForm" ref="myForm" id="datos">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <h2> <strong>Solicita Cotización</strong> </h2>
                        <br />
                        <strong>Tu correo, aquí te responderemos:</strong>
                        <input
                            required
                            type="email"
                            name="client_email"
                            class="form-control col-xs-12 col-sm-12 col-md-4"
                            autocomplete="new-password"
                            placeholder="Email"
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
                            placeholder="Escribe todo lo que necesitas"
                            rows="6"
                            required
                        ></textarea>
                    </div>
                </div>

             

                
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                       
                        <strong>Adjuntar archivos:  </strong>
                        <input id="archivo" multiple v-on:change='setFileName' name="a_file[]" type="file" />
                        <button class="btn btn-primary btn-round">Seleccionar archivos</button>
                         <label >
                                {{archivos}}
                         </label>
                          <div class="loader" v-if="spin"> cargando...</div>

                        
                        
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sistema de solicitudes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Gracias {{user.name}} hemos recibido tu solicitud con <strong> éxito </strong>, en breve te responderemos.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      
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
            spin:false,
            myFormData: null,
        };
    },
    methods: {
        checkForm: function (e) {
            this.myFormData = new FormData(this.$refs.myForm);
            this.spin=true;
            axios({
                method: "post",
                url: "/client/send",
                data: this.myFormData,
                config: { headers: { "Content-Type": "multipart/form-data" } },
            }).then( (response) =>{
                console.log(response.data);
                this.spin=false;
               $('#exampleModal').modal('show')
              

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
    },
    mounted() {},
    created() {
        
        axios.get("/user").then((res) => {
            this.user = res.data.data;

            console.log(this.user);
            console.log("ok");
        });
    },
};
</script>
