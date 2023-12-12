const filtroproductos = document.querySelector("#filtroproductos");
const buscadorproductos = document.querySelector("#buscadorpro");
const tabla = document.querySelector(".lista");
const tbody = document.querySelector("#tbody");
filtroproductos.focus();
filtroproductos.addEventListener("keyup", () => {
  let valor = filtroproductos.value.trim();
  let peticion = "f";
  let data = new FormData();
  data.append("peticion", peticion);
  data.append("valor", valor);
  let parametros = {
    method: "POST",
    body: data,
  };
  fetch("../servicios/controler/pedidocontroller.php", parametros)
    .then((respuesta) => respuesta.json())
    .then((datos) => {
      mostrarPedidos(datos);
    })
    .catch((error) => {
      console.log(error);
    });
});
function mostrarPedidos(datos) {
  tbody.innerHTML = "";
  if (datos.codigo === "00") {
    datos.mensaje.forEach((item) => {
      tbody.innerHTML += `<tr><td>${item.nombreprod}</td><td>${item.total}</td><td>${item.fecha}</td><td>${item.usuario}</td></tr>`;
    });
  } else {
    tbody.innerHTML += `<tr><td colspan="4">${datos.mensaje}</td></tr>`;
  }
  filtroproductos.value = "";
}
