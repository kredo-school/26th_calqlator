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

    # FAQlist
    public function indexlist(){
        $list_faqs = $this->faq->get();

        return view('admin.faqlist.index')
                ->with('list_faqs', $list_faqs);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'new_question' => 'required|min:1|max:50' . $id,
            'new_answer' => 'required|min:1|max:50' . $id
        ]);

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


    #FAQregistration
    public function reg_index()
    {
        return view('admin.faqregistration.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'faqs.*.question' => 'required|string|max:255',
            'faqs.*.answer' => 'required|string|max:255',
        ]);

        $sessionFaqs = session()->get('faqs', []);

        foreach ($data['faqs'] as $item) {
            $question = Faq::create($item);
            $sessionFaqs[] = $question->id; // 保存した質問のIDをセッションに追加
        }

        session()->put('faqs', $sessionFaqs);

        return redirect()->route('admin.faqregistration.complete');

    }
    
    public function complete()
    {
        $sessionFaqs = session()->get('faqs', []);

        $faqs = Faq::whereIn('id', $sessionFaqs)->get();

        return view('admin.faqregistration.complete', compact('faqs'));
    }

    public function search(Request $request)
    {
        $list_faqs = $this->faq->where('question' , 'like', '%' . $request->search . '%')->get();

        return view('admin.faqlist.search')
                ->with('list_faqs' , $list_faqs)
                ->with('search' , $request->search);
    }

}