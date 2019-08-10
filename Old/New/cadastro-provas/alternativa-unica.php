<?php 
    $quantidade = $_GET['qtdUnica'];
?>

<div class="col s12">
    <p class="justificar title prove-text text-vermelho">Selecione a alternativa verdadeira</p>
</div>
<input type="hidden" name="qtdAltUnica" value="<?php echo $quantidade ?>">

<?php

    for ($i = 0; $i < $quantidade; $i++) {

?>
    <div class="col s10">    
        <div class="input-field">
            <input id="alternativaUnica-<?php echo $i + 1; ?>" type="text" class="validate">
            <label for="alternativaUnica-<?php echo $i + 1; ?>">Alternativa <?php echo $i + 1 ?></label>
        </div>
    </div>
    <div class="col s2" style="margin-top: 1.5rem;">
        <label>
            <input name="alternativaUnica-correta-<?php echo $i+1; ?>" class="with-gap" type="radio" value=<?php echo $i + 1?> />
            <span></span>
        </label>
    </div>

<?php } ?>