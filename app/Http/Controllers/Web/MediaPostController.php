<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use File;
use App\Http\Requests\MediaPost\StoreImagesRequest;
use App\Http\Requests\MediaPost\UpdateImageRequest;
use App\Http\Requests\MediaPost\StoreVideoRequest;
use App\Http\Requests\MediaPost\UpdateVideoRequest;
use App\Models\Mediastore;
use App\Models\MediaPost;

use Illuminate\Http\JsonResponse;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
 

use Illuminate\Http\UploadedFile;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
class MediaPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
//     public function storeimages(StoreImagesRequest $request, $id)//StoreImagesRequest
//     {
//         $formdata = $request->all();
//         //return (dd( $formdata));
//         $validator = Validator::make(
//             $formdata,
//             $request->rules(),
//             $request->messages()
//         );
//         if ($validator->fails()) {

//             return response()->json($validator);

//         } else {
            
//             $caption = isset($formdata["caption"]) ? $formdata["caption"] : '';
//             $tablename = $request["dep_name"];
//             $local_path = '';
//             if ($tablename == 'category') {
//                 $local_path = 'categories';
//             } else {
//                 $local_path = 'posts';
//             }
// /*
//             foreach ($request->file('images') as $imagefile) {

//                 $newObj = new Mediastore;
//                 // $newObj->name='';
//                 $newObj->caption = $caption;
//                 $newObj->title = '';
//                 $newObj->local_path = $local_path;
//                 $newObj->type = 'image';

//                 $newObj->save();
//                 $res = $this->storeImage($imagefile, $newObj->id, 'image', $tablename);
//                 $mediaproj = new MediaPost();
//                 if ($tablename == 'category') {
//                     $mediaproj->category_id = $id;
//                 } else {
//                     $mediaproj->post_id = $id;
//                 }

//                 $mediaproj->media_id = $newObj->id;
//                 $mediaproj->status = 1;
//                 $mediaproj->save();
//             }
//             */
//             return response()->json("ok");
//         }
//     }

    public function storeimages(StoreImagesRequest $request, $id)//StoreImagesRequest
    {
        $formdata = $request->all();
        //return (dd( $formdata));
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );
        if ($validator->fails()) {

            return response()->json($validator);

        } else {
            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
  
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }
        
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { 

              $formdata=$request->fdata;
              // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                //convert to array
                $DataArr = [];
                parse_str($formdata,$DataArr);
                
                $caption = isset($DataArr['caption']) ? $DataArr['caption'] : '';
                $file_type = isset($DataArr['file_type']) ? $DataArr['file_type'] : 'image';
                 
                            $tablename =$DataArr["dep_name"];
                            $local_path = '';
                            if ($tablename == 'category') {
                                $local_path = 'categories';
                            } else {
                                $local_path = 'posts';
                            }
                                           $newObj = new Mediastore;
                                            // $newObj->name='';
                                            $newObj->caption = $caption;
                                            $newObj->title = '';
                                            $newObj->local_path = $local_path;
                                            $newObj->type = $file_type;
                            
                                            $newObj->save();
                                            $res = $this->storeImage($file, $newObj->id, $file_type, $tablename);
                                            $mediaproj = new MediaPost();
                                            if ($tablename == 'category') {
                                                $mediaproj->category_id = $id;
                                            } else {
                                                $mediaproj->post_id = $id;
                                            }                            
                                            $mediaproj->media_id = $newObj->id;
                                            $mediaproj->status = 1;
                                            $mediaproj->save();

                            //delete aftercheck
                //  $strgCtrlr=new  StorageController();
      
                // $ext = $file->getClientOriginalExtension();
                // $filename = rand(10000, 99999) . '.' . $ext;
                // $path = $strgCtrlr->path['posts'];
                // $path = $file->storeAs($path, $filename, 'public');
                // $cap="";
                // if(isset( $formdata->caption)){
                //   $cap=$formdata->caption;
         
                // } 
              
               // end delete aftercheck
                // delete chunked file
              unlink($file->getPathname());
                return [
                    //'path' => asset('storage/' . $path),
                    // 'filename' => $filename,
                    // 'descdata'=> $formdata,
                    // 'caption'=>  $DataArr['caption'],
                    'id'=>$id,
                ];
            }
        
            // otherwise return percentage information
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];


///////////////////////////////////////


//             $caption = isset($formdata["caption"]) ? $formdata["caption"] : '';
//             $tablename = $request["dep_name"];
//             $local_path = '';
//             if ($tablename == 'category') {
//                 $local_path = 'categories';
//             } else {
//                 $local_path = 'posts';
//             }
// /*
//             foreach ($request->file('images') as $imagefile) {

//                 $newObj = new Mediastore;
//                 // $newObj->name='';
//                 $newObj->caption = $caption;
//                 $newObj->title = '';
//                 $newObj->local_path = $local_path;
//                 $newObj->type = 'image';

//                 $newObj->save();
//                 $res = $this->storeImage($imagefile, $newObj->id, 'image', $tablename);
//                 $mediaproj = new MediaPost();
//                 if ($tablename == 'category') {
//                     $mediaproj->category_id = $id;
//                 } else {
//                     $mediaproj->post_id = $id;
//                 }

//                 $mediaproj->media_id = $newObj->id;
//                 $mediaproj->status = 1;
//                 $mediaproj->save();
//             }
//             */
//             return response()->json("ok");

        }
    }

    public function update(UpdateImageRequest $request, $id)
    {
        $formdata = $request->all();
        //return (dd( $formdata));
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {

            return response()->json($validator);

        } else {             
            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));  
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }        
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { 

              $formdata=$request->fdata;
              // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                //convert to array
                $DataArr = [];
                parse_str($formdata,$DataArr);                
                $caption = isset($DataArr['caption-edit']) ? $DataArr['caption-edit'] : '';
                $file_type = isset($DataArr['file_type']) ? $DataArr['file_type'] : 'image';
                            $tablename =$DataArr["dep_name"];
                            $local_path = '';
                            if ($tablename == 'category') {
                                $local_path = 'categories';
                            } else {
                                $local_path = 'posts';
                            }
//$file = $request->file('image');
            $MediaObj = Mediastore::find($id);
            // $newObj->name='';
            $MediaObj->caption = $caption;
            // $MediaObj->title='';
            $MediaObj->local_path = $local_path;
            $MediaObj->type =  $file_type;

            $MediaObj->save();
            $res = $this->storeImage($file, $MediaObj->id,  $file_type, $tablename);

                // delete chunked file
              unlink($file->getPathname());
                return [                    
                    'id'=>$id,
                ];
            }
        
            // otherwise return percentage information
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];
            // $caption = isset($formdata["caption-edit"]) ? $formdata["caption-edit"] : '';
            // $tablename = $formdata["dep_name"];
            // $local_path = '';
            // if ($tablename == 'category') {
            //     $local_path = 'categories';
            // } else {
            //     $local_path = 'posts';
            // }
            // $file = $request->file('image');
            // $MediaObj = Mediastore::find($id);
            // // $newObj->name='';
            // $MediaObj->caption = $caption;
            // // $MediaObj->title='';
            // $MediaObj->local_path = $local_path;
            // $MediaObj->type = 'image';

            // $MediaObj->save();
            // $res = $this->storeImage($file, $MediaObj->id, 'image', $tablename);


            // return response()->json("ok");
        }
    }

    public function updatevideo(UpdateVideoRequest $request, $id)
    {
        $formdata = $request->all();
        //return (dd( $formdata));
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {
            return response()->json($validator);
        } else {
            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
  
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }
        
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { 

              $formdata=$request->fdata;
              // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                //convert to array
                $DataArr = [];
                parse_str($formdata,$DataArr);
                $caption = isset($DataArr['caption-edit']) ? $DataArr['caption-edit'] : '';
                            $tablename =$DataArr["dep_name"];
                            $local_path = '';
                            if ($tablename == 'category') {
                                $local_path = 'categories';
                            } else {
                                $local_path = 'posts';
                            }
             $MediaObj = Mediastore::find($id);
            // $newObj->name='';
            $MediaObj->caption = $caption;
            // $MediaObj->title='';
            $MediaObj->local_path = $local_path;
            //  $MediaObj->type='image';
            $MediaObj->save();
            $res = $this->storeImage($file, $MediaObj->id, 'video', $tablename);
                // delete chunked file
              unlink($file->getPathname());
                return [                    
                    'id'=>$id,
                ];
            }        
            // otherwise return percentage information
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];
        }
    }
    /**
     * Remove the specified resource from storage.
     */

    public function storeImage($file, $id, $type, $tablename)
    {
        $imagemodel = Mediastore::find($id);
        $oldimage = $imagemodel->name;
        $oldimagename = basename($oldimage);
        $strgCtrlr = new StorageController();
        $ext = $file->getClientOriginalExtension();
        if ($type == 'image') {
            //get path
            $path = '';
            if ($tablename == 'category') {
                $path = $strgCtrlr->path['categories'];
            } else {
                $path = $strgCtrlr->path['posts'];
            }

            if (Str::lower($ext) == 'svg') {
                if ($file !== null) {
                    $ext = $file->getClientOriginalExtension();
                    $filename = rand(10000, 99999) . $id . '.' . $ext;
                    Storage::delete("public/" . $path . '/' . $oldimagename);
                    $path = $file->storeAs($path, $filename, 'public');
                    Mediastore::find($id)->update([
                        "name" => $filename
                    ]);
                }
            } else {
                if ($file !== null) {

                    $filename = rand(10000, 99999) . $id . ".webp";
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($file);
                    $image = $image->toWebp(75);
                    if (!File::isDirectory(Storage::url('/' . $path))) {
                        Storage::makeDirectory('public/' . $path);
                    }
                    $image->save(storage_path('app/public') . '/' . $path . '/' . $filename);

                    Mediastore::find($id)->update([
                        "name" => $filename
                    ]);
                    Storage::delete("public/" . $path . '/' . $oldimagename);
                }
            }

        } else if($type=='pdf'){
            $path = '';
            if ($tablename == 'category') {
                $path = $strgCtrlr->pdfpath['categories'];
            } else {
                $path = $strgCtrlr->pdfpath['posts'];
            }

            if ($file !== null) {
                $ext = $file->getClientOriginalExtension();
                $filename = rand(10000, 99999) . $id . '.' . $ext;
                Storage::delete("public/" . $path . '/' . $oldimagename);
                $path = $file->storeAs($path, $filename, 'public');
                Mediastore::find($id)->update([
                    "name" => $filename
                ]);
            }
        }        
        else {
            //vedio
            $path = '';
            if ($tablename == 'category') {
                $path = $strgCtrlr->vidpath['categories'];
            } else {
                $path = $strgCtrlr->vidpath['posts'];
            }

            if ($file !== null) {
                $ext = $file->getClientOriginalExtension();
                $filename = rand(10000, 99999) . $id . '.' . $ext;
                Storage::delete("public/" . $path . '/' . $oldimagename);
                $path = $file->storeAs($path, $filename, 'public');
                Mediastore::find($id)->update([
                    "name" => $filename
                ]);
            }
        }
        return 1;
    }

    public function storevideo(StoreVideoRequest $request, $id)//StoreImagesRequest
    {

        $formdata = $request->all();
         
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {

            return response()->json($validator);

        } else {

            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
  
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }
        
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { 

              $formdata=$request->fdata;
              // file uploading is complete / all chunks are uploaded
                $file = $fileReceived->getFile(); // get file
                //convert to array
                $DataArr = [];
                parse_str($formdata,$DataArr);
                
                $caption = isset($DataArr['caption']) ? $DataArr['caption'] : '';
                            $tablename =$DataArr["dep_name"];
                            $local_path = '';
                            if ($tablename == 'category') {
                                $local_path = 'categories';
                            } else {
                                $local_path = 'posts';
                            }

                             $newObj = new Mediastore;
            // $newObj->name='';
            $newObj->caption = $caption;
            $newObj->title = '';
            $newObj->local_path =$local_path;
            $newObj->type = 'video';

            $newObj->save();
            $res = $this->storeImage($file, $newObj->id, 'video',$tablename);
            $mediaproj = new MediaPost();
            if ($tablename == 'category') {
                $mediaproj->category_id = $id;
            } else {
                $mediaproj->post_id = $id;
            }
            $mediaproj->media_id = $newObj->id;
            $mediaproj->status = 1;
            $mediaproj->save(); 
                    
              unlink($file->getPathname());
                return [
                    
                    'id'=>$id,
                ];
            }        
            // otherwise return percentage information
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];
 
        }
    }

}
