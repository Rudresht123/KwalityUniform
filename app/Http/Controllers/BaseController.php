<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function pageData(
        string $title,
        string $breadcrumb
    ): array {

        return [

            'title'      => $title,

            'breadcrumb' => $breadcrumb

        ];
    }
}
