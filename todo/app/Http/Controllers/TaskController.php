<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //select * from tasks;
        $tasks = Task::all();
        //select * from tasks order by title;
        //$tasks = Task::orderby('title')->get();
        return view('task.index', ['tasks' => $tasks]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);

        //redirect()->back()->withErrors(['nom du champ 1'=> [regle de validation1, regle de validation2],'nom du champ 2'=> [regle de validation2, regle de validation2]])->inputs()
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->input('completed', false),
            'due_date' => $request->due_date,
            'user_id' => 1
        ]);

        return redirect()->route('task.show', $task->id)->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // select * from tasks where id = ?
        // return $task;
        // $task = Task::select()
        //         ->where('tasks.id', $task->id)
        //         ->join('users', 'users.id', 'user_id')
        //         ->first();
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'completed' => 'nullable|boolean',
            'due_date' => 'nullable|date',
        ]);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->input('completed', false),
            'due_date' => $request->due_date,
        ]);

       return redirect()->route('task.show', $task->id)->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')->withSuccess('Task deleted successfully!');
    }

    public function completed($completed){
        $tasks = Task::where('completed', $completed)->get();
        return view('task.index', ['tasks' => $tasks]);
    }
    public function query(){
        //$stmt = $pdo->query(SELECT * FROM Tasks)
        //$stmt->fetchAll()
        // $tasks = Task::all(); 
        // $tasks = Task::select()->get();
        // return $tasks[9]->title;
        
        // SELECT * FROM Tasks LIMIT 1
        // $tasks = Task::select()->first();

        // SELECT * FROM Tasks ORDER BY title DESC;
        // $tasks = Task::orderby('title', 'desc')->get();

        // SELECT title, description FROM tasks ORDER By title;
        // $tasks = Task::select('title', 'description')->orderby('title')->get();

        // SELECT * FROM tasks WHERE user_id =  1;
        // $tasks = Task::where('user_id', 1)->get();
        // $tasks = Task::select()->where('user_id', 1)->get();
        // $tasks = Task::select()->where('user_id','=', 1)->get();

        // SELECT * FROM tasks WHERE title like 'Task%' ;
        // $tasks = Task::select()->where('title','like', 'Task%')->get();

        // SELECT * FROM tasks WHERE id =  1;
        // $tasks = Task::where('id', 1)->get();
        // $tasks = $tasks[0];
        // $tasks = Task::where('id', 1)->first();
        // $tasks = Task::find(1);

        // SELECT title, description FROM tasks WHERE title like 'Task%' order by title desc 
        // $tasks = Task::select('title', 'description')
                // ->where('title', 'like', 'Task%')
                // ->orderby('title', 'desc')
                // ->get();

        // SELECT * FROM tasks where user_id = 1 AND completed = 1;
        // $tasks = Task::where('user_id', 1)
        //         ->where('completed', 1)
        //         ->get();

        // SELECT * FROM tasks where title like 'task%' OR completed = 1;
        //  $tasks = Task::where('title', 'like', 'Task%')
        //         ->orWhere('completed', 1)
        //         ->get();

        // SELETC * FROM tasks INNER JOIN users ON tasks.user_id = users.id
        // $tasks = Task::select()
        //         ->join('users', 'users.id', 'user_id')
        //         ->get();

        // SELETC * FROM tasks RIGHT OUTER JOIN users ON tasks.user_id = users.id
        // $tasks = Task::select()
        //         ->rightJoin('users', 'users.id', 'user_id')
        //         ->get();

        // SELECT MAX(user_id) FROM tasks;
        // $tasks = Task::max('user_id');

         // SELECT count(id) FROM tasks;
        //  $tasks = Task::count('id');

        // SELECT count(*) FROM tasks WHERE user_id =  1;
        // $tasks = Task::where('user_id', 1)->count();

        //requetes brutes
        // SELECT COUNT(*) as count_tasks, user_id FROM tasks group by user_id
        $tasks = Task::select(DB::raw('COUNT(*) as count_tasks'), 'user_id')
        ->groupBy('user_id')
        ->get();
        
        return $tasks;

        
    }
}
