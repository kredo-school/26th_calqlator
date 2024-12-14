<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private $question;
    private $answer;

    public function userChat(){
        $questions = Question::with('answers')->where('user_id', Auth::user()->id)->get();
        return view('user.chat', compact('questions'));
    }

    public function adminChat(Request $request)
    {
        $users = User::has('questions')->get();
        $selectedUserId = $request->query('user_id');
        $selectedUser = null;
        
        if($selectedUserId)
        {
            $selectedUser = User::find($selectedUserId);
        }

        $questions = $selectedUserId
            ? Question::where('user_id', $selectedUserId)
                ->with('answers')
                ->orderBy('created_at')
                ->get()
                ->groupBy(function ($item) {
                    return $item->created_at->format('Y-m-d');
                })
            : collect();

        return view('admin.chatpage.index', compact('users', 'questions','selectedUser', 'selectedUserId'));
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required',
        ]);

        $question = Question::create([
            'user_id' => Auth::user()->id,
            'question' => $request->input('question'),
        ]);

        $temporaryAnswer = Answer::create([
            'user_id' => null,
            'answer' => null,
            'created_at' => null,
        ]);

        // $this->question->user_id = Auth::user()->id;
        // $this->question->question = $request->question;
        // $this->question->save();

        QuestionAnswer::create([
            'question_id' => $question->id,
            'answer_id' => $temporaryAnswer->id,
        ]);

        return redirect()->back();
    }

    public function storeAnswer(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'question_id' => 'required|exists:questions,id',
        ]);

        $questionId = $request->input('question_id');
        $newAnswerText = $request->input('answer');

        $qa = QuestionAnswer::where('question_id', $questionId)->first();

        if ($qa) {
            $temporaryAnswer = Answer::find($qa->answer_id);
            $temporaryAnswer->update([
                'user_id' => Auth::user()->id,
                'answer' => $newAnswerText,
            ]);

            Question::where('id', $questionId)->update(['checked' => true]);
        }

        return redirect()->route('chat.adminChat', ['user_id' => $request->input('user_id')]);
    }
}
