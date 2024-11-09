<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Exercise;
use App\Models\Faq;
use App\Models\Question;

class HomesController extends Controller
{
    private $user;
    private $food;
    private $exercise;
    private $faq;
    private $question;

    public function __construct(User $user, Food $food , Exercise $exercise, Faq $faq, Question $question){
        $this->user = $user;
        $this->food = $food;
        $this->exercise = $exercise;
        $this->faq = $faq;
        $this->question = $question;
    }

    public function index() {
        $users = $this->user->all();
        $foods = $this->food->where('status', 'approved');
        $exercises = $this->exercise->where('status', 'approved');
        $faqs = $this->faq->all();
        $foodConfirmations = $this->food->where('status', 'pending');
        $exerciseConfirmations = $this->exercise->where('status', 'pending');
        $questions = $this->question->where('checked', '1');

        return view('admin.homepage.homepage')->with([
                                            'users' => $users,
                                            'foods' => $foods,
                                            'exercises' => $exercises,
                                            'faqs' => $faqs,
                                            'foodConfirmations' => $foodConfirmations,
                                            'exerciseConfirmations' => $exerciseConfirmations,
                                            'questions' => $questions,
                                        ]);
    }
}
