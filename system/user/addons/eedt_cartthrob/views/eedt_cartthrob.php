<div style="float:left"><h4><?php //echo lang('eedt_cartthrob_module_name'); ?></h4></div>

<div style="float:right" id="EEDebug_cartthrob_nav_items">
    <a href="javascript:;" id="EEDebug_cartthrob_general" class=" flash">General</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_discounts" class="">Discounts</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_customer_info" class="">Customer</a>
    | <a href="javascript:;" id="EEDebug_cartthrob_cart_items" class="">Items (<?php echo count($items); ?>)</a>
    <?php if (!empty($gift_certificates)): ?>
        | <a href="javascript:;" id="EEDebug_cartthrob_gift_certificates" class="">Gift Certificates</a>
    <?php endif; ?>
    | <a href="javascript:;" id="EEDebug_cartthrob_advanced" class="">Advanced</a>
</div>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_general">

    <h4>General Details</h4>
    <br>
    <table style='width:100%;'>
        <?php foreach ($general as $key => $value): ?>
            <tr>
                <td style="width:30%"><?= $key; ?></td>
                <td><?= $value; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <h4>Shipping Details</h4>
    <table style='width:100%;'>
        <?php foreach ($shipping as $key => $value): ?>
            <tr>
                <td style="width:30%"><?= $key; ?></td>
                <td><?= $value; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <h4>Tax Details</h4>
    <table style='width:100%;'>
        <?php foreach ($tax as $key => $value): ?>
            <tr>
                <td style="width:30%"><?= $key; ?></td>
                <td><?= $value; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_discounts" style="display: none">
    <h4>Discounts</h4>
    <br>
    <?php if ($discounts): ?>
        <table style='width:100%;'>
            <?php foreach ($discounts as $key => $discount): ?>
                <?php foreach ($discount as $key => $value): ?>
                    <tr>
                        <td style="width:30%"><?= $key; ?></td>
                        <td>
                            <?php
                            if (is_array($value)) {
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
    <?php if ($coupon_codes): ?>
        <table style='width:100%;'>
            <?php foreach ($coupon_codes as $coupon): ?>
                <?php foreach ($coupon as $key => $value): ?>
                    <tr>
                        <td style="width:30%"><?= $key; ?></td>
                        <td>
                            <?php
                            if (is_array($value)) {
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
        <?php foreach ($session as $key => $value): ?>
            <tr>
                <td style="width:30%"><?= $key; ?></td>
                <td><?= $value; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <h4>Cart Meta</h4>
    <table style='width:100%;'>
        <?php foreach ($meta as $key => $value): ?>
            <tr>
                <td style="width:30%"><?= $key; ?></td>
                <td>
                    <?php
                    if (is_array($value)) {
                        echo ee('ee_debug_toolbar:OutputService')->outputArray($value);
                    } else {
                        echo $value;
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if ($custom_data): ?>
        <br>
        <h4>Custom Data</h4>
        <table style='width:100%;'>
            <?php
            foreach ($custom_data as $key => $value): ?>
                <tr>
                    <td style="width:30%"><?= $key; ?></td>
                    <td>
                        <?php
                        if (is_array($value)) {
                            echo ee('ee_debug_toolbar:OutputService')->outputArray($value);
                        } else {
                            echo $value;
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>

<div class="EEDebug_cartthrob_container EEDebug_cartthrob_customer_info" style="display: none">

    <h4>Customer Info</h4>
    <br>
    <table style='width:100%;'>
        <?php foreach ($customer_info as $key => $value): ?>
            <tr>
                <td style="width:30%"><?= $key; ?></td>
                <td><?= $value; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<div class="EEDebug_cartthrob_container EEDebug_cartthrob_cart_items" style="display: none">

    <h4>Items Details (<?php echo count($items); ?>)</h4>
    <br>
    <?php if ($items): ?>
        <?php foreach ($items as $item): ?>
            <table style='width:100%;'>
                <?php foreach ($item as $key => $value): ?>
                    <tr>
                        <td style="width:30%"><?= $key; ?></td>
                        <td>
                            <?php
                            if (is_array($value)) {
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

<?php if (!empty($gift_certificates)): ?>
    <div class="EEDebug_cartthrob_container EEDebug_cartthrob_gift_certificates" style="display: none">
        <h4>Gift Certificates</h4>
        <br>
        <table style='width:100%;'>
            <?php foreach ($gift_certificates['general'] as $key => $value): ?>
                <tr>
                    <td style="width:30%"><?= $key; ?></td>
                    <td><?= $value; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
