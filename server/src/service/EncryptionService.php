<?php
namespace anitop\service;

class EncryptionService {
    public function encrypt($value) {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    public function verify($value, $hash) {
        return password_verify($value, $hash);
    }
}