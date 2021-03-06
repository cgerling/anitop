<?php
namespace anitop\service;

use \DateTime;

class DateTimeService {
    public static function fromString($date, $format = "Y-m-d") {
        return DateTime::createFromFormat($format, $date);
    }

    public static function toString($date, $format = "Y-m-d") {
        return $date->format($format);
    }
}