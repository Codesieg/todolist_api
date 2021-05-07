<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;
use App\Models\Tasks;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function home()
    {
        // $results = DB::select("SELECT * FROM tasks");
        // dump($results);

        // foreach ($results as $result) {
        //     echo "Titre " . $result;
        // }
        // $categories->title;
        // return response($categories);
        // ->header('Content-Type', $value);
        // $category = new Category();
        // dump($category);

        // $category->name = "Categorie n 1";
        // $category->save();

        echo "YAtaaa";

        // return response()->json(1);
        // $newTask = new Tasks();
        // dump($newTask);

        // $newTask->title = "Tache new n 1";
        // $newTask->category_id = 1;
        // $newTask->save();
    }
}
      // https://lumen.laravel.com/docs/6.x/database#basic-usage

        //$results = DB::select("SELECT * FROM tasks");
        //dump($results);

        // $category = new Category();


        // https://laravel.com/docs/6.x/eloquent#retrieving-models
        //dump($category::all())

        //dump($category::find(1)); // WHERE ID =
        //dump($category::find([1,4]));
        //dump($category::where('id', 4)->get());

        // $category->name = 'Titre pro';
        // $category->save();

        //https://laravel.com/docs/6.x/eloquent#deleting-models
        //$category::destroy(6);
        //$category::destroy([4,5]);
