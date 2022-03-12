<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {

        print_r(route('products'));
        return view('products.index');


        // Compact method
        // return view('products.index', compact('title', 'description'));

        // With method: useful for one variable
        // return view('products.index')->with('title', $title);
        // return view('products.index')->with('data', $data);

        /*
         Directly in the view
        return view('products.index', [
            'data' => $data
        ]);
        */
    }

//    public function about() {
//        return 'About Us Page';
//    }
//
//    public function show($name) {
//        $data = [
//            'iPhone' => 'iPhone',
//            'Samsung' => 'Samsung'
//        ];
//
//        return view('products.index', [
//            'products' => $data[$name] ?? ' Product ' . $name . ' does not exist'
//        ]);
//    }
}
