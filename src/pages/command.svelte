<script>
    let products = [
        { id: 1, name: 'Menu Kebab',description:'menu complet avec frite et boissons', price: 9 },
        { id: 2, name: 'Menu Burguer', description:'menu complet avec frite et boissons',price: 8 },
        { id: 3, name: 'Menu Frit',description:'menu complet avec frite et boissons', price: 5 },
        { id: 4, name: 'Cubano',description:'menu complet avec frite et boissons', price: 8 },
        { id: 5, name: 'Gazpacho',description:'menu complet avec frite et boissons', price: 4 },
        { id: 6, name: 'Pastelão',description:'menu complet avec frite et boissons', price: 6 },
        { id: 7, name: 'Poulet Croustillant',description:'menu complet avec frite et boissons', price: 6 },
        { id: 8, name: 'Poulet Rôti',description:'menu complet avec frite et boissons', price: 10 },
        { id: 9, name: 'Pieces De Poulet Bbq',description:'menu complet avec frite et boissons', price: 8 },
        { id: 10, name: 'Kebab Seule',description:'menu complet avec frite et boissons', price: 6 },
        { id: 11, name: 'Burger Seule',description:'menu complet avec frite et boissons', price: 6.5 },
        { id: 12, name: 'Salade Composée',description:'menu complet avec frite et boissons', price: 8 },
        { id: 13, name: 'Salade De Poulpe',description:'menu complet avec frite et boissons', price: 8 },
        { id: 14, name: 'Américain',description:'menu complet avec frite et boissons', price: 8 },
        { id: 15, name: 'Churros',description:'menu complet avec frite et boissons', price: 2 },
        // Agrega más productos aquí
    ];

    let cart = [];

    function addToCart(product) {
        let item = cart.find(item => item.id === product.id);
        if (item) {
            item.quantity += 1;
            item.totalPrice += product.price;
        } else {
            cart.push({ ...product, quantity: 1, totalPrice: product.price });
        }
        cart = cart;
    }

    function removeFromCart(product) {
        let index = cart.findIndex(item => item.id === product.id);
        if (index !== -1) {
            cart.splice(index, 1);
            cart = cart;
        }
    }

    let total = 0;

    $: {
        total = cart.reduce((acc, item) => acc + item.totalPrice, 0);
    }
   

    function submitOrder() {
        let orderTime = document.getElementById('orderTime').value;
        if (!orderTime) {
            alert('Por favor, selecciona la hora del pedido.');
            return;
        }

        let order = {
            cart,
            total,
            orderTime
        };

        localStorage.setItem('order', JSON.stringify(order));
        alert('Pedido guardado en localStorage.');
        vaciarCart();
    }
    function vaciarCart(){
        cart = [];
        cart = cart;
    }
  
</script>


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
        & .btn{
            max-width: 9.375rem;
            background-color: #4CAF50;
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
    }
</style>


<div class="container">
    <div class="products">
        <h2>Plats</h2>
        <ul>
            {#each products as product}
                <li>
                    
                    <button on:click={() => addToCart(product)}>
                    <div class="containerProduct">
                        {product.name} - {product.price}€
                        <p>{product.description}</p>
                    </div></button>
                </li>
            {/each}
        </ul>
    </div>

    <div class="cart">
        <h2>Panier</h2>
        <ul>
            {#each cart as item (item.id)}
                <li>
                    {item.name} - {item.totalPrice}€ (Quantités: {item.quantity})
                    <button on:click={() => removeFromCart(item)}>Effacer</button>
                </li>
            {/each}
        </ul>
        <p>Total: {total}€</p>
        <select id="orderTime">
            <option value="">Seleccionez l'heure de la commande:</option>
            <option value="10:00">10:00</option>
            <option value="11:00">11:00</option>
            <option value="12:00">12:00</option>
            <!-- Agrega más opciones de tiempo aquí -->
        </select>
        <button class="btn" on:click={submitOrder}>Envoyer</button>
    </div>
</div>