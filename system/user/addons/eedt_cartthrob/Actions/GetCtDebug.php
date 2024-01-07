<?php

namespace DebugToolbar\CartThrob\Actions;

use ExpressionEngine\Service\Addon\Controllers\Action\AbstractRoute;

class GetCtDebug extends AbstractRoute
{
    public function process()
    {
        ee()->load->add_package_path(PATH_THIRD . 'cartthrob/');

        $vars['session'] = ee()->cartthrob_session->toArray();
        $vars = array_merge($vars, ee()->cartthrob->cart->toArray());
        $vars['shippable_subtotal'] = ee()->cartthrob->cart->shippable_subtotal();
        $vars['tax'] = ee()->cartthrob->cart->tax();
        $vars['taxable_subtotal'] = ee()->cartthrob->cart->taxable_subtotal();
        $vars['discount'] = ee()->cartthrob->cart->discount();
        $vars['shipping'] = ee()->cartthrob->cart->shipping();
        $vars['subtotal'] = ee()->cartthrob->cart->subtotal();
        $vars['total'] = ee()->cartthrob->cart->total();
        $vars['shipping_info'] = ee()->cartthrob->cart->shipping_option();
        uksort($vars, 'strnatcasecmp');

        $vars['content'] = $this->format_debug($vars);
        echo ee()->load->view('eedt_cartthrob', $vars, true);
        exit;
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
