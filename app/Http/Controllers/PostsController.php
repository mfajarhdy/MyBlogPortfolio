<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::paginate(10);
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('category','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'gambar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
            
            ]);
            

            $gambar = $request->gambar;
            $new_gambar = time().'_'.$gambar->getClientOriginalName();
            $tujuan_upload = 'public/uploads/post';
            $gambar->move($tujuan_upload, $new_gambar);
            
            $post = Post::create([
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'gambar' => $new_gambar,
                'slug' => Str::slug($request->judul),
                'users_id' => Auth::id()

            ]);

            $post->tags()->attach($request->tags);

            return redirect()->back()->with('success', 'Postingan anda berhasil disimpan'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $category = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post','tags','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
     {
        $this->validate($request,[
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            
            if ($request->has('gambar')) {
                $gambar = $request->gambar;
                $new_gambar = time().'_'.$gambar->getClientOriginalName();
                $tujuan_upload = 'public/uploads/post';
                $gambar->move($tujuan_upload, $new_gambar);
    
                $post_data = [
                    'judul' => $request->judul,
                    'category_id' => $request->category_id,
                    'content' => $request->content,
                    'gambar' => $new_gambar,
                    'slug' => Str::slug($request->judul)
                    
    
                ];
            } else {
                
                $post_data = [
                    'judul' => $request->judul,
                    'category_id' => $request->category_id,
                    'content' => $request->content,
                    'slug' => Str::slug($request->judul)
    
                ];
            }


            $post->tags()->sync($request->tags);
            $post->update($post_data);

            return redirect()->route('post.index')->with('success', 'Postingan anda berhasil diubah'); 
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus -- Silahkan Cek Trashed Post --');
    }

    public function tampil_hapus(){
        $post = Post::onlyTrashed()->paginate();
        return view('admin.post.hapus',compact('post'));
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with('success', 'Data Berhasil DiRestore -- Silahkan Cek List Post --');
    }
    
    public function kill($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus Secara Permanen ');
    }
}
