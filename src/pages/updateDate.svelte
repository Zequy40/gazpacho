
<script>
    import { onMount } from 'svelte';

    let storedTime = '';
    let newTime = '';

    let order = {};

    onMount(() => {
        loadOrderFromLocalStorage()
    });

    function updateOrderTime() {
        let orderFromStorage = JSON.parse(localStorage.getItem('orderDetails')) || {};
        orderFromStorage.date = newTime;
        localStorage.setItem('orderDetails', JSON.stringify(orderFromStorage));
        storedTime = newTime;
        alert('Nouvelle heure enregistrée!');
        window.location.href = '/validate';
    }
    function loadOrderFromLocalStorage() {
        if (typeof localStorage !== 'undefined') {
            let orderFromStorage = JSON.parse(localStorage.getItem('orderDetails')) || {};
            order = orderFromStorage;
            storedTime = order.date;
            console.log(storedTime);
        }
    }
    
    
</script>

<div class="container">
    <h2 class="h2">Modication de l'heure</h2>
    <div>
        <p class='p'>Heure actuelle saisie: {storedTime}</p>
    </div>
    <label>
        Nouvelle heure:
        <select bind:value={newTime}>
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
            <option value="20:00">20:00</option>
            <!-- Agrega más opciones de tiempo aquí -->
          </select>
    </label>
    <button class="btnEffacer" on:click={updateOrderTime}>Modifier heure</button>
</div>

<style>
    .container {
      max-width: 75rem;
      margin: auto;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      gap: 2rem;
      margin-bottom: 2rem;
    
      
      & .h2 {
        font-size: 1.4rem;
        font-weight: 700;
      }
      & hr {
        margin: 1rem 0;
        max-width: 90%;
      }
    
   
      & .p {
        font-size: 1.2rem;
        font-weight: 700;
      }
      & select {
        padding: 0.5rem;
        border-radius: 1rem;
        border: 1px solid #ccc;
      }
      & .btnEffacer {
        max-width: 9.375rem;
        background: #5fff74;
        color: rgb(73, 73, 73);
        padding: 5px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 1.2rem;
      }
    }
  </style>
