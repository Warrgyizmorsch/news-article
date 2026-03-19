<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('crm.category.index')
            ->with('editCategory', null);
    }

    public function create()
    {
        return view('crm.category.create');
    }
}
