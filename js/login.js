const enviar = document.getElementById("login");
enviar.addEventListener("click", login);
let carrito = JSON.parse(sessionStorage.getItem("carrito"));
let id = JSON.parse(sessionStorage.getItem("idusuario"));
sessionStorage.removeItem("carrito");
sessionStorage.removeItem("idusuario");
function login() {
  const user = document.getElementById("usuario").value.trim();
  const clave = document.getElementById("pass").value.trim();
  try {
    if (user == "" || clave == "") {
      throw new Error("Debe completar todos los campos");
    }
    const url = "servicios/controler/logincontroller.php";
    const datos = new FormData();
    datos.append("usuario", user);
    datos.append("password", clave);
    let parametros = {
      method: "post",
      body: datos,
    };
    fetch(url, parametros)
      .then((respuesta) => respuesta.json())
      .then((datos) => {
        let codigo = datos.codigo;
        let mensaje = datos.mensaje;
        if (codigo == "00") {
          let idusuario = mensaje.id;
          sessionStorage.setItem("idusuario", idusuario);
          if (mensaje.roles === "administrador") {
            window.location.href = "mantenimiento/mantenimiento.php";
          } else {
            window.location.href = "cliente/tienda.php";
          }
        } else {
          throw new Error(mensaje);
        }
      })
      .catch((error) => {
        alert(error);
      });
  } catch (error) {
    alert(error);
  }
}
