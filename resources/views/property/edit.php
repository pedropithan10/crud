<h1>Formulário de Edição :: Imóveis</h1>

<?php
$property = $property[0];
?>

<form action="<?= url('/imoveis/update', ['id' => $property->id]);?>" method="post">

<?=csrf_field(); ?>
<?=method_field('PUT'); ?>


<label for="title">Título do Imóvel</label>
<input type="text" name="title" id="title" value=" <?= $property->title; ?>">

<br/>

<label for="title">Descrição</label>
<textarea name="descripition" id="descripition" cols="30" rows="10" ><?= $property->descripition; ?></textarea>

<br/>

<label for="rental_price">Valor de Locaçao</label>
<input type="text" name="rental_price" id="rental_price" value="<?= $property->rental_price; ?>">

<br/>

<label for="sale_price">Valor de Venda</label>
<input type="text" name="sale_price" id="sale_price" value="<?= $property->sale_price; ?>">

<br/>

<button type="submit">Atualizar imóvel</button>

</form>