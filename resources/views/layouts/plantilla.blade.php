

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="stylesheet" href= "{{ asset('css/main.css') }}">
    <title>@yield ('title')</title>

  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      
      <header class="main-header hidden-print"><a class="logo" href="#">@yield ('title') </a>
        <nav class="navbar navbar-static-top">
          <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <div class="navbar-custom-menu">
            <ul class="top-nav">
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu">
                  
                  
                </ul>
              </li>
            </ul>
          </div>

          
        </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print sidebar-collapse">
        <section class="sidebar">
          <div class="user-panel">

          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <li class="active"><a href="#"><i class="fa fa-home"></i><span>Inicio</span></a></li>

            <li class="treeview"><a href="{{route('empleados.index')}}"><i class="fa fa-user"></i><span>Empleados</span><i class="fa fa-angle-right"></i></a></li>
            <li class="treeview"><a href="{{route('roles.index')}}"><i class="fa fa-user"></i><span>Roles</span><i class="fa fa-angle-right"></i></a></li>
            <li class="treeview"><a href="{{route('sueldossalarios.index')}}"><i class="fa fa-user"></i><span>Sueldo Salarios</span><i class="fa fa-angle-right"></i></a></li>
            <li class="treeview"><a href="{{route('sucursales.index')}}"><i class="fa fa-user"></i><span>Sucursales</span><i class="fa fa-angle-right"></i></a></li>
            
          </ul>
        </section>
      </aside>
<br><br><br><br><br><br><br>
<!-- aquiiiiiiiii  -->
      @yield('content')

    <!-- Javascripts-->
    
    <script>
        $(document).ready(function(){
            $('.sidebar-toggle').click(function(){
                if($('body').hasClass('sidebar-collapse')){
                    $('body').removeClass('sidebar-collapse');
                } else {
                    $('body').addClass('sidebar-collapse');
                }
            });
        });
    </script>
    <script src= "{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src= "{{ asset('js/bootstrap.min.js') }}"></script>
    <script src= "{{ asset('js/plugins/pace.min.js') }}"></script>
    <script src= "{{ asset('js/main.js') }}"></script>
    
  </body>
</html>
      


