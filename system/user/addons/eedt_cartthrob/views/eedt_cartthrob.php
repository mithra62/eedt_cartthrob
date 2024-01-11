<div style="float:left"><h4><?php //echo lang('eedt_cartthrob_module_name'); ?></h4></div>
<?php

//ee()->load->helpers('eedt_output');
?>
<div style="float:right" id="EEDebug_cartthrob_nav_items">
    <a href="javascript:;" id="EEDebug_cartthrob_general" class="EEDebug_actions flash">General</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_discounts" class="EEDebug_actions">Discounts</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_customer_info" class="EEDebug_actions">Customer</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_cart_items" class="EEDebug_actions">Items (<?php echo count($items); ?>)</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_advanced" class="EEDebug_actions">Advanced</a>
</div>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>General Details</h4>
    <br>
    <table style='width:100%;'>
        <?php foreach($general AS $key => $value): ?>
        <tr>
            <td style="width:30%"><?=$key;?></td>
            <td><?=$value;?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <h4>Shipping Details</h4>
    <table style='width:100%;'>
        <?php foreach($shipping AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
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

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_discounts" style="display: none">
    <h4>Discounts</h4>
    <br>
    <?php if($discounts): ?>
    <table style='width:100%;'>
        <?php foreach($discounts AS $key => $discount): ?>
            <?php foreach($discount AS $key => $value): ?>
                <tr>
                    <td style="width:30%"><?=$key;?></td>
                    <td>
                        <?php
                        if(is_array($value)) {
                            echo ee('ee_debug_toolbar:OutputService')->outputArray($value, 'N/A');
                        } else {
                            echo $value;
                        }
                        ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>

    <?php else: ?>
        <strong>No Discounts Applied</strong><br>
    <?php endif; ?>

    <br>
    <h4>Coupons</h4><br>
    <?php if($coupon_codes): ?>
    <table style='width:100%;'>
        <?php foreach($coupon_codes AS $coupon): ?>
            <?php foreach($coupon AS $key => $value): ?>
                <tr>
                    <td style="width:30%"><?=$key;?></td>
                    <td>
                        <?php
                        if(is_array($value)) {
                            echo ee('ee_debug_toolbar:OutputService')->outputArray($value, 'N/A');
                        } else {
                            echo $value;
                        }
                        ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>

    <?php else: ?>
        <strong>No Coupons Applied</strong><br>
    <?php endif; ?>
</div>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_advanced" style="display: none">

    <h4>Session</h4>
    <br>
    <table style='width:100%;'>
        <?php foreach($session AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <h4>Cart Meta</h4>
    <table style='width:100%;'>
        <?php foreach($meta AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if($custom_data): ?>
    <br>
    <h4>Custom Data</h4>
    <table style='width:100%;'>
        <?php foreach($custom_data AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

</div>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_customer_info" style="display: none">

    <h4>Customer Info</h4>
    <br>
    <table style='width:100%;'>
        <?php foreach($customer_info AS $key => $value): ?>
            <tr>
                <td style="width:30%"><?=$key;?></td>
                <td><?=$value;?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_cart_items" style="display: none">

    <h4>Items Details (<?php echo count($items); ?>)</h4>
    <br>
    <?php if($items): ?>
        <?php foreach($items AS $item): ?>
            <table style='width:100%;'>
            <?php foreach($item AS $key => $value): ?>
                <tr>
                    <td style="width:30%"><?=$key;?></td>
                    <td>
                        <?php
                        if(is_array($value)) {
                            echo ee('ee_debug_toolbar:OutputService')->outputArray($value, 'N/A');
                        } else {
                            echo $value;
                        }
                        ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        <hr><br clear="all">
        <?php endforeach; ?>


    <?php else: ?>
        <strong>No Items In Cart</strong><br>
    <?php endif; ?>
</div>