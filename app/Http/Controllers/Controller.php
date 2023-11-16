<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $protected_A = 'Protected';
    private $private_A = 'Private';
    public $public_A = 'Public';

    private function showPrivate()
    {
        echo $this->private_A;
    }

    protected function showProtected()
    {
        echo $this->protected_A;
    }

    public function showPublic()
    {
        echo $this->public_A;
    }
}
