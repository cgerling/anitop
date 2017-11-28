<?php
namespace anitop\utils;

class EncodingService {
    public static function encode(string $str = '') {
        return \mb_convert_encoding($str, 'UTF-8', 'ISO-8859-1');
    }

    public static function encodeArray($data = array()) {
        $encoded = array();

        foreach ($data as $key=>$value) {
            $encoded[$key] = EncodingService::encode($value);
        }

        return $encoded;
    }

    public static function encodeDoubleArray($data = array()) {
        $encoded = array();

        foreach ($data as $value) {
            $encoded[] = EncodingService::encodeArray($value);
        }

        return $encoded;
    }

    public static function encodeTripleArray($data = array()) {
        $encoded = array();

        foreach ($data as $values) {
            $encoded[] = EncodingService::encodeDoubleArray($values);
        }

        return $encoded;
    }
}