function verificarCi(ci) {
   // Realizar una petición AJAX para verificar el CI
   // Aquí debes hacer la petición a tu servidor para comprobar si el CI ya existe
   // Puedes usar fetch o jQuery.ajax para esto
   // Supongamos que la respuesta del servidor es un JSON con un campo "existe" que indica si el CI existe o no
   // Por ejemplo, si usas jQuery.ajax:
   $.ajax({
       url: '/verificar-ci',
       method: 'GET',
       data: { ci: ci },
       success: function(response) {
           if (response.existe) {
               alert('El CI ya existe en la base de datos');
           }
       }
   });
}

// Función para verificar si el correo ya existe
function verificarCorreo(correo) {
   // Realizar una petición AJAX para verificar el correo
   // Aquí debes hacer la petición a tu servidor para comprobar si el correo ya existe
   // Puedes usar fetch o jQuery.ajax para esto
   // Supongamos que la respuesta del servidor es un JSON con un campo "existe" que indica si el correo existe o no
   // Por ejemplo, si usas jQuery.ajax:
   $.ajax({
       url: '/verificar-correo',
       method: 'GET',
       data: { correo: correo },
       success: function(response) {
           if (response.existe) {
               alert('El correo electrónico ya existe en la base de datos');
           }
       }
   });
}

// Función que se ejecuta al enviar el formulario
function validarFormulario() {
   var ci = document.getElementById('Ci').value;
   var correo = document.getElementById('Correo').value;

   // Verificar el CI y el correo antes de enviar el formulario
   verificarCi(ci);
   verificarCorreo(correo);
}