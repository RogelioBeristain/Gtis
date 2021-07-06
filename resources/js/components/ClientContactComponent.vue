<template>
    <div class="contact col-xs-12 col-sm-12 col-md-12">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-header">
                Contactos del cliente
            </div>
            <div class="card-body">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">Lista de contactos</div>
                    <div class="card-body">
                        <div
                            v-if="data.length > 0"
                            class="table-responsive"
                        >
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Contacto</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody
                                    v-for="(contact, index) in contacts"
                                    :key="index"
                                    class="contacts"
                                >
                               
                                     <tr v-for="(email, indexE) in contact.emails"
                                    :key="indexE">
                                        
                                        <td>{{ contact.name }}</td>
                                        <td>Correo</td>
                                        <td>{{ email.email }}</td>
                                        <td class="text-right">
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                                <button
                                                    type="button"
                                                    v-on:click="editItem(indexE)"
                                                    class="btn btn-secondary"
                                                >
                                                    editar
                                                </button>
                                                <button
                                                    v-on:click="
                                                        deleteItem(indexE)
                                                    "
                                                    type="button"
                                                    class="btn btn-secondary"
                                                >
                                                    eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-for="(phone, indexP) in contact.phones"
                                    :key="indexP">
                                        
                                        <td>{{ contact.name }}</td>
                                        <td>Telefono</td>
                                        <td>{{ phone.number }}</td>
                                        <td class="text-right">
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                                <button
                                                    type="button"
                                                    v-on:click="editItem(indexP)"
                                                    class="btn btn-secondary"
                                                >
                                                    editar
                                                </button>
                                                <button
                                                    v-on:click="
                                                        deleteItem(indexP)
                                                    "
                                                    type="button"
                                                    class="btn btn-secondary"
                                                >
                                                    eliminar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div
                    v-if="!agregarContacto"
                    class="col-xs-12 col-sm-12 col-md-12 text-center"
                >
                    <div class="form-group">
                        <button
                            type="button"
                            v-on:click="newContact"
                            class="btn btn-primary"
                        >
                            Agregar nuevo contacto
                        </button>
                    </div>
                </div>
                <datalist id="names" >
                                <div v-for="(names,indexA) in contacts" :key="indexA ">
                                    <option v-bind:value="names.name"></option>
                  

                                </div>
                                
                </datalist>
                <div
                    v-if="agregarContacto || editarContacto"
                    class="newcontactbool"
                >
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong
                                >Nombre del Contacto que desea agregar</strong
                            >
                            <input
                                
                                list="names"
                                required
                                type="text"
                                name="client_name"
                                class="form-control col-xs-12 col-sm-12 col-md-12"
                                autocomplete="new-password"
                                placeholder="Nombre del contacto"
                                v-model="contactSelect.name"
                            />
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong
                                >Selecciona el tipo de contacto para
                                {{
                                    contactSelect.name == ""
                                        ? "este contacto"
                                        : contactSelect.name
                                }}
                            </strong>

                            <select
                                required
                                v-model="contactType"
                                id="inputContact_tipo"
                                class="form-control"
                            >
                                <option value="" selected disabled hidden>
                                    Slecciona el tipo de contacto
                                </option>

                                <option value="tel"
                                    >Numero telefónico de contacto</option
                                >
                                <option value="email"
                                    >Correo electrónico de contacto</option
                                >
                            </select>
                        </div>
                    </div>

                    <div
                        v-if="contactType == 'tel'"
                        class="col-xs-12 col-sm-12 col-md-12"
                    >
                        <div class="form-group">
                            <strong>Número de contacto:</strong> Formato:
                            123-123-1234
                            <input
                                required
                                type="tel"
                                id="inputContact_tel"
                                name="tel_number"
                                class="form-control col-xs-12 col-sm-12 col-md-12"
                                autocomplete="new-password"
                                placeholder="123-123-1234 Número a 10 dígitos"
                                minlength="12"
                                maxlength="12"
                                pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                v-model="contactSelect.value"
                            />
                        </div>
                    </div>

                    <div
                        v-if="contactType == 'email'"
                        class="col-xs-12 col-sm-12 col-md-12"
                    >
                        <div class="form-group">
                            <strong>Correo electrónico</strong>
                            <input
                                required
                                id="inputContact_email"
                                type="email"
                                name="client_email"
                                class="form-control col-xs-12 col-sm-12 col-md-12"
                                autocomplete="new-password"
                                placeholder="Correo electrónico"
                                v-model="contactSelect.value"
                            />
                        </div>
                    </div>
                </div>

                <div
                    v-if="agregarContacto && !editarContacto"
                    class="col-xs-12 col-sm-12 col-md-12 text-center"
                >
                    <div class="form-group">
                        <button
                            type="button"
                            v-on:click="createContact"
                            class="btn btn-primary"
                        >
                            Agregar
                        </button>
                    </div>
                    <div class="form-group">
                        <button
                            type="button"
                            v-on:click="cancelActionContact"
                            class="btn btn-danger"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>
                <div
                    v-if="editarContacto && !agregarContacto"
                    class="col-xs-12 col-sm-12 col-md-12 text-center"
                >
                    <div class="form-group">
                        <button
                            type="button"
                            v-on:click="saveContact"
                            class="btn btn-primary"
                        >
                            Guardar
                        </button>
                    </div>
                    <div class="form-group">
                        <button
                            type="button"
                            v-on:click="cancelActionContact"
                            class="btn btn-danger"
                        >
                            Cancelar
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
            agregarContacto: false,
            editarContacto: false,
            contacts: this.data,

            contactType: "",

            contactSelect: { name: "", type: "", value: "", index: "" },

            countries: [{ id: 1, name: "México" }],
            states: [{ id: 1, name: "Chiapas" }],
            cities: [{ id: 1, name: "Tuxtla Gutiérrez" }],

            spin: false,
            myFormData: null,
        };
    },
    methods: {
        validInputs: function () {
            let valid = true;
            console.log("inputs: ");
            let input_tipo = document.getElementById("inputContact_tipo");
            console.log(input_tipo);
            let input_email = document.getElementById("inputContact_email");
            console.log(input_email);
            let input_tel = document.getElementById("inputContact_tel");
            console.log(input_tel);

            if (input_tipo.validity.valid) {
                valid = valid && true;
            } else {
                valid = valid && false;
            }
            if (input_email != null) {
                if (input_email.validity.valid) {
                    valid = valid && true;
                } else {
                    valid = valid && false;
                }
            }

            if (input_tel != null) {
                if (input_tel.validity.valid) {
                    valid = valid && true;
                } else {
                    valid = valid && false;
                }
            }

            return valid;
        },
        newContact: function () {
            this.agregarContacto = true;
            this.editarContacto = false;
        },
        createContact: function () {
            let valid = this.validInputs();
            if (valid) {
                this.agregarContacto = false;

                this.contactSelect.type = this.contactType;
                this.contacts.push(this.contactSelect);
                this.contactType = "";

                this.contactSelect = {
                    name: "",
                    type: "",
                    value: "",
                    index: "",
                };
            }
        },
        saveContact: function () {
            let valid = this.validInputs();

            if (valid) {
                this.editarContacto = false;
                this.contactSelect.type = this.contactType;

                let contact = this.contacts[this.contactSelect.index];
                contact.name = this.contactSelect.name;
                contact.type = this.contactSelect.type;
                contact.value = this.contactSelect.value;

                this.contactSelect = {
                    name: "",
                    type: "",
                    value: "",
                    index: "",
                };
                this.contactType = "";
                this.contactSelect.type = this.contactType;
            }
        },
        deleteItem(item) {

            this.contacts.splice(item.index, 1);
            this.contactType = "";
            this.contactSelect = { name: "", type: "", value: "", index: "" };

            this.agregarContacto = false;
            this.editarContacto = false;
        },
        editItem(item) {
            this.editarContacto = true;
            this.agregarContacto = false;
            let contact = this.contacts[item.index];

            contact.index = item.index;
            this.contactSelect = {
                name: contact.name,
                type: contact.type,
                value: contact.value,
                index: contact.index,
            };
            this.contactType = this.contactSelect.type;
        },
        cancelActionContact() {
            this.contactType = "";
            this.contactSelect = { name: "", type: "", value: "", index: "" };

            this.agregarContacto = false;
            this.editarContacto = false;
        },
    },
    mounted() {

       
    },
    created() {
       

        
    },
};
</script>
<style>
input:invalid {
    border: 1.5px solid #FAB526;
}

input:valid {
    border: 1.5px solid #34b5b8;
}

select:invalid {
    border: 1.5px solid #FAB526;
}

select:valid {
    border: 1.5px solid #34b5b8;
}
</style>
