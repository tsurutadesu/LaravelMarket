<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PostCategory;
use App\Models\Admin\Post;
use Image;
use Illuminate\Support\Facades\Storage;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show article categories list
     *
     * @return void
     */
    public  function articleCategoryList() {
        $article_categories = PostCategory::all();

        return view('admin.article.category.index', compact('article_categories'));
    }

    /**
     * Store article category
     *
     * @param Request $request
     * @return void
     */
    public function storeArticleCategory(Request $request) {
        $request->validate([
            'category_name_ja' => 'required|max:255',
        ]);

        PostCategory::create($request->all());

        $notification = array(
            'message' => 'カテゴリーを追加しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Delete article category
     *
     * @param String $id
     * @return void
     */
    public function deleteArticleCategory($id) {
        PostCategory::find($id)->delete();

        $notification = array(
            'message' => 'カテゴリーを削除しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit article category view
     *
     * @param String $id
     * @return void
     */
    public function editArticleCategory($id) {
        $article_category = PostCategory::find($id);

        return view('admin.article.category.edit', compact('article_category'));
    }

    /**
     * Update article category
     *
     * @param Request $request
     * @param String $id
     * @return void
     */
    public function updateArticleCategory(Request $request, $id) {
        $request->validate([
            'category_name_ja' => 'required|max:255',
        ]);

        PostCategory::find($id)->update($request->all());

        $notification = array(
            'message' => 'カテゴリーを更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.article.category')->with($notification);
    }

    /**
     * Show create post view
     *
     * @return void
     */
    public function createPost() {
        $article_categories = PostCategory::all();

        return view('admin.article.create', compact('article_categories'));
    }

    /**
     * Store article post
     *
     * @param Request $request
     * @return void
     */
    public function storeArticlePost(Request $request) {
        $request->validate([
            'post_title_ja' => 'required|max:255',
            'post_category_id' => 'required',
            'details_ja' => 'required|max:4000',
            'post_image' => 'required',
        ]);

        $post = new Post();
        $post->fill($request->all());
        $post->create_user = Auth::user()->name;
        $post_image = $request->file('post_image');

        if ($post_image) {
            $post_image_name = uniqid() . "_" . $post_image->getClientOriginalName();
            $img = Image::make($post_image)->resize(400, 200)->encode('jpg');
            Storage::disk('s3')->put('public/post/' . $post_image_name, $img, 'public');
            $post->post_image = 'public/post/' . $post_image_name;
        }

        $post->save();

        $notification = array(
            'message' => '投稿しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.article.post')->with($notification);
    }

    /**
     * Show post list
     *
     * @return void
     */
    public function indexPost() {
        $posts = Post::select('posts.*', 'posts.post_category_id', 'post_categories.category_name_ja')
                    ->join('post_categories', 'posts.post_category_id', '=', 'post_categories.id')
                    ->orderBy('id')
                    ->get();

        return view('admin.article.index', compact('posts'));
    }

    /**
     * Delete post
     *
     * @param String $id
     * @return void
     */
    public function deletePost($id) {
        $post = Post::find($id);
        $post_image = $post->post_image;
        $post->update_user = Auth::user()->name;

        if ($post_image) {
            if (Storage::disk('s3')->exists($post_image)) {
                Storage::disk('s3')->delete($post_image);
            }
        }

        $post->delete();

        $notification = array(
            'message' => '投稿を削除しました',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Show edit post view
     *
     * @param [type] $id
     * @return void
     */
    public function editPost($id) {
        $post = Post::find($id);
        $article_categories = PostCategory::all();

        return view('admin.article.edit', compact('post', 'article_categories'));
    }

    public function updatePost(Request $request, $id) {
        $request->validate([
            'post_title_ja' => 'required|max:255',
            'post_category_id' => 'required',
            'details_ja' => 'required|max:4000',
        ]);

        $post = Post::find($id);
        $post->fill($request->all());
        $post->update_user = Auth::user()->name;
        $old_image = $request->old_image;
        $post_image = $request->file('post_image');

        if ($post_image) {
            if (Storage::disk('s3')->exists($old_image)) {
                Storage::disk('s3')->delete($old_image);
            }

            $post_image_name = uniqid() . "_" . $post_image->getClientOriginalName();
            $img = Image::make($post_image)->resize(400, 200)->encode('jpg');
            Storage::disk('s3')->put('public/post/' . $post_image_name, $img, 'public');
            $post->post_image = 'public/post/' . $post_image_name;
        } else {
            $post->post_image = $old_image;
        }

        $post->save();

        $notification = array(
            'message' => '投稿を更新しました',
            'alert-type' => 'success'
        );

        return redirect()->route('index.article.post')->with($notification);
    }
}
