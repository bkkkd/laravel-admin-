<?php


namespace bkkkd\LaravelAdminExcel;



use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Form as WidgetsForm;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

trait ImportActions
{

    public function importForm(Content $content,Request $request){
        $form = new WidgetsForm();
        $form->action('importPost');
        $form->file('import')->rules('required')
            ->options(['initialPreviewAsData'=>false,'overwriteInitial'=>false,'showPreview'=>false]);

        return $content->header('导入数据')
            ->body($form);
    }
    public function importPost(){

        $data = $this->validate(Request(), ['import'=>'required']);
        $sheet = IOFactory::load($data['import']->getRealpath());
        return $this->importSaving($sheet);
    }
    abstract protected function importSaving(Spreadsheet $sheet);
}