<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Client;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users_count = User::whereRoleIs('admin')->count();
        $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        return view('dashboard.index', compact('categories_count','users_count', 'products_count', 'clients_count'));
    }
}
