<?php


namespace App\Http\Services\Post;


use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function insert($request)
    {
        try {
            #$request->except('_token');
            Post::create($request->input());
            Session::flash('success', 'Thêm bài viết mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Lỗi thêm bài viết');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function get()
    {
        return Post::orderByDesc('id')->paginate(15);
    }

    public function update($request, $post)
    {
        try {
            $post->fill($request->input());
            $post->save();
            Session::flash('success', 'Cập nhật Bài viết thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật Bài viết Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $post = Post::where('id', $request->input('id'))->first();
        if ($post) {
            $post->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return Post::orderByDesc('sort_by')->get();
    }
}
