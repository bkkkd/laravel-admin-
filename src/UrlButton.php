<?php
namespace bkkkd\LaravelAdminExcel;

use Encore\Admin\Grid\Tools\AbstractTool;

class UrlButton extends AbstractTool{

    private $url = '';
    private $name = '';
    public function __construct($url, $name){
        $this->url = $url;
        $this->name = $name;
    }
    public function render() {
        return "<a class='btn btn-default' ".($this->url?"href='".$this->url."'":'').">".$this->name."</a>";
    }



}
