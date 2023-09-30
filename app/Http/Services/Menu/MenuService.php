<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{

    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')
            ->get();
    }
    public function getAll()
    {
        return Menu::orderBy('id')->paginate(20);
    }
    public function  create($request)
    {

        try {
            Menu::create([
                'name' =>(string) $request->input('name'),
                'parent_id' =>(int) $request->input('parent_id'),
                'description' =>(string) $request->input('description'),
                'content' =>(string) $request->input('content'),
                'active' =>(string) $request->input('active')
            ]);

            Session::flash('success', 'Tạo danh mục thành công');
        }
        catch (\Exception $err){
        Session::flash('error',$err->getMessage());
        return false;
        }

        return true;
    }

    public function  update($request, $menu) : bool
    {
        if ($request->input('parent_id') != $menu->id){
            $menu->parent_id = (string) $request->input('parent_id');
        }


        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->save();

        Session::flash('success', 'Cập nhật thành công Danh Mục');
        return true;

    }

    public function destroy($request)
    {
        //cũ không hiệu quả menu cap 2 la gioi han
        $id = (int)$request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
        //Tốt hơn menu cap 3
//        try {
//            //Xoá Root
//
//            Menu::where('id', $idMenu)->delete();
//            //Lấy danh sách con của Root
//            $listMenu = Menu::where('parent_id', $idMenu)->get();
//            //Duyệt danh sách con
//            foreach ($listMenu as $menu) {
//                //Gọi đệ quy
//                $this->Remove($menu->id);
//                //Xoá danh sách con
//                Menu::destroy($menu);
//            }
//            return true;
//        } catch (Exception $e) {
//            return false;
//        }

    }

    public function getId($id)
    {
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();
    }


}
