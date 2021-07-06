@extends('layouts.app', [ 'class' => '', 'elementActive' => 'dashboard' ])
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i
                                    class="nc-icon nc-single-copy-04 text-warning"
                                ></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">COTIZACIONES</p>
                                <p class="card-title" id="cotizaciones"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("rate/count", "GET","cotizaciones")'>
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i
                                    class="nc-icon nc-single-copy-04 text-success"
                                ></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">NOTAS DE REMISION</p>
                                <p class="card-title">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats">
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i
                                    class="nc-icon nc-single-copy-04 text-danger"
                                ></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">FACTURAS</p>
                                <p class="card-title">0</p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats">
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i
                                    class="nc-icon nc-satisfied text-primary"
                                ></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">CLIENTES</p>
                                <p class="card-title" id="clientes">0</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("client/count", "GET","clientes")'>
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-email-85 text-info"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">SOLICITUDES</p>
                                <p class="card-title" id="solicitudes">0</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("user/count", "GET","solicitudes")'>
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-bag-16 text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">PRODUCTOS</p>
                                <p class="card-title" id="productos">0</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("product/count", "GET","productos")'>
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-app text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">KITS</p>
                                <p class="card-title" id="kits">0</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("kits/count", "GET","kits")'>
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-box-2 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">FABRICANTES</p>
                                <p class="card-title" id="fabricantes">0</p>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("manufacturer/count", "GET","fabricantes")'>
                        <i class="fa fa-refresh"></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i
                                    class="nc-icon nc-delivery-fast text-info"
                                ></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">PROVEEDORES</p>
                                <p class="card-title" id="proveedores">0</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <hr />
                    <div class="stats" onclick='ajax("wholesaler/count", "GET","proveedores")'>
                          <i class="fa fa-refresh"  ></i> ACTUALIZAR
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">COMPORTAMINETO DE USUARIOS</h5>
                        <p class="card-category">DESEMEPEÑO EN ULTIMAS 24 HORAS</p>
                    </div>
                    <div class="card-body ">
                        <canvas id=chartHours width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-history"></i> ACTULIZADO HACE 3 MINUTOS
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h5 class="card-title">ESTADISTICAS DE CORREO</h5>
                        <p class="card-category">DESEMPEÑO EN LA ULTIMA CAMPAÑA</p>
                    </div>
                    <div class="card-body ">
                        <canvas id="chartEmail"></canvas>
                    </div>
                    <div class="card-footer ">
                        <div class="legend">
                            <i class="fa fa-circle text-primary"></i> Opened
                            <i class="fa fa-circle text-warning"></i> Read
                            <i class="fa fa-circle text-danger"></i> Deleted
                            <i class="fa fa-circle text-gray"></i> Unopened
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-calendar"></i> NUMERO DE CORREOS ENVIADOS
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-chart">
                    <div class="card-header">
                        <h5 class="card-title">NASDAQ: AAPL</h5>
                        <p class="card-category">Line Chart with Points</p>
                    </div>
                    <div class="card-body">
                        <canvas id="speedChart" width="400" height="100"></canvas>
                    </div>
                    <div class="card-footer">
                        <div class="chart-legend">
                            <i class="fa fa-circle text-info"></i> Tesla Model S
                            <i class="fa fa-circle text-warning"></i> BMW 5 Series
                        </div>
                        <hr />
                        <div class="card-stats">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</div>

<div></div>

<script>
    var totales = {
        cotizaciones: 0,
        remisiones: 0,
        facturas: 0,
        clientes: 0,
        solicitudes: 0,
        productos: 0,
        kits: 0,
        frabricantes: 0,
        proveedores: 0,
    };

    function ajax(url, type, id) {
        var xhttp = new XMLHttpRequest();
        
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                console.log(id);
                if(id=="cotizaciones"){
                  /*  res= JSON.parse(this.responseText); */
                  res = JSON.parse(this.responseText).total;
                console.log(res);

                totales.cotizaciones=res;

                 document.getElementById(id).innerHTML = totales.cotizaciones;
                }

               /*   if(id="remisiones"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                } */

               /*   if(id="facturas"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                } */
                 if(id=="clientes"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                totales.clientes=res;
                 document.getElementById(id).innerHTML = totales.clientes;
                }

                 if(id=="solicitudes"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                totales.solicitudes=res;
                 document.getElementById(id).innerHTML = totales.solicitudes;
                }

                 if(id=="productos"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                totales.productos=res;
                 document.getElementById(id).innerHTML = totales.productos;
                }

                 if(id=="kits"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                totales.kits=res;
                 document.getElementById(id).innerHTML = totales.kits;
                }
                if(id=="fabricantes"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                totales.frabricantes=res;
                document.getElementById(id).innerHTML = totales.frabricantes;
                }
                if(id=="proveedores"){
                     res = JSON.parse(this.responseText).total;
                console.log(res);
                totales.proveedores=res;
                document.getElementById(id).innerHTML = totales.proveedores;

                }
               
                
            }
        };

        xhttp.open(type, url, true);
        xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp.send();
       
    }

    document.addEventListener("DOMContentLoaded", function () {
        ajax("rate/count", "GET","cotizaciones");
        ajax("client/count", "GET","clientes");
        ajax("user/count", "GET","solicitudes");
        ajax("product/count", "GET","productos");
        ajax("kit/count", "GET","kits");
        ajax("wholesaler/count", "GET","proveedores");  
        ajax("manufacturer/count", "GET","fabricantes"); 
       
        console.log("OK");
    });
</script>

@endsection @push('scripts')
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        /*    demo.initChartsPages(); */
    });
</script>
@endpush
