<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Exercise;
use App\Models\Faq;

class IndexController extends Controller
{
    private $user;
    private $food;
    private $exercise;
    private $faq;

    public function __construct(User $user, Food $food, Exercise $exercise, Faq $faq) {
        $this->user = $user;
        $this->food = $food;
        $this->exercise = $exercise;
        $this->faq = $faq;
    }

    public function home() {

        $users = $this->user->all();
        $foods = $this->food->all();
        $exercises = $this->exercise->all();
        $faqs = $this->faq->all();

        return view('admins.home')
                ->with([
                    'users' => $users,
                    'foods' => $foods,
                    'exercises' => $exercises,
                    'faqs' => $faqs,
                ]);
    }
}
