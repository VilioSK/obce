<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Drnxloc\LaravelHtmlDom\HtmlDomParser;
use App\Models\City;

class ParserController extends Controller
{
    public function index()
    {
        return view('parser');
    }
}
