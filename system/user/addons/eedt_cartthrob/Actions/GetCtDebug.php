<?php

namespace DebugToolbar\CartThrob\Actions;

use ExpressionEngine\Service\Addon\Controllers\Action\AbstractRoute;

class GetCtDebug extends AbstractRoute
{
    public function process()
    {
        $panel = ee('eedt_cartthrob:PanelService');
        echo ee()->load->view('eedt_cartthrob', $panel->compilePanelVars(), true);
        exit;
    }
}
