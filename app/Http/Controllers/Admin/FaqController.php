<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'         => 'FAQ',
            'main_title'    => 'FAQ',
            'sidebar'       => 'faq',
            'faqs'          => FAQ::orderBy('updated_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.faq.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'FAQ',
            'main_title'    => 'Tambah FAQ',
            'sidebar'       => 'bank-account',
        ];

        return view('admin.pages.faq.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question'             => 'required',
            'answer'                => 'required',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $faq = Faq::create([
            'question'             => $request->question,
            'answer'                => $request->answer,
        ]);

        return redirect('/app-admin/faq')->with('success', 'FAQ ' . $faq->question . ' telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title'         => 'FAQ',
            'main_title'    => 'Edit FAQ',
            'sidebar'       => 'bank-account',
            'faq'           => FAQ::find($id),
        ];

        return view('admin.pages.faq.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'question'             => 'required',
            'answer'                => 'required',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        Faq::find($id)->update([
            'question'             => $request->question,
            'answer'               => $request->answer,
        ]);

        return redirect('/app-admin/faq')->with('success', 'FAQ ' . $request->question . ' telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        Faq::destroy($id);

        return redirect('/app-admin/faq')->with('success', 'FAQ ' . $faq->question . ' telah dihapus');
    }
}
