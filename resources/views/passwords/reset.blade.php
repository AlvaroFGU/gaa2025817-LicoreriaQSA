<!doctype html>
<html lang="en">
<head>
    <title>Restablecer Contraseña</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .vh-100 {
            min-height: 115vh;
        }
    </style>
    <script>
        function validatePasswords() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const errorDiv = document.getElementById('password_error');
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (password !== confirmPassword) {
                errorDiv.innerText = "Las contraseñas no coinciden.";
                return false;
            }

            if (!regex.test(password)) {
                errorDiv.innerText = "La contraseña debe tener al menos 8 caracteres, incluyendo una letra minúscula, una mayúscula, un número y un símbolo.";
                return false;
            }

            errorDiv.innerText = "";
            return true;
        }
    </script>
</head>
<body>
<section class="vh-100" style="background-color: #333333;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body p-5 p-lg-6 text-black">
            <form method="POST" action="{{ route('password.update') }}" onsubmit="return validatePasswords()">
              @csrf
              <div class="d-flex align-items-center mb-3 pb-1">
                <span class="h1 fw-bold mb-0">Restablecer Contraseña</span>
              </div>
              <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Ingrese su nueva contraseña</h5>
              <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control form-control-lg" value="{{ $email ?? old('email') }}" required />
                <label class="form-label" for="email">Correo Electrónico</label>
              </div>
              <div class="form-outline mb-4">
                <input type="number" name="seguridad" id="seguridad" class="form-control form-control-lg" required />
                <label class="form-label" for="seguridad">Código de Seguridad</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control form-control-lg" required />
                <label class="form-label" for="password">Nueva Contraseña</label>
              </div>
              <div class="form-outline mb-4">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg" required />
                <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
              </div>
              <div id="password_error" style="color:red;" class="mb-3"></div>
              <div class="pt-1 mb-4">
                <button class="btn btn-dark btn-lg btn-block" type="submit">Restablecer</button>
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
