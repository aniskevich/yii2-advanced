<?php
    use yii\helpers\Html;
?>
<div id="chat"></div>
<div id="response"></div>
<div class="row">
    <div class="col-9">
        <?= Html::textInput('message', '', ['id'=>'message','class'=>'form-control'])?>
    </div>
    <div class="col-3">
        <?= Html::button('send', ['id'=>'send', 'class'=>'btn btn-primary'])?>
    </div>
</div>
<?= Html::hiddenInput('username', $username, ['class'=>'js-username'])?>

<div>
    <h3>History</h3>
    <div id="history"></div>
    <?= Html::button('load story', ['id'=>'load', 'class'=>'btn btn-primary'])?>
</div>
