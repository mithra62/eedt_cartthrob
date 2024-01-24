<?php

namespace DebugToolbar\CartThrob\Services;
class PanelService
{
    protected array $cart_info = [];

    /**
     * @param $value
     * @return mixed|string
     */
    protected function extractInventory($value): string
    {
        if ($value == PHP_INT_MAX) {
            $value = "unlimited";
        }

        return $value;
    }

    /**
     * @param $data
     * @param $item
     * @return string
     */
    protected function extractPrice($data, $item): string
    {
        if ($data['price'] == '') {
            $field_id = ee()->cartthrob->store->config('product_channel_fields', $item->meta('channel_id'), 'price');
            $field_name = "channel entry";
            if (ee()->cartthrob->store->config('product_channel_fields', $item->meta('channel_id'), "global_price")) {
                $field_name = "globally set";
            } else if ($field_id) {
                $field_name = ee()->cartthrob_field_model->get_field_name($field_id) . " field";
            }

            $value = $item->price() . " (uses " . $field_name . " price)";
        } else {
            $value = $data['price'] . " (uses customer price)";
        }

        return $value;
    }

    /**
     * @return array
     */
    protected function compileItems(): array
    {
        ee()->load->model('cartthrob_field_model');
        $items = ee()->cartthrob->cart->items_array();
        foreach ($items as $key => $item) {
            $items[$key]['price'] = $this->extractPrice($item, ee()->cartthrob->cart->item($key));

            if (!empty($item['inventory'])) {
                $items[$key]['inventory'] = $this->extractInventory($item['inventory']);
            }

            $items[$key]['is_shippable'] = false;
            $items[$key]['is_taxable'] = false;
            if (ee()->cartthrob->cart->item($key)->is_shippable()) {
                $items[$key]['is_shippable'] = true;
            }

            if (ee()->cartthrob->cart->item($key)->is_taxable()) {
                $items[$key]['is_taxable'] = true;
            }
        }

        return $items;
    }

    /**
     * @param array $info
     * @return array
     */
    protected function compileCoupons(array $info): array
    {
        $return = [];
        if (isset($info['coupon_codes']) && is_array($info['coupon_codes'])) {
            foreach ($info['coupon_codes'] as $coupon) {

                $code = ee()->cartthrob->get_coupon_code_data($coupon);
                if ($code) {
                    $return[] = array_merge(['code' => $coupon], $code);
                }
            }
        }

        return $return;
    }

    /**
     * @return array
     */
    protected function getCartInfo()
    {
        if (!$this->cart_info) {
            $this->cart_info = ee()->cartthrob->cart->toArray();
        }

        return $this->cart_info;
    }

    /**
     * @return array
     */
    public function compilePanelVars()
    {

        $info = ee()->cartthrob->cart->toArray();
        $items = $this->compileItems();
        $discount = ee()->cartthrob->cart->discount();
        $vars = [
            'general' => [
                'total' => ee()->cartthrob->cart->total(),
                'subtotal' => ee()->cartthrob->cart->subtotal(),
                'shipping' => ee()->cartthrob->cart->shipping(),
                'shipping_plus_tax' => ee()->cartthrob->cart->shipping_plus_tax(),
                'discount' => $discount,
                'taxable_subtotal' => ee()->cartthrob->cart->taxable_subtotal(),
                'tax' => ee()->cartthrob->cart->tax(),
                'shippable_subtotal' => ee()->cartthrob->cart->shippable_subtotal(),
                'total_items' => count($items),
                'weight' => ee()->cartthrob->cart->weight(),
                'shippable_weight' => ee()->cartthrob->cart->shippable_weight(),
            ],
            'items' => $items,
            'shipping' => [
                'total' => ee()->cartthrob->cart->shipping(),
                'shipping_plus_tax' => ee()->cartthrob->cart->shipping_plus_tax(),
                'option' => ee()->cartthrob->cart->shipping_option(),
                'shipping_tax' => ee()->cartthrob->cart->shipping_tax(),
                'plugin' => ee()->cartthrob->store->config('shipping_plugin'),
            ],
            'tax' => [
                'total' => ee()->cartthrob->cart->tax(),
                'taxable_subtotal' => ee()->cartthrob->cart->taxable_subtotal(),
                'plugin' => ee()->cartthrob->store->config('tax_plugin'),
                'shipping_tax' => ee()->cartthrob->cart->shipping_tax(),
            ],
            'meta' => $info['meta'],
            'customer_info' => $info['customer_info'],
            'order' => $info['order'],
            'coupon_codes' => $this->compileCoupons($info),
            'discounts' => ee()->cartthrob->get_discount_data(),
            'custom_data' => ee()->cartthrob->cart->custom_data(),
            'session' => ee()->cartthrob_session->toArray(),
        ];

        if (ee('ee_debug_toolbar:ToolbarService')->isAddonInstalled('cartthrob_gift_certificates')) {
            $vars['gift_certificates'] = ee('eedt_cartthrob:GiftCertificateService')->compilePanel($info);
        }

        if (ee('ee_debug_toolbar:ToolbarService')->isAddonInstalled('cartthrob_fees')) {
            $vars['fees'] = ee('eedt_cartthrob:FeesService')->compilePanel($info);
        }

        return $vars;
    }
}