<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Category;

class CategoryController extends Controller
{
    public function list()
    {
        $results = DB::select("SELECT * FROM categories");
        return response($results);
    }

    public function delete($id)
    {
        $task = Category::find($id);

        if ($task) {
            $task::destroy($id);
            return $this->sendJsonResponse($id . " supprimer", 200);
        } else {
            return $this->sendEmptyResponse(500);
        }
    }
}
