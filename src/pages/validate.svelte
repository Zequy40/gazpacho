<script>
    import { onMount } from 'svelte';
    import jsPDF from 'jspdf';

    let order = {};
    let total = 0;
    let errorMessage = '';

    onMount(() => {
        loadOrderFromLocalStorage();
    });

    function loadOrderFromLocalStorage() {
        if (typeof localStorage !== 'undefined') {
            let orderFromStorage = JSON.parse(localStorage.getItem('orderDetails')) || {};
            order = orderFromStorage;
            calculateTotal();
        }
    }

    function calculateTotal() {
        if (order.product && Array.isArray(order.product)) {
            total = order.product.reduce((acc, item) => acc + (item.quantity * item.price), 0);
        } else {
            total = 0;
        }
    }
    function validateOrderDates(){
        const orderDateTimeStr = order.orderCommande; //  order.orderCommande es una cadena en formato "DD/MM/YYYY, HH:mm:ss"
    const orderTimeOnly = order.date; //  order.date es una cadena en formato "HH:mm"
    
    // Crear un objeto Date a partir de orderCommande
    const [datePart, timePart] = orderDateTimeStr.split(', ');
    const [day, month, year] = datePart.split('/');
    const orderDate = new Date(year, month - 1, day); // Crear el objeto Date con la fecha
    
    // Separar la hora y los minutos de order.date
    const [hour, minute] = orderTimeOnly.split(':');
    
    // Establecer la hora y los minutos en la fecha del pedido
    orderDate.setHours(hour, minute, 0, 0); // La hora, los minutos, segundos y milisegundos
    
    // Obtener el tiempo actual
    const currentTime = new Date();

    // Comparar las fechas
    if (orderDate <= currentTime) {
        const errorMessage = "Veuillez sélectionner une heure future. Heure de la commande: " + orderDate + ", Heure actuelle: " + currentTime;
        console.log(errorMessage); // O utilizar cualquier método para mostrar el mensaje de error
        return false;
    }

    return true;
    }

    function handleUpdate(name) {
        if (validateOrderDates()) {
            
            // Proceder con la actualización o generación del PDF
            alert("Commande confirmée")
            updateOrder(name)
            generatePDF();
        }
    }

    function generatePDF() {
    if (!order || !order.product) return;

    const doc = new jsPDF();

    doc.text(`Gazpacho FoodTruck`, 10, 10);
    doc.text(`Résumé de votre commande`, 10, 20);
    doc.text(`Nom: ${order.name}`, 10, 30);
    doc.text(`Prénom: ${order.lastName}`, 10, 40);
    doc.text(`Heure pour récupérer la commande: ${order.date}`, 10, 50);

    let yPosition = 60;
    order.product.forEach((item, index) => {
      doc.text(
        `${index + 1}. ${item.title} - Prix: ${item.price}€ 
        Qté: ${item.quantity} 
        SubTotal: ${item.totalPrice}€`,
        20,
        yPosition
      );
      yPosition += 30;
    });

    doc.text(`Total de l'achat: ${total}€`, 10, yPosition + 10);
    doc.text(`Commandé le: ${order.orderCommande}`, 10, yPosition + 20);

    doc.save('JustificatifCommande.pdf');
   
    clearLocalStorage()
      
  }
  function clearLocalStorage() {
        if (typeof localStorage !== 'undefined') {
            localStorage.removeItem('orderDetails');
            loadOrderFromLocalStorage();
            window.location.href = '/';
        }
    }
    function updateOrder(commandNumber) {
        fetch(`https://gazpacho.fr/_admin/api.php/?actualizar=${commandNumber}`, {
        method: 'PUT'
    })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((datosRespuesta) => {
                
              
            })
            .catch(console.log);
            
    }
    function removeOrder(commandNumber) {
        fetch(`https://gazpacho.fr/_admin/api.php/?borrar=${commandNumber}`, {
        method: 'DELETE'
    })
            .then(response => {
                console.log(response);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((datosRespuesta) => {
                clearLocalStorage();
                alert('Commande supprimée avec succès');
            })
            .catch(console.log);
    }
</script>

<div class="container">
    <div class="cart">
        <h2 class="h2">Commande</h2>
        <hr>
        <ul>
            {#if order.product && Array.isArray(order.product)}
                {#each order.product as item (item.idCarte)}
                <li class="li">
                    <div class="divPrice">
                      <p class="price">{item.title}</p>
                      <p class="price">{item.totalPrice}€</p>
                    </div>
                    <div class="divPrice2">
                      <p class="price2">Qté: {item.quantity}</p>
                      <p class="price2">Prix unitaire: {item.price}€</p>
          
                     
                    </div>
                  </li>
                {/each}
            {:else}
                <p>Aucune commande en cours.</p>
            {/if}
        </ul>
        {#if order.total}
        <div class="containP">
            <p class="p1">Total: </p>
            
        <p class="p">{order.total}€</p>
    
        </div>{/if}
        {#if order.product}
        <div class="name-inputs">
            
            <h2>Données de la commande:</h2>
            <p class='parr'>Commandé par: {order.name}</p>
            <p class='parr'>Prenom: {order.lastName}</p>
            <p class='parr'>Heure pour récupérer la commande: {order.date}</p>
            <p class='parr'>Commandé le: {order.orderCommande}</p>
        </div>
        <button class='btn2' on:click={() => handleUpdate(order.commandNumber)}>Imprimer et Enregistrer Justificatif</button>
        <button class='btn2 remove' on:click={() => removeOrder(order.commandNumber)}>Eliminer Commande</button>
        {#if errorMessage}
            <p class="error">{errorMessage}</p>
        {/if}
        <h3 class='h3'><span class='span'>*Attention important:</span><br>
            Appuyer sur le button pour garder votre reçu de la commande et le montrer a l'heure d'aller cherche votre commande.<br><span class="underline font-semibold">Tant que vous n'imprimez pas la commande, votre commande ne seras pas valider et donc pas préparé.</span><br> Sans ce justificatifs on ne seras pas dans l'obligation de remettre votre commande. <br>
            Nous n'envoyons pas de mail ni sms de confirmation de votre commande, de lá l'interêt de garder le justificatif.
        </h3>
        
    {/if}
    
        
        
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
        & .btn2{
            max-width: 20rem;
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
        & .remove{
            background-color: #f0352e;
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
    & .divPrice2 {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
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
    & .error {
        color: red;
        font-weight: bold;
    }
    & .name-inputs{
            padding: 0.5rem;
            
            & .parr{
                width: 100%;
                margin: 5px 0;
                max-width: 18.75rem;
                padding: 0.5rem;
                border-bottom: 1px solid #848484;
                
            }
        }
        
        & .h3{
            font-size: 1rem;
            font-style: italic;
            border: 1px solid #4d4d4d;
            border-radius: 1rem;
            padding: 1rem;
            & .span{
            text-transform: uppercase;
            text-decoration: underline;
            font-size: 1.3rem;
            font-weight: 800;
            font-style: italic;
        }
    }
        
    }
</style>

