<?php

namespace bkkkd\LaravelAdminExcel;

use Encore\Admin\Grid\Tools\AbstractTool;

class ImportButton extends AbstractTool
{

    private $url = '';

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function render()
    {
        return "<button class='btn btn-default'>" . trans("admin.export") . "</button>";
    }


}
