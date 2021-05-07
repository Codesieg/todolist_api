<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function list()
    {
        // $results = DB::select("SELECT * FROM tasks");
        // return response($results);

        $tasksList = Tasks::all()->load('category');
        //return response()->json($categoriesList, 200);
        return $this->sendJsonResponse($tasksList, 200);
        //dump($categoriesList);
    }


    public function add(Request $request)
    {
        $title = $request->input('title');
        $categoryId = $request->input('categoryId');
        $completion = $request->input('completion');
        $status = $request->input('status');
        
        $newTask = new Tasks();
        $newTask->title = $title;
        $newTask->category_id = $categoryId;
        $newTask->completion = $completion;
        $newTask->status = $status;

        // dump($newTask);

        $isInserted = $newTask->save();

        if ($isInserted) {
            return $this->sendJsonResponse($newTask, 200);
        } else {
            return $this->sendEmptyResponse(500);
        } 
        
        // foreach ($newTask->getAttributes() as $key => $value) {
        //     if ($newTask->filled($key)) {
        //         $newTask->$key = $newTask->input($key);
        //         $newTask->$key = $value;
        //     }
        // }

        
    }

    public function item($id)
    {
        $task = Tasks::find($id);
        // si une tache avec cet id existe
        if ($task) {
            // on retourne une réponse contenant la tache encodée
            // au format json
            return $this->sendJsonResponse($task, 200);
        } else {
            // sinon, on retourne une réponse vide avec un code 500
            return $this->sendEmptyResponse(500);
        }
    }

    public function delete($id)
    {
        $task = Tasks::find($id);

        if ($task) {
            $task::destroy($id);
            return $this->sendJsonResponse($id . " supprimer", 200);
        } else {
            return $this->sendEmptyResponse(500);
        }
    }

    public function update(Request $request, $taskId)
    {

        // foreach ($task->getAttributes() as $key => $value){
        //     if ($update->has($key)) {
        //         $task->$key = $update->input($key);
        //         $task->save();
        //         if ($task) {
        //             return $this->sendJsonResponse($task, 200);
        //         } else {
        //             return $this->sendEmptyResponse(400);
        //         }
        //         break;
        //      }
        //     }
            
    //     $taskId = intVal($id);
    //     $task = Tasks::find($taskId);

    //     if (!empty($task))
    //     {
    //     $title = $request->input('title');
    //     $categoryId = $request->input('categoryId');
    //     $completion = $request->input('completion');
    //     $status = $request->input('status');
        
    //     $task->title = $title;
    //     $task->category_id = $categoryId;
    //     $task->completion = $completion;
    //     $task->status = $status;

    //     $isUpdated = $task->save();

    //     }
    //     if ($isUpdated) {
    //         return $this->sendEmptyResponse(204);
    //     } else {
    //         return $this->sendEmptyResponse(500);
    //     }
    // }
            // ici on récupérer la tache qui a pour id
            $taskId = intval($taskId);
            $task = Tasks::find($taskId);
    
            //! si on utilise le verbe PATCH
            if($request->isMethod('patch')){
    
                $oneDataAtLeast = false;
                // ici grace a has, je demande si la requete a une entrée 'title'
                if($request->has('title')){
                    $task->title = $request->input('title');
                    $oneDataAtLeast = true;
                }
                if($request->has('categoryId')){
                    $task->category_id = $request->input('categoryId');
                    $oneDataAtLeast = true;
                }
                if($request->has('completion')){
                    $task->completion = $request->input('completion');
                    $oneDataAtLeast = true;
                }
                if($request->has('status')){
                    $task->status = $request->input('status');
                    $oneDataAtLeast = true;
                }
    
                if(!$oneDataAtLeast){
                    // Si aucune donnée n'a été mis a jour
                    $this->sendEmptyResponse(400);
                    //abort(400);
                }else{
                    // SI AU MOINS UNE DONNEE A ETE MIS A JOUR
                    $isUpdated = $task->save();
    
                    if($isUpdated){
                        // alors on retourne un code de réponse HTTP 204 "No Content"
                        //return $this->sendEmptyResponse(204);
                        //! OU
                        return $this->sendJsonResponse($task, 200);
    
                    } else {
                        // alors retourner un code de réponse HTTP 500 "Internal Server Error"
                        // https://restfulapi.net/http-status-codes/
                        // sans body (pas de JSON ni d'HTML)
                        return $this->sendEmptyResponse(500);
                    }
    
    
                }
    
    
            } else {
                //! SI ON EST PAS SUR PATCH
                //! (et donc si on est sur l methode put)
                if(!empty($task)){
                    $title = $request->input('title');
                    $categoryId = $request->input('categoryId');
                    $completion = $request->input('completion');
                    $status = $request->input('status');
    
                    // modifier les propriétés de l'obet Task
                    $task->title = $title;
                    $task->category_id = $categoryId;
                    $task->completion = $completion;
                    $task->status = $status;
    
                    $isUpdated = $task->save();
    
                    // Si la modification a fonctionné
    
                    if($isUpdated){
                        // alors on retourne un code de réponse HTTP 204 "No Content"
                        //return $this->sendEmptyResponse(204);
                        //! OU
                        return $this->sendJsonResponse($task, 200);
    
                    } else {
                        // alors retourner un code de réponse HTTP 500 "Internal Server Error"
                        // https://restfulapi.net/http-status-codes/
                        // sans body (pas de JSON ni d'HTML)
                        return $this->sendEmptyResponse(500);
                    }
    
    
                } else {
                    // alors retourner un code de réponse HTTP 404 "Not Found"
                    // https://restfulapi.net/http-status-codes/
                    // sans body (pas de JSON ni d'HTML)
                    return $this->sendEmptyResponse(404);
                }
 
            }
 
        }
}

// public function update(Request $request, $taskId)
// {
//     // ici on récupérer la tache qui a pour id
//     $taskId = intval($taskId);
//     $task = Task::find($taskId);

//     // si j'ai bien une tache
//     if(!empty($task)){

//         // et si je suis sur la methode PATCH
//         if($request->isMethod('patch')){

//             $oneDataAtLeast = false;
//             // ici grace a has, je demande si la requete a une entrée 'title'
//             if($request->has('title')){
//                 $task->title = $request->input('title');
//                 $oneDataAtLeast = true;
//             }
//             if($request->has('categoryId')){
//                 $task->category_id = $request->input('categoryId');
//                 $oneDataAtLeast = true;
//             }
//             if($request->has('completion')){
//                 $task->completion = $request->input('completion');
//                 $oneDataAtLeast = true;
//             }
//             if($request->has('status')){
//                 $task->status = $request->input('status');
//                 $oneDataAtLeast = true;
//             }

//             if(!$oneDataAtLeast){
//                 // Si aucune donnée n'a été mis a jour
//                 $this->sendEmptyResponse(400);
//                 //abort(400);
//             }else{
//                 // SI AU MOINS UNE DONNEE A ETE MIS A JOUR
//                 $isUpdated = $task->save();

//                 if($isUpdated){
//                     // alors on retourne un code de réponse HTTP 204 "No Content"
//                     //return $this->sendEmptyResponse(204);
//                     //! OU
//                     return $this->sendJsonResponse($task, 200);

//                 } else {
//                     // alors retourner un code de réponse HTTP 500 "Internal Server Error"
//                     // https://restfulapi.net/http-status-codes/
//                     // sans body (pas de JSON ni d'HTML)
//                     return $this->sendEmptyResponse(500);
//                 }


//             }


//         } else {
//             //! SI ON EST SUR PUT
//             //! (et donc si on est sur l methode put)
//                 if($request->has(['title', 'categoryId', 'completion', 'status'])){
//                     $title = $request->input('title');
//                     $categoryId = $request->input('categoryId');
//                     $completion = $request->input('completion');
//                     $status = $request->input('status');
//                     // modifier les propriétés de l'obet Task
//                     $task->title = $title;
//                     $task->category_id = $categoryId;
//                     $task->completion = $completion;
//                     $task->status = $status;

//                     $isUpdated = $task->save();
//                 } else {
//                     $this->sendEmptyResponse(400);
//                 }
//                 // Si la modification a fonctionné
//                 if($isUpdated){
//                     // alors on retourne un code de réponse HTTP 204 "No Content"
//                     //return $this->sendEmptyResponse(204);
//                     //! OU
//                     return $this->sendJsonResponse($task, 200);
//                 } else {
//                     // alors retourner un code de réponse HTTP 500 "Internal Server Error"
//                     // https://restfulapi.net/http-status-codes/
//                     // sans body (pas de JSON ni d'HTML)
//                     return $this->sendEmptyResponse(500);
//                 }

//         }


//     }else{ // Si il n'existe pas de task ayant pour id $taskId
//         return $this->sendEmptyResponse(500);
//     }



// }