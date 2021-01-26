<?php

namespace Goodarzi\Inventory\Http\Helpers;
use IntlDateFormatter;


class PersianDate
{

    public function persian_date($date) {

        $dateType = null;
        $timeType = null;
        $timezone = 'Asia/Tehran';
        $pattern = null;
        $formatter = new \IntlDateFormatter(
            'fa_IR@calendar=persian',
            \IntlDateFormatter::SHORT,
            \IntlDateFormatter::SHORT,
            'Asia/Tehran',
            \IntlDateFormatter::TRADITIONAL,
            'yyyy-MM-dd HH:mm:ss'
                );
        $date = new \DateTime($date);
        //var_dump($date);
        //var_dump(datefmt_format( $formatter , $date_obj));
        //$formatter = datefmt_create( "fa_IR@calendar=persian" ,IntlDateFormatter::FULL, IntlDateFormatter::FULL,
        //'Asia/Tehran', IntlDateFormatter::TRADITIONAL  );

        //exit;
        return $formatter->format($date);
    }

}