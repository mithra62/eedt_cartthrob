<?php

namespace DebugToolbar\CartThrob\Actions;

use DebugToolbar\Actions\AbstractAction;

class GetCtDebug extends AbstractAction
{
    public function processDebug()
    {
        if($this->toolbar->isAddonInstalled('cartthrob')) {

            loadCartThrobPath();
            if (!ee('ee_debug_toolbar:ToolbarService')->canViewToolbar()) {
                return;
            }

            $panel = ee('eedt_cartthrob:PanelService');
            echo ee()->load->view('eedt_cartthrob', $panel->compilePanelVars(), true);
            exit;
        } else {
            echo "CartThrob isn't installed!";
        }
    }
}
