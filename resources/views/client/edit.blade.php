@extends('layouts.app', [
'class' => '',
'elementActive' => 'client'
])
@section('content')
<script>

    var arrayContacts = [];
    var auxContact = [];
    var auxNumber = [];
    var auxEmail = [];

    var indexContact = {{$contacts->count()}};
    var indexEmail = {{$emailscount}};
    var indexNumber ={{$numberscount}};

</script>


<div class="content">
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
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> Editar Cliente</div>
    
                <div class="card-body">
    
                    <form action="{{ route('client.update',$client->id) }}" method="POST" id="datos">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="contactosJson" name="contacts">
    
    
                        <div class="row">
    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nombre del Cliente:</strong>
                                    <input type="text" name="nameC" class="form-control" autocomplete="new-password"
                                        placeholder="Nombre del Cliente" value="{{$client->name}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Dirección:</strong>
                                    <input type="text" name="address" class="form-control" autocomplete="new-password"
                                        placeholder="Dirección" value="{{$client->address}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Pais:</strong>
                                    <input type="text" name="country" class="form-control" autocomplete="new-password"
                                        placeholder="Pais" value="{{$client->country}}">
                                </div>
                            </div>
    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Estado:</strong>
                                    <input type="text" name="state" class="form-control" autocomplete="new-password"
                                        placeholder="Estado" value="{{$client->state}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ciudad:</strong>
                                    <input type="text" name="city" class="form-control" autocomplete="new-password"
                                        placeholder="Ciudad" value="{{$client->city}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Numero de contacto:</strong>
                                    <input type="text" name="number" class="form-control" autocomplete="new-password"
                                        placeholder="Numero de contacto" value="{{$client->number}}">
                                </div>
                            </div>
    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Persona Fisica o Moral</strong>
                                    <div class="form-check">
    
                                        @if (strlen($client->rfc)==13 )
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            onclick="changeRFC(1)" id="exampleRadios1" value="option1" checked>
                                        @else
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            onclick="changeRFC(1)" id="exampleRadios1" value="option1">
    
                                        @endif
    
                                        <label class="form-check-label" for="exampleRadios1">
                                            Persona Fisica
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        @if (strlen($client->rfc)==12 )
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            onclick="changeRFC(0)" id="exampleRadios2" value="option2" checked>
                                        @else
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            onclick="changeRFC(0)" id="exampleRadios2" value="option2">
    
                                        @endif
    
                                        <label class="form-check-label" for="exampleRadios2">
                                            Persona Moral
                                        </label>
                                    </div>
    
    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>RFC:</strong>
                                    <input required type="text" id="inputRFC" value="{{$client->rfc}}" minlength="13"
                                        maxlength="13" name="rfc" class="form-control" autocomplete="new-password"
                                        placeholder="XXXXddmmaa###">
                                    <a href="https://agsc.siat.sat.gob.mx/PTSC/ValidaRFC/" target="_blank"> Verifica aquí si
                                        el RFC es valido en el SAT</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Correo electrónico:</strong>
                                    <input type="text" name="email" class="form-control" autocomplete="new-password"
                                        placeholder="Correo electrónico" value="{{$client->email}}">
                                </div>
                            </div>
    
                        </div>
    
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
    
                                        <button type="button" onclick="addContact()"
                                            class="nav-link btn btn-primary my-2 my-sm-0">
                                            Agregar Contacto
                                        </button>
                                    </li>
    
                                </ul>
                            </div>
                        </div>
    
    
                        @foreach ($contacts as $contact)
    
    
                        <div id="{{$loop->index+1}}" class=" contact{{$loop->index+1}} col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <hr>
                            <div class="form-row ">
                                <div class="col form-group">
                                    <strong>Nombre del Contacto {{$loop->index+1}}:</strong>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="text" id="inputC{{$loop->index+1}}" name="name" value="{{$contact->name}}"
                                        class="form-control contactosInputs " placeholder="Nombre del Contacto 1:">
                                </div>
                                <div class="col-2 form-group">
                                    <button type="button" onclick="deleteContact('contact{{$loop->index+1}}')"
                                        class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
                                        <button type="button" onclick="addNumber({{$loop->index+1}})"
                                            class="nav-link btn btn-primary btn-outline-info my-2 my-sm-0">
                                            Agregar Numero de Contacto
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" onclick="addEmail({{$loop->index+1}})"
                                            class="nav-link btn btn-primary btn-outline-info my-2 my-sm-0">
                                            Agregar Email de Contacto
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @foreach ($contact->clientphonenumbers as $number)
    
                        <div id="tel{{$loop->index+1}}"
                            class="contact{{$loop->parent->iteration}} col-xs-12 col-sm-12 col-md-12">
                            <hr>
                            <div class="form-row ">
                                <div class="col form-group">
                                    <strong>Numero telefonico {{$contact->name}}:</strong>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="tel" name="number{{$loop->parent->iteration}}" value="{{$number->number}}"
                                        class="form-control contactosInputs " placeholder="Numero telefonico:">
                                </div>
                                <div class="col-2 form-group">
                                    <button type="button" onclick="deleteNumber('tel{{$loop->index+1}}')"
                                        class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
    
                        @foreach ($contact->clientemails as $email)
                        <div id="email{{$loop->index+1}}"
                            class="contact{{$loop->parent->iteration}} col-xs-12 col-sm-12 col-md-12">
                            <div class="form-row ">
                                <div class="col form-group">
                                    <strong>Correo electronico de {{$contact->name}}:</strong>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="email" name="email{{$loop->parent->iteration}}" value="{{$email->email}}"
                                        class="form-control contactosInputs " placeholder="Numero telefonico">
                                </div>
                                <div class="col-2 form-group">
                                    <button type="button" onclick="deleteEmail('email{{$loop->index+1}}')"
                                        class="btn btn-danger">
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
    
    
                        @endforeach
    
    
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" id="contactos">
                            <button type="button" onclick="guardar()" class="btn btn-primary">Guardar Cliente</button>
                        </div>
                </div>
    
                </form>
    
    
    
            </div>
        </div>
    </div>
    </div>
</div>

<script>

    var dataContacts = "";

    var xhr = new XMLHttpRequest();

    // Setup our listener to process completed requests
    xhr.onload = function () {

        // Process our return data
        if (xhr.status >= 200 && xhr.status < 300) {
            // What do when the request is successful
            console.log('success!', xhr);
            dataContacts = JSON.parse(xhr.response);
            console.log(dataContacts);
            /* dataProducts.forEach(element => {
                 pp.push(element);
                 console.log(element.id);
                 var p= document.getElementById('product'+element.id);
                 p.checked=true;
                 
             });
             */
            //addProductos();

        } else {
            // What do when the request fails
            console.log('The request failed!');
        }

        // Code that should run regardless of the request status
        console.log('This always runs...');
    };


    xhr.open('GET', '{{ route('client.editJson',$client->id) }}');
    xhr.send();


    function guardar() {

        var inputsC = document.querySelectorAll('.contactosInputs')
        inputsC.forEach(element => {
            auxContact = { 'id': '', 'name': '', 'emails': [], 'numbers': [] };

            console.log(element.value + "Contacto" + element.name);
            if (element.name == 'name') {
                // console.log(element.value)
                auxContact.name = element.value;

                console.log(auxContact.name);
                arrayContacts.push(auxContact);
            }

        }); // se puede optimizar codigo




        inputsC.forEach(input => {
            auxEmail = { 'id': '', 'name': '', 'email': '' };
            auxNumber = { 'id': '', 'name': '', 'number': [] };



            arrayContacts.forEach(function (element, index) {
                if (input.name == 'email' + (index + 1)) {
                    auxEmail.name = "";
                    auxEmail.email = input.value;
                    arrayContacts[index].emails.push(auxEmail);

                }
                if (input.name == 'number' + (index + 1)) {
                    auxNumber.name = "";
                    auxNumber.number = input.value;

                    arrayContacts[index].numbers.push(auxNumber);

                }

            }

            );


        });


        var contactosJ = JSON.stringify(arrayContacts);

        console.log(contactosJ);
        document.getElementById('contactosJson').value = contactosJ;
        document.getElementById("datos").submit();

    }

    /****@description
        
        crea los input necesarios para agregar un contacto
    **/
    function buscarContact(id_c) {

        var contactoB=document.getElementById('inputC'+id_c);
       
        if(contactoB!=null){
            return contactoB.value;
        }

        return "";


        
    }
    function makeInputs(clase, id_c) {

        var label = "";
        var name = "";
        var id = "";
        var type = "";
        var evento = "";
        var classContact = "";

        var contactoValue=buscarContact(id_c);//Document.getElementById(id_c).value;

        if (id_c != null) {
            var classContact = "contact" + id_c;

        } else {
            var classContact = "contact" + indexContact;

        }


        var botones = "<div class=\"form-group\">\r\n<ul class=\"nav justify-content-center\">\r\n<li class=\"nav-item\">\r\n\r\n<button type=\"button\" onclick=\"addNumber(" + indexContact + ")\" class=\"nav-link btn btn-primary btn-outline-info my-2 my-sm-0\">\r\nAgregar Numero de Contacto\r\n<\/button>\r\n<\/li>\r\n\r\n<li class=\"nav-item\">\r\n\r\n<button type=\"button\" onclick=\"addEmail(" + indexContact + ")\" class=\"nav-link btn btn-primary btn-outline-info my-2 my-sm-0\">\r\nAgregar Email de Contacto\r\n<\/button>\r\n<\/li>\r\n\r\n <\/ul>\r\n <\/div>\r\n  <\/div>";
        if (clase == "contacto") {
            label = "Nombre del Contacto " + indexContact + ":";
            name = "name";
            
            id = indexContact;
            contactoValue=buscarContact(id);;
            type = "text";
            evento = "deleteContact('" + classContact + "')";

        }

        if (clase == "tel") {
            contactoValue=buscarContact(id_c);;
            label = "Numero telefonico de  " + contactoValue + ":";
            name = "number" + id_c;
            id = clase + indexNumber;
            type = "tel";
            botones = "";
            evento = "deleteNumber('" + id + "')";

        }


        if (clase == "email") {
            contactoValue=buscarContact(id_c);;
            label = "Correo electronico de  " + contactoValue + ":";
            name = "email" + id_c;
            id = clase + indexEmail;
            type = "email";
            botones = "";
            evento = "deleteEmail('" + id + "')";

        }

        var aux = "<div id=\"" + id + "\" class=\" " + classContact + " col-xs-12 col-sm-12 col-md-12\"><div class=\"form-row \"><div class=\"col form-group\"><strong>" + label + "<\/strong><\/div><\/div><div class=\"form-row\"><div class=\"col form-group\"><input type=\"" + type + "\"  id=\"inputC"+id+"\" name=\"" + name + "\" class=\"form-control contactosInputs \" placeholder=\"" + label + "\"><\/div><div class=\"col-2 form-group\"><button type=\"button\" onclick=\"" + evento + "\" class=\"btn btn-danger\">Cancelar<\/button><\/div><\/div>";

        aux += botones;

        var divContactos = document.getElementById('contactos').insertAdjacentHTML('beforebegin', aux);



    }

    function changeRFC(value){
        if(value==1){
            document.getElementById('inputRFC').maxLength="13";
            document.getElementById('inputRFC').minLength="13";
           
           
            document.getElementById('inputRFC').placeholder ="XXXXddmmaa###";
            //alert(document.getElementById('inputRFC').maxlength);
        }
        if(value==0){
            document.getElementById('inputRFC').minLength="12";
            document.getElementById('inputRFC').maxLength="12";
           
           // alert(document.getElementById('inputRFC').maxlength);

            document.getElementById('inputRFC').placeholder ="XXXddmmaa###";
            
        }
    }

    function addContact(id, value) {
        indexContact++;
        makeInputs('contacto', id);


    }

    function addEmail(id) {
        indexEmail++;
        makeInputs('email', id);

    }

    function addNumber(id) {
        indexNumber++;
        makeInputs('tel', id);

    }

    function deleteContact(name) {
        var inputs = document.getElementsByClassName(name);

        Array.from(inputs).forEach(input => {
            input.remove();
        });

    }

    function deleteEmail(id) {
        var input = document.getElementById(id);
        input.remove();

    }

    function deleteNumber(id) {
        var input = document.getElementById(id);
        input.remove();

    }





</script>



@endsection