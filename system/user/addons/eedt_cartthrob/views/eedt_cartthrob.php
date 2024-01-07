<h4><?php echo lang('cartthrob_profiler_data'); ?></h4>

<div style="float:right">
    <a href="javascript:;" id="EEDebug_cartthrob_general" class="EEDebug_actions">General</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_discounts" class="EEDebug_actions">Discounts</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_shipping" class="EEDebug_actions">Shipping</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_taxes" class="EEDebug_actions">Taxes</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_payment" class="EEDebug_actions">Payment</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_session" class="EEDebug_actions">Session</a>
</div>
<fieldset id="ct_debug_info" style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#ffbc9f ">
<?php echo $content; ?>
</fieldset>