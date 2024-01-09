<div style="float:left"><h4><?php //echo lang('eedt_cartthrob_module_name'); ?></h4></div>

<div style="float:right">
    <a href="javascript:;" id="EEDebug_cartthrob_general" class="EEDebug_actions">General</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_discounts" class="EEDebug_actions">Discounts</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_shipping" class="EEDebug_actions">Shipping</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_taxes" class="EEDebug_actions">Taxes</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_payment" class="EEDebug_actions">Payment</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_session" class="EEDebug_actions">Session</a>
</div>

<br clear="all"/>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>General Details</h4>
    <table style='width:100%;'>
        <?php foreach($general AS $key => $value): ?>
        <tr>
            <td style="width:30%"><?=$key;?></td>
            <td><?=$value;?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</div>

<br>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>Session</h4>
    <table style='width:100%;'>
        <?php foreach($session AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<br>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>Customer Info</h4>
    <table style='width:100%;'>
        <?php foreach($customer_info AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<br>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>Cart Meta</h4>
    <table style='width:100%;'>
        <?php foreach($meta AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<br>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>Shipping Details</h4>
    <table style='width:100%;'>
        <?php foreach($shipping AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<br>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>Tax Details</h4>
    <table style='width:100%;'>
        <?php foreach($tax AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<br>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_discounts">

    <h4>Items Details (<?php echo count($items); ?>)</h4>
    <table style='width:100%;'>
        <?php foreach($items AS $item): ?>
            <?php foreach($item AS $key => $value): ?>
                <tr>
                    <td style="width:30%"><?=$key;?></td>
                    <td>
                        <?php
                        if(is_array($value)) {
                            echo eedt_output_array($value, 'N/A');
                        } else {
                            echo $value;
                        }
                        ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>

</div>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_shipping" >bvcx</div>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_taxes" style="display: none;">hgtd</div>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_payment" style="display: none;">uytr</div>

<fieldset id="ct_debug_info" style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#ffbc9f ">
<?php echo $content; ?>
</fieldset>