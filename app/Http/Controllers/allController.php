<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contact;
use App\Group;

class allController extends Controller

{
    private $rules = [
        'name' => ['required', 'min:5'],
        'email' => ['required', 'email'],
        'company' => ['required'],
        'photo' => ['mimes:jpg,jpeg,png,gif,bmp']
    ];

    private $upload_dir = 'public/uploads';

    public function __construct()
    {
        //$this->middleware('auth');
        $this->upload_dir = base_path() . '/'. $this->upload_dir;
    }

    public function index(Request $request)
    {
            $contacts = Contact::where(function($query) use ($request) {

            // Filter by seleted group
            if ( $group_id = ( $request->get("group_id") )) {
                $query->where("group_id", $group_id);
            }
            // Filter by keyword
            if (( $term = $request->get('term'))) {
                $query->orwhere('name', 'like', '%' . $term .'%');
                $query->orwhere('email', 'like', '%' . $term .'%');
                $query->orwhere('company', 'like', '%' . $term .'%');
            }
        })
        ->orderBy("id","desc")
        ->paginate(5);

        return view('contacts.index', [
            'contacts' => $contacts
        ]);
    }

   
    public function show($id, $name)
    {
        $name = str_replace('-',' ', $name);
        $contact = Contact::where(compact('id', 'name'))->first();
        return view('contacts.show', compact('contact'));
    }
    

    
}