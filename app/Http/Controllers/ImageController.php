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
use App\Models\Image;


class ImageController extends Controller
{
/////////////////////////
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    //  public function getUpload()
    // {
    //     return view('pages.upload');
    // }

    public function postUpload()
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;
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
    }

      /**
     * Part 2 - Display already uploaded images in Dropzone
     */

    public function getServerImagesPage()
    {
        return view('pages.upload-2');
    }

    public function getServerImages()
    {
        $images = Image::get(['original_name', 'filename']);

        $imageAnswer = [];

        foreach ($images as $image) {
            $imageAnswer[] = [
                'original' => $image->original_name,
                'server' => $image->filename,
                'size' => File::size(public_path('images/full_size/' . $image->filename))
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
