<script>
  import { v4 as uuidv4 } from "uuid";

  let products = [];
  let name = "";
  let lastName = "";
  let commandNumber = uuidv4();

  async function fetchProducts() {
    try {
      let response = await fetch("https://gazpacho.fr/_admin/api.php");
      if (!response.ok) {
        throw new Error("Error en la solicitud de productos");
      }
      let data = await response.json();
      products = data.map((product) => ({
        ...product,
        idCarte: product.idCarte || generateUniqueId(),
        price: parseFloat(product.price), // Asegurarse de que price es un número
      }));
    } catch (error) {
      console.error("Error al obtener los productos:", error);
    }
  }

  fetchProducts();

  let cart = [];
  let total = 0;

  function addToCart(product) {
    let item = cart.find((item) => item.idCarte === product.idCarte);
    if (item) {
      item.quantity += 1;
      item.totalPrice = (item.quantity * product.price).toFixed(2);
    } else {
      cart = [
        ...cart,
        { ...product, quantity: 1, totalPrice: product.price.toFixed(2) },
      ];
    }
    cart = [...cart];
    updateTotal();
  }

  function updateTotal() {
    total = cart
      .reduce((acc, item) => acc + parseFloat(item.totalPrice), 0)
      .toFixed(2);
  }
  function getCurrentTime() {
    const now = new Date();
    return now.toLocaleString();
  }
  function removeFromCart(product) {
    let index = cart.findIndex((item) => item.idCarte === product.idCarte);
    if (index !== -1) {
      cart[index].quantity -= 1;
      cart[index].totalPrice = (cart[index].quantity * product.price).toFixed(
        2
      );
      if (cart[index].quantity === 0) {
        cart = cart.filter((_, i) => i !== index);
      }
    }
    cart = [...cart];
    updateTotal();
  }
</script>

<div class="container">
  <div class="products">
    <ul>
      {#each products as product (product.idCarte)}
        <li>
          <div class="containerProduct">
            <div class="image">
              <img src={`./img/${product.img}`} alt={product.title} />
            </div>
            <div class="col">
              <p>{product.title}</p>
              <p class="text-xs flex-wrap max-w-[155px]">{product.parr}</p>
            </div>
            <div class="col3">
              <p>{product.price}€</p>
              <button on:click={() => addToCart(product)}>+</button>
            </div>
          </div>
        </li>
      {/each}
    </ul>
  </div>
  <ul>
    {#each cart as item (item.idCarte)}
      <li class="li">
        <div class="divPrice">
          <p class="price">{item.title}</p>
          <p class="price">{item.price}€</p>
        </div>
        <div class="divPrice">
          <p class="price2">Qté: {item.quantity}</p>

          <button on:click={() => removeFromCart(item)} class="btnEffacer"
            ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  viewBox="0 0 16 16">
              <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
            </svg></button
          >
        </div>
      </li>
    {/each}
  </ul>
</div>

<style>
  .container {
    max-width: 100%;
  }

  .products {
    width: 100%;
    
    & .h2 {
      font-size: 1rem;
      font-weight: 700;
    }
    & hr {
      margin: 1rem 0;
      max-width: 90%;
    }
  }
  .products ul {
    width: 100%;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 1.25rem;
    padding: 0 1rem;
    & li {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 1.2rem;
      padding-left: 1rem;
      & .containerProduct {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        & .image {
          width: 5rem;
          height: 5rem;
          border-radius: 1rem;
          overflow: hidden;
          & img {
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
        & .col3 {
          display: flex;
          flex-direction: column;
          
          font-size: 1rem;
          text-transform: uppercase;
          color: chocolate;
          height: 100%;
          & button{
            width: 25px;
            height: 25px;
            padding: .9rem;
            border-radius: 100%;
            background-color: chocolate;
            color: white;
            border: none;
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            align-items: center
          }
        }
      }
    }
  }
</style>
