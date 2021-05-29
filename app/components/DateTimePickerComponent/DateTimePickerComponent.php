<style>
    <?=file_get_contents(dirname(__FILE__) . '/style.css')?>
</style>
<?php
class DateTimePickerComponent extends Component
{

    public function __construct($dateName, $timeName){
        $this->componentData['dateName'] = $dateName;
        $this->componentData['timeName'] = $timeName;

        parent::__construct();
    }

}