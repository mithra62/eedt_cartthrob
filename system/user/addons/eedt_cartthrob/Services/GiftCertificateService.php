<?php

namespace DebugToolbar\CartThrob\Services;

use CartThrob\GiftCertificates\Traits\TemplateTrait;

class GiftCertificateService
{
    use TemplateTrait;

    public function compilePanel(): array
    {
        return [
            'general' => [
                'applied_amount' => $this->inCart(false),
                'balance_amount' => $this->inCart(),
                'cart_total_minus_gift_certificates' => $this->CartTotalMinusGiftCertificates(),
            ],
        ];
    }

    public function CartTotalMinusGiftCertificates()
    {
        $total = ee()->cartthrob->cart->total();

        ee()->load->helper('array');

        $giftCertificates = ee('cartthrob_gift_certificates:CodesService')->getCartCodes();
        if (empty($giftCertificates)) {
            return $total;
        }

        $giftCertificates = ee('Model')
            ->get('cartthrob_gift_certificates:GiftCertificate')
            ->fields('balance')
            ->filter('gift_certificate_code', 'IN', $giftCertificates)
            ->filter('balance', '>', 0)
            ->filter('status', 'open')
            ->all();

        foreach ($giftCertificates as $giftCertificate) {
            $total = ($giftCertificate->balance > $total) ? 0 : $total - $giftCertificate->balance;
        }

        if ($total < 0) {
            $total = 0;
        }

        return $total;
    }
}