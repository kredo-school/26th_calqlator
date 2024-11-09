<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FAQController extends Controller
{
    private $faq;

    public function __construct(Faq $faq){
        $this->faq = $faq;
    }

    public function indexlist(){
        $list_faqs = $this->faq->get();

        return view('admin.faqlist.index')
                ->with('list_faqs', $list_faqs);
    }

    public function update($id, Request $request)
    {
        $faq                 = $this->faq->where('id', $id);
        $faq->question       = $request->question;
        $faq->answer         = $request->answer;

        # Save
        $faq->save();

        return redirect()->back();
    }   

    public function delete($id){
        $this->faq->where('id', $id)->delete();
        return redirect()->back();
    }
}
