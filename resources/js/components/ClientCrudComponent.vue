<template>
    <div class="col-md-12 ">

        <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Seleciona un cliente de la lista o haz click en cliente nuevo</strong>
                       
                    </div>
        </div>
        
        <div
           
            class="col-xs-12 col-sm-12 col-md-12 "
        >
            <div class="form-group">
                <button
                    type="button"
                   v-on:click="newClient"
                    class="btn btn-primary"
                >
                    
                    {{!isNewClient?  "Cliente nuevo":"Selecionar cliente"}}
                </button>
            </div>
        </div>
        
          <client-list-component v-if="!isNewClient" v-on:clientselect="isSelect"></client-list-component>


       <div class="formulario" v-if="activeForm">
            <form action="" @submit="checkForm" ref="myForm" id="datos">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Nombre del cliente</strong>
                        <input
                            required
                            type="text"
                            name="client_name"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="Nombre del Cliente"
                            v-model="client.name"
                            v-bind:disabled="disableForm"
                        />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Número de contacto: </strong> Formato:
                        123-123-1234
                        <input
                          
                            type="tel"
                            name="client_number"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="123-123-1234 Número a 10 dígitos (opcional)"
                            minlength="12"
                            maxlength="12"
                            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                             v-model="client.number"
                             v-bind:disabled="disableForm"
                        />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Correo electrónico</strong>
                        <input
                         
                            type="text"
                            name="client_email"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="Correo electrónico (opcional)"
                            v-model="client.email"
                             v-bind:disabled="disableForm"
                        />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3">
                    <fieldset class="form-group">
                        <div class="row">
                            <legend
                                class="col-form-label col-xs-2 col-md-6 pt-0"
                            >
                                <strong>Persona</strong> 
                            </legend>

                            <div class="col-xs-10 col-md-6">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="gridRadios"
                                        id="gridRadios1"
                                        value="fisica"
                                         v-bind:disabled="disableForm"
                                    
                                        v-model="rfc_tipo"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="gridRadios1"
                                    >
                                        Fisica
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="gridRadios"
                                        id="gridRadios2"
                                        value="moral"
                                        v-model="rfc_tipo"
                                         v-bind:disabled="disableForm"
                                       
                                    />
                                    <label
                                        class="form-check-label"
                                        for="gridRadios2"
                                    >
                                        Moral
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <strong>R.F.C.</strong>
                        <input
                            
                            type="text"
                            name="client_rfc"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="(opcional)"
                            v-model="client.rfc"
                            v-on:keyup="toUpper(client.rfc)"
                            
                             v-bind:minlength="rfc_tipo=='fisica'? '13': '12'" 
                                       
                                        v-bind:maxlength="rfc_tipo=='fisica'? '13': '12'"
                         v-bind:disabled="disableForm"
                        />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Dirección</strong>
                        <input
                            required
                            type="text"
                            name="client_address"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="Dirección"
                            v-model="client.address"
                             v-bind:disabled="disableForm"
                        />
                    </div>
                </div>
                 <datalist id="countries" >
                                <div v-for="(item,index) in countries" :key="index ">
                                    <option v-bind:value="item.name"></option>
                  

                                </div>
                                
                </datalist>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>Pais</strong>
                        <input
                            list="countries"
                            required
                            type="text"
                            name="client_country"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="Pais"
                            v-model="client.country"
                             v-bind:disabled="disableForm"
                        />
                    </div>
                </div>
                <datalist id="states" >
                                <div v-for="(item,index) in states" :key="index ">
                                    <option v-bind:value="item.name"></option>
                  

                                </div>
                                
                </datalist>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>Estado</strong>
                        <input
                            list="states"
                            required
                            type="text"
                            name="client_state"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="Estado"
                            v-model="client.state"
                             v-bind:disabled="disableForm"
                        />
                    </div>
                </div>
                <datalist id="cities" >
                                <div v-for="(item,index) in cities" :key="index ">
                                    <option v-bind:value="item.name"></option>
                  

                                </div>
                                
                </datalist>
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>Ciudad</strong>
                        <input
                            list="cities"
                            required
                            type="text"
                            name="client_city"
                            class="form-control col-xs-12 col-sm-12 col-md-12"
                            autocomplete="new-password"
                            placeholder="Ciudad"
                            v-model="client.city"
                             v-bind:disabled="disableForm"
                        />
                    </div>
                </div>
             
               <!--  <client-contact-component :data="client.contacts" ></client-contact-component>
                 -->
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                     <div class="form-group">
                    <button type="button" v-on:click="saveClient" class="btn btn-primary">
                        Guardar
                    </button>
                     </div>
                </div>

                
            </div>


        </form>
       </div>

    </div>
</template>
<script>
export default {
    props: ["data"],
    data() {
        return {
            disableForm:true,
            isNewClient:false,
            activeForm:false,
            /* clients:[], */
            rfc_tipo:"fisica",
            client: {id:"",name: "",address:"", city:"",email:""},
            countries:[{"id":1,"name":"México"}],
            states:[{"id":1,"name":"Chiapas"}],
            cities:[{"id":1,"name":"Tuxtla Gutiérrez"}],
            
           
            spin: false,
            myFormData: null,
        };
    },
    methods: {
        toUpper: function (texto){
            
            texto=texto.toUpperCase();
            this.client.rfc=texto;
           // alert(texto);
        },
        checkForm: function (e) {

           /*  this.myFormData = new FormData(this.$refs.myForm);
            this.spin = true;

            axios({
                method: "post",
                url: "/client/warranty",
                data: this.myFormData,
                config: { headers: { "Content-Type": "multipart/form-data" } },
            }).then((response) => {
                console.log(response.data);
                this.spin = false;
            
            });

            e.preventDefault(); */
        },
        send(){
            this.$emit('saveclient',this.client);
        },
        isSelect(client){
           
            console.log("isSelect##");
            console.log(client.contacts.data.length);
            this.disableForm=true;
            this.activeForm=true;
           /*  if(client.contacts.data.length>0){
            let contactoAux= client.contacts.data;
                for (let index = 0; index < contactoAux.length; index++) {
                    this.contacts[index] = {name: contactoAux[index].name , emails: contactoAux[index].emails, phones:contactoAux[index].phones};

                    
                }
            }else{
                this.contacts=[];
            } */
            
           // console.log(this.contacts);

            this.client={ 
                id: client.id,
                name: client.name,
                address: client.address,
                city: client.city,
                number: client.number,
                email: client.email,
                country:client.country,
                state: client.state,
                rfc: client.rfc,
                contacts: client.contacts.data};
                 //llenado de imputs
           
            this.$emit('selectclient',this.client);
        },
          saveClient(){
           
       

            this.disableForm=true;
            this.activeForm=true;
 

         /*    this.client={ 
                id: client.id,
                name: client.name,
                address: client.address,
                city: client.city,
                number: client.number,
                email: client.email,
                country:client.country,
                state: client.state,
                rfc: client.rfc,
                contacts: client.contacts.data};
                 //llenado de imputs
            */
            this.$emit('selectclient',this.client);
        },

        newClient(){
        this.isNewClient=!this.isNewClient;//lo vamos a dejar para despues 
        this.activeForm=true;
        this.disableForm=false;
        this.client={name: "", address:"", city:""};// vaciando los inputs
        
        }
        

       
    },
    mounted() {

      
    },
    created() {
        

    },
};
</script>
