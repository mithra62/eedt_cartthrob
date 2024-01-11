<?php

namespace DebugToolbar\CartThrob\Extensions;

use DebugToolbar\Panels\Model;

class EeDebugToolbarAddPanel extends AbstractHook
{
    public function process(array $panels, array $view = [])
    {
        $panels = (ee()->extensions->last_call != '' ? ee()->extensions->last_call : $panels);
        if(REQ == 'CP') {
            //return $panels;
        }

        ee()->benchmark->mark('eedt_cartthrob_start');

        $vars['panel_fetch_url'] = $this->toolbar->getActionUrl('GetCtDebug', 'Eedt_cartthrob');
        $vars['theme_img_url'] = URL_THIRD_THEMES.'eedt_cartthrob/images/';
        $vars['theme_js_url'] = ee('ee_debug_toolbar:OutputService')->themeUrl() . 'eedt_cartthrob/js/';
        $vars['theme_css_url'] = ee('ee_debug_toolbar:OutputService')->themeUrl() . 'eedt_cartthrob/css/';

        $panels['cartthrob'] = new Model();
        $panels['cartthrob']->setName('cartthrob');
        $panels['cartthrob']->setButtonIcon($vars['theme_img_url'].'logs.png');
        $panels['cartthrob']->setButtonLabel(lang('CartThrob'));
        $panels['cartthrob']->setPanelFetchUrl($vars['panel_fetch_url']);
        $panels['cartthrob']->addJs($vars['theme_js_url'] . 'eedt_cartthrob.js');

        ee()->benchmark->mark('eedt_cartthrob_end');
        return $panels;
    }
}
