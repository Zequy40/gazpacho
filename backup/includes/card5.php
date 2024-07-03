<?php
$query_DatosConsulta2 = sprintf("SELECT * FROM dblCarte");
$DatosConsulta2 = mysqli_query($con,  $query_DatosConsulta2) or die(mysqli_error($con));
$row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2);
$totalRows_DatosConsulta2 = mysqli_num_rows($DatosConsulta2);
if ($totalRows_DatosConsulta2 > 0) {  
    do { 
             ?>

<div class="menu__mobile-section2">
               
               <ul class="text-menu2">
                   <li><?php echo $row_DatosConsulta2["title"]?> |
                       €<?php echo number_format($row_DatosConsulta2["price"],2,",","");?>
                       <p><?php echo $row_DatosConsulta2["parr"]?></p>
                   </li>
                   
               </ul>
           </div>
                    
                <?php
    
       
} while ($row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2)); 
} 
?>