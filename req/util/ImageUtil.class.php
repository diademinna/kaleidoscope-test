<?php

class ImageUtil {

	/**
	 * путь к изображению
	 *
	 * @var string
	 */
	private $src;
	/**
	 * тип изображения
	 *
	 * @var string
	 */
	private $type;
	/**
	 * ширина изображения
	 *
	 * @var int
	 */
	private $width;
	/**
	 * высота изображения
	 *
	 * @var int
	 */
	private $height;
	/**
	 * качество jpeg
	 *
	 * @var int
	 */
	private $quality = 93;
	private $copyName;
	private $imgResource;


	public function __construct($srcPath = '') {
		if ($srcPath) {
			$this->src = $srcPath;
			$this->getType();
			$imageSource = $this->src;

			$er = false;
			switch ($this->type) {
				case "gif": $srcImage = ImageCreateFromGIF($this->src) or $er = true;
					break;
				case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
				case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
				case "bmp": $srcImage = ImageCreateFromBMP($this->src) or $er = true;
					break;
				case "png": $srcImage = ImageCreateFromPNG($this->src) or $er = true;
					break;
				default: $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
			}
			if (!$er) {
				$this->width = ImageSX($srcImage);
				$this->height = ImageSY($srcImage);
				$this->imgResource = $srcImage;
			}
		}
	}

	public function getWidth() {
		if (!$this->width) {
			$imageSource = $this->src;

			$er = false;
			switch ($this->type) {
				case "gif": $srcImage = ImageCreateFromGIF($this->src) or $er = true;
					break;
				case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
				case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
				case "bmp": $srcImage = ImageCreateFromBMP($this->src) or $er = true;
					break;
				case "png": $srcImage = ImageCreateFromPNG($this->src) or $er = true;
					break;
				default: $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
			}
			if (!$er) {
				$this->width = ImageSX($srcImage);
				$this->height = ImageSY($srcImage);
			}
		}
		return $this->width;
	}

	public function getHeight() {
		if (!$this->height) {
			$imageSource = $this->src;

			$er = false;
			switch ($this->type) {
				case "gif": $srcImage = ImageCreateFromGIF($this->src) or $er = true;
					break;
				case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
				case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
				case "bmp": $srcImage = ImageCreateFromBMP($this->src) or $er = true;
					break;
				case "png": $srcImage = ImageCreateFromPNG($this->src) or $er = true;
					break;
				default: $srcImage = ImageCreateFromJPEG($this->src) or $er = true;
					break;
			}
			if (!$er) {
				$this->width = ImageSX($srcImage);
				$this->height = ImageSY($srcImage);
			}
		}
		return $this->height;
	}

	/**
	 * set Image
	 *
	 * @param string $srcPath
	 */
	public function setImage($srcPath) {
		$this->src = $srcPath;
		$this->getType();
	}

	/**
	 * установка качества jpeg
	 *
	 * @param int $quality
	 */
	public function setQuality($quality) {
		$this->quality = $quality;
	}

	/**
	 * make image source
	 *
	 * @return unknown
	 */
	private function makeImageSource() {
		// создаём исходное изображение на основе исходного файла
		switch ($this->type) {
			case 'gif':
				$src = imagecreatefromgif($this->src);
				break;
			case 'jpg':
				$src = imagecreatefromjpeg($this->src);
				break;
			case 'jpeg':
				$src = imagecreatefromjpeg($this->src);
				break;
			case 'bmp':
				$src = imagecreatefrombmp($this->src);
				break;
			case 'png':
				$src = imagecreatefrompng($this->src);
				break;
			default:
				$src = imagecreatefromjpeg($this->src);
				break;
		}
		return $src;
	}

	private function saveResizedImage($dest, $destPath) {
		switch ($this->type) {
			case 'gif':
				imagegif($dest, $destPath);
				break;
			case 'jpg':
				// сохранять в progressive jpg
//				imageinterlace($dest, 1);
				imagejpeg($dest, $destPath, $this->quality);
				break;
			case 'png':
				imagepng($dest, $destPath);
				break;
			case 'bmp':
				imagebmp($dest, $destPath);
				break;
			default:
				// сохранять в progressive jpg
//				imageinterlace($dest, 1);
				imagejpeg($dest, $destPath, $this->quality);
				break;
		}
	}

	public function resizeAsTemplate($destPath, $width, $height) {
		$src = $this->makeImageSource();

		$w_src = imagesx($src);
		$h_src = imagesy($src);

		if (($w_src != $width) || ($h_src != $height)) {
			if ($w_src > $h_src) {
				$ratio = $h_src / $height;
				$w_dest = round($w_src / $ratio);
				$h_dest = round($h_src / $ratio);

				// создаем новое изображение требуемого размера
				$dest = imagecreatetruecolor($w_dest, $h_dest);
				imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
			} else {

			}

			$this->saveResizedImage($dest, $destPath);

			imagedestroy($dest);
			imagedestroy($src);
		} else {
			copy($this->src, $destPath);
		}

		@chmod($destPath, 0777);
	}

	/**
	 * изменяем пропорционально размер
	 *
	 * @param string $destPath
	 * @param int $width
	 * @param bool $isProportional
	 */
	public function resizeProportionally($destPath, $width, $isProportional = false) {
		// создаём исходное изображение на основе исходного файла
		$src = $this->makeImageSource();

		// и опеределяем его размеры
		$w_src = imagesx($src);
		$h_src = imagesy($src);

		// размер исходного изображения должен отличаться от требуемого размера
		if ($w_src != $width) {
			if ($isProportional) { // пропорциональное изменение размера
				// определяем пропорции изображения
				$ratio = $w_src / $width;
				$w_dest = round($w_src / $ratio);
				$h_dest = round($h_src / $ratio);

				// создаем новое изображение требуемого размера
				$dest = imagecreatetruecolor($w_dest, $h_dest);
                                imagealphablending($dest, false);
                                imagesavealpha($dest, true);
				imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
			} 
			else { // неободимо квадратное изображение
				$dest = imagecreatetruecolor($width, $width);
                                imagealphablending($dest, false);
                                imagesavealpha($dest, true);

				// если картинка горизонтальная, то вырезаем по оси x
				if ($w_src > $h_src)
					imagecopyresampled($dest, $src, 0, 0, round(($w_src - $h_src) / 2), 0, $width, $width, $h_src, $h_src);

				// если картинка вертикальная, то вырезаем по оси y
				if ($w_src < $h_src)
					imagecopyresampled($dest, $src, 0, 0, 0, 0, $width, $width, $w_src, $w_src);

				// квадратная картинка масштабируется без вырезания
				if ($w_src == $h_src)
					imagecopyresampled($dest, $src, 0, 0, 0, 0, $width, $width, $w_src, $w_src);
			}

			// сохраняем результат в нужном формате
			$this->saveResizedImage($dest, $destPath);

			imagedestroy($dest);
			imagedestroy($src);
		}
		else {
			copy($this->src, $destPath);
		}

		@chmod($destPath, 0777);
	}

	/**
	 * устанавливает тип изображения
	 *
	 */
	public function getType() {
		if (!empty($this->src) && empty($this->type)) {
			$type = explode(".", $this->src);
			if (sizeof($type) == 1) {
				$this->type = "jpg";
			} else {
				$type = strtolower($type[sizeof($type) - 1]);
				$this->type = $type;
			}
		}
	}

	public function setType($type = "jpg") {
		$this->type = $type;
	}

	
	
	// ресайзить с добавлением пустых полей по краям. при этом картинка не обрезается.
	public function Resize($newWidth, $newHeight, $tofile=null, $rgb=0xFFFFFF) {
		$imageSource = $this->src;
		$er = 'Загруженный рисунок является поврежденным';
		switch ($this->type) {
			case "gif": $srcImage = ImageCreateFromGIF($this->src) or die($er . BACK);
				break;
			case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
			case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
			case "bmp": $srcImage = ImageCreateFromBMP($this->src) or die($er . BACK);
				break;
			case "png": $srcImage = ImageCreateFromPNG($this->src) or die($er . BACK);
				break;
			default: $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
		}
		$srcWidth = ImageSX($srcImage);
		$srcHeight = ImageSY($srcImage);

		$buf = explode(".", $this->src);
		$buf[0] .= "_copy";
		$fileName = implode(".", $buf);

		if ($newWidth xor $newHeight) {
			if ($newHeight == 0

				)$newHeight = $newWidth * $srcHeight / $srcWidth;
			if ($newWidth == 0

				)$newWidth = $newHeight * $srcWidth / $srcHeight;
		}
		if ($srcWidth > $newWidth) {
			$this->resizeProportionally($fileName, $newWidth, 1);
			$this->src = $fileName;

			switch ($this->type) {
				case "gif": $srcImage = ImageCreateFromGIF($this->src) or die($er . BACK);
					break;
				case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
					break;
				case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
					break;
				case "bmp": $srcImage = ImageCreateFromBMP($this->src) or die($er . BACK);
					break;
				case "png": $srcImage = ImageCreateFromPNG($this->src) or die($er . BACK);
					break;
				default: $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
					break;
			}
			$srcWidth = ImageSX($srcImage);
			$srcHeight = ImageSY($srcImage);
		}
		if ($srcHeight > $newHeight) {
			$this->resizeProportionallyHeight($fileName, $newHeight);
			$this->src = $fileName;

			switch ($this->type) {
				case "gif": $srcImage = ImageCreateFromGIF($this->src) or die($er . BACK);
					break;
				case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
					break;
				case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
					break;
				case "bmp": $srcImage = ImageCreateFromBMP($this->src) or die($er . BACK);
					break;
				case "png": $srcImage = ImageCreateFromPNG($this->src) or die($er . BACK);
					break;
				default: $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
					break;
			}
			$srcWidth = ImageSX($srcImage);
			$srcHeight = ImageSY($srcImage);
		}

		if ($newWidth < $srcWidth) {
			$width = $newWidth;
			$newLeft = 0;
		} else {
			$width = $srcWidth;
			$newLeft = $newWidth / 2 - $srcWidth / 2;
		}

		if ($newHeight < $srcHeight) {
			$height = $newHeight;
			$newTop = 0;
		} else {
			$height = $srcHeight;
			$newTop = $newHeight / 2 - $srcHeight / 2;
		}

		$image = imagecreatetruecolor($newWidth, $newHeight);
		imagefill($image, 0, 0, $rgb);

		imagecopyresampled($image, $srcImage, $newLeft, $newTop, 0, 0, $width, $height, $width, $height);


		if ($tofile){
			imagejpeg($image, $tofile, $this->quality);
		}
		else{
			imagejpeg($image);
		}
		
		ImageDestroy($image);
		ImageDestroy($srcImage);

		@chmod($tofile, 0777);

		if (file_exists($fileName)) {
			unlink($fileName);
		}
		$this->src = $imageSource;
	}

	/**
	 * изменяем пропорционально размер
	 *
	 * @param string $destPath
	 * @param int $width
	 * @param bool $isProportional
	 */
	public function resizeProportionallyHeight($destPath, $height) {
		// создаём исходное изображение на основе исходного файла
		$src = $this->makeImageSource();

		// и опеределяем его размеры
		$w_src = imagesx($src);
		$h_src = imagesy($src);

		// размер исходного изображения должен отличаться от требуемого размера
		if ($w_src != $height) {
			// определяем пропорции изображения
			$ratio = $h_src / $height;
			$w_dest = round($w_src / $ratio);
			$h_dest = round($h_src / $ratio);

			// создаем новое изображение требуемого размера
			$dest = imagecreatetruecolor($w_dest, $h_dest);
                        imagealphablending($dest, false);
                        imagesavealpha($dest, true);
			imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

			// сохраняем результат в нужном формате
			$this->saveResizedImage($dest, $destPath);

			imagedestroy($dest);
			imagedestroy($src);
		} else {
			copy($this->src, $destPath);
		}

		@chmod($destPath, 0777);
	}

	public function uploadImage($sourcefile, $location, $filename) {
		if (!file_exists($location)) {
			mkdir($location, 0777);
			@chmod($location, 0777);
		}
		move_uploaded_file($sourcefile, $location . "/" . $filename);
		@chmod($location . "/" . $filename, 0777);
	}

	public function getImageType() {
		return $this->type;
	}

	public function MergeWaterMark($foregroundPath, $savePath, $opacity = 50, $x = 10, $y = 10) {

		$er = 'Загруженный рисунок является поврежденным';

		switch ($this->type) {
			case "gif": $background = ImageCreateFromGIF($this->src) or die($er);
				break;
			case "jpg": $background = ImageCreateFromJPEG($this->src) or die($er);
				break;
			case "jpeg": $background = ImageCreateFromJPEG($this->src) or die($er);
				break;
			case "bmp": $background = ImageCreateFromBMP($this->src) or die($er);
				break;
			case "png": $background = ImageCreateFromPNG($this->src) or die($er);
				break;
			default: $background = ImageCreateFromJPEG($this->src) or die($er);
				break;
		}

		if (!empty($foregroundPath)) {
			$type = explode(".", $foregroundPath);
			$type = strtolower($type[1]);
		}
		switch ($type) {
			case "gif": $foreground = ImageCreateFromGIF($foregroundPath) or die($er);
				break;
			case "jpg": $foreground = ImageCreateFromJPEG($foregroundPath) or die($er);
				break;
			case "jpeg": $foreground = ImageCreateFromJPEG($foregroundPath) or die($er);
				break;
			case "bmp": $foreground = ImageCreateFromBMP($foregroundPath) or die($er);
				break;
			case "png": $foreground = ImageCreateFromPNG($foregroundPath) or die($er);
				break;
			default: $foreground = ImageCreateFromJPEG($foregroundPath) or die($er);
				break;
		}

		$insertWidth = imagesx($foreground);
		$insertHeight = imagesy($foreground);

		$imageWidth = imagesx($background);
		$imageHeight = imagesy($background);

//		$overlapX = $imageWidth - $insertWidth - $x;
//		$overlapY = $imageHeight - $insertHeight - $y;
//		imagecolortransparent($foreground, imagecolorat($foreground, 0, 0));
//		imagecopymerge($background, $foreground, $overlapX, $overlapY, 0, 0, $insertWidth, $insertHeight, $opacity);

		require_once("util/api.watermark.php");
		$return_img = imagecreatetruecolor($imageWidth, $imageHeight);
		$watermark = new watermark();
		$return_img_obj = $watermark->create_watermark($background, $foreground, $opacity);

		$this->saveResizedImage($return_img_obj, $savePath);
//		$this->saveResizedImage($background, $savePath);
	}
	
	public function checkLastPixel() {
		$er = 'Загруженный рисунок является поврежденным';
		switch ($this->type) {
			case "gif": $srcImage = ImageCreateFromGIF($this->src) or die($er . BACK);
				break;
			case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
			case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
			case "bmp": $srcImage = ImageCreateFromBMP($this->src) or die($er . BACK);
				break;
			case "png": $srcImage = ImageCreateFromPNG($this->src) or die($er . BACK);
				break;
			default: $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
		}
		$x = imagesx($srcImage);
		$y = imagesy($srcImage);
		$rgb = imagecolorat($srcImage, $x-1, $y-1);
		$r = ($rgb >> 16) & 0xFF;
		$g = ($rgb >> 8) & 0xFF;
		$b = $rgb & 0xFF;
		$q = 1 - ($r+$g+$b)/765;

		ImageDestroy($srcImage);

		return $q;
	}

	public function ResizeFromRaf($newWidth, $newHeight, $tofile=null, $border=0, $not_center=false, $padding_top=0){
		$er = 'Загруженный рисунок является поврежденным';
		switch ($this->type) {
			case "gif": $srcImage = ImageCreateFromGIF($this->src) or die($er . BACK);
				break;
			case "jpg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
			case "jpeg": $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
			case "bmp": $srcImage = ImageCreateFromBMP($this->src) or die($er . BACK);
				break;
			case "png": $srcImage = ImageCreateFromPNG($this->src) or die($er . BACK);
				break;
			default: $srcImage = ImageCreateFromJPEG($this->src) or die($er . BACK);
				break;
		}
		$srcWidth = ImageSX($srcImage);
		$srcHeight = ImageSY($srcImage);

		if ($srcWidth == $newWidth && $srcHeight == $newHeight && $tofile) {
			copy($this->src, $tofile);
		} 
		else {
			if ($newWidth xor $newHeight) {
				if ($newHeight == 0

					)$newHeight = $newWidth * $srcHeight / $srcWidth;
				if ($newWidth == 0

					)$newWidth = $newHeight * $srcWidth / $srcHeight;
			}
			elseif (!$newWidth and !$newHeight)
				die("высота и ширина не заданы" . BACK);

			$s = $srcWidth / $srcHeight;
			$n = $newWidth / $newHeight;

			if ($srcWidth < $srcHeight) {
				if ($s < $n) {
					$destWidth = $newWidth;
					$destHeight = $newWidth / $s;
				} 
				else {
					$destHeight = $newHeight;
					$destWidth = $newHeight * $s;
				}
			} 
			else {
				if ($s < $n) {
					$destWidth = $newWidth;
					$destHeight = $newWidth / $s;
				} 
				else {
					$destHeight = $newHeight;
					$destWidth = $newHeight * $s;
				}
			}

			$destImage = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($destImage, false);
                        imagesavealpha($destImage, true);
			$pSrcX = 0;
			$pSrcY = 0;
			//print_r("destWidth=".$destWidth."; newWidth=".$newWidth."; srcWidth=".$srcWidth."   ");
			//print_r("destHeight=".$destHeight."; newHeight=".$newHeight."; srcHeight=".$srcHeight."============ ");
			
			
			//destWidth=146; newWidth=146; srcWidth=290
			//destHeight=185.772413793; newHeight=112; srcHeight=369
			
			
			if ($destWidth > $newWidth && !$not_center) {				
				$pSrcX = ($srcWidth - $newWidth * ($srcWidth / $destWidth)) / 2;
			}
			if ($destHeight > $newHeight && !$not_center) {
				$pSrcY = ($srcHeight - $newHeight * ($srcHeight / $destHeight)) / 2;
				if($padding_top){
					$pSrcY = $padding_top;
				}
				//die();
			}

			
			
			imagecopyresampled($destImage, $srcImage, 0, 0, $pSrcX, $pSrcY, $destWidth, $destHeight, $srcWidth, $srcHeight);

			if ($border != 0) {
				$destImage2 = imagecreatetruecolor($newWidth + $border * 2, $newHeight + $border * 2);
				imagecopy($destImage2, $destImage, $border, $border, 0, 0, $newWidth, $newHeight);
				$destImage = $destImage2;
			}

			if ($tofile)
				$this->saveResizedImage($destImage, $tofile);
			else
				$this->saveResizedImage($destImage, $destImage);
			ImageDestroy($srcImage);
			ImageDestroy($destImage);
		}

		chmod($tofile, 0777);
	}

	function crop($x1,$y1,$x2,$y2,$rw=false,$rh=false,$tofile=false) {
		$outWidth = $x2 - $x1;
		$outHeight = $y2 - $y1;
		$rw = !$rw ? $outWidth : $rw;
		$rh = !$rh ? $outHeight : $rh;
//		echo "$rw $rh";
		$image = imagecreatetruecolor($rw, $rh);
		imagecopyresampled($image, $this->imgResource, 0, 0, $x1, $y1, $rw, $rh, $outWidth, $outHeight);

		if ($tofile) {
			$this->saveResizedImage($image, $tofile);
		}
		imagedestroy($image);
	}
}

?>