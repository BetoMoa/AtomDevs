//Funcion para crear cuenta
$("#nuevo_usuario").submit(function (e) {
  let datos = $("#nuevo_usuario").serialize();
  let password = $("#password").val();
  let confirmar_password = $("#confirmar_password").val();

  if (password.length < 8) {
    $("#mensaje")
      .html(`<div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              La contraseña debe contener al menos 8 caracteres.
             </div>`);
  } else if (confirmar_password != password) {
    $("#mensaje")
      .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Asegurate que las contraseñas sean las mismas.
             </div>`);
  } else {
    $.ajax({
      type: "POST",
      data: datos,
      url: "php/nuevo_usuario.php",
      success: function (r) {
        // console.log(r);
        if (r == 1) {
          let datos = $("#nuevo_usuario")[0].reset();
          $("#mensaje")
            .html(`<div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Cuenta creada!</strong> Inicia sesión para acceder a tu cuenta.
             </div>`);
        } else if (r == "existe") {
          $("#mensaje")
            .html(`<div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Este usuario ya esta registrado, intenta con otro correo electrónico.
             </div>`);
        } else {
          $("#mensaje")
            .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Parece que ha habido un error con el servidor, intentalo mas tarde.
             </div>`);
        }
      },
    });
  }

  e.preventDefault();
});

//Iniciar sesión
$("#iniciar_sesion").submit(function (e) {
  let datos = $("#iniciar_sesion").serialize();

  $.ajax({
    type: "POST",
    data: datos,
    url: "php/validar_login.php",
    success: function (r) {
      console.log(r);
      if (r == 1) {
        window.location = "index.php";
      } else {
        $("#msj")
          .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Usuario o contraseña incorrecta
             </div>`);
      }
    },
  });

  e.preventDefault();
});

//Editar perfil
$("#editar_perfil").submit(function (e) {
  let datos = $("#editar_perfil").serialize();

  $.ajax({
    type: "POST",
    data: datos,
    url: "php/editar_perfil.php",
    success: function (r) {
      console.log(r);
      if (r == 1) {
        $("#msj")
          .html(`<div class="alert alert-info alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        Cambios guardados con exíto.
       </div>`);
      } else {
        $("#msj")
          .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        Parece que hay un problema con el sevidor, intentalo mas tarde.
       </div>`);
      }
    },
  });

  e.preventDefault();
});

//Cambiar contraseña
$("#cambiar_password").submit(function (e) {
  let datos = $("#cambiar_password").serialize();
  let password = $("#n_password").val();
  let cpassword = $("#c_password").val();

  if (password.length < 8) {
    $("#msj_c")
      .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    La contraseña debe contener al menos 8 caracteres.
   </div>`);
  } else if (cpassword != password) {
    $("#msj_c")
      .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    Asegurate de que las contraseñas sean las mismas.
   </div>`);
  } else {
    $.ajax({
      type: "POST",
      data: datos,
      url: "php/cambiar_password.php",
      success: function (r) {
        console.log(r);
        if (r == 1) {
          $("#cambiar_password")[0].reset();
          $("#msj_c")
            .html(`<div class="alert alert-info alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    Contraseña cambiada con exíto.
   </div>`);
        } else {
          $("#msj_c")
            .html(`<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    Contraseña incorrecta.
   </div>`);
        }
      },
    });
  }

  e.preventDefault();
});
