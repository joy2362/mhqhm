<?php
//@abdullah zahid joy
namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Support\Facades\Storage;

class Test extends BaseModel
{
    public function getlogoAttribute($value)
	{
	 	 if (!empty($value)) {
	 	 	 return Storage::url($value) ;
	 	 }
 	 return null;
 }

//add your model content here
}
