<!doctype html>
<html lang="en">
<head>
    <title>Recuperar Contraseña</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<section class="vh-100" style="background-color: #333333;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body p-4 p-lg-5 text-black">
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="d-flex align-items-center mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Cambiar Contraseña</span>
              </div>
              <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Ingrese su correo electrónico para recibir un codigo con el cual podras ingresar</h5>
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control form-control-lg" required />
                <label class="form-label" for="email">Correo Electrónico</label>
              </div>
              <div class="pt-1 mb-4">
                <button class="btn btn-dark btn-lg btn-block" type="submit">Enviar Codigo
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
