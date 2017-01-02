<?php

namespace App\Http\Controllers;

use App\Logic\Image\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contact;
use App\Group;
use App\Photo;

class ContactsController extends Controller

{
    private $rules = [
        'name' => ['required', 'min:5'],
        'email' => ['required', 'email'],
        'company' => ['required'],
        'photo' => ['mimes:jpg,jpeg,png,gif,bmp']
    ];

    private $upload_dir = 'public/uploads';

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
        $this->middleware('auth');
        $this->upload_dir = base_path() . '/'. $this->upload_dir;
    }

    public function index(Request $request)
    {
            // \DB::enableQueryLog();
            // listGroups($request->user()->id);
            // dd(\DB::getQueryLog());
            $contacts = Contact::where(function($query) use ($request) {
            //Filter by current user
            $query->where("user_id", $request->user()->id);

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

    public function getGroups()
    {
        $groups = [];
        foreach(Group::all() as $group) 
        {
            $groups[$group->id] = $group->name;
        }
        return $groups;
    }

    public function create()
    {
        $groups = $this->getGroups();
        return view('contacts.create', compact('groups'));
    }

     public function edit($id)
    {
        $groups = $this->getGroups();
        $contact = Contact::findOrFail($id);
        $this->authorize('modify', $contact);
        return view('contacts.edit', compact('groups', 'contact'));
    }

    public function show($id, $name)
    {
        // $contact = Contact::findOrFail($id);
        //  return view('contacts.show', compact('contact'));
        $name = str_replace('-',' ', $name);
        $contact = Contact::where(compact('id', 'name'))->first();
        return view('contacts.show', compact('contact'));
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        $data = $this->get_request($request);
        //$request->user()->contacts()->create($data);
        //return redirect("contacts")->with("message", "contact save");
        $obj = $request->user()->contacts()->create($data);
        return redirect()->action('ContactsController@edit', ['id' => $obj->id]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, $this->rules);
        // $contact = Contact::find($id);
         $contact = Contact::findOrFail($id);
        $this->authorize('modify', $contact);
        $oldPhoto = $contact->photo;

        $data = $this->get_request($request);
        $contact->update($data);

        if($oldPhoto !== $contact->photo) {
            $this->removePhoto($oldPhoto);
        }

        return redirect("contacts")->with("message", "contact updated");
    }

    public function get_request(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('photo'))
            {
                //get file name
                $photo = $request->file('photo');
                $fileName = $photo->getClientOriginalName();
                //move files to server
                $destination = $this->upload_dir;
                $photo->move($destination, $fileName);
                $data['photo'] = $fileName;
            }
        return $data;
    }

    public function addPhoto($id, $name, Request $request)
    {
        $data = $request->all();
        if($request->hasFile('file'))
            {
                $file = $request->file('file');
                $name = time() . '_' . $file->getClientOriginalName();
                $destination = $this->upload_dir;
                $file->move($destination, $name);
                $data['path'] = $name;

            }
       //$contact = Contact::where(compact('id', 'name'))->first();
       $contact = Contact::findOrFail($id);
       $contact->photos()->create(['path' => "{$name}"]);
       return response()->json(['path'=> $data['path']]);
       // $contact->photos()->create($data);
    }

    public function destroy($id)
    {
        // $contact = Contact::find($id);
        $contact = Contact::findOrFail($id);
        $this->authorize('modify', $contact);
        // if (!is_null($contact->photo))
        //     {
        //         $file_path = $this->upload_dir . '/' . $contact->photo;
        //         if(file_exists($file_path)) unlink ($file_path);
        //     }
        $imgs = Photo::where('contact_id', 'like', $contact->id)->get();
        foreach ($imgs as $img) {
           $this->image->delete($img->path);
        }
        $contact->delete();
        // $this->removePhoto($contact->photo);
        return redirect("contacts")->with("message", "contact deleted");
    }

    private function removePhoto($photo) {
        if(! empty($photo)) {
            $file_path = $this->upload_dir . '/' . $photo;
            if (file_exists($file_path)) unlink($file_path);
        }
    }
}
