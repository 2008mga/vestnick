<?php
namespace App\Helpers;

trait HasRole {
    public function isRole($name) {
        return $this->roles()->where('name', $name)->first() == true;
    }
}