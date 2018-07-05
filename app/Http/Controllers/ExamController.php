<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user and $user->can('建立測驗')) {
            $exams = Exam::orderBy('created_at', 'desc')
                ->paginate(3);
        } else {
            $exams = Exam::where('enable', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(2);
        }
        return view('exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exam           = new Exam;
        $exam['enable'] = 1;
        $method         = 'post';
        $action         = '/exam';
        return view('exam.create', compact('exam', 'method', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        Exam::create($request->all());
        return redirect()->route('exam.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Exam $exam)
    {
        $topic  = new Topic;
        $method = 'post';
        $action = '/topic';
        return view('exam.show', compact('exam', 'topic', 'method', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        $method = 'patch';
        $action = "/exam/" . $exam->id;
        return view('exam.create', compact('exam', 'method', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->update($request->all());
        return redirect()->route('exam.show', $exam->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
    }
}
