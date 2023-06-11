<?php

class RandomHelper{
    public static function jsonEncode($data = []){
        return json_encode($data);
    }
    public static function add($a,$b){
        return ($a+$b);
    }
}