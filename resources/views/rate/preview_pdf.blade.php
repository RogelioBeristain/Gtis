<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista previa</title>

      <style>
      #container { overflow: auto; -webkit-overflow-scrolling: touch; height: 100%; }
      object { width: 100%; height: 1000px }
    </style>
</head>
<body>
     <div id="container">
      <object id="obj" type="application/pdf" data="/cotizaciones_test/{{$cotizacion}}" >

      <embed src="/cotizaciones_test/{{$cotizacion}}" type="application/pdf" />
      </object>
    </div>


</style>
</body>
</html>
    