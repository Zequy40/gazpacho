<?php
$query_DatosConsulta2 = sprintf("SELECT * FROM dblCarte WHERE cat=3");
$DatosConsulta2 = mysqli_query($con,  $query_DatosConsulta2) or die(mysqli_error($con));
$row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2);
$totalRows_DatosConsulta2 = mysqli_num_rows($DatosConsulta2);
if ($totalRows_DatosConsulta2 > 0) {  
    do { 
             ?>
     <div class="card-content_price">
         <ul>
             <li><?php echo $row_DatosConsulta2["title"];?></li>
             <li><b>€<?php echo number_format($row_DatosConsulta2["price"],2,",","");?></b></li>
         </ul>
     </div>

     <?php
    
       
} while ($row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2)); 
} 

?>