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
            'tytuł'=> '',
            'opis'=> '',
            'status'=> '',
            'uzytkownik'=> ''
        ]);
    }
}
