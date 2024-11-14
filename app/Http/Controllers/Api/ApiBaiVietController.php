<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaiVietRequest;
use App\Http\Resources\BaiVietResource;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ApiBaiVietController extends Controller
{
    public function index(Request $request)
    {
        $query = BaiViet::query();

        // Tìm kiếm theo tiêu đề và nội dung
        if ($request->filled('tieu_de') || $request->filled('noi_dung')) {
            $query->where(function($q) use ($request) {
                if ($request->filled('tieu_de')) {
                    $tieu_de = $request->input('tieu_de');
                    $q->where('tieu_de', 'like', "%$tieu_de%");
                }
                if ($request->filled('noi_dung')) {
                    $noi_dung = $request->input('noi_dung');
                    $q->orWhere('noi_dung', 'like', "%$noi_dung%");
                }
            });
        }

        // Phân trang (1 sản phẩm 1 trang)
        $baiViets = $query->paginate(10);
        return BaiVietResource::collection($baiViets);
    }

    public function store(BaiVietRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('hinh_anh')) {
            $filename = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
            $validated['hinh_anh'] = $filename;
        }

        $baiViet = BaiViet::create($validated);

        return response()->json([
            'data' => new BaiVietResource($baiViet),
            'status' => true,
            'message' => 'Bài Viết đã được thêm ',
        ], 201);
    }

    public function show(string $id)
    {
        $baiViet = BaiViet::findOrFail($id);
        return new BaiVietResource($baiViet);
    }

    public function update(BaiVietRequest $request, string $id)
    {
        $baiViet = BaiViet::findOrFail($id);

        $validated = $request->validated();

        if ($request->hasFile('hinh_anh')) {

            if($baiViet->hinh_anh && Storage::disk('public')->exists($baiViet->hinh_anh)){
                Storage::disk('public')->delete($baiViet->hinh_anh);
            }
            $filename = $request->file('hinh_anh')->store('uploads/baiviet', 'public');
            $validated['hinh_anh'] = $filename;
        }

        $baiViet->update($validated);

        return response()->json([
            'data' => new BaiVietResource($baiViet),
            'status' => true,
            'message' => 'Bài Viết sửa thành công ',
        ], 200);
    }

    public function destroy(string $id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $baiViet->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
