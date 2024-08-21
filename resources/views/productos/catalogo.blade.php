<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Catalogo TechEmpire</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo_tech-mini.png')}}" />
    <style>
      .card-img-top {
          width: 100%;
          height: 200px;
          object-fit: cover;
      }
      .card-link {
          text-decoration: none;
          color: inherit;
      }
      .card-link:hover {
          color: inherit;
      }
      
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">

        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
              <ul class="navbar-nav w-100">
                  <li class="nav-item w-100">
                      <form class="nav-link mt-2 mt-md-0 d-lg-flex search" id="searchForm">
                          <input type="text" id="searchInput" class="form-control search-input" placeholder="Buscar Productos">
                      </form>
                  </li>

                  <li class="nav-item menu-items">
        <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
          <span class="menu-icon">
            <i class="mdi mdi-account"></i>
          </span>
          <span class="menu-title">Ingresar</span>
        </a>
      </li>

              </ul>
          </div>
      </nav>

        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Catalogo </h3>
              <nav aria-label="breadcrumb">

              </nav>
            </div>
            <div class="row" id="productContainer">
              @foreach ($productos as $producto)
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card product-card">
                    <div class="card">
                      <a href="#" class="card card-link" data-toggle="modal" data-target="#productoModal" 
                        data-nombre="{{ $producto->Nombre }}"
                        data-imagen="{{ asset($producto->ImagenUrl) }}"
                        data-precio="{{ $producto->Precio }}"
                        data-descripcion="{{ $producto->Descripcion }}"
                        data-modelo="{{ $producto->Modelo }}"
                        data-marca="{{ $producto->marca->Nombre }}">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-12">
                                      @if ($producto->ImagenUrl)
                                          <img src="{{ asset($producto->ImagenUrl) }}" alt="Imagen del Producto" class="card-img-top">
                                      @else
                                          <img src="https://via.placeholder.com/250x200?text=No+Image" alt="No Image" class="card-img-top">
                                      @endif
                                  </div>
                                  <div class="col-12 mt-2">
                                      <h5 class="mb-0">{{ $producto->Nombre }}</h5>
                                      <p hidden class="product-name">{{ $producto->Nombre }}</p>
                                      <p hidden class="product-precio">{{ $producto->Precio }}</p>
                                      <p hidden class="product-descripcion">{{ $producto->Descripcion }}</p>
                                      <p hidden class="product-modelo">{{ $producto->Modelo }}</p>
                                      <p hidden class="product-marca">{{ $producto->marca->Nombre }}</p>
                                      @php
                                          $disponible = $producto->Cantidad;
                                      @endphp
                                      <p class="{{ $disponible ? 'text-success' : 'text-danger' }} ml-2 mb-0 font-weight-medium">
                                          {{ $disponible ? 'Disponible' : 'No disponible' }}
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </a>
                    </div>
                </div>
            @endforeach

            </div>
          </div>
          <div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productoModalLabel">Detalles del Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" id="productoImagen" class="img-fluid mb-3" alt="Imagen del Producto">
                        <h5>Nombre: <span id="productoNombre"></span></h5>
                        <p>Precio: <span id="productoPrecio"></span></p>
                        <p>Marca: <span id="productoMarca"></span></p>
                        <p>Modelo: <span id="productoModelo"></span></p>
                        <p>Descripcion: <hr><span id="productoDescripcion"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © techempire.com 2024</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    <div class="pagination-container">
      {{ $productos->links('vendor.pagination.bootstrap-4') }} <!-- Enlaces de paginación -->
  </div>
  <style>
      .pagination-container {
          position: fixed;
          bottom: 50px; /* Ajusta este valor según tus necesidades */
          right: 20px;  /* Ajusta este valor según tus necesidades */
      }
  </style>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    

<script>
  $(document).ready(function() {
    $('#searchForm').on('submit', function(event) {
                event.preventDefault();
            });
      $('#searchInput').on('keyup', function() {
          var value = $(this).val().toLowerCase();
          $('#productContainer .product-card').filter(function() {
              $(this).toggle(
                  $(this).find('.product-name').text().toLowerCase().indexOf(value) > -1 || 
                  $(this).find('.product-descripcion').text().toLowerCase().indexOf(value) > -1 || 
                  $(this).find('.product-precio').text().toLowerCase().indexOf(value) > -1 || 
                  $(this).find('.product-modelo').text().toLowerCase().indexOf(value) > -1 || 
                  $(this).find('.product-marca').text().toLowerCase().indexOf(value) > -1
              );
          });
      });

      $('#productoModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var nombre = button.data('nombre');
          var imagen = button.data('imagen');
          var descripcion = button.data('descripcion');
          var precio = button.data('precio');
          var modelo = button.data('modelo');
          var marca = button.data('marca');

          var modal = $(this);
          modal.find('.modal-title').text('Detalles del Producto');
          modal.find('#productoImagen').attr('src', imagen);
          modal.find('#productoNombre').text(nombre);
          modal.find('#productoDescripcion').text(descripcion);
          modal.find('#productoPrecio').text(precio);
          modal.find('#productoModelo').text(modelo);
          modal.find('#productoMarca').text(marca);
      });
  });
</script>
    <!-- container-scroller -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>