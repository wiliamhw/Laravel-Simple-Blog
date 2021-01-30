<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Render a list of a resource
    public function index() // GET
    {
        if (request('tag')) {
            $articles = Tag::where('name', request('tag'))->firstOrFail()->articles;
        } else {
            $articles = Article::latest()->get();
        }

        return view('articles.index', ['articles' => $articles]);
    }

    // Show a single resource
    public function show(Article $article) // GET
    {
        return view('articles.show', ['article' => $article]);
    }

    // Show a view to create a new resource
    public function create() // GET
    {
        return view('articles.create', [
            'tags' => Tag::all()
        ]);
    }

    // Persist the new resource
    public function store() // POST
    {
        $this->validateArticle();

        $article = new Article(request(['title', 'excerpt', 'body']));
        $article->user_id = 1; // auth()=?id()
        $article->save();

        $article->tags()->attach(request('tags'));

        return redirect(route('articles.index'));
    }

    // Show a view to edit an existing resource
    public function edit(Article $article) // PUT
    {
        return view('articles.edit', compact('article'));
    }

    // Persist the edited resource
    public function update(Article $article) // PUT or PATCH
    {
        $article->update($this->validateArticle());

        return redirect(route('articles.show', $article));
    }

    // Delete the resource
    public function destroy(Article $article) //DELETE
    {
        $article->delete();
        return redirect(route('articles.index'));
    }

    protected function validateArticle()
    {
        return request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
    }
}
