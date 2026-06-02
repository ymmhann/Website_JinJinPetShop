<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryDetail(Request $request, $id){
        $listCategory = Category::all();
        $category = Category::find($id);
        $listProduct = Product::with(['Category', 'listProductChild'])->where('category_id', $id);
        $listProductIdsByAttrSearch = getListProductIdsByAttrSearch();

        if (!empty($listProductIdsByAttrSearch)) {
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

        return view('web.category.detail', compact('category', 'listProduct', 'listCategory', 'listProductId'));
    }
}
