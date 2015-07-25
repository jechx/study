<?php
namespace App\Decorator;
/**
 * Decorator
 */
class Login{
    function beforeRequest(){
        echo 'before request';
    }
    function afterRequest(){
        echo 'after request';
    }
}