<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::all();
        if($tasks->count() > 0){
            return response()->json([
                'status' => 200,
                'tasks' => $tasks
                ],200);
        }else{
            return response()->json([
                'status' => 404,
                'status_message' => 'brak zadan'
                ],404);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'tytuł'=> 'required|string|max:191',
            'opis'=> 'required|string|max:191',
            'uzytkownik'=> 'required|string|max:191',
            'status'=> 'required|in:w trakcie,nowe,zakończone',   
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{
            $task = Task::create([
                'tytuł'=> $request->tytuł,
                'opis'=> $request->opis,
                'uzytkownik'=> $request->uzytkownik,
                'status'=> $request->status,
            ]);
            if($task){
                return response()->json([
                    'status'=> 200,
                    'message' => "Zadanie dodane"
                ],200);
            }else{
                return response()->json([
                    'status'=> 500,
                    'message' => "Nie udalo sie dodac zadania"
                ],500);
            }
        }
    }
    public function show($id){
        $task = Task::find($id);
        if($task){
            return response()->json([
                "status"=> 200,
                "task"=> $task
            ],200);

        }else{
            return response()->json([
                "status"=> 404,
                "message"=> "Nie ma takiego zadania"
            ],404);
        }
    }
    public function edit($id){
        $task = Task::find($id);
        if($task){
            return response()->json([
                "status"=> 200,
                "task"=> $task
            ],200);

        }else{
            return response()->json([
                "status"=> 404,
                "message"=> "Nie ma takiego zadania"
            ],404);
        }
    }
    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(),[
            'tytuł'=> 'required|string|max:191',
            'opis'=> 'required|string|max:191',
            'uzytkownik'=> 'required|string|max:191',
            'status'=> 'required|in:w trakcie,nowe,zakończone',   
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{
            $task = Task::find($id);

            if($task){

                $task->update([
                    'tytuł'=> $request->tytuł,
                    'opis'=> $request->opis,
                    'uzytkownik'=> $request->uzytkownik,
                    'status'=> $request->status,
                ]);

                return response()->json([
                    'status'=> 200,
                    'message' => "Zadanie zaktualizowane"
                ],200);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message' => "Nie udalo sie dodac zadania"
                ],404);
            }
        }
    }
    public function destroy($id){
        $task = Task::find($id);
        if($task){
            $task->delete();
            return response()->json([
                'status'=> 200,
                'message' => "Zadanie usuniete"
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message' => "Nie udalo sie usunac zadania"
            ],404);
        }
    }
}
