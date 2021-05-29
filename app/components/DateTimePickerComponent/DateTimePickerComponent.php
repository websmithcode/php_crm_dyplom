<style>
    <?=file_get_contents(dirname(__FILE__) . '/style.css')?>
</style>
<?php

class DateTimePickerComponent extends Component
{

    public function __construct($dateName, $timeName, $classes = '')
    {
        $this->componentData['dateName'] = $dateName;
        $this->componentData['timeName'] = $timeName;
        $this->componentData['dateValue'] = @$_GET[$dateName];
        $this->componentData['timeValue'] = @$_GET[$timeName];

        $this->componentData['classes'] = $classes;

        parent::__construct();
    }

}