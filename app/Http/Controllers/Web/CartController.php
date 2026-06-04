<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addCart(Request $request) {
        $productId = $request->get('product_id');
        $quantity = $request->get('quantity') ?? 1;
        $quantityNew = $request->get('quantity_new') ?? null;
        $product = DB::table('products')->where('id', $productId);
        $productExists = $product->exists();

        if (!$productExists) {
            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'Sản phẩm không tồn tại',
                    'qty' => Auth::guard('web')->check() 
                        ? Auth::guard('web')->user()->countListProductInCart() 
                        : collect(session('cart', []))->sum(),
                ]
            ]);
        }

        $productPrice = $product->get()->first()->price ?? null;
        $productQuantity = Product::find($productId)->getQuantityActive() ?? null;

        if ($quantity < 1 || !is_numeric($quantity) || ($quantityNew != null && $quantityNew <= 0)){
            return response()->json([
                'success'=>false,
                'data'=>[
                    'message'=>'Số lượng không hợp lệ',
                    'qty' => Auth::guard('web')->check() 
                        ? Auth::guard('web')->user()->countListProductInCart() 
                        : collect(session('cart', []))->sum(),
                ]
            ]);
        }

        $quantityUpdate = 0;

        if (Auth::guard('web')->check()) {
            $userId = Auth::guard('web')->user()->id;
            $cart = DB::table('carts')
                ->where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if (!empty($cart)){
                $quantityUpdate = $quantityNew ?? ($cart->quantity + $quantity);

                if ($productQuantity < $quantityUpdate){
                    return response()->json([
                        'success'=>false,
                        'data'=>[
                            'message'=>'Số lượng trong kho không đủ',
                            'qty' => Auth::guard('web')->user()->countListProductInCart(),
                        ]
                    ]);
                }

                DB::table('carts')
                    ->where('user_id', '=', $userId)
                    ->where('product_id', '=', $productId)
                    ->update([
                        'quantity' => $quantityUpdate
                    ]);
            } else {
                if ($productQuantity < $quantity){
                    return response()->json([
                        'success'=>false,
                        'data'=>[
                            'message'=>'Số lượng trong kho không đủ',
                            'qty' => Auth::guard('web')->user()->countListProductInCart(),
                        ]
                    ]);
                }

                DB::table('carts')->insert([
                   'user_id' => $userId,
                   'product_id' => $productId,
                   'quantity' => $quantity
                ]);
                $quantityUpdate = $quantity;
            }

            return response()->json([
                'success'=>true,
                'data'=>[
                    'message'=> 'Thêm vào giỏ hàng thành công',
                    'qty' => Auth::guard('web')->user()->countListProductInCart(),
                    'total' => Auth::guard('web')->user()->totalMoneyInCart(),
                    'total_row' => $productPrice * $quantityUpdate
                ]
            ]);
        } else {
            $cart = session()->get('cart', []);
            $currentQty = isset($cart[$productId]) ? $cart[$productId] : 0;
            $quantityUpdate = $quantityNew ?? ($currentQty + $quantity);

            if ($productQuantity < $quantityUpdate){
                return response()->json([
                    'success'=>false,
                    'data'=>[
                        'message'=>'Số lượng trong kho không đủ',
                        'qty' => collect(session('cart', []))->sum(),
                    ]
                ]);
            }

            if ($quantityUpdate <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $quantityUpdate;
            }
            session()->put('cart', $cart);

            $totalMoney = 0;
            if (!empty($cart)) {
                $products = Product::whereIn('id', array_keys($cart))->get();
                foreach ($products as $p) {
                    $totalMoney += $p->price * $cart[$p->id];
                }
            }

            return response()->json([
                'success'=>true,
                'data'=>[
                    'message'=> 'Thêm vào giỏ hàng thành công',
                    'qty' => collect(session('cart', []))->sum(),
                    'total' => $totalMoney,
                    'total_row' => $productPrice * $quantityUpdate
                ]
            ]);
        }
    }

    public function deleteProductCart(Request $request){
        $productId = $request->get('product_id');

        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();
            DB::table('carts')
                ->where('product_id', $productId)
                ->where('user_id', $user->id)
                ->delete();

            return response()->json([
                'success' => true,
                'data' => [
                    'qty' => $user->countListProductInCart(),
                    'total' => $user->totalMoneyInCart()
                ]
            ]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }

            $totalMoney = 0;
            if (!empty($cart)) {
                $products = Product::whereIn('id', array_keys($cart))->get();
                foreach ($products as $p) {
                    $totalMoney += $p->price * $cart[$p->id];
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'qty' => collect($cart)->sum(),
                    'total' => $totalMoney
                ]
            ]);
        }
    }

    public function listProductInCart() {
        if (Auth::guard('web')->check()) {
            $listProduct = Auth::guard('web')->user()->listProductInCart;
            $total = Auth::guard('web')->user()->totalMoneyInCart();
        } else {
            $cart = session()->get('cart', []);
            $listProduct = collect();
            $total = 0;
            if (!empty($cart)) {
                $products = Product::whereIn('id', array_keys($cart))->get();
                foreach ($products as $p) {
                    $p->pivot = (object) ['quantity' => $cart[$p->id]];
                    $listProduct->push($p);
                    $total += $p->price * $cart[$p->id];
                }
            }
        }
        return view('web.cart.list', compact('listProduct', 'total'));
    }
}
