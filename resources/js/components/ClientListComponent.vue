<template>
    <div class="clients col-xs-12 col-sm-12 col-md-12">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-header">
                Clientes registrados
            </div>
            <div class="card-body">
                <div class="card text-white bg-dark mb-3">
                    <!--  <div class="card-header">Lista de Clientes</div> -->
                    <div class="card-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                               
                                <input
                                    type="text"
                                    name="client_name"
                                    class="form-control col-xs-12 col-sm-6 col-md-6"
                                    autocomplete="new-password"
                                    placeholder="Busqueda por nombre"
                                    v-model="buscador"
                                />
                            </div>
                        </div>
                        <div v-if="clients.length > 0" class="table-responsive tableLProductos" >
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Ciudad</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody
                                    v-for="(client, index) in filtrarlista"
                                    :key="index"
                                    class="clients"
                                >
                                    <tr>
                                        <td>{{ client.name }}</td>
                                        <td>{{ client.address }}</td>
                                        <td>{{ client.city }}</td>
                                        <td class="text-right">
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                                <button
                                                    type="button"
                                                    v-on:click="
                                                        selectItem(client)
                                                    "
                                                    class="btn btn-secondary"
                                                >
                                                    selecionar
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    data: function () {
        return {
            agregarCliente: false,
            editarCliente: false,
            buscador: "",
            clients: [],
            clientSelect: {id:"", name: "", address: "", city: "" },
            spin: false,
            myFormData: null,
        };
    },
    methods: {
        selectItem(item) {
            this.seleccionClient = true;
            this.agregarClient = false;
            let client = item;

            this.clientSelect = {
                id: client.id,
                name: client.name,
                address: client.address,
                city: client.city,
                number: client.number,
                email: client.email,
                country:client.country,
                state: client.state,
                rfc: client.rfc,
                contacts:client.contacts,
            };
            this.$emit("clientselect", this.clientSelect);
            /* this.contactType = this.contactSelect.type; */
        },
    },
    mounted() {},
    computed: {
        filtrarlista: function () {
         
            if (this.buscador.length > 0) {
                return this.clients.filter((item) =>
                    item.name
                        .toLowerCase()
                        .includes(this.buscador.toLowerCase())
                );
            } else {
                return this.clients;
            }
        },
    },
    created() {
          axios.get("/client").then((res) => {
            this.clients = res.data.data;

            console.log(JSON.stringify(this.clients));
            console.log("ok");
        }); 
    },
};
</script>
