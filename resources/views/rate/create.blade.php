@extends('layouts.app', [
'class' => '',
'elementActive' => 'rate'
])
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.6.0/math.min.js"></script>

<script>
    var arrayProductosSelecionados = [];//
    var arrayKitsSelecionados = [];//
    var arrayConceptosSelecionados = [];//
    var objProductoAux = [];//
</script>

<div class="content">
    <div class="container">
    
    
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    
        <div class="row justify-content-center">
    
            <div class="modal fade" id="modalDescription" tabindex="-1" role="dialog">
                <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Descripción del producto</h5>
                            <button type="button" class="close" data-dismiss="modal">
    
                            </button>
                        </div>
                        <div id="modalBody" class="modal-body">
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    
                        </div>
                    </div>
                </div>
            </div>
    
    
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Nueva Cotización
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rate.store') }}" id="datosForm" target="print_popup"
                            onsubmit="window.open('about:blank','print_popup','width=1000,height=800');" method="POST">
    
    
    
                            @csrf
                            <input type="hidden" id="clientId" name="clientId">
    
                            <input type="hidden" id="inputTotal" name="total">
                            <input type="hidden" name="conceptos" id="conceptos" required>
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Cliente:</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="name" id="selectClient" required
                                        onchange="setClient(event)">
                                        <option value="" selected disabled hidden>Selecciona un cliente</option>
    
                                        @foreach($clients as $client)
    
                                        <option value="{{$client->id}}">{{$client->name}} -{{$client->rfc}} </option>
    
                                        @endforeach
                                    </select>
                                </div>
    
                            </div>
    
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Vigencia:</label>
                                <div class="col-md-6">
                                    <input type="date" required name="validation" class="form-control"
                                        autocomplete="new-password">
    
                                </div>
    
                            </div>
                            <div class="form-group row">
    
                                <datalist id="condiciones">
                                    <option value="donde indique el cliente"></option>
                                    <option value="la existencia puede variar según el tiempo de compra"></option>
    
                                </datalist>
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Condiciones de
                                    Entrega:</label>
                                <div class="col-md-6">
                                    <input type="text" list="condiciones" required name="place_delivery"
                                        class="form-control" autocomplete="new-password">
    
                                </div>
    
                            </div>
                            <div class="form-group row">
                                <datalist id="plazo">
    
                                    <option value="la existencia puede variar según el tiempo de compra"></option>
    
                                </datalist>
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Plazo de Entrega:</label>
                                <div class="col-md-6">
                                    <input type="text" list="plazo" required name="time_delivery" class="form-control"
                                        autocomplete="new-password">
    
                                </div>
    
                            </div>
    
                            <div class="form-group row">
                                <datalist id="garantia">
                                    <option value="La que el fabricante indique"></option>
    
    
                                </datalist>
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Garantia:</label>
                                <div class="col-md-6">
                                    <input type="text" list="garantia" required name="guarantee" class="form-control"
                                        autocomplete="new-password">
    
                                </div>
    
                            </div>
    
                            <div class="form-group row">
                                <datalist id="modo">
                                    <option value="de contado"></option>
                                    <option value="contraentrega"></option>
                                    <option value="credito 20 dias naturales"></option>
                                    <option value="a partir de la entrada del producto"></option>
    
    
                                </datalist>
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Condiciones de
                                    Pago:</label>
                                <div class="col-md-6">
                                    <input type="text" list="modo" required name="pay_mode" class="form-control"
                                        autocomplete="new-password">
    
                                </div>
    
                            </div>
    
                            <div class="form-group row">
                                <datalist id="divisa">
                                    <option value="pesos mexicanos, ya incluye IVA"></option>
                                    <option value="dolares estadounidenses, ya incluye IVA"></option>
    
    
                                </datalist>
                                <label for="name" class="col-md-4 col-form-label text-md-right"> Divisa:</label>
                                <div class="col-md-6">
                                    <input type="text" list="divisa" required name="type_currency" class="form-control"
                                        autocomplete="new-password">
    
                                </div>
    
                            </div>
    
    
    
    
    
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
    
                                    <button type="button" class="nav-link btn btn-primary  my-2 my-sm-0" data-toggle="modal"
                                        data-target="#productsModal">
                                        Agregar Productos
                                    </button>
                                </li>
    
                                <li class="nav-item">
                                    <button type="button" class="nav-link btn btn-primary  my-2 my-sm-0" data-toggle="modal"
                                        data-target="#kitsModal">
                                        Agregar Kits de Productos
                                    </button>
                                </li>
    
                            </ul>
    
                            <div class="form-group  row">
                                <label class="col-md-4 col-form-label text-md-right" for="checkFill">Cotización
                                    Valida:</label>
    
                                <div class="col-md-6">
                                    <input type="checkbox" onclick="return false;" required class="form-check-input"
                                        id="checkFill">
    
    
                                </div>
                            </div>
    
    
                            <br>
    
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
    
                                    <button type="submit" id="btnenviar" onclick="enviar()" class="btn btn-primary ">Guardar
                                        Cotización</button>
    
    
                                </li>
    
                                <li class="nav-item">
                                    <button type="submit" onclick="vistaPrevia()" class="btn btn-primary  ">Vista
                                        Previa</button>
    
                                </li>
    
                            </ul>
    
    
    
                            <br>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
    
                                </div>
                            </div>
    
                    </div>
    
                    </form>
    
                </div>
    
            </div>
    
        </div>
    
    
        <div class="row justify-content-center">
    
    
    
            <div class="col-xs-10 col-sm-10 col-md-10">
                <div class="form-group">
    
    
                </div>
            </div>
    
    
    
    
            <div class="col-xs-12 col-sm-12 col-md-12">
    
                <table id="tableProductos"
                    class="table table-responsive table-borderless table-striped  table-sm  table-hover table-bordered table-striped ">
    
                    <thead>
                        <tr>
                            <th scope="col">Lote</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Precio de inventario</th>
                            <th scope="col">Utilidad</th>
                            <th scope="col">Costo de envío</th>
                            <th scope="col">Descuento</th>
                            <th scope="col">Precio unitario</th>
                            <th scope="col">Importe Total</th>
    
                        </tr>
    
                    </thead>
    
                    <tbody>
    
                    </tbody>
    
    
    
    
    
    
                </table>
    
    
    
    
    
    
    
            </div>
    
    
    
    
    
    
        </div>
    
    
    
        <div class="row justify-content-center">
    
            <div class="col-lg-8 margin-tb">
                <div class="float-left">
    
                </div>
                <div class="float-right">
                    <h6 id="subtotal"> SUB TOTAL: </h6>
    
                    <h6 id="iva"> IVA: </h6>
    
                    <h6 id="totalCotizacion"> TOTAL: </h6>
                </div>
            </div>
    
    
    
    
        </div>
    
    
    
    
        <!-- Modal -->
        <div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-scrollable  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=" ">Lista de Productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
    
    
    
                        <list-component :data="{{$products}}">
    
    
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="addProductos()"> Finalizar</button>
                    </div>
                </div>
            </div>
        </div>
    
    
    
        <!-- Modal -->
        <div class="modal fade" id="kitsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-scrollable  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=" ">Lista de Kits</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
    
                        <listkits-component :data="{{$kits}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="addKits()"> Finalizar</button>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
   
</div>






<script>

    function setClient(event) {

        var ok = document.getElementById("selectClient").value;

        document.getElementById('clientId').value = ok;


    }

    function verDescription(id) {



        var xhr = new XMLHttpRequest();
        // Setup our listener to process completed requests

        xhr.onload = function () {


            // Process our return data
            if (xhr.status >= 200 && xhr.status < 300) {
                // What do when the request is successful
                console.log('success!', xhr.response);


                let dataProducts = JSON.parse(xhr.response);
                console.log(dataProducts);
                $('#productsModal').modal('hide');
                $('#kitsModal').modal('hide');
                $('#modalDescription').modal('toggle');

                let des = document.getElementById('modalBody').innerHTML = dataProducts.description;



            } else {
                // What do when the request fails
                console.log('The request failed!');
                //  console.log('success!', xhr.response);
            }

            // Code that should run regardless of the request status
            console.log('This always runs...');
        };


        xhr.open('GET', '/product/' + id);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();



    }


    function verDescriptionk(id) {



        var xhr = new XMLHttpRequest();
        // Setup our listener to process completed requests

        xhr.onload = function () {


            // Process our return data
            if (xhr.status >= 200 && xhr.status < 300) {
                // What do when the request is successful
                console.log('success!', xhr.response);


                let dataProducts = JSON.parse(xhr.response);
                console.log(dataProducts);
                $('#exampleModal').modal('hide');

                $('#modalDescription').modal('toggle');

                let des = document.getElementById('modalBody').innerHTML = dataProducts.description;



            } else {
                // What do when the request fails
                console.log('The request failed!');
                //  console.log('success!', xhr.response);
            }

            // Code that should run regardless of the request status
            console.log('This always runs...');
        };


        xhr.open('GET', '/kit/' + id);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();



    }



    function calcularPrecio(id, price, type) {

        var cantidad = document.getElementById('cantidad' + type + id).value;
        var utilidad = document.getElementById('utilidad' + type + id).value;
        var envio = document.getElementById('envio' + type + id).value;
        var descuento = document.getElementById('descuento' + type + id).value;
        var total = document.getElementById('total' + type + id).value;
        var preciounitario = document.getElementById('precioU' + type + id).value;

        total = math.sum(price, envio);
        total = math.multiply(cantidad, total);

        var porcentaje = math.divide(utilidad, 100);

        total = math.sum(math.multiply(total, porcentaje), total);

        total = math.subtract(total, descuento);

        document.getElementById('total' + type + id).value = total;

        var preciounitario = document.getElementById('precioU' + type + id).value = math.divide(total, cantidad);

        arrayConceptosSelecionados.forEach(element => {
            if (element.id == id) {
                console.log(total);
                element.total = total;
                element.cantidad = cantidad;
                element.discount = descuento;
                element.utility = utilidad;
                element.shipping = envio;
                element.unitario = preciounitario;
            }

        });
        calcularTotales();


    }

    function calcularUtilidad(id, price, type) {

        var cantidad = document.getElementById('cantidad' + type + id).value;
        var utilidad = document.getElementById('utilidad' + type + id).value;
        var envio = document.getElementById('envio' + type + id).value;
        var descuento = document.getElementById('descuento' + type + id).value;
        var total = document.getElementById('total' + type + id).value;
        var preciounitario = document.getElementById('precioU' + type + id).value;
        
        utilidad = math.sum(price, envio);
        utilidad = math.multiply(utilidad, cantidad);
        //utilidad= math.subtract(utilidad,descuento);
        total = math.sum(total, descuento);
        var dif = math.subtract(total, utilidad);

        utilidad = math.divide(dif, utilidad);
        utilidad = math.multiply(utilidad, 100);
        var preciounitario = document.getElementById('precioU' + type + id).value = math.divide(total, cantidad);

        document.getElementById('utilidad' + type + id).value = utilidad;
        arrayConceptosSelecionados.forEach(element => {
            if (element.id == id) {
                console.log(total);
                element.total = total;
                element.cantidad = cantidad;
            }

        });
        calcularTotales();


    }
    function calcularUtilidad2(id, price, type) {

        var cantidad = document.getElementById('cantidad' + type + id).value;
        var utilidad = document.getElementById('utilidad' + type + id).value;
        var envio = document.getElementById('envio' + type + id).value;
        var descuento = document.getElementById('descuento' + type + id).value;
        var total = document.getElementById('total' + type + id).value;

        var preciounitario = document.getElementById('precioU' + type + id).value;
        var total = preciounitario * cantidad;
        document.getElementById('total' + type + id).value = total;
        utilidad = math.sum(price, envio);
        utilidad = math.multiply(utilidad, cantidad);
        //utilidad= math.subtract(utilidad,descuento);
        total = math.sum(total, descuento);
        var dif = math.subtract(total, utilidad);

        utilidad = math.divide(dif, utilidad);
        utilidad = math.multiply(utilidad, 100);


        document.getElementById('utilidad' + type + id).value = utilidad;
        arrayConceptosSelecionados.forEach(element => {
            if (element.id == id) {
                console.log(total);
                element.total = total;
                element.cantidad = cantidad;
            }

        });
        calcularTotales();


    }

    function addConceptos() {
        $('#productsModal').modal('hide');
        let tableRef = document.getElementById('tableProductos');

        for (var i = tableRef.rows.length - 1; i > 0; i--) {
            tableRef.deleteRow(i);
        }
        arrayProductosSelecionados.forEach(function (element, index) {
            addRow('tableProductos', element, index);
        });

        arrayKitsSelecionados.forEach(function (element, index) {
            addRow('tableProductos', element, index);
        });




    }
    function addProductos() {

        $('#productsModal').modal('hide');


        let tableRef = document.getElementById('tableProductos');

        for (var i = tableRef.rows.length - 1; i > 0; i--) {
            tableRef.deleteRow(i);

        }
        arrayProductosSelecionados.forEach(function (element, index) {

            addRow('tableProductos', element, index);
        });


        arrayKitsSelecionados.forEach(function (element, index) {
            addRow('tableProductos', element, index);
        });


    }



    function addKits() {

        $('#kitsModal').modal('hide');
        let tableRef = document.getElementById('tableProductos');

        for (var i = tableRef.rows.length - 1; i > 0; i--) {
            tableRef.deleteRow(i);

        }

        arrayProductosSelecionados.forEach(function (element, index) {
            addRow('tableProductos', element, index);
        });
        arrayKitsSelecionados.forEach(function (element, index) {

            addRow('tableProductos', element, index);
        });


    }

    function addRow(tableID, d, index) {
        let tableRef = document.getElementById(tableID).getElementsByTagName('tbody')[0];
        //  let header = tableRef.createTHead();




        /*  <thead>
               <tr>
                    <th scope="col" >Lote</th>
                    <th scope="col"  class="bg-warning">Cantidad</th>
                    <th scope="col" >Descripción</th>
                    <th scope="col" >Precio de inventario</th>
                    <th scope="col"  class="bg-warning">Utilidad</th>
                    <th scope="col"  class="bg-warning">Costo de envío</th>
                    <th scope="col"  class="bg-warning">Descuento</th>
                    <th scope="col" >Precio unitario</th>
                    <th scope="col"  class="bg-success">Importe Total</th>
    
                </tr>

                </thead>
            */
        /*
        Lote
        Cantidad
        Descripción
        Utilidad
        Precio de inventario
        Costo de envío
        Descuento
        Precio Unitario
        Importe Total

        */
        let newRow = tableRef.insertRow(-1);

        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);
        let cell6 = newRow.insertCell(5);
        let cell7 = newRow.insertCell(6);
        let cell8 = newRow.insertCell(7);
        let cell9 = newRow.insertCell(8);
        cell1.scope = "row";


        cell1.setAttribute("data-label", "Lote");

        cell2.setAttribute("data-label", "Cantidad");

        cell3.setAttribute("data-label", "Descripción");

        cell5.setAttribute("data-label", "Utilidad");

        cell4.setAttribute("data-label", "Precio de inventario");

        cell6.setAttribute("data-label", "Costo de envío");

        cell7.setAttribute("data-label", "Descuento");

        cell8.setAttribute("data-label", "Precio unitario");

        cell9.setAttribute("data-label", "Importe Total");

        //document.getElementById();


        var unutariovalue = 0;
        cell1.innerHTML = math.sum(index, 1);
        cell2.innerHTML = '<input min="1" onfocus="marcarInput(event)" required class="form-control" value="' + d.cantidad + '" id="cantidad' + d.type + d.id + '" onkeyup="calcularPrecio(' + d.id + ',' + d.price + ',\'' + d.type + '\')" type="number" autocomplete="new-password" placeholder="Cantidad">';

        if (d.type == "product") {
            cell3.innerHTML = ' <button type=\"button\" onclick=\"verDescription(' + d.id + ')\" class=\"btn btn-secondary btn-sm\"> ver descripci\u00F3n<\/button>';

        } else {
            cell3.innerHTML = ' <button type=\"button\" onclick=\"verDescriptionk(' + d.id + ')\" class=\"btn btn-secondary btn-sm\"> ver descripci\u00F3n<\/button>';
        }
        cell4.innerHTML = d.price;
        cell5.innerHTML = '<input min="0"  onfocus="marcarInput(event)" required class="form-control" value="' + d.utility + '"  id="utilidad' + d.type + d.id + '"       onkeyup="calcularPrecio(' + d.id + ',' + d.price + ',\'' + d.type + '\')" type="number" autocomplete="new-password" placeholder="Utilidad">';
        cell6.innerHTML = '<input min="0" onfocus="marcarInput(event)" required  class="form-control" value="' + d.shipping + '"         id="envio' + d.type + d.id + '"       onkeyup="calcularPrecio(' + d.id + ',' + d.price + ',\'' + d.type + '\')" type="number" autocomplete="new-password" placeholder="Costo de envio">';
        cell7.innerHTML = '<input min="0"  onfocus="marcarInput(event)"class="form-control" value="' + d.discount + '"id="descuento' + d.type + d.id + '"       onkeyup="calcularPrecio(' + d.id + ',' + d.price + ',\'' + d.type + '\')" type="number" autocomplete="new-password" placeholder="Descuento">';
        cell8.innerHTML = '<input  min="1" onfocus="marcarInput(event)" class="form-control" value="' + unutariovalue + '"id="precioU' + d.type + d.id + '"onkeyup="calcularUtilidad2(' + d.id + ',' + d.price + ',\'' + d.type + '\')" type="number" autocomplete="new-password" placeholder="Precio unitario">';
        cell9.innerHTML = '<input  min="1"  onfocus="marcarInput(event)"class="form-control" value="' + d.total + '"     id="total' + d.type + d.id + '"       onkeyup="calcularUtilidad(' + d.id + ',' + d.price + ',\'' + d.type + '\')"  type="number" autocomplete="new-password" placeholder="Total">';


    }
    function marcarInput(e) {
        console.log('The time is: ' + e.target.id);
        document.getElementById(e.target.id).select();

    }

    function addProducto(id, producto, price) {


        objProductoAux = { 'id': producto, 'unitario': 0, 'total': 0, 'price': price, 'type': 'product', 'cantidad': 0, 'discount': 0, 'utility': 0, 'shipping': 0 };


        var p = document.getElementById(id);
        if (p.checked) {

            arrayProductosSelecionados.push(objProductoAux);
            arrayConceptosSelecionados.push(objProductoAux);

        } else {

            removeElementJ(arrayProductosSelecionados, objProductoAux);
            removeElementJ(arrayConceptosSelecionados, objProductoAux);
        }
        calcularTotales();
        //var conceptos= document.getElementById('conceptos').innerHTML="<input type='hidden'  name='conceptos' value='"+JSON.stringify(arrayConceptosSelecionados)+ "'>";



    }


    function addKit(id, producto, description, price) {


        objProductoAux = { 'id': producto, 'unitario': 0, 'total': 0, 'description': description, 'price': price, 'type': 'kit', 'cantidad': 0, 'discount': 0, 'utility': 0, 'shipping': 0 };


        var p = document.getElementById(id);
        if (p.checked) {

            arrayKitsSelecionados.push(objProductoAux);
            arrayConceptosSelecionados.push(objProductoAux);

        } else {

            removeElementJ(arrayKitsSelecionados, objProductoAux);
            removeElementJ(arrayConceptosSelecionados, objProductoAux);
        }
        calcularTotales();

    }

    function removeElement(array, elem) {
        var index = array.indexOf(elem);
        if (index > -1) {
            array.splice(index, 1);
        }
    }

    function removeElementJ(array, elem) {
        var dato = 0;
        var val = 0;


        array.forEach(element => {
            if (element.id == elem.id) {
                console.log(element.id);
                val = dato;
            }
            dato++;
        });


        var index = val;

        if (index > -1) {
            array.splice(index, 1);
        }
    }

    function currencyFormat(num) {
        return '$' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
    function enviar() {

        var dato = document.getElementById("conceptos").value;
        // alert(dato);
        if (dato != '') {
            // document.getElementById("datosForm").submit();
        } else {


            $('#btnenviar').popover({
                container: 'body',
                content: '<span style=\"color: #ffa300;\"> <i class="fas fa-exclamation-triangle"></i> </span>La Cotización esta vacia',
                html: true,
                placement: "left"
            })


            $('#btnenviar').popover('show');
            setTimeout(() => { $('#btnenviar').popover('hide'); }, 5000);


        }
        document.getElementById('datosForm').action = "{{route('rate.store')}}";
       // alert("guardar datos :D")


    }

    function vistaPrevia() {

        var dato = document.getElementById("conceptos").value;
        // alert(dato);
        if (dato != '') {
            // document.getElementById("datosForm").submit();
        } else {


            $('#btnenviar').popover({
                container: 'body',
                content: '<span style=\"color: #ffa300;\"> <i class="fas fa-exclamation-triangle"></i> </span>La Cotización esta vacia',
                html: true,
                placement: "left"
            })
            $('#btnenviar').popover('show');
            setTimeout(() => { $('#btnenviar').popover('hide'); }, 5000);


        }
        document.getElementById('datosForm').action = "{{route('rate.verPDF')}}";
        alert("vista previa :D")
    }

    window.addEventListener("load", function () {


        // Access the form element...
        let form = document.getElementById("datosForm");

        // ...and take over its submit event.
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            //alert("OK");
            console.log(event);

            form.submit();

        });
    });

    function calcularTotales() {


        var subtotal = 0;
        var iva = 0;

        var totalC = 0;
        arrayConceptosSelecionados.forEach(element => {
            subtotal = math.sum(subtotal, element.total);
        });
        iva = math.multiply(subtotal, 0.16);
        totalC = math.sum(subtotal, iva);



        document.getElementById('subtotal').innerHTML = 'SUB TOTAL: ' + currencyFormat(subtotal);
        document.getElementById('iva').innerHTML = 'IVA: ' + currencyFormat(iva);
        document.getElementById('totalCotizacion').innerHTML = 'TOTAL: ' + currencyFormat(totalC);

        document.getElementById('inputTotal').value = totalC;
        var conceptos = document.getElementById('conceptos').value = JSON.stringify(arrayConceptosSelecionados);
        if (arrayConceptosSelecionados.length == 0) {
            document.getElementById('conceptos').value = "";
        }
        isCheck();


    }

    function isCheck() {
        var valido = false;

        var cantidades = 0;
        var discounts = 0;
        var utilitys = 0;
        var shippings = 0;
        var totals = 0;

        /*
            total: 0
            description: "x"
            price: "120.00"
            type: "product"
            cantidad: ""
            discount: "0"
            utility: "0"
            shipping: "0"
        */
        arrayConceptosSelecionados.forEach(element => {
            if (element.cantidad > 0) {
                cantidades++;
            }
            if (element.discount >= 0) {
                discounts++;
            }

            if (element.utility >= 0) {
                utilitys++;
            }
            if (element.shipping >= 0) {
                shippings++;
            }
            if (element.total > 1) {
                totals++;
            }
        });


        if (cantidades == arrayConceptosSelecionados.length
            && discounts == arrayConceptosSelecionados.length
            && utilitys == arrayConceptosSelecionados.length
            && shippings == arrayConceptosSelecionados.length
            && totals == arrayConceptosSelecionados.length) {
            valido = true;
        }


        // alert( arrayConceptosSelecionados.length+"::,"+valido);

        if (arrayConceptosSelecionados.length == 0) {
            conceptos = document.getElementById('conceptos').value = "";
            document.getElementById('checkFill').checked = false;
        } else {
        }
        if (valido) {
            document.getElementById('checkFill').checked = true;
        } else {
            document.getElementById('checkFill').checked = false;
        }
    }


</script>


<style>
    body {}

    table {}

    table caption {}

    table tr {}

    table th,
    table td {}

    table th {}

    table td img {
        text-align: center;
    }

    @media screen and (max-width: 768px) {

        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            display: none;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td:before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }
</style>
@endsection