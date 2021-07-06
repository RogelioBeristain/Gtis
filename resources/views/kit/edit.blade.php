@extends('layouts.app_old', [
'class' => '',
'elementActive' => 'kit'
]) 
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.6.0/math.min.js"></script>

<script>
    var arrayProductosSelecionados=[];
    var objProductoAux=[];
    var arrayConceptosSelecionados=[];

</script>
<div class="content">
    <div class="row justify-content-center">
        <div class="col-lg-10 margin-tb">
            <div class="float-left">
                <h2>Actualizar Kit {{$kit->id}}</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('kit.index') }}"> Regresar</a>
            </div>
        </div>
    </div>
    
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
    
    <div class="row  justify-content-center">
        <div class="col-lg-10 margin-tb">
            <div class="modal fade" id="modalDescription" tabindex="-1" role="dialog">
                <div class="modal-dialog   modal-dialog-scrollable modal-dialog-centered" role="document">
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
    
    
    
    
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog   modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id=" ">Lista de Productos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
    
    
    
                            <list-component :data="{{$products}}"></list-component>
    
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" onclick="addProductos()"> Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <form action="{{ route('kit.update',$kit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Título: </strong>
                            <input type="text" name="title" class="form-control" autocomplete="new-password"
                                placeholder="Titulo" value="{{$kit->title }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Descripción:</strong>
    
                            <textarea required name="description" class="form-control" autocomplete="new-password"
                                placeholder="Descripción">  {{$kit->description}}</textarea>
    
                        </div>
                    </div>
                    <input type="hidden" name="price" id="price" class="form-control" autocomplete="new-password">
                    <div id="productos">
    
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
    
    
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Seleccionar Productos
                            </button>
                        </div>
                    </div>
    
                    <div class="col-xs-12 col-sm-12 col-md-12">
    
                        <table id="tableProductos" class="table table-bordered table-striped ">
                            <tr>
                                <th>Código de producto</th>
                                <th>Descripción</th>
    
                                <th>Price</th>
    
                            </tr>
    
    
    
                        </table>
    
                    </div>
                    <div class="col-lg-11 margin-tb">
                        <div class="float-left">
    
                        </div>
                        <div class="float-right">
                            <h6 id="total"> TOTAL: </h6>
    
                        </div>
                    </div>
    
    
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
    
            </form>
    
    
    
    
    
        </div>
    </div>
</div>


<script >









var xhr = new XMLHttpRequest();

// Setup our listener to process completed requests
xhr.onload = function () {

	// Process our return data
	if (xhr.status >= 200 && xhr.status < 300) {
		// What do when the request is successful
		console.log('success!', xhr);
        var dataProducts=JSON.parse(xhr.response);
        console.log(dataProducts);
        dataProducts.productsK.forEach(element => {
            arrayProductosSelecionados.push(element);
            console.log(element.id);
            var p= document.getElementById('product'+element.id);
            p.checked=true;
            
        });
        addProductos();

	} else {
		// What do when the request fails
		console.log('The request failed!');
	}

	// Code that should run regardless of the request status
	console.log('This always runs...');
};


xhr.open('GET', '{{ route('kit.editJson',$kit->id) }}' );
xhr.send();



   function addProductos(){

    $('#exampleModal').modal('hide');
    var products= document.getElementById('productos');

        products.innerHTML="<input type='hidden'  name='products' value='"+JSON.stringify(arrayProductosSelecionados)+"'' >"  ;

       let tableRef = document.getElementById('tableProductos');
       console.log("hola:"+tableRef.rows.length);
       for(var i =tableRef.rows.length -1; i>0; i--)
        {
            tableRef.deleteRow(i);
            
        }

 var totalP=0;
       arrayProductosSelecionados.forEach(element => {
        addRow('tableProductos',element);   
           totalP=math.sum(totalP,element.price);
         });
           document.getElementById('total').innerHTML='TOTAL: $'+totalP;
         document.getElementById('price').value=totalP;
        
    
      



 

   }
   function addRow(tableID,element) {
        
    let tableRef = document.getElementById(tableID);

        
let newRow = tableRef.insertRow(-1);


let cell1 = newRow.insertCell(0);
let cell2 = newRow.insertCell(1);
let cell3 = newRow.insertCell(2);

cell1.innerHTML = element.code;
cell2.innerHTML = '<button type=\"button\" onclick=\"verDescription('+element.id+')\" class=\"btn btn-secondary btn-sm\"> ver descripci\u00F3n<\/button>';
cell3.innerHTML = element.price;


  
}


function addProducto(id,producto,code,price){

  
objProductoAux={ 'id':producto,  'code':code,'price':price };


 var p= document.getElementById(id);
 if(p.checked){
     arrayConceptosSelecionados.push(  objProductoAux);

  
     arrayProductosSelecionados.push(objProductoAux);

 }else{
     removeElementj(arrayConceptosSelecionados,objProductoAux);
     removeElementJ(arrayProductosSelecionados, objProductoAux);
    
 }

// alert(productos);


}

function removeElement(array, elem) {
    var index = array.indexOf(elem);
    if (index > -1) {
        array.splice(index, 1);
    }
}

function removeElementJ(array, elem) {
    var dato=0;
    var val=0;
    

    array.forEach(element => {
        if(element.id==elem.id){
            console.log(element.id);
            val=dato;
        }
        dato++;
        
    });


    var index = val;

    if (index > -1) {
        array.splice(index, 1);
    }
}

function verDescription(id){


                
var xhr = new XMLHttpRequest();
// Setup our listener to process completed requests

xhr.onload = function () {
    
   
    // Process our return data
    if (xhr.status >= 200 && xhr.status < 300) {
        // What do when the request is successful
        console.log('success!', xhr.response);

        
    let dataProducts=JSON.parse(xhr.response);
    console.log(dataProducts);
        $('#exampleModal').modal('hide');
   
        $('#modalDescription').modal('toggle');

        let des=document.getElementById('modalBody').innerHTML=dataProducts.description;


        
    } else {
        // What do when the request fails
        console.log('The request failed!');
      //  console.log('success!', xhr.response);
    }

    // Code that should run regardless of the request status
    console.log('This always runs...');
};


xhr.open('GET', '/product/'+id );
xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
xhr.send();



}

   function calcularTotales() {}

</script>


<script>
    tinymce.init({
        selector:'textarea',
        menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  ' bold italic backcolor | alignleft aligncenter ' +
  ' alignright alignjustify | bullist numlist outdent indent |' +
  ' removeformat | help',
       
    });

    
</script>

  @endsection