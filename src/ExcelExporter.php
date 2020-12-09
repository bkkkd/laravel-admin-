<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExcelExporter
 *
 * @author tim
 */
namespace bkkkd\LaravelAdminExcel;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Encore\Admin\Grid\Exporters\CsvExporter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelExporter extends AbstractExporter{
    protected $head = [];
    protected $body = [];
    public function setAttr($head, $body){
        $this->head = $head;
        $this->body = $body;
    }
    //put your code here
    public function export() {

        $filename = $this->getTable().'.xls';
        $headers = [
            'Content-Encoding'    => 'UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        response()->stream(function () {
            $head = $this->head;
            $body = $this->body;
            $bodyRows = collect($this->getData(false))->map(function ($item)use($body) {
                foreach ($body as $keyName){
                    switch ($keyName) {
                    default:
                    $arr[] = $item->getAttribute($keyName);
                    break;
                    }
                }
                return $arr;
            });
            $rows = collect([$head])->merge($bodyRows)->toArray();
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getActiveSheet()->fromArray($rows);
            $writer = IOFactory::createWriter($spreadsheet, 'Xls');
            $writer->save('php://output');
        }, 200, $headers)->send();
    }

}
