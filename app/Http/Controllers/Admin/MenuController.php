<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
    $this->menuService = $menuService;
    }

    public function  create(){
        return view('admin.menu.add',[
           'title'=> 'Thêm Danh Mục Mới',
            'menus' => $this->menuService->getParent(0)
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->menuService->create($request);

        return redirect()->back();
    }

    public  function index(){
        return view('admin.menu.list',[
            'title' => 'Danh sách Danh mục mới nhất',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Chỉnh sửa Danh Mục: ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request)
    {
        $this->menuService->update($request,$menu);
        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request) :JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if ($result){
            return response()->json([
                'error' =>false,
                'message'=> 'Xóa thành công danh mục'
            ]);
        }
        return response()->json([
            'error' =>true
        ]);
    }

}
