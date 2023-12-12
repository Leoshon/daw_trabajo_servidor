const btnAlta = document.getElementById("alta");
const formulario = document.getElementById("formulario");
btnAlta.addEventListener("click", alta);

function alta() {
  const nombre = document.getElementById("usuario").value.trim();
  const clave = document.getElementById("pass").value.trim();
  const email = document.getElementById("correo").value.trim();
  try {
    if (nombre == "" || clave == "" || email == "") {
      throw new Error("Debe completar todos los campos");
    }
    const url = "../servicios/controler/altacontroller.php";
    const datos = new FormData();
    datos.append("nombre", nombre);
    datos.append("clave", clave);
    datos.append("correo", email);
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
          alert(mensaje);
          formulario.reset();
          window.location.href = "../index.php";
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
