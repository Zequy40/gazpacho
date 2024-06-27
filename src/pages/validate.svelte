<script>
    import { onMount } from 'svelte';

    let order = {};
    let total = 0;
    let name = '';
    let lastName = '';

    onMount(() => {
        loadOrderFromLocalStorage();
    });

    function loadOrderFromLocalStorage() {
        if (typeof localStorage !== 'undefined') {
            let orderFromStorage = JSON.parse(localStorage.getItem('order')) || {};
            order = orderFromStorage;
            calculateTotal();
        }
    }

    function calculateTotal() {
        if (order.cart && Array.isArray(order.cart)) {
            total = order.cart.reduce((acc, item) => acc + (item.quantity * item.price), 0);
        } else {
            total = 0;
        }
    }

    function removeFromCart(item) {
        if (order.cart && Array.isArray(order.cart)) {
            order.cart = order.cart.filter(i => i.idCarte !== item.idCarte);
            order.orderTime = ""
            order.total = ""
            order.cart = []
            if (typeof localStorage !== 'undefined') {
                localStorage.setItem('order', JSON.stringify(order));
            }
            calculateTotal();
        }
    }

    function submitName() {
        // Validar que se haya ingresado un nombre sin espacio
        if (!name.trim()) {
            alert('Veuillez mettre votre nom pour la commande');
            return;
        }

        // Agregar nombre y apellido al objeto order
        order.name = name;
        order.lastName = lastName;
        calculateTotal()

        // Aquí deberías hacer la solicitud POST al backend
        // Simulación de solicitud POST (reemplazar con tu lógica de backend real)
        console.log('Datos a enviar al backend:', order);
        if (order.cart && Array.isArray(order.cart)) {
            localStorage.removeItem('order');
            if (typeof localStorage !== 'undefined') {
                localStorage.setItem('order', JSON.stringify(order));
            }
            calculateTotal();
            cartUpdated = !cartUpdated; // Actualiza la variable para forzar la actualización de la interfaz
        }
        alert('Orden enviada correctamente');
        localStorage.removeItem('order');
    }
</script>

<div class="container">
    <div class="cart">
        <h2 class="h2">Commande</h2>
        <hr>
        <ul>
            {#if order.cart && Array.isArray(order.cart)}
                {#each order.cart as item (item.idCarte)}
                    <li>
                        <p>{item.title} - {item.quantity} x {item.price}€ = {item.totalPrice}€</p>
                        <button on:click={() => removeFromCart(item)} class="btnEffacer">Effacer</button>
                    </li>
                {/each}
            {:else}
                <p>Le panier est vide.</p>
            {/if}
        </ul>
        
        <div class="containP">
            <p class="p1">Total: </p>
            {#if order.total}
        <p class="p">{order.total}€</p>
    {/if}
        </div>
        
        <div class="name-inputs">
            <input class="input" type="text" placeholder="Nom" bind:value={name}>
            <input class="input" type="text" placeholder="Prénom" bind:value={lastName}>
        </div>
        
        <button class="btn" on:click={submitName}>Envoyer</button>
    </div>
</div>

<style>
    .container {
        max-width: 75rem;
        margin: auto;
        display: flex;
        justify-content: space-between;
    }

   
    .cart {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
        & .btn{
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
        & .h2{
            font-size: 1.4rem;
            font-weight: 700;
        }
        & .p{
            font-size: 1.2rem;
            font-weight: 700;
        
        }
        & .p1{
            font-size: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
        
        }
        & .containP{
            display: flex;
            justify-content: space-between;
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
        & li{
            display:flex; 
            justify-content:flex-start;
            align-items: center;
            gap: 2rem;
            width: 100%;
            & .btnEffacer{
            max-width: 32rem;
            background-color: #f0522e;
            border: none;
            color: white;
            padding: 5px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 0.8rem;
        
        }
        }
        
    }
</style>

