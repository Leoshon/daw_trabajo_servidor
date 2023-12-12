let idcliente = JSON.parse(sessionStorage.getItem("idusuario"));
const fragment = document.createDocumentFragment();
const cards = document.querySelector("#cards");
const tableBody = document.querySelector("#tbody");
const footer = document.querySelector("#tfoot");
const consultar = document.querySelector("#consultar");
let carrito = {};

document.addEventListener("DOMContentLoaded", function () {
  fetchData();
  if (sessionStorage.getItem("carrito")) {
    carrito = JSON.parse(sessionStorage.getItem("carrito"));
    pintarCarrito();
  }
});
cards.addEventListener("click", (e) => {
  agregarCarrito(e);
});
tableBody.addEventListener("click", (e) => {
  btnAction(e);
});
consultar.addEventListener("click", () => {
  window.location.href = "pedidos.php";
});
const fetchData = async (id = 0) => {
  try {
    let url = "../servicios/controler/productocontroller.php";
    let datos = new FormData();

    datos.append("idproducto", id);
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
          mostrarProductos(datos.mensaje);
        } else {
          throw new Error(mensaje);
        }
      })
      .catch((error) => {
        console.log(error);
      });
  } catch (error) {
    console.log(error);
  }
};
const mostrarProductos = (data) => {
  const templateCard = document.querySelector("#template-card").content;

  data.map((producto) => {
    console.log(producto.idprod);
    const clone = templateCard.cloneNode(true);
    clone.querySelector("h4").textContent = producto.nombreprod;
    clone.querySelector("p").textContent = `${producto.precio} €`;
    clone
      .querySelector("img")
      .setAttribute("src", "../img/" + producto.imagenprod + ".jpg");
    clone.querySelector("button").dataset.id = producto.idprod;
    fragment.appendChild(clone);
  });
  cards.appendChild(fragment);

};
function agregarCarrito(e) {
  e.target.classList.contains("btn-dark")
    ? setCarrito(e.target.parentElement)
    : "";
  window.scrollTo(0, 0);
  console.log(e.target.parentElement);
  e.stopPropagation();
}
const setCarrito = (item) => {
  const producto = {
    id: item.querySelector(".btn-dark").dataset.id,
    iduser: idcliente,
    title: item.querySelector("h4").textContent,
    precio: item.querySelector("p").textContent,
    cantidad: 1,
  };
  if (carrito.hasOwnProperty(producto.id)) {
    producto.cantidad = carrito[producto.id].cantidad + 1;
  }
  carrito[producto.id] = { ...producto };
  pintarCarrito();
};
const pintarCarrito = () => {
  const templateItems = document.querySelector("#template-items").content;

  tableBody.innerHTML = "";
  Object.values(carrito).forEach((item) => {
    let precio = +item.precio.substring(0, item.precio.length - 2);
    templateItems.querySelector("th").textContent = item.id;
    templateItems.querySelectorAll("td")[0].textContent = item.title;
    templateItems.querySelectorAll("td")[1].textContent = item.cantidad;
    templateItems.querySelector(".btn-info").dataset.id = item.id;
    templateItems.querySelector(".btn-warning").dataset.id = item.id;
    templateItems.querySelector("span").textContent = item.cantidad * precio;
    templateItems.querySelector(".btn-success").dataset.id = item.id;
    const clone = templateItems.cloneNode(true);
    fragment.appendChild(clone);
  });
  tableBody.appendChild(fragment);
  pintarFooter();
  sessionStorage.setItem("carrito", JSON.stringify(carrito));
};
const btnAction = (e) => {
  let producto = carrito[e.target.dataset.id];
  if (e.target.classList.contains("btn-info")) {
    producto.cantidad++;
    carrito[e.target.dataset.id] = { ...producto };
    pintarCarrito();
  }
  if (e.target.classList.contains("btn-warning")) {
    producto.cantidad--;
    if (producto.cantidad === 0) {
      delete carrito[e.target.dataset.id];
    }
  }
  if (e.target.classList.contains("btn-success")) {
    let precio = +producto.precio.substring(0, producto.precio.length - 2);
    let total = precio * producto.cantidad;
    let url = "../servicios/controler/pedidocontroller.php";
    let datos = new FormData();
    datos.append("peticion", "R");
    datos.append("idproducto", producto.id);
    datos.append("idusuario", producto.iduser);
    datos.append("total", total);
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
        } else {
          throw new Error(mensaje);
        }
      })
      .catch((error) => {
        console.log(error);
      });

    console.log(precio * producto.cantidad);
    console.log(producto.iduser);
    console.log(producto.title);
    console.log(producto.id);
  }
  pintarCarrito();
};
const pintarFooter = () => {
  const templateFooter = document.querySelector("#template-footer").content;
  footer.innerHTML = "";
  const ncantidad = Object.values(carrito).reduce(
    (ac, { cantidad }) => ac + cantidad,
    0
  );
  const nprecio = Object.values(carrito).reduce(
    (ac, { cantidad, precio }) =>
      ac + +precio.substring(0, precio.length - 2) * cantidad,
    0
  );
  if (Object.values(carrito).length === 0) {
    footer.innerHTML = `<th scope="row" colspan="6">Carrito vacío - comience a comprar!</th>`;
    return;
  }
  templateFooter.querySelectorAll("td")[0].textContent = ncantidad;
  templateFooter.querySelector("span").textContent = nprecio;
  const clone = templateFooter.cloneNode(true);
  fragment.appendChild(clone);
  footer.appendChild(fragment);
  const btnVaciar = footer.querySelector("#vaciar");
  btnVaciar.addEventListener("click", () => {
    carrito = {};
    pintarCarrito();
  });
 
};
