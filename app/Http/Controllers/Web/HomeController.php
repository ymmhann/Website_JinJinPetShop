<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $listCategory = Category::all();
        $listProduct = Product::with(['Category', 'listProductChild'])->where('parent_id', '=', null)->where('status', '=', 1)->paginate(8);
        return view('web.home.index', compact('listCategory', 'listProduct',));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $listCategory = Category::all();

        $listProduct = Product::with(['Category', 'listProductChild'])->where('name', 'like', '%' . $search . '%');

        $listProductIdsByAttrSearch = getListProductIdsByAttrSearch();

        if (is_array($listProductIdsByAttrSearch)) {
            $listProduct->whereIn('id', $listProductIdsByAttrSearch);
        }

        // Thêm bộ lọc giá (min_price, max_price)
        if ($request->has('min_price') && $request->min_price !== null && $request->min_price !== '') {
            $listProduct->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price !== null && $request->max_price !== '') {
            $listProduct->where('price', '<=', $request->max_price);
        }

        $listProductId = $listProduct->pluck('id')->toArray();

        $listProduct = $listProduct->paginate(10);

        return view('web.search.index', compact('search', 'listProduct', 'listCategory', 'listProductId'));
    }

    public function about() {
        return view('web.about.index');
    }

    public function contact() {
        return view('web.contact.index');
    }
}
