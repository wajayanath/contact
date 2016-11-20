<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// use App\Http\Requests;

// use Image;

use App\Logic\Image\ImageRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
//use App\Models\Image;
use Illuminate\Http\Request;
use App\Contact;
use App\Photo;

class ImageController extends Controller
{
/////////////////////////
    protected $image;
    private $upload_dir = 'public/uploads';

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
        $this->middleware('auth');
        //$this->upload_dir = base_path() . '/'. $this->upload_dir;
    }

    //  public function getUpload()
    // {
    //     return view('pages.upload');
    // }

    public function postUpload($id, $name, Request $request)
    {
        $photo = Input::all();
        $response = $this->image->upload($id, $photo);
        return $response;

        // $data = $request->all();
        // if($request->hasFile('file'))
        //     {
        //         $file = $request->file('file');
        //         $name = time() . '_' . $file->getClientOriginalName();
        //         $destination = $this->upload_dir;
        //         $file->move($destination, $name);
        //       $data['path'] = $name;

        //     }
       //$contact = Contact::where(compact('id', 'name'))->first();
       
       // $contact = Contact::findOrFail($id);
       // $contact->photos()->create(['path' => "{$name}"]);
       // return response()->json(['path'=> $data['path']]);

       // $contact->photos()->create($data);
    }

    public function deleteUpload()
    {

        $filename = Input::get('id');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
        //$photo = Photo::where(compact('path'))->first();
        //$photo->delete();
    }

      /**
     * Part 2 - Display already uploaded images in Dropzone
     */

    // public function getServerImagesPage()
    // {
    //     return view('pages.upload-2');
    // }

    public function getServerImages()
    {
        $images = Photo::get(['path']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                //'original' => $image->original_name,
                'server' => $image->path,
                'size' => File::size(public_path('images/full_size/' . $image->path))
            ];
        }

        return response()->json([
            'images' => $imageAnswer
        ]);
    }

////////////////////////
    
  //   /**
  //    * Show the form for creating a new resource.
  //    *
  //    * @return \Illuminate\Http\Response
  //    */
  //   public function resizeImage()
  //   {
  //   	return view('resizeImage');
  //   }

  //   /**
  //    * Show the form for creating a new resource.
  //    *
  //    * @return \Illuminate\Http\Response
  //    */
  //   public function resizeImagePost(Request $request)
  //   {
	 //    $this->validate($request, [
	 //    	'title' => 'required',
  //           'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  //       ]);

  //       $image = $request->file('image');
  //       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
     
   
  //       $destinationPath = public_path('uploads/thumbnail');
  //       $img = Image::make($image->getRealPath());
  //       $img->resize(100, 100, function ($constraint) {
		//     $constraint->aspectRatio();
		// })->save($destinationPath.'/'.$input['imagename']);

  //       $destinationPath = public_path('uploads/images');
  //       $image->move($destinationPath, $input['imagename']);

  //      // $this->postImage->add($input);

  //       return back()
  //       	->with('success','Image Upload successful')
  //       	->with('imageName',$input['imagename']);

  //   }


}
