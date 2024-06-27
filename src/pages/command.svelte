<script>
  let products = [];
  let name = '';
  let lastName = '';
  
  

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

  function updateTotal() {
    total = cart
      .reduce((acc, item) => acc + parseFloat(item.totalPrice), 0)
      .toFixed(2);
  }
  function getCurrentTime() {
    const now = new Date()
    return now.toLocaleString()
  }

  function submitOrder() {
    let orderTime = document.getElementById("orderTime").value;
    let orderCommande = getCurrentTime()
    if (!orderTime) {
      alert("Svp, Seleccionez l'heure pour recuperer la commande");
      return;
    }
    const newCommand = {
      product: cart,
      name,
      lastName,
      date: orderTime,
      total,
      orderCommande
    }
    fetch("https://gazpacho.fr/_admin/api.php/?insertar=1", {
      method:"POST",
      body:JSON.stringify(newCommand)
    })
    .then(response=>response.json())
    .then((datosRespuesta) => {
      alert("Commande envoyée")
      localStorage.setItem('orderDetails', JSON.stringify(newCommand));
      window.location.href = '/validate';
    })
    .catch(console.log)

    console.log(newCommand);
  }
  function vaciarCart() {
    cart = [];
    updateTotal();
    document.getElementById("orderTime").value = "";
  }
  
</script>

<div class="container">
  <div class="products">
    <h2 class="h2">Plats</h2>
    <hr />
    <ul>
      {#each products as product (product.idCarte)}
        <li>
          <button on:click={() => addToCart(product)}>
            <div class="containerProduct">
              {product.title} - {product.price}€
              <p>{product.parr}</p>
            </div></button
          >
        </li>
      {/each}
    </ul>
  </div>

  <div class="cart">
    <h2 class="h2">Panier</h2>
    <hr />
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

    <select id="orderTime">
      <option value="">Seleccionez l'heure de la commande:</option>
      <option value="9:00">9:00</option>
      <option value="9:30">9:30</option>
      <option value="10:00">10:00</option>
      <option value="10:30">10:30</option>
      <option value="11:00">11:00</option>
      <option value="11:30">11:30</option>
      <option value="12:00">12:00</option>
      <option value="12:30">12:30</option>
      <option value="13:00">13:00</option>
      <!-- Agrega más opciones de tiempo aquí -->
    </select>
    <div class="name-inputs">
        <input class="input" type="text" placeholder="Nom" bind:value={name}>
        <input class="input" type="text" placeholder="Prénom" bind:value={lastName}>
    </div>
    <div class="containP">
      <p class="p1">Total:</p>
      <p class="p">{total}€</p>
    </div>

    <button class="btn" on:click={submitOrder}>Envoyer</button>
  </div>
</div>

<style>
  .container {
    max-width: 75rem;
    margin: auto;
    display: flex;
    justify-content: space-between;
  }

  .products {
    width: 65%;
    & .containerProduct {
      border: 1px solid #ccc;
      border-radius: 1.2rem;
      padding: 2rem 1rem;
      margin-bottom: 1rem;
    }
    & .h2 {
      font-size: 1.4rem;
      font-weight: 700;
    }
    & hr {
      margin: 1rem 0;
      max-width: 90%;
    }
  }
  .products ul {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.25rem;
  }

  .cart {
    width: 35%;
    display: flex;
    flex-direction: column;
    gap: 1.1rem;
    & .btn {
      max-width: 9.375rem;
      background-color: #f0ad2e;
      border: none;
      color: white;
      padding: 10px 22px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 1rem;
    }
    & .h2 {
      font-size: 1.4rem;
      font-weight: 700;
    }
    & .p {
      font-size: 1.2rem;
      font-weight: 700;
    }
    & .p1 {
      font-size: 1.2rem;
      font-weight: 700;
      text-transform: uppercase;
    }
    & .containP {
      display: flex;
      justify-content: space-between;
    }
    & select {
      padding: 0.5rem;
      border-radius: 1rem;
      border: 1px solid #ccc;
    }
    & .btnEffacer {
      max-width: 9.375rem;
      
      padding: 5px 15px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
        & svg{
            fill:#fc6341;
        }
    }
    & .li {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      width: 100%;
      padding-bottom: 1.2rem;
    }
    & .divPrice {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }
    & .price {
      font-size: 1.2rem;
      font-weight: 700;
    }
    & .price2 {
      font-size: 0.8rem;
      color: #9b9b9b;
      font-style: italic;
    }
    & .name-inputs{
            padding: 0.5rem;
            
            & .input{
                width: 100%;
                margin: 5px 0;
                max-width: 18.75rem;
                padding: 0.5rem;
                border: 1px solid #848484;
                border-radius: 1rem;
            }
        }
  }
</style>
