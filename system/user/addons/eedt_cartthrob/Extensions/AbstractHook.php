<?php

namespace DebugToolbar\CartThrob\Extensions;

use ExpressionEngine\Service\Addon\Controllers\Extension\AbstractRoute;
use DebugToolbar\Services\ToolbarService;

abstract class AbstractHook extends AbstractRoute
{
    /**
     * @var ToolbarService|mixed
     */
    protected ToolbarService $toolbar;

    public function __construct($settings = '')
    {
        $this->toolbar = ee('ee_debug_toolbar:ToolbarService');
    }
}