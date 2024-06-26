<?php

namespace App\Http\Controllers;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
   public function index(): View
   {

  
    
     $post=Post::find(6);

  ;
    
 

     
    

     return view('blog.index',[
        'posts'=>Post::with('tags','category')->paginate(10)
     ]);
   }

   public function create(){

     $post = new Post();
     return view('blog.create',[
      'post'=> $post ,
      'categories'=>Category::select('id','name')->get(),
      'tags'=>Tag::select('id','name')->get()
     ]); 
   
   }

   public function edit(Post $post){
      { 

         
         return view('blog.edit',
         [
            'post'=>$post,
           
            'categories'=>Category::select('id','name')->get(),
            'tags'=>Tag::select('id','name')->get()
         ]);
      }
   }
 
   public function update(Post $post,FormPostRequest $request){
      {
         $data= $request->validated();
         /** @var UploadedFile|null $image */
         $image= $request->validated('image');
         if($image !== null && !$image->getError()){
            $data['image']=$image->store('blog','public');
         }
         $post->update($data);
         $post->tags()->sync($request->validated('tags'));
         return redirect()->route('blog.show',['slug'=>$post->slug,'post'=>$post->id])->with('success',"L'article a bien été modifié");
      }
   }

   public function store(FormPostRequest $request){
      {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show',['slug'=>$post->slug,'post'=>$post->id])->with('success',"L'article a bien été sauvegardé");
      }
   }
   public function show(string $slug,Post $post):RedirectResponse | View
   {
      
    
    if ($post->slug !== $slug) {
        
        return to_route('blog.show', ['slug'=> $post->slug,'id'=> $post->id]);
    }
    return view('blog.show',[
      'post'=>$post

    ]);
   }
}
