<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    public function index(){
        return Zona::all();
    }
}
