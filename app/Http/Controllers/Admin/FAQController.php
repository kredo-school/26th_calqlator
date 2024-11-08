<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    private $faq;

    public function __construct(Faq $faq){
        $this->faq = $faq;
    }
    public function index(){
        $list_faqs = $this->faq->get();

        return view('admin.faqlist.index')
                ->with('list_faqs', $list_faqs);
    }
}
