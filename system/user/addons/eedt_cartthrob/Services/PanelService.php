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

    protected function extractPrice($data, $item)
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

    protected function compileItems(): array
    {
        ee()->load->model('cartthrob_field_model');
        $items = ee()->cartthrob->cart->items_array();
        foreach ($items as $key => $item) {
            $items[$key]['price'] = $this->extractPrice($item, ee()->cartthrob->cart->item($key));
            $items[$key]['inventory'] = $this->extractInventory($item['inventory']);
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
        if(isset($info['coupon_codes']) && is_array($info['coupon_codes'])) {
            foreach($info['coupon_codes'] AS $coupon) {

                $code = ee()->cartthrob->get_coupon_code_data($coupon);
                if($code) {
                    $return[] = array_merge(['code' => $coupon], $code);
                }
            }
        }

        return $return;
    }

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

        return $vars;
    }

    protected function getCartInfo()
    {
        if (!$this->cart_info) {
            $this->cart_info = ee()->cartthrob->cart->toArray();
        }

        return $this->cart_info;
    }

    private function format_debug($data, $parent_key = null)
    {
        if (is_array($data)) {
            uksort($data, 'strnatcasecmp');
            $output = "<table style='width:100%;'>";
            foreach ($data as $key => $value) {
                $content = "";
                $output_key = $key;
                if (is_numeric($key)) {
                    $output_key = "Row ID: " . $key;
                }
                if (is_array($value)) {
                    $content .= $this->format_debug($value, $key);
                } else {
                    if ($key == "inventory" && $value == PHP_INT_MAX) {
                        $value = "unlimited";
                    }
                    if ($key == "price") {
                        if ($value == "" && $parent_key !== null) {
                            ee()->load->model('cartthrob_field_model');

                            echo $parent_key;
                            exit;
                            $item = ee()->cartthrob->cart->item($parent_key);
                            $field_id = ee()->cartthrob->store->config('product_channel_fields', $item->meta('channel_id'), $key);

                            $field_name = "channel entry";
                            if (ee()->cartthrob->store->config('product_channel_fields', $item->meta('channel_id'), "global_price")) {
                                $field_name = "globally set";
                            } else if ($field_id) {
                                $field_name = ee()->cartthrob_field_model->get_field_name($field_id) . " field";
                            }

                            $value = $item->price() . " (uses " . $field_name . " price)";
                        } else {
                            $value = $value . " (uses customer price)";
                        }
                    }
                    if ($key == "entry_id" && empty($value)) {
                        $value = "(dynamic item)";
                    }
                    $content .= htmlspecialchars($value);
                }
                $output .= "<tr><td style='padding:5px; vertical-align: top;color:#900;background-color:#ddd;'>" . $output_key . "&nbsp;&nbsp;</td><td style='padding:5px; color:#000;background-color:#ddd;'>" . $content . "</td></tr>\n";
            }
            $output .= '</table>';
        } else {
            $output = htmlspecialchars($data);
        }
        return $output;
    }
}