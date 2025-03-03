<?php
namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::orderBy('id', 'desc')->get(); // Lấy danh sách và sắp xếp từ lớn đến nhỏ
        return view('admin.InformationManager.ShowInformation', compact('informations'));
    }

    public function create()
    {
        return view('admin.InformationManager.CreateInformation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,jfif|max:2048',
            'description_information' => 'nullable|string',
        ]);

        $data = $request->only(['type', 'title','description_information']);
         // Xử lý file hình ảnh
         if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['thumbnail'] = $imageName;
        }
        Information::create($data);

        return redirect()->route('InformationManager.ShowInformation')->with('success', 'Thông tin đã được thêm thành công!');
    }

    // public function show(Information $information)
    // {
    //     return view('information.show', compact('information'));
    // }

    public function edit(Information $information, $id)
    {
        $information = Information::findOrFail($id);
        return view('admin.InformationManager.EditInformation', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'nullable|string',
            'title' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_information' => 'nullable|string',
        ]);
        $information = Information::findOrFail($id);

        $data = $request->only(['type', 'title','description_information']);

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['thumbnail'] = $imageName;
        } else {
            $data['thumbnail'] = $information->thumbnail;
        }

        $information->update($data);

        return redirect()->route('InformationManager.ShowInformation')->with('success', 'Thông tin đã được cập nhật!');
    }

    public function destroy($id)
    {   
        $information = Information::findOrFail($id);
        $information->delete();

        return redirect()->route('InformationManager.ShowInformation')->with('success', 'Thông tin đã được xóa!');
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            return response()->json([
                'url' => asset('uploads/' . $filename)
            ]);
        }

        return response()->json(['uploaded' => false]);
    }
}
