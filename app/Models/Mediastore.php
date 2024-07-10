<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Http\Controllers\Web\StorageController;
class Mediastore extends Model
{
    use HasFactory;
    protected $table = 'mediastore';
    protected $fillable = [
        'name',
        'caption',
        'title',
        'local_path',
        'type',
        'sequence',
                
    ];

    protected $appends= ['image_path' ];
    public function getImagePathAttribute(){
        $conv="";
        $strgCtrlr = new StorageController(); 
      //  if($this->type=='image'){
            if(is_null($this->name) ){
              //  $conv =$strgCtrlr->DefaultPath('image'); 
                $conv =''; 
            }else if($this->name==''){
                $conv =''; 
            } else {
                if($this->local_path=='categories'){
                    $url = $strgCtrlr->CategoryPath($this->type);
                    $conv =  $url.$this->name;
                }else if($this->local_path=='posts'){
                    $url = $strgCtrlr->PostPath($this->type);
                    $conv =  $url.$this->name;
                }
           
            }      
       
            return  $conv;
     }
   
     
    public function mediaposts(): HasMany
    {
        return $this->hasMany(MediaPost::class,'media_id');
    }
}
