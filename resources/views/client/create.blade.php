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

    var indexContact = 0;
    var indexEmail = 0;
    var indexNumber = 0;

</script>


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
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> Nuevo Cliente</div>
    
                <div class="card-body">
    
                    <form action="{{ route('client.store') }}" method="POST" id="datos">
                        @csrf
    
    
                        <input type="hidden" id="contactosJson" name="contacts">
    
    
                        <div class="row">
    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nombre del Cliente:</strong>
                                    <input required type="text" name="nameC" class="form-control"
                                        autocomplete="new-password" placeholder="Nombre del Cliente">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Dirección:</strong>
                                    <input required type="text" name="address" class="form-control"
                                        autocomplete="new-password" placeholder="Dirección">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Pais:</strong>
                                    <input required type="text" name="country" class="form-control"
                                        autocomplete="new-password" placeholder="Pais">
                                </div>
                            </div>
    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Estado:</strong>
                                    <input required type="text" name="state" class="form-control"
                                        autocomplete="new-password" placeholder="Estado">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Ciudad:</strong>
                                    <input required type="text" name="city" class="form-control" autocomplete="new-password"
                                        placeholder="Ciudad">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Numero de contacto:</strong>
                                    <input required type="tel" name="number" class="form-control"
                                        autocomplete="new-password" placeholder="Numero de contacto">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Persona Fisica o Moral</strong>
                                    <div class="form-check">
    
    
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            onclick="changeRFC(1)" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Persona Fisica
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios"
                                            onclick="changeRFC(0)" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Persona Moral
                                        </label>
                                    </div>
    
    
                                </div>
                            </div>
    
    
    
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>RFC:</strong>
                                    <input required type="text" id="inputRFC" minlength="13" maxlength="13" name="rfc"
                                        class="form-control" autocomplete="new-password" placeholder="XXXXddmmaa###">
                                    <a href="https://agsc.siat.sat.gob.mx/PTSC/ValidaRFC/" target="_blank"> Verifica aquí si
                                        el RFC es valido en el SAT</a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Correo electrónico:</strong>
                                    <input required type="email" name="email" class="form-control"
                                        autocomplete="new-password" placeholder="Correo electrónico">
                                </div>
                            </div>
    
                        </div>
    
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <ul class="nav justify-content-center">
                                    <li class="nav-item">
    
                                        <button type="button" onclick="addContact()"
                                            class="nav-link btn btn-primary  my-2 my-sm-0">
                                            Agregar Contacto
                                        </button>
                                    </li>
    
                                </ul>
                            </div>
                        </div>
    
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center" id="contactos">
                            <button type="submit" onclick="guardar()" class="btn btn-primary">Guardar Cliente</button>
                        </div>
                </div>
    
                </form>
    
    
    
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    function guardar() {

        var inputsC = document.querySelectorAll('.contactosInputs')
        inputsC.forEach(element => {
            auxContact = { 'name': '', 'emails': [], 'numbers': [] };

            console.log(element.value + "Contacto" + element.name);
            if (element.name == 'name') {
                // console.log(element.value)
                auxContact.name = element.value;

                console.log(auxContact.name);
                arrayContacts.push(auxContact);
            }

        });




        inputsC.forEach(input => {
            auxEmail = { 'name': '', 'email': '' };
            auxNumber = { 'name': '', 'number': [] };



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
        //document.getElementById("datos").submit();

    }
    function addContact() {
        indexContact++;
        makeInputs('contacto');


    }
    /****@description
        
        crea los input necesarios para agregar un contacto
    **/
    function makeInputs(clase, id_c) {
     
        var label = "";
        var name = "";
        var id = "";
        var type = "";
        var evento="";
        var classContact="";
        if(id_c!=null){
            var classContact="contact"+id_c;

        }else{
            var classContact="contact"+indexContact;

        }
       

        var botones = "<div class=\"form-group\"><ul class=\"nav justify-content-center\"><li class=\"nav-item\"><button type=\"button\" onclick=\"addNumber(" + indexContact + ")\" class=\"nav-link btn btn-primary btn-outline-info my-2 my-sm-0\">Agregar Numero de Contacto<\/button><\/li><li class=\"nav-item\"><button type=\"button\" onclick=\"addEmail(" + indexContact + ")\" class=\"nav-link btn btn-primary btn-outline-info my-2 my-sm-0\">Agregar Email de Contacto<\/button><\/li><\/ul><\/div><\/div>";
        if (clase == "contacto") {
            label = "Nombre del Contacto " + indexContact + ":";
            name = "name";
            id = indexContact;
            type = "text";
            evento="deleteContact('"+classContact+"')";

        }

        if (clase == "tel") {
            label = "Numero telefonico del contacto " + id_c + ":";
            name = "number" + id_c;
            id = clase+indexNumber;
            type = "tel";
            botones = "";
            evento="deleteNumber('"+id+"')";

        }


        if (clase == "email") {
            label = "Correo Electronico del contacto " + id_c + ":";
            name = "email" + id_c;
            id = clase+indexEmail;
            type = "email";
            botones = "";
            evento="deleteEmail('"+id+"')";

        }

       var aux = "<div id=\""+id+"\" class=\" "+classContact+" col-xs-12 col-sm-12 col-md-12\"><div class=\"form-row \"><div class=\"col form-group\"><strong>"+label+"<\/strong><\/div><\/div><div class=\"form-row\"><div class=\"col form-group\"><input  required type=\""+type+"\" name=\""+name+"\" class=\"form-control contactosInputs \" placeholder=\""+ label+"\"><\/div><div class=\"col-2 form-group\"><button type=\"button\" onclick=\""+evento+"\" class=\"btn btn-danger\">Cancelar<\/button><\/div><\/div>";

        aux += botones;

        var divContactos = document.getElementById('contactos').insertAdjacentHTML('beforebegin', aux);



    }

 

    function addEmail(id) {
        indexEmail++;
        makeInputs('email', id);

    }

    function addNumber(id) {
        indexNumber++;
        makeInputs('tel', id);

    }

    function deleteContact(name){
        var inputs = document.getElementsByClassName(name);

        Array.from(inputs).forEach(input => {
            input.remove();
        });
       
    }

    function deleteEmail(id){
        var input = document.getElementById(id);
        input.remove();

    }

    function deleteNumber(id){
        var input = document.getElementById(id);
        input.remove();

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

</script>



@endsection