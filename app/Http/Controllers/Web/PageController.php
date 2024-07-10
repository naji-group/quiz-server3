<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Http\Requests\Category\UpdateMenuRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Category\StoreCategoryRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
  
    
     
     public function show(string $slug)
     {
        $catmodel= Category::where('slug',$slug)->select('id','code')->first();
        return view("admin.page.add");
     }
  

}
