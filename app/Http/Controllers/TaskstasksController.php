<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskstasksController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $taskstasks = $user->taskstasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'taskstasks' => $taskstasks,
            ];
        }
        
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->taskstasks()->create([
            'content' => $request->content,
        ]);

        return back();
    }
    
    public function destroy($id)
    {
        $taskstask = \App\Taskstask::find($id);

        if (\Auth::id() === $taskstask->user_id) {
            $taskstask->delete();
        }

        return back();
    }
    
    public function edit($id)
    {
        $taskstask = \App\Taskstask::find($id);
        
        if (\Auth::id() === $taskstask->user_id) {
            $taskstask->edit();
        }
        return view('tasks.edit', [
            'taskstask' => $taskstask,
        ]);
    }
    
    public function create()
    {
        $taskstask = new Taskstask;
        
        if (\Auth::id() === $taskstask->user_id) {
            $taskstask->edit();
        }
        
        return view('tasks.create', [
            'taskstask' => $taskstask,
        ]);
    }
}