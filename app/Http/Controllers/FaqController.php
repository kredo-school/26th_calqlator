<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    private $faq;

    public function __construct(Faq $faq){
        $this->faq = $faq;
    }

    public function index(Request $request){
        $search_faqs = [];

        if($request->search){
            $search_faqs = $this->faq->where('question', 'LIKE', '%'.$request->search.'%')
                                     ->paginate(10);
        }else{
            $search_faqs = $this->faq->paginate(10);
        }
        return view('user.faq')->with('faqs', $search_faqs)
                               ->with('search', $request->search);
    }
}
