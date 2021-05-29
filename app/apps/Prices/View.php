<?php namespace apps\Prices;

class View extends \Core\View{
    public function getPartnerOptionValue($partner)
    {
        return join(' ',
            [
                $partner['PartnerID'] . ')',
                $partner['PartnerName'] ,
                '(' . $partner['PartnerEmail'] . ')',
                '[' . $partner['PartnerRequisites'] . ']'
            ]
        );
    }
}
