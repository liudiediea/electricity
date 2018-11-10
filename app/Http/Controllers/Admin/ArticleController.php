<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Article_sort;
use DB;
class ArticleController extends Controller
{
    //
    public function index(){
        $article = DB::table('article')
                    ->leftjoin('article_sort','article_sort.id','=','article.cat_id')
                    ->select('article.*','article_sort.cat_name')         
                    ->paginate(5);

        $count = DB::table('article')
                    ->count();
        $sort = DB::table('article_sort')
                    ->get();
        // dd($article);die;        
        // dd($count);die;
        return view('admin.article.article_list',[
            'article'=>$article,
            'count'=>$count,
            'sort'=>$sort
        ]);
    }
  
    public function add(){
        $cat = DB::table('article_sort')->get();

        return view('admin.article.article_add',[
            'cat'=>$cat
        ]);
    }
    public function insert(Request $req){
        
        $article = new Article;
        $article->fill($req->all());
        $article->save();
        // dd($article);
        return redirect()->route('article_index');
    }

    public function edit($id){
        $cat = DB::table('article_sort')->get()->toArray();

        $article = Article::find($id);
        // dd($article);die;
        return view('admin.article.article_edit',[
            'article'=>$article,
            'cat'=>$cat
        ]);
    }
    public function update(Request $req,$id){
        $article = Article::find($id);
        $article->fill($req->all());
        $article->save();
        
        return redirect()->route('article_index');
    }
    public function delete($id){
        Article::destroy($id);
        return redirect()->route('article_index');
    }


    public function sort(){
        $cat = DB::table('article_sort')->get();

        return view('admin.article.article_sort',[
            'cat'=>$cat
        ]);
    }
    public function sort_insert(Request $req){
        $sort = new Article_sort;
        $sort->fill($req->all());
        $sort->save();
        return redirect()->route('article_sort');
        
    }
    public function sort_del($id){
        Article_sort::destroy($id);
        return redirect()->route('article_sort');
    }
}
