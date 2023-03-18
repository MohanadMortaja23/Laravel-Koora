<?php 

namespace App\Traits ;

use App\Models\Sector;
use Illuminate\Http\Request;
trait GeneralTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function imageStore(Request $request, $input, $fieldname = 'image', $directory = 'images' ) {
        if ($input[$fieldname]) {
            $image_path = $request->file($fieldname)->store($directory, 'public');
            return $input[$fieldname] = $image_path;
        }    

    }

  

}