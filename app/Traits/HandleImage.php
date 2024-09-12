<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait HandleImage
{
    public function uploadImage($image)
    {
        // Tạo tên file duy nhất
        $extension = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;

        $manager = new ImageManager(new Driver());
        $img = $manager->read($image->getRealPath());
        // Resize ảnh theo tỷ lệ 300px width
        $img = $img->cover(300, 300);

        // Lưu ảnh đã chỉnh sửa vào đường dẫn mong muốn
        $path = 'uploads/product/' . $imageName; // Đường dẫn tạm thời trong storage/app/public
        Storage::disk('public')->put($path, (string) $img->encode());
        return $imageName;
    }

    public function deleteImage($imagePath)
    {
        // Tạo tên file duy nhất
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
            return true;
        }

        return false;
    }
}
