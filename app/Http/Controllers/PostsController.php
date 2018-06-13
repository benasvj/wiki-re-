<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = $request->input('value');
        $posts = DB::table('posts')
        ->where('content', 'like', '%'.$value.'%')->paginate(3);
        $categories = Category::orderBy('position', 'asc')->get();
        return view('posts.index', [
        'posts' => $posts,
        'categories'=>$categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'Please fill :attribute field',
            'content.required' => 'Please fill :attribute field',
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect('posts/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = $request->all();
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category = $request->input('category');
        $post->user = Auth::id();
        $post->save();
        $request->session()->flash('message', 'Post created!');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', ['post' => $post ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        $categories = Category::all();
        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category = $request->input('category');
        $post->save();
        $request->session()->flash('message', 'Post updated!');
        return redirect(route('controll_posts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        $post->delete();
        $request->session()->flash('message', 'Post was deleted!');
        return redirect(route('controll_posts'));
    }

    public function filter($idz){
        $posts = Post::where('category', $idz)->paginate(3);
        $categories = Category::orderBy('position', 'asc')->get();
        return view('posts.filtered', [
        'posts' => $posts,
        'categories'=>$categories,
        ]);
    }
    //sitas tam kad Admin sectiona rodytu tik admin useriui, ir tam kad kitas vartotojas negaletu pasiekti per GET
    public function controll(){
        $posts = Post::paginate(15);

        $this->middleware('auth');
        $user = Auth::user();
        if ($user->can('controll', Post::class)) {
            return view('admin.index', ['posts'=>$posts]);
        }
        else{
            return redirect('/');
        }  
    }

    public function search(Request $request){
        //
    }
}
