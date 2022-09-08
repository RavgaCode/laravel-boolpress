<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $posts= Post::all();

        // Leggo l'url per leggere eventuali messaggi dell'url di post cancellati 
        $request_info = $request->all();
        $show_deleted_message = isset($request_info['deleted']) ? $request_info['deleted'] : null;

        $data=[
            'posts'=> $posts,
            'show_deleted_message' => $show_deleted_message
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data =[
            'categories'=> $categories,
            'tags' => $tags,
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $form_data =$request->all();

        $new_post = new Post();
        $new_post ->fill($form_data);


        $new_post->slug= $this->getFreeSlugFromTitle($new_post->title);
        $new_post->save();

        // Una volta salvato il nuovo post, deve attaccare gli eventuali tag, SOLO se ci sono
        if(isset($form_data['tags'])){
            $new_post->tags()->sync($form_data['tags']);
        }
        

        return redirect()->route('admin.posts.show', ['post'=>$new_post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $now = Carbon::now();
        $days_ago = $post->created_at-> diffInDays($now);


        $data=[
            'post'=>$post,
            'days_ago' => $days_ago,
        ];
        return view('admin.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        $data=[
            'post'=>$post,
            'categories'=>$categories,
            'tags' => $tags,
        ];
        return view('admin.posts.edit',$data);  
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
        // Faccio la validazione dei dati richiamando il metodo con le specifiche impostate
        $request->validate($this->getValidationRules());


        $form_data = $request->all();

        $post_to_update = Post::findOrFail($id);
        // Aggiungo all'array associativo dei nuovi dati lo slug, ma solo nel caso il titolo sia cambiato
        if($form_data['title'] !== $post_to_update->title){
            $form_data['slug'] = $this->getFreeSlugFromTitle($form_data['title']);
        } else{
            $form_data['slug'] = $post_to_update->slug;
        }


        $post_to_update->update($form_data);

         // Una volta aggiornato il nuovo post, devo attaccare i nuovi tag, SOLO se ci sono
         if(isset($form_data['tags'])){
            $post_to_update->tags()->sync($form_data['tags']);
        } else{
            $post_to_update->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', ['post'=> $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::findOrFail($id);
        // Svuoto la colonna delle tag, per permettere il delete
        $post_to_delete->tags()->sync([]);
        $post_to_delete->delete();

        return redirect()->route('admin.posts.index',['deleted'=>'yes']);
    }
    protected function getFreeSlugFromTitle($title){
        //Assegno lo slug
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        // Verifico se questo slug esiste nel db
        $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

        // Finchè non trovo uno slug libero, appendo un numero allo->first(); slug base base -1,-2, etc..

        $counter = 1;

        while($existing_slug_post){
            // Provo a creare un nuovo slugo con $counter
            $slug_to_save = $slug_base . '-' . $counter;

            // Verifico se questo slug esiste nel db
            $existing_slug_post = Post::where('slug', '=', $slug_to_save)->first();

            $counter++;
        }

        return $slug_to_save;
    }

    protected function getValidationRules(){
        return[
            'title' => 'required|max:255',
            'content' =>'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',
        ];
    }
}
