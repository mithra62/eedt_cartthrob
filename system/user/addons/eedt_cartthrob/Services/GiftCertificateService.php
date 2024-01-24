<?php

namespace DebugToolbar\CartThrob\Services;

use CartThrob\GiftCertificates\Traits\TemplateTrait;

class GiftCertificateService
{
    use TemplateTrait;

    public function compilePanel(array $cart): array
    {
        return [
            'general' => [
                'applied_amount' => (float)$this->inCart(false),
                'balance_amount' => (float)$this->inCart(),
                'cart_total_minus_gc' => $this->CartTotalMinusGiftCertificates(),
                'total_gift_certificates' => ee('cartthrob_gift_certificates:GiftCertificatesService')->getMemberTotal(ee()->session->userdata('member_id')),
                'active_gift_certificates' => $codes = (array)ee()->cartthrob->cart->meta('gift_certificates'),
                'available_gift_certificates' => $this->getMemberCerts(ee()->session->userdata('member_id')),
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

    /**
     * @param int $member_id
     * @return array
     */
    public function getMemberCerts(int $member_id): array
    {
        $query = ee()->db->select()->from('cartthrob_gift_certificates')
            ->where(['member_id' => $member_id])
            ->where('balance >', 0)
            ->get();

        $return = [];
        if ($query) {
            foreach ($query->result_array() as $key => $cert) {
                $return[] = [
                    'code' => $cert['gift_certificate_code'],
                    'balance' => $cert['balance'],
                    'amount' => $cert['amount'],
                ];
            }
        }

        return $return;
    }
}