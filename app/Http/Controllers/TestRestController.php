<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class TestRestController extends Controller
{

    public function index()
    {
        return [
            [
                'id' => '1',
                'name' => 'Ilia'
            ],
            [
                'id' => '2',
                'name' => 'Dasha'
            ],
        ];
    }
}
