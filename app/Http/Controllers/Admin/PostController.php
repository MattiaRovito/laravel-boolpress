<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Usare il Model
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        // chi deve visualizzare i prodotti?

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // prendere i dati
        $data = $request->all();


        // creare la nuova istanza con i dati ottenuti dalla request
        $new_post = new Post();
        $new_post->slug = Str::slug($data['title'], '-');
        $new_post->fill($data);



        // salvare i dati
        $new_post->save();

        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    //! Collegamento show con slug (utilizzato nel front-office)
    //* al posto di $slug si può passare qualsiasi cosa, è sempre un segnaposto
    public function show($slug)
    {

        //* vado a selezionare il primo elemento
        $post = Post::where('slug', $slug)->first();

        return view('admin.posts.show', compact('post'));
    }


    //! Collegamento show con id
    // public function show(Post $post)
    // {
    //     return view('admin.posts.show', compact('post'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // prendere tutti i dati
        $data = $request->all();


        // Se è stato modificato aggiungi questo. Permette di aggiungere un -numero se è già esistente il titolo modificato. 
        if($data['title'] != $post->title){

            $data['slug'] = Str::slug($data['title'], '-'); 

            $slug_base = $data['slug'];

            $slug_presente = Post::where('slug',  $data['slug'])->first();

            $contatore = 1;
            while($slug_presente){
                // aggiungiamo al post di prima un -contatore


                // controlliamo nuovamente se il post esiste ancora


                // incrementiamo il contatore
            }

        }   


        
        // vado a modificarli
        $post->update($data);

        // fare il return
        return redirect()->route('admin.posts.index')->with('updated', 'Il post numero ' . $post->id . ' è stato modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
