@extends('layouts.app_old', [
'class' => '',
'elementActive' => 'product'
])
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/6.6.0/math.min.js"></script>
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
        
        
                <div class="col-md-12">
        
                    <div class="card">
                        <div class="card-header">
                            Editar Producto
                        </div>
                        <div class="card-body">
        
                            <form action="{{ route('product.update',$product->id) }}" method="POST">
                                @csrf
                                @method('PUT')
        
                                <input type="hidden" id="manufacturerId" name="manufacturerId">
                                <input type="hidden" id="wholesalerId" name="wholesalerId">
        
        
        
                                <div class="form-group row">
                                    <label for="article" class="col-md-4 col-form-label text-md-right">
                                        Articulo:
                                    </label>
                                    <div class="col-md-6">
        
                                        <textarea class="form-control" id="article" name="article" autocomplete="new-password"
                                            placeholder="Articulo" rows="6"> {{$product->article}}</textarea>
        
        
        
                                    </div>
        
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-md-4 col-form-label text-md-right">
                                        Descripción:
                                    </label>
                                    <div class="col-md-6">
        
                                        <textarea class="form-control" id="description" name="description"
                                            autocomplete="new-password" placeholder="Descripción"
                                            rows="6"> {{$product->description}}</textarea>
        
        
        
                                    </div>
        
                                </div>
        
                                <div class="form-group row">
                                    <label for="partnumber" class="col-md-4 col-form-label text-md-right">
                                        Número de Parte
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" value="{{$product->partnumber}}" name="partnumber"
                                            class="form-control" autofocus required autocomplete="new-password"
                                            placeholder="Número de Parte">
                                    </div>
        
                                </div>
        
                                <div class="form-group row">
                                    <label for="code" class="col-md-4 col-form-label text-md-right">
                                        Código del Producto
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" value="{{$product->code}}" name="code" class="form-control" autofocus
                                            required autocomplete="new-password" placeholder="Código del Producto">
                                    </div>
        
                                </div>
        
        
        
                                <div class="form-group row">
                                    <label for="model" class="col-md-4 col-form-label text-md-right">
                                        Modelo:
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" value="{{$product->model}}" class="form-control" name="model"
                                            autofocus required autocomplete="new-password" placeholder="Modelo">
                                    </div>
        
                                </div>
        
        
        
        
                                <div class="form-group row">
                                    <label for="manufacturer_id" class="col-md-4 col-form-label text-md-right">
                                        Fabricante
                                    </label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="selectManufacturer" name="manufacturerId"
                                            onchange="setManufacturer(event)">
                                            <option value="" selected disabled hidden>Selecciona un Fabricante</option>
        
                                            @foreach($manufacturers as $manufacturer)
        
                                            @if ($manufacturer->id==$product->manufacturer->id)
                                            <option selected value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                            @else
                                            <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                            @endif
        
        
                                            @endforeach
                                        </select>
        
        
                                    </div>
        
                                </div>
        
                                <div class="form-group row">
                                    <label for="wholesaler" class="col-md-4 col-form-label text-md-right">
                                        Mayorista
                                    </label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="selectWholesaler" name="wholesalerId"
                                            onchange="setWholesaler(event)">
                                            <option value="none" selected disabled hidden>Selecciona un Mayorista</option>
        
                                            @foreach($wholesalers as $wholesaler)
        
        
        
                                            @if ($wholesaler->id==$product->wholesaler->id)
                                            <option selected value="{{$wholesaler->id}}">{{$wholesaler->name}}</option>
                                            @else
                                            <option value="{{$wholesaler->id}}">{{$wholesaler->name}} - {{$wholesaler->code}}
                                            </option>
                                            @endif
        
                                            @endforeach
                                        </select>
        
        
        
                                    </div>
        
                                </div>
        
        
        
                                <div class="form-group row">
                                    <label for="stock" class="col-md-4 col-form-label text-md-right">
                                        Cantidad de produtos (Stock)
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" value="{{$product->stock}}" name="stock" type="number"
                                            step="1" min="0" autocomplete="new-password" autofocus required
                                            placeholder=" Cantidad de produtos (Stock)">
                                    </div>
        
                                </div>
                                <div class="form-group row">
                                    <label for="cost" class="col-md-4 col-form-label text-md-right">
                                        Costo:
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" value="{{$product->cost}}" name="cost" id="costo"
                                            onkeyup="calcularPrecio()" type="number" step="0.01" min="0" autofocus required
                                            autocomplete="new-password" placeholder="Costo">
        
                                    </div>
        
                                </div>
        
                                <div class="form-group row">
                                    <label for="shipping" class="col-md-4 col-form-label text-md-right">
                                        Costo de envío:
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" value="{{$product->shipping}}" name="shipping" id="envio"
                                            onkeyup="calcularPrecio()" type="number" step="0.01" min="0" autofocus required
                                            autocomplete="new-password" placeholder="Costo de envío">
                                    </div>
        
                                </div>
        
                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">
                                        Precio:
                                    </label>
                                    <div class="col-md-6">
                                        <input class="form-control" value="{{$product->price}}" readonly name="price"
                                            id="precio" type="number" autocomplete="new-password" autofocus required
                                            placeholder="Precio o costo final">
                                    </div>
        
                                </div>
        
                                <div class="form-goup row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
        
                                    </div>
        
                                </div>
        
                        </div>
        
                        </form>
        
                    </div>
                </div>
            </div>
        </div>
        
        
        </div>
</div>



   
   
  
    <script>
    
  
        function calcularPrecio(){
        
          var costo=  document.getElementById('costo').value;
          var envio=  document.getElementById('envio').value;
          var precio=  document.getElementById('precio').value;
            if(costo >0&& envio>0){
                precio=math.sum([costo,envio]);
        
                document.getElementById('precio').value=precio;
            }else if(costo >0){
                precio= costo;
        
                document.getElementById('precio').value=precio;
            }
        
        }

        function setWholesaler(event) {

var ok = document.getElementById("selectWholesaler").value;

document.getElementById('wholesalerId').value = ok;
}
function setManufacturer(event) {

var ok = document.getElementById("selectManufacturer").value;

document.getElementById('manufacturerId').value = ok;
}
        
        
        
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