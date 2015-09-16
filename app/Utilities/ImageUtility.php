<?php

namespace App\Utilities;

use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUtility extends Image {

	static $directory = 'files/images/';

	static $extension = '.jpg';

	static $encode = 'jpg';

	static function create($image) {
		$image = Image::make($image);
		$path = self::path($image);
		$image->encode(self::$encode)->save($path);
		return $path;
	}

	static function thumbnail($image) {
		$image = Image::make($image);
		$path = self::path($image);
		$image->encode(self::$encode)->fit(400)->save($path);
		return $path;
	}

	static function path($image)
	{
		return self::$directory . uniqid() . $image->filename . self::$extension;
	}

}