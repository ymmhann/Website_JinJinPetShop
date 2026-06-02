<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ShippingFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $listCity = City::where(function ($query) use($request){
            if (!empty($request->get('search'))){
                $query->where('name', 'like', "%" . $request->get('search') . "%");
            }
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.city.index', compact('listCity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'shipping_fee' => 'required',
        ], [
            'name.required' => 'Tên tỉnh/thành phố không được để trống.',
            'shipping_fee.required' => 'Phí vận chuyển không được để trống.',
        ]);

        try {
            $data = $request->all();

            if (isset($data['shipping_fee'])) {
                $cleanedFee = preg_replace('/[^\d.]/', '', $data['shipping_fee']);
                $data['shipping_fee'] = $cleanedFee !== '' ? (double)$cleanedFee : 0.0;
            }

            if ($data['shipping_fee'] < 0) {
                return redirect()->back()->withInput()->with('error', 'Phí vận chuyển phải lớn hơn hoặc bằng 0.');
            }

            // Tự động tạo mã code duy nhất cho tỉnh/thành phố
            $data['code'] = strtoupper(substr(md5($data['name'] . time()), 0, 6));

            City::create($data);

            return redirect()->route('admin.cities.index')->with('success', 'Thêm mới phí vận chuyển thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $city = City::find($id);
        return view('admin.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $city = City::find($id);
            $data = $request->all();

            if (isset($data['shipping_fee'])) {
                $cleanedFee = preg_replace('/[^\d.]/', '', $data['shipping_fee']);
                $data['shipping_fee'] = $cleanedFee !== '' ? (double)$cleanedFee : 0.0;
            }

            $city->fill($data);

            $city->save();

            return redirect()->route('admin.cities.edit', $id)->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        try {
            $city = City::find($id);
            if ($city) {
                $city->delete();
                return redirect()->route('admin.cities.index')->with('success', 'Xóa phí vận chuyển thành công');
            }
            return redirect()->route('admin.cities.index')->with('error', 'Không tìm thấy tỉnh/thành phố cần xóa');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Không thể xóa tỉnh/thành phố này vì có liên kết với đơn đặt hàng hiện tại.');
        }
    }
}
