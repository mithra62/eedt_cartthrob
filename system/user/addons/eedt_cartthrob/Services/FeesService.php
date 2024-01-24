<?php

namespace DebugToolbar\CartThrob\Services;

class FeesService
{
    public function compilePanel(array $cart): array
    {
        ee()->cartthrob->cart->total();

        $fees = ee()->cartthrob->cart->meta('cartthrob_fees');
        $return = [];
        if (!empty($fees)) {
            foreach ($fees as $fee) {
                $fee = $fee->toArray();
                $return[] = $fee;
            }
        }

        return $return;
    }
}