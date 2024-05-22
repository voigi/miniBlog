

<form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
    @csrf
    @method($post->id ? "PATCH" :"POST")

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control" >
        @error("image")
            {{$message}}
        @enderror
    </div>
    
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" class="form-control" value="{{old('title',$post->title)}}">
        @error("title")
            {{$message}}
        @enderror
    </div>
    <div class="form-group">
        <label for="title">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{old('slug',$post->slug)}}">
        @error("slug")
            {{$message}}
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
          <textarea name="content" class="form-control">{{old('content',$post->content)}}</textarea>
          @error("content")
            {{$message}}
        @enderror
    </div>
    <div class="form-group">
        <label for="category">Categorie</label>
           <select class="form-control" id="category" name="category_id">
            <option value="">Selectionnez une catégorie</option>
        
            @foreach ($categories as $category )
               <option @selected(old('category_id',$post->category_id)== $category->id) value="{{$category->id}}">{{$category->name}}</option>
            @endforeach    
          </select> 
           
         


          @error("category_id")
            {{$message}}
        @enderror
    </div>
     @php
     $tagsId = $post->tags()->pluck('id');
     @endphp
    <div class="form-group">
        <label for="tag">Tag</label>
           <select class="form-control" id="tag" name="tags[]" multiple>
           
        
            @foreach ($tags as $tag )
               <option @selected($tagsId->contains($tag->id)) value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach    
          </select> 
           
         


          @error("tags")
            {{$message}}
        @enderror
    </div>
  
  
    <button class="btn btn-primary">
    @if($post->id)
     Modifier
    @else
     Créer
    @endif
    
   </button>
</form>


