<h1>Página single</h1>

<?php

if(!empty($property)){
    
    foreach($property as $prop){
        ?>
        <h2>Título do Imóvel: <?=  $prop->title; ?></h2>

        <p>Descrição:<?= $prop->descripition; ?></p>

        <p>Valor de Locação:R$<?=  number_format($prop->rental_price, 2, ',', '.' ) ; ?></p>

        <p>Valor de Venda:R$<?=  number_format($prop->sale_price, 2, ',', '.' ) ; ?></p>
    <?php
    }
}


 
