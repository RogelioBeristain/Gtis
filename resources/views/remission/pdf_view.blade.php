<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
  <!-- Scripts -->
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;500;600;700;800&display=swap');
  </style>
  <link rel="stylesheet" href="css/style_pdf.css">
</head>


<body>
 <script type="text/php">
  if (isset($pdf))
  {
  $font = $fontMetrics->getFont("Arial", "bold");

  $pdf->page_text(530, 10, "Pagina {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0, 0, 0));

  }
</script>
<header>



  <div class="row">
    <div id="logo">
      <img src="{{$organization->url_logo}}" width="100%">
    </div>

    <div id="razon-social" style="background-color: {{ $organization->color}} ">
      {!!Str::upper($organization->name)!!}
    </div>
    <div class="datosEmpresa">

      <div>{{Str::upper($organization->address)}}</div>
      <div>
        {{Str::upper($organization->city)}}
      </div>
      <div>
        {{Str::upper($organization->tel1)}}
      </div>
      <div>
        {{strtolower($organization->skype)}}
      </div>

      <div>
        @if ($remission_user!=null)
        correo: {{ strtolower($remission_user->email)}}
        @endif

      </div>
    </div>



  </div>

</header>
 <div class="main">

 
  <div class="row">

    <div class="colC" id="nombre"> <strong> {{ Str::upper( $client->name) }} </strong></div>
    <div class="colR"> FOLIO</div>


  </div>

  <div class="row">



    <div class="colC" id="direcion"> <strong> {{ Str::upper ( $client->address) }} </strong></div>

    @if ($remission_user!=null)
    <div class="colRw" id="numCotizacion">{{$remission_user->prefix}}{{sprintf('%05d', $remission->remission_number)}}</div>
    @endif


  </div>
  <div class="row">

    <div class="colC" id="email"> <strong> {{  Str::lower($client->email)}} </strong> </div>


    <div class="colR"> FECHA</div>



  </div>
  <div class="row">

    <div class="colRwr" id="numCotizacion"> {{$remission_date}}</div>
    <br>
    <div class="colC" id="direcion"> NOTA DE REMISION  </div>

    <br>

  </div>




  <div class="row">

    <div class="lote2"> LOTE
    </div>

    <div class="cantidad2"> CANTIDAD
    </div>

    <div class="descripcion2"> DESCRIPCIÓN
    </div>

    <div class="unitario2"> PRECIO UNITARIO

    </div>

    <div class="importe2">
      IMPORTE
    </div>

  </div>

 
  <div class="row">
    <table class="colMaxwl datos_t">



      @foreach ($conceptos as $item)
      <tr >

        <td class="lote">{{($loop->index)+1 }}</td>
        <td class="cantidad">{{$item->cantidad }} </td>
        <td class="descripcion">{!!$item->description!!} </td>
        <td class="unitario">${{ number_format( $item->total/$item->cantidad,2)}} </td>
        <td class="importe">${{ number_format($item->total, 2) }}</td>


      </tr>

      @endforeach

    </table>
    <br>
  </div>


 <div  >
   

 

  <div class="row">

    <div class="lote">
    </div>

    <div class="cantidad">
    </div>

    <div class="descripcion">
    </div>

    <div class="unitario" style="text-align: right"> SUB TOTAL

    </div>

    <div class="importe">
      ${{ number_format($remission_subtotal, 2) }}
    </div>

  </div>


  <div class="row">

    <div class="lote">
    </div>

    <div class="cantidad">
    </div>

    <div class="descripcion">
    </div>

    <div class="unitario" style="text-align: right"> IVA

    </div>

    <div class="importe">
      ${{ number_format($remission_iva, 2) }}
    </div>

  </div>
  <div class="row">

    <div class="lote">
    </div>

    <div class="cantidad">
    </div>

    <div class="descripcion">
    </div>

    <div class="unitario" style="text-align: right"> TOTAL

    </div>

    <div class="importe">
      ${{ number_format($remission->total, 2) }}
    </div>

  </div>

</div>




<div >
 





  <br>
  <br>
  <div class="row">


    <div class="colMaxw">

      @if ($remission_user!=null)
      @if ($remission_user->url_photo )
      {{--   <img id="firma" src="{{$remission_user->url_path}}" alt="{{$remission_user->url_path}}">
      --}}
      <img id="firma" src="lili.png">
      @else
      <img id="firma" src="perfil.png">
      @endif
      @endif

      <br>
      @if ($remission_user!=null)
      {{Str::upper($remission_user->grado)}} {{Str::upper($remission_user->name)}}
      <br>
      {{Str::upper($remission_user->cargo)}}
      <br>
      {!!$organization->name!!}

    </div>

    @endif
  </div>
</div>
 
 <footer>
<div class="colMax"> 
  <div class="row">
<a href="{{$organization->url_page}}">{{$organization->url_page}}</a> 
  </div>
  
    </div>
    <br>
    <img id="marcas" src="{{$organization->url_marcas}}">
 </footer>

  
 

   



</body>




</html>


      
