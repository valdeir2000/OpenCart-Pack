<h2><?php echo $text_instruction; ?></h2><br />
<h3><?php echo $text_instruction2; ?></h3><br />
<p><?php echo $text_payment; ?></p>
<div class="buttons">
  <div class="pull-right">
    <a id="button-confirm" class="btn btn-primary" href="index.php?route=payment/boleto_itau/callback&order_id=<?php echo $idboleto; ?>" target="_blank">
        <span><?php echo $button_confirm; ?></span>
    </a>
  </div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').on('click', function() {
    $.ajax({
        type: 'get',
        url: 'index.php?route=payment/boleto_itau/confirm',
        cache: false,
        beforeSend: function() {
            $('#button-confirm').button('loading');
        },
        complete: function() {
            $('#button-confirm').button('reset');
        },
        success: function() {
            location = '<?php echo $continue; ?>';
        }
    });
});
//--></script>
