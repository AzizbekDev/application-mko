<?php
namespace App\Traits\Applications;

use Illuminate\Http\Request;

trait UploadImage
{
    public function uploadImage(Request $request){
        $result = [
            'passport_image'   => 'no-image.jpg',
            'passport_image1'  => 'no-image.jpg',
            'passport_image2'  => 'no-image.jpg',
        ];

        if ($request->has('passport_image')) {
            $data = $this->upload($request->passport_image);
            if($data['success']){
                $result['passport_image'] = $data['name'];
            }
        }
        if ($request->has('passport_image1')) {
            $data = $this->upload($request->passport_image1);
            if($data['success']){
                $result['passport_image1'] = $data['name'];
            }
        }
        if ($request->has('passport_image2')) {
            $data = $this->upload($request->passport_image2);
            if($data['success']){
                $result['passport_image2'] = $data['name'];
            }
        }
        return $request->merge($result)->all();
    }

    public function upload($img_info){

        if (preg_match('/^data:image\/(\w+);base64,/', $img_info, $type)) {

            $img_info = substr($img_info, strpos($img_info, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, jpeg

            if (!in_array($type, [ 'jpg', 'jpeg', 'png' ])) return ['success' => false, 'message' => 'Invalid image type.', 'name' => null ];

            $img_info = str_replace( ' ', '+', $img_info );

            $image = base64_decode($img_info);
            if ($image === false)
                return [
                    'success' => false,
                    'message' => 'Base64 decode failed.',
                    'name'    => null
                ];

            $image_name = time()."-".uniqid().".".$type;
            
            if(request()->has('is_test') && request()->is_test)
                file_put_contents(public_path('uploads/test_passport_images/').$image_name, $image);
            else
                file_put_contents(public_path('uploads/passport_images/').$image_name, $image);

            return [
                 'success' => true,
                 'name' => $image_name
             ];
        } else {
            return [
                'success' => false,
                'message' => 'Did not match data URI with image data.',
                'name'    => null
            ];
        }
    }
}


