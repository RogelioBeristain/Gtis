<h2>Responder al Cliente : {{$mensaje['client']->name}} correo: {{$mensaje['email']}} o al {{$mensaje['client']->email}}
</h2>

<p>
<strong> Numero de contacto </strong> {{$mensaje['tel_number']}}
<br>
  <strong> Descripción </strong>  {{$mensaje['bodyMessage']}}
    <br>
  <strong> Fabricante </strong> {{$mensaje['manufacturer']}}
    <br>
    <strong> Modelo </strong> {{$mensaje['model']}}
    <br>
    <strong> Numero de serie </strong> {{$mensaje['serial_number']}}
    <br>
    <strong> Codigo de producto </strong> {{$mensaje['code']}}
    <br>
    <strong> Fecha de compra </strong> {{$mensaje['date_pay']}}
    <br>


</p>
<span>{{ config('app.name', 'Sistema') }}</span>