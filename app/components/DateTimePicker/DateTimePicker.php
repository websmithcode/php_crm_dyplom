<style>
    <?=file_get_contents(dirname(__FILE__) . '/style.css')?>
</style>
<?php

class DateTimePicker extends Component
{

    public function __construct($dateName, $timeName, $classes = '', $required = false, $date = '', $time = '')
    {
        $this->componentData['dateName'] = $dateName;
        $this->componentData['timeName'] = $timeName;
        $this->componentData['dateValue'] = @$_GET[$dateName] ?? $date;
        $this->componentData['timeValue'] = @$_GET[$timeName] ?? $time;

        $this->componentData['required'] = $required;

        $this->componentData['classes'] = $classes;

        parent::__construct();
    }

}