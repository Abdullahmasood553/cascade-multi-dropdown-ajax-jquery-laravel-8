<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function index() {
        $data = DB::table('categories')->get();
        return view('index', compact('data', $data));
    }

    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('sub_categories')->where('category_id', $id)->get());
    }   

    public function GetCaloriesAgainstSubCategory($id) {
        echo json_encode(DB::table('calories')->where('sub_category_id', $id)->get());
    }
}
