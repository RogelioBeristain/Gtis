<template>
    <div class="productsKits">
        <div class="container-fluid">
            <div class="row">
                <div class="card text-center bg-light col-md-12">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a
                                    v-bind:class="
                                        'nav-link ' +
                                        (tapProductosActive == true
                                            ? 'active'
                                            : '')
                                    "
                                    v-on:click="showProducts"
                                    >Productos</a
                                >
                            </li>
                            <li class="nav-item">
                                <a
                                    v-bind:class="
                                        'nav-link ' +
                                        (tapProductosActive == false
                                            ? 'active'
                                            : '')
                                    "
                                    v-on:click="showKits"
                                    >Kits</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="productos" v-if="tapProductosActive">
                            <input
                                type="text"
                                name="client_name"
                                class="form-control col-xs-12 col-sm-6 col-md-6"
                                autocomplete="new-password"
                                placeholder="Busqueda por Modelo"
                                v-model="buscaProduct"
                            />

                            <div class="table-responsive tableLProductos">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th class="text-left">Modelo</th>
                                            <th>Descrición</th>
                                            <th>Precio</th>
                                            <th class="text-right">Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr
                                            v-for="(product,
                                            index) in filtrarProduct"
                                            :key="index"
                                        >
                                            <td class="text-left">
                                                {{ product.model }}
                                            </td>

                                            <td class="text-left">
                                                <div
                                                    v-html="product.description"
                                                    class="itemdescription"
                                                ></div>
                                            </td>
                                            <td>{{ product.price }}</td>
                                            <td class="text-right">
                                                <div
                                                    class="btn-group"
                                                    role="group"
                                                    aria-label="Basic example"
                                                >
                                                    <button
                                                        type="button"
                                                        v-on:click="
                                                            addProduct(product)
                                                        "
                                                        class="btn btn-secondary"
                                                    >
                                                        Agregar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="kits" v-if="!tapProductosActive">
                            <input
                                type="text"
                                name="client_name"
                                class="form-control col-xs-12 col-sm-6 col-md-6"
                                autocomplete="new-password"
                                placeholder="Busqueda por Titulo"
                                v-model="buscaKit"
                            />

                            <div class="table-responsive tableLProductos">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            <th class="text-left">Titulo</th>
                                            <th>Descrición</th>
                                            <th>Precio</th>

                                            <th class="text-right">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(kit, index) in filtrarKit"
                                            :key="index"
                                        >
                                            <td class="text-left">
                                                {{ kit.title }}
                                            </td>
                                            <td class="text-left">
                                                <div
                                                    v-html="kit.description"
                                                    class="itemdescription"
                                                ></div>
                                            </td>
                                            <td>{{ kit.price }}</td>
                                            <td class="text-right">
                                                <div
                                                    class="btn-group"
                                                    role="group"
                                                    aria-label="Basic example"
                                                >
                                                    <button
                                                        type="button"
                                                        v-on:click="addKit(kit)"
                                                        class="btn btn-secondary"
                                                    >
                                                        Agregar
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <br />
                    </div>
                </div>

                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">
                        Datos de cotizacion vista previa
                    </div>
                    <div class="card-body">
                        <div class="table-responsive tableLProductos">
                            <table class="table">
                                <thead class="text-primary">
                                    <tr>
                                        <th class="text-left">Lote</th>
                                        <th>Titulo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Costo envio</th>
                                        <th>Descuento</th>
                                        <th>Utilidad</th>
                                        <th>Precio unitario</th>
                                        <th>Importe Total</th>

                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(concepto, index) in conceptos"
                                        :key="index"
                                    >
                                        <td class="text-left">
                                            {{ index + 1 }}
                                        </td>
                                        <td>
                                            {{ concepto.label }}
                                        </td>

                                        <td>${{ concepto.price }}</td>

                                        <td>{{ concepto.cantidad }}</td>
                                        <td>${{ concepto.costo_envio }}</td>
                                        <td>-${{ concepto.descuento }}</td>
                                        <td>{{ concepto.utilidad }}%</td>
                                        <td>${{ concepto.precio_unitario }}</td>
                                        <td>${{ concepto.total }}</td>
                                        <td class="text-right">
                                            <div
                                                class="btn-group"
                                                role="group"
                                                aria-label="Basic example"
                                            >
                                                <button
                                                    type="button"
                                                    v-on:click="
                                                        modificarConcepto(
                                                            concepto, index+1
                                                        )
                                                    "
                                                    class="btn btn-secondary"
                                                >
                                                    Modificar variables
                                                </button>
                                                <button
                                                    type="button"
                                                    v-on:click="
                                                        eliminarConcepto(
                                                            concepto,
                                                            index
                                                        )
                                                    "
                                                    class="btn btn-secondary"
                                                >
                                                    x
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
                      <div class="card col-md-12 text-white text-center bg-dark mb-3 " v-if="conceptos.length>0">
                    
                    <div class="card-body ">
                        <div class="row">
                             <div class="col-md-4"> <strong>Subtotal</strong> {{subtotal}} </div>
                        <div class="col-md-4"> <strong>IVA</strong> {{iva}} </div>
                        <div class="col-md-4"> <strong>Total</strong> {{total}} </div>

                        </div>
                       

                    </div>
                </div>
              <!--  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                     <div class="form-group">
                    <button type="button" v-on:click="saveCotizacion" class="btn btn-primary">
                        Cotizacion lista
                    </button>
                     </div>
                </div> -->
              

                <div class="card col-md-12" v-if="concepto_edit.id">
                    <div class="card-header">
                       <strong> Modificando el lote [ {{concepto_edit.index}} ] titulo [ {{concepto_edit.label}} ] con precio de [ {{concepto_edit.price}} ]</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-data row">
                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Cantidad</strong>
                                    <input
                                        required
                                        type="number"
                                        name="concepto_cantidad"
                                        class="form-control dato-variable col-xs-12 col-sm-12 col-md-12"
                                        autocomplete="new-password"
                                        placeholder="Cantidad"
                                        v-on:keyup="calCantidad(concepto_edit)"
                                        v-model="concepto_edit.cantidad"
                                    />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Costo de envio</strong>
                                    <input
                                        required
                                        name="concepto_envio"
                                        class="form-control dato-variable col-xs-12 col-sm-12 col-md-12"
                                        autocomplete="new-password"
                                        placeholder="Envio"
                                        v-on:keyup="calEnvio(concepto_edit)"
                                        v-model="concepto_edit.costo_envio"
                                    />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Descuento</strong>
                                    <input
                                        required
                                        name="concepto_descuento"
                                        class="form-control dato-variable col-xs-12 col-sm-12 col-md-12"
                                        autocomplete="new-password"
                                        v-on:keyup="calDescuento(concepto_edit)"
                                        placeholder="Descuento"
                                        v-model="concepto_edit.descuento"
                                    />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Utilidad</strong>
                                    <input
                                        required
                                        name="concepto_utilidad"
                                        class="form-control dato-variable col-xs-12 col-sm-12 col-md-12"
                                        autocomplete="new-password"
                                        placeholder="Utilidad"
                                        v-on:keyup="calUtilidad(concepto_edit)"
                                        v-model="concepto_edit.utilidad"
                                    />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Precio unitario</strong>
                                    <input
                                        required
                                        name="concepto_unitario"
                                        class="form-control dato-variable col-xs-12 col-sm-12 col-md-12"
                                        autocomplete="new-password"
                                        placeholder="Unitario"
                                        v-on:keyup="calUnitario(concepto_edit)"
                                        v-model="concepto_edit.precio_unitario"
                                    />
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="form-group">
                                    <strong>Total</strong>
                                    <input
                                        required
                                        id="pruebaInput"
                                        name="concepto_total"
                                        class="form-control dato-variable col-xs-12 col-sm-12 col-md-12"
                                        autocomplete="new-password"
                                        v-on:keyup="calTotal(concepto_edit)"
                                        placeholder="Total"
                                        v-model="concepto_edit.total"
                                    />
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
            tapProductosActive: true,
            buscaKit: "",
            buscaProduct: "",
            product: {},
            kit: {},
            subtotal:"",
            iva:"",
            total:"",
            conceptos: [], // id ,label, price and type
         
            concepto_edit: {
                id: "",
                title: "",
                price: "",
                cantidad: "",
                costo_envio: "",
                descuento: "",
                utilidad: "",
                precio_unitario: "",
                total: "",
            },
            ops: {
                sumar: function sumarNumeros(n1, n2) {
                    return (
                        parseFloat(n1.replace(",", "")) +
                        parseFloat(n2.replace(",", ""))
                    );
                },

                restar: function restarNumeros(n1, n2) {
                    return (
                        parseFloat(n1.replace(",", "")) -
                        parseFloat(n2.replace(",", ""))
                    );
                },

                multiplicar: function multiplicarNumeros(n1, n2) {
                    return (
                        parseFloat(n1.replace(",", "")) *
                        parseFloat(n2.replace(",", ""))
                    );
                },

                dividir: function dividirNumeros(n1, n2) {
                    return (
                        parseFloat(n1.replace(",", "")) /
                        parseFloat(n2.replace(",", ""))
                    );
                },
                redondear: function redondearDigitos(n1,base){

                   return parseFloat((Math.round(parseFloat(n1.replace(",", "")) * 100) / 100).toFixed(base));
                }
                ,
            },
            products: [],
            kits: [],
        };
    },
    methods: {
        saveCotizacion(){
            console.log(this.conceptos);
            this.$emit('cotizacionConceptos',this.conceptos);
        },
        existConcepto: function (concepto) {
            let value = false;

            for (let index = 0; index < this.conceptos.length; index++) {
                if (
                    this.conceptos[index].id == concepto.id &&
                    this.conceptos[index].type == concepto.type
                ) {
                    value = true;
                }
            }

            return value;
        },
        calcularPrecioTotal: function (data) {
            this.isEmptyisZero(data);

            let precio_mas_envio = this.ops.sumar(
                "" + data.price,
                data.costo_envio
            );
         
            let precio_final = this.ops.multiplicar(
                "" + precio_mas_envio,
                "" + data.cantidad
            );
       
            let porcentaje = this.ops.dividir("" + data.utilidad, "" + 100);
     
            let porcentaje_utilidad = this.ops.multiplicar(
                "" + precio_final,
                "" + porcentaje
            );
         
            let precio_final_sin_descuento = this.ops.sumar(
                "" + precio_final,
                "" + porcentaje_utilidad
            );
          
            let precio_final_con_descuento = this.ops.restar(
                "" +
                    precio_final_sin_descuento,
                "" + data.descuento
            );
            data.total = this.ops.redondear(""+precio_final_con_descuento,2).toLocaleString();
          
            data.precio_unitario = this.ops
                .dividir("" + data.total, "" + data.cantidad)
                .toLocaleString();
           
            this.calcularTotales();
        },
        calcularUtilidadyUnitario: function (data) {
            this.isEmptyisZero(data);

            

            let precio_mas_envio = this.ops.sumar(
                "" + data.price,
                "" + data.costo_envio
            );
            let precio_final = this.ops.multiplicar(
                "" + precio_mas_envio,
                "" + data.cantidad
            );
            let precio_final_2 = this.ops.sumar(
                "" + data.total,
                "" + data.descuento
            );
            let diferencia_precios = this.ops.restar(
                "" + precio_final_2,
                "" + precio_final
            );
            let diferencia_porcentaje = this.ops.dividir(
                "" + diferencia_precios,
                "" + precio_final
            );
            let utilidad_porcentaje = this.ops.multiplicar(
                "" +
                    diferencia_porcentaje,
                "100"
            );
            data.utilidad = utilidad_porcentaje.toLocaleString();
            data.precio_unitario = this.ops
                .dividir("" + data.total, "" + data.cantidad)
                .toLocaleString();

            this.calcularTotales();
        },

         calcularUtilidadyTotal: function (data) {
            this.isEmptyisZero(data);

            let unitario_mul_cantidad=this.ops.multiplicar( ""+data.precio_unitario,""+data.cantidad);//total
            let precio_mas_envio=this.ops.sumar(""+data.price,""+data.costo_envio);//precio original
            let precio_final=this.ops.multiplicar(""+precio_mas_envio,""+data.cantidad);
            let precio_final_2=this.ops.sumar(""+unitario_mul_cantidad,""+data.descuento);
            let diferencia_precios=this.ops.restar(""+precio_final_2,""+precio_final);
            let diferencia_porcentaje=this.ops.dividir(""+diferencia_precios,""+precio_final);
            let utilidad_porcentaje= this.ops.multiplicar(""+diferencia_porcentaje,"100");
            data.utilidad=utilidad_porcentaje.toLocaleString();
            
            data.total=this.ops.redondear(""+unitario_mul_cantidad,2) .toLocaleString();
            this.calcularTotales();
        },
        calCantidad: function (data) {
            this.calcularPrecioTotal(data);
        },
        calEnvio: function (data) {
            this.calcularPrecioTotal(data);
        },
        calDescuento: function (data) {
            this.calcularPrecioTotal(data);
        },
        calUtilidad: function (data) {
            this.calcularPrecioTotal(data);
        },
        calUnitario: function (data) {
            this.calcularUtilidadyTotal(data);
        },
        calTotal: function (data) {
            this.calcularUtilidadyUnitario(data);
        },
        isEmptyisZero: function (data) {
            data.cantidad =
                data.cantidad.length == 0 ? "0" : "" + data.cantidad;
            data.costo_envio =
                data.costo_envio.length == 0 ? "0" : "" + data.costo_envio;
            data.utilidad =
                data.utilidad.length == 0 ? "0" : "" + data.utilidad;
            data.descuento =
                data.descuento.length == 0 ? "0" : "" + data.descuento;

            data.cantidad =
                data.cantidad.length > 1 && data.cantidad.charAt(0) == "0"
                    ? "" + data.cantidad.slice(1)
                    : "" + data.cantidad;
            data.costo_envio =
                data.costo_envio.length > 1 && data.costo_envio.charAt(0) == "0"
                    ? "" + data.costo_envio.slice(1)
                    : "" + data.costo_envio;
            data.utilidad =
                data.utilidad.length > 1 && data.utilidad.charAt(0) == "0"
                    ? "" + data.utilidad.slice(1)
                    : "" + data.utilidad;
            data.descuento =
                data.descuento.length > 1 && data.descuento.charAt(0) == "0"
                    ? "" + data.descuento.slice(1)
                    : "" + data.descuento;

            
        },

        calcularTotales:function (){
            var subtotal_aux=0;
            var total_aux=0;
            var iva_aux=0;
            
            this.conceptos.forEach(concepto => {
                subtotal_aux=this.ops.sumar(""+subtotal_aux,""+concepto.total);
            });

        iva_aux=this.ops.multiplicar(""+subtotal_aux,".16");
        iva_aux=this.ops.redondear(""+iva_aux,2);
        total_aux=this.ops.sumar(""+subtotal_aux,""+iva_aux);
        total_aux=this.ops.redondear(""+total_aux,2);
            this.total=total_aux.toLocaleString();
            this.iva=iva_aux.toLocaleString();
            subtotal_aux==this.ops.redondear(""+subtotal_aux,2);
            this.subtotal=subtotal_aux.toLocaleString();


        },

        addProduct: function (product) {
            this.product = product;
            product.type = "product";

            if (!this.existConcepto(product)) {
                this.conceptos.push({
                    id: product.id,
                    description:"",
                    label: product.model,
                    price: product.price,
                    cantidad: "1",
                    costo_envio: "0",
                    descuento: "0",
                    utilidad: "0",
                    precio_unitario: product.price,
                    total: product.price,
                    type: "product",
                });

                
                this.calcularTotales();
            }
        },
        addKit: function (kit) {
            this.kit = kit;
            kit.type = "kit";

            if (!this.existConcepto(kit)) {
                this.conceptos.push({
                    id: kit.id,
                    description:"",
                    label: kit.title,
                    price: kit.price,
                    cantidad: "1",
                    costo_envio: "0",
                    descuento: "0",
                    utilidad: "0",
                    precio_unitario: kit.price,
                    total: kit.price,
                    type: "kit",
                });
         

                 this.calcularTotales();
            }
        },
        modificarConcepto: function (concepto,index) {
            this.concepto_edit = concepto;
            this.concepto_edit.index=index;
            
        },
        eliminarConcepto: function (concepto, index) {
            this.conceptos.splice(index, 1);
         
        },

        selectProduct: function (product) {
            this.product = product;
        },
        selectKit: function (kit) {
            this.kit = kit;
        },
        showProducts: function () {
            //this.tapProductosActive=!this.tapProductosActive;
            this.tapProductosActive = true;
        },
        showKits: function () {
            //this.tapProductosActive=!this.tapProductosActive;
            this.tapProductosActive = false;
        },
    },
    computed: {
        filtrarProduct: function () {
            if (this.buscaProduct.length > 0) {
                return this.products.filter((item) =>
                    item.model
                        .toLowerCase()
                        .includes(this.buscaProduct.toLowerCase())
                );
            } else {
                return this.products;
            }
        },

        filtrarKit: function () {
            if (this.buscaKit.length > 0) {
                return this.kits.filter((item) =>
                    item.title
                        .toLowerCase()
                        .includes(this.buscaKit.toLowerCase())
                );
            } else {
                return this.kits;
            }
        },
    },
    mounted: function () {},
    created() {

        this.saveCotizacion();
        /*  var inputs=document.getElementsByClassName("dato-variable");
            var input_i=document.getElementById("pruebaInput");
             alert("Hola");
            for (let index = 0; index < inputs.length; index++) {
                console.log(typeof(inputs[index]));
                console.log(typeof(input_i));
                
            }
                
                
           
            console.log(inputs); */

        axios.get("/product").then((res) => {
            this.products = res.data.data;

            console.log(JSON.stringify(this.products));
            console.log("show porducts");
        });

        axios.get("/kit").then((res) => {
            this.kits = res.data.data;

            console.log(JSON.stringify(this.kits));
            console.log("show kits");
        });
    },
};
</script>

<style>
.tableLProductos {
    max-height: 200px;
}
.itemdescription {
    max-height: 90px;
    overflow: scroll;
}
@keyframes spinner-border {
  to { transform: rotate(360deg); }
}

.spinner-border {
  display: inline-block;
  width: 2rem;
  height: 2rem;
  vertical-align: text-bottom;
  border:.25em solid currentColor;
  border-right-color: transparent;

  border-radius: 50%;
  animation: spinner-border .75s linear infinite;
}

/* .spinner-border-sm {
  width: $spinner-width-sm;
  height: $spinner-height-sm;
  border-width: $spinner-border-width-sm;
}
 */

@keyframes spinner-grow {
  0% {
    transform: scale(0);
  }
  50% {
    opacity: 1;
    transform: none;
  }
}

/* .spinner-grow {
  display: inline-block;
  width: $spinner-width;
  height: $spinner-height;
  vertical-align: text-bottom;
  background-color: currentColor;
  // stylelint-disable-next-line property-blacklist
  border-radius: 50%;
  opacity: 0;
  animation: spinner-grow .75s linear infinite;
} */

/* .spinner-grow-sm {
  width: $spinner-width-sm;
  height: $spinner-height-sm;
} */

</style>
