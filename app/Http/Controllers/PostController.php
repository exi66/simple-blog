<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Support\Arr;
    
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
		//$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
		$this->middleware('permission:post-create', ['only' => ['create','store']]);
		$this->middleware('permission:post-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }
	 
    public function index(Request $request)
    {
        $posts = Post::withTrashed()->orderBy('id','DESC')->paginate(5);
        return view('posts.index',compact('posts'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = Post::pluck('title','description')->all();
        return view('posts.create',compact('post'));
    }
    
	public function restore($id)
	{
		$post = Post::withTrashed()->find($id);
		$post->comments()->restore();
		$post->restore();
		return redirect()->route('posts.index')->with('success','Post restored successfully');
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
		$input = $request->all();
        $input['user_id'] = auth()->user()->id;
        $post = Post::create($input);
        return redirect()->route('posts.index')->with('success','Your publication created successfully');
    }
	
	public function store_comment(Request $request, $postid)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
		$input = $request->all();
        $input['user_id'] = auth()->user()->id;
		$input['post_id'] = $postid;
        $post = Comment::create($input);
        return redirect()->route('posts.show', $postid)->with('success','Your comment publicate successfully');
    }
	
	public function destroy_comment($id)
    {
        $postid = Comment::find($id)->post_id;
		Comment::find($id)->delete();
        return redirect()->route('posts.show', $postid)->with('success','Post deleted successfully');
    }
	
	public function restore_comment($id)
    {
        $postid = Comment::withTrashed()->find($id)->post_id;
		Comment::withTrashed()->find($id)->restore();
        return redirect()->route('posts.show', $postid)->with('success','Post deleted successfully');
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
		$comments = $post->comments()->withTrashed()->get();
        return view('posts.show',compact('post', 'comments'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required'
        ]);
        $post = Post::find($id);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
		$post->comments()->delete();
		$post->delete();
        return redirect()->route('posts.index')->with('success','Post deleted successfully');
    }
}