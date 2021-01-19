<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\BankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title'         => 'Rekening Bank',
            'main_title'    => 'Rekening Bank',
            'sidebar'       => 'bank-account',
            'bank_accounts' => BankAccount::orderBy('updated_at', 'DESC')->paginate(10),
        ];

        return view('admin.pages.bank-account.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title'         => 'Rekening Bank',
            'main_title'    => 'Tambah Rekening Bank',
            'sidebar'       => 'bank-account',
        ];

        return view('admin.pages.bank-account.create', $data);
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
            'bank_name'             => 'required',
            'bank_account_name'     => 'required',
            'bank_account_number'   => 'required',
            'bank_logo'             => 'required',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $fileValidation = $this->fileValidation($request->file('bank_logo'), ['jpeg', 'jpg', 'png', 'webp']);

        if($fileValidation) {
            return back()
                ->withInput()
                ->with('failed', 'Gambar logo jpg, jpeg, png', 'webp');
        }

        $bank_logo = $this->uploadFile(Str::random('40'), $request->file('bank_logo'), 'images/bank-accounts');

        $bank_account = BankAccount::create([
            'bank_name'             => $request->bank_name,
            'bank_account_name'     => $request->bank_account_name,
            'bank_account_number'   => $request->bank_account_number,
            'bank_logo'             => $bank_logo,
        ]);

        return redirect('/app-admin/bank-account')->with('success', 'Rekening Bank ' . $bank_account->bank_account_name . ' telah ditambahkan');
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
            'title'                 => 'Rekening Bank',
            'main_title'            => 'Edit Rekening Bank',
            'sidebar'               => 'bank-account',
            'bank_account'          => BankAccount::find($id),
        ];

        return view('admin.pages.bank-account.edit', $data);
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
            'bank_name'             => 'required',
            'bank_account_name'     => 'required',
            'bank_account_number'   => 'required',
        ]);

        if($validator->fails()) {
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $bank_account = BankAccount::find($id);
        $bank_logo   = $bank_account->bank_logo;

        if( !is_null($request->file('bank_logo')) ) {
            $fileValidation = $this->fileValidation($request->file('bank_logo'), ['jpeg', 'jpg', 'png', 'webp']);
            
            if($fileValidation) {
                return back()
                    ->withInput()
                    ->with('failed', 'Gambar Kategori harus berekstensi jpg, jpeg, png, webp');
            }

            Storage::delete('public/images/bank-accounts/' . $bank_logo);
            $bank_logo = $this->uploadFile(Str::random(40), $request->file('bank_logo'), 'images/bank-accounts');
        }

        $bank_account->update([
            'bank_name'             => $request->bank_name,
            'bank_account_name'     => $request->bank_account_name,
            'bank_account_number'   => $request->bank_account_number,
            'bank_logo'             => $bank_logo,
        ]);
        
        return redirect('/app-admin/bank-account')->with('success', 'Rekening Bank ' . $bank_account->bank_account_name . ' telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank_account = BankAccount::find($id);

        Storage::delete('public/images/bank-accounts/' . $bank_account->bank_logo);
        BankAccount::destroy($bank_account->id);

        return back()->with('success', 'Rekeking Bank ' . $bank_account->bank_account_name . ' telah dihapus');
    }
}
