<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<body>
    <?php include_once __DIR__ .'/../templates/header.php' ?>

    <h1 class="mt-5"><?php echo $titulo; ?></h1>
    
    <main class="content px-3 py-2 bg-light">
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 d-flex">
                    <div class="card flex-fill border-0 illustration">
                        <div class="card-body p-0 d-flex flex-fill">
                            <div class="row g-0 w-100">
                                <div class="col-6">
                                    <div class="p-3 m-1">
                                        <h4>Bienvenido de nuevo al</h4>
                                        <p class="mb-0">Dashboard</p>
                                    </div>
                                </div>
                                <div class="col-6 align-self-end text-end">
                                    <img src="../img/admin.png" class="img-fluid illustration-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row mt-4">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success">  
                    <div class="card-body d-flex text-white">
                        Productos
                        <i class="fas fa-thin fa-cart-plus fa-2x ml-auto"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/listar-producto" class="text-white">Ver Productos</a>
                        <span class ="text-white"><?php echo $productos?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary">  
                    <div class="card-body d-flex text-white">
                        Clientes
                        <i class="fas fa-regular fa-user fa-2x ml-auto"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/clientes" class="text-white">Ver Clientes</a>
                        <span class ="text-white"><?php echo $clientes?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info">  
                    <div class="card-body d-flex text-white">
                        Ventas
                        <i class="fas fa-solid fa-handshake fa-2x ml-auto"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/listar-ventas" class="text-white">Ver Ventas</a>
                        <span class ="text-white"><?php echo $pedidos?></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-secondary">  
                    <div class="card-body d-flex text-white">
                        Compras
                        <i class="fas fa-sharp fa-regular fa-money-bill fa-2x ml-auto"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a href="/listar-compras" class="text-white">Ver Compras</a>
                        <span class ="text-white"><?php echo $compras?></span>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="mt-2">Reportes Gráficos</h4>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar mr-1"></i>
                            Productos Stock Mínimo
                        </div>
                        <div class="card-body bg-light"><canvas id="stockMinimo" width="50" height="50"></canvas></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Productos Más vendidos(MES ACTUAL)
                        </div>
                        <div class="card-body bg-light"><canvas id="productosVendidos" width="50" height="50"></canvas></div>
                    </div>
                </div>
            </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
        <script>


            document.addEventListener('DOMContentLoaded', function () {
                (function () {
                    const ctx1 = document.getElementById('stockMinimo');
                    const ctx2 = document.getElementById('productosVendidos');
                    
                    obtenerDatos();
                    async function obtenerDatos(){
                        const url = '/api/stock'
                        const respuesta = await fetch(url)
                        const resultado = await respuesta.json()

                    new Chart(ctx1, {
                            type: 'bar',
                            data: {
                                labels: resultado.map(producto => producto.nombre),
                                datasets: [{
                                    label: 'Productos con Stock minimo',
                                    data : resultado.map(producto => producto.stock),
                                    backgroundColor: [
                                    '#ea580c',
                                    '#84cc16',
                                    '#22d3ee',
                                    '#a855f7',
                                    '#ef4444',
                                    '#14b8a6',
                                    '#db2777',
                                    '#e11d48',
                                    '#7e22ce'
                                    ]
                                }]
                            },
                            options: {
                                scales: {
                                        y: {
                                            ticks: {
                                            precision: 0,
                                            max: 100, // Número de decimales    
                                            beginAtZero: true,
                                            stepSize: 5 // Comenzar en cero
                                            }   
                                        }
                                    }
                            }
                        });
                    }

            
                    obtenerGrafico();
                    async function obtenerGrafico(){
                        const url = '/api/vendidos'
                        const respuesta = await fetch(url)
                        const resultado = await respuesta.json()

                    new Chart(ctx2, {
                            type: 'pie',
                            data: {
                                labels: resultado.map(producto => producto.nombre_producto),
                                datasets: [{
                                    data : resultado.map(producto => producto.vendidos),
                                    backgroundColor: [
                                    '#ea580c',
                                    '#84cc16',
                                    '#22d3ee',
                                    '#a855f7',
                                    '#14b8a6',
                                    '#7e22ce'
                                    ]
                                }]
                            },
                            options: {
                            }
                        });
                    }
                })();
            });
        </script>
</body>
</html>
