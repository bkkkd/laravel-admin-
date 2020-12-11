<?php


namespace bkkkd\LaravelAdminExcel;


use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Form as WidgetsForm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

trait ImportActions
{

    public function importForm(Content $content, Request $request)
    {
        $form = new WidgetsForm();
        $form->action('import');
        $file = $form->file('import')->rules('required')
            ->options(['initialPreviewAsData' => false, 'overwriteInitial' => false, 'showPreview' => false]);
        if($this->importTplResponse()){
            $file->help("<a href='importTpl'>模板</a>");
        }

        return $content->header('导入数据')
            ->body($form);
    }

    public function importPost()
    {

        $data = $this->validate(Request(), ['import' => 'required']);
        $sheet = IOFactory::load($data['import']->getRealpath());
        return $this->importSaving($sheet);
    }

    public function importTpl()
    {
        $response = $this->importTplResponse();
        if (empty($response)) {
            $response = new Response();
            $response->setStatusCode(404);
            return $response;
        }
        return $response;

    }

    abstract protected function importSaving(Spreadsheet $sheet);

    abstract protected function importTplResponse();
}