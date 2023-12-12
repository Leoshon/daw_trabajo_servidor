let id = JSON.parse(sessionStorage.getItem("idusuario"));
console.log(id);

document.addEventListener("DOMContentLoaded", () => {
  getPedidos(id);
});
async function getPedidos(id) {
  let url = "../servicios/controler/pedidocontroller.php";
  let data = new FormData();
  data.append("peticion", "C");
  data.append("idusuario", id);
  let parametros = {
    method: "POST",
    body: data,
  };
  fetch(url, parametros)
    .then((respuesta) => respuesta.json())
    .then((datos) => {
      let codigo = datos.codigo;
      let mensaje = datos.mensaje;
      if (codigo == "00") {
        mostrarPedidos(mensaje);
      } else if (codigo == "01") {
        alert(mensaje);

      } else {
        throw new Error(mensaje);
      }
    })
    .catch((error) => {
      console.log(error);
    });
}
function mostrarPedidos(datos) {
  let tbody = document.getElementById("tbody");
  tbody.innerHTML = "";
  for (let i = 0; i < datos.length; i++) {
    let tr = document.createElement("tr");
    let tdFecha = document.createElement("td");
    let tdproducto = document.createElement("td");
    let tdTotal = document.createElement("td");
    let tdUsuario = document.createElement("td");
    tdFecha.innerHTML = datos[i].fecha;
    tdproducto.innerHTML = datos[i].nombreprod;
    tdTotal.innerHTML = datos[i].total;
    tdUsuario.innerHTML = datos[i].usuario;
    tr.appendChild(tdUsuario);
    tr.appendChild(tdproducto);
    tr.appendChild(tdTotal);
    tr.appendChild(tdFecha);
    tbody.appendChild(tr);
  }
}
