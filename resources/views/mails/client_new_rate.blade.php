
<h2>Responder al Cliente : {{$mensaje['client']->name}} correo: {{$mensaje['email']}}  o al   {{$mensaje['client']->email}}  </h2>
<p> <strong> Cuerpo del mensaje:</strong>   {{$mensaje['bodyMessage']}}</p>
<br>
<p> <strong> Numero de contacto: </strong> {{$mensaje['tel_number']}}</p>

<span> {{ config('app.name', 'Sistema') }}</span>