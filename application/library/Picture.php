<?php
/**
 * 功能：图片压缩
 * @date 2015-9-29 下午4:30:20
 * @author wangjian
 * @version 1.0.0
 */
class Picture {
	const MAX = 300;
	public static function resizeImage($srcFile) {
		$show_pic_scal = self::show_pic_scal ( self::MAX, self::MAX, PIC_PATH. '/' . $srcFile );
		return basename(self::resize ( $filename, $show_pic_scal [0], $show_pic_scal [1] ));
	}
	private static function show_pic_scal($width, $height, $picpath) {
		$imginfo = getimagesize ( $picpath );
		$imgw = $imginfo [0];
		$imgh = $imginfo [1];
		
		$ra = number_format ( ($imgw / $imgh), 1 ); // 宽高比
		$ra2 = number_format ( ($imgh / $imgw), 1 ); // 高宽比
		
		if ($imgw > $width || $imgh > $height) {
			if ($imgw > $imgh) {
				$newWidth = $width;
				$newHeight = round ( $newWidth / $ra );
			} elseif ($imgw < $imgh) {
				$newHeight = $height;
				$newWidth = round ( $newHeight / $ra2 );
			} else {
				$newWidth = $width;
				$newHeight = round ( $newWidth / $ra );
			}
		} else {
			$newHeight = $imgh;
			$newWidth = $imgw;
		}
		return array (
				$newWidth,
				$newHeight 
		);
	}
	private static function create($src) {
		$info = getimagesize ( $src );
		switch ($info [2]) {
			case 1 :
				$im = imagecreatefromgif ( $src );
				break;
			case 2 :
				$im = imagecreatefromjpeg ( $src );
				break;
			case 3 :
				$im = imagecreatefrompng ( $src );
				break;
		}
		return $im;
	}
	private static function resize($src, $w, $h) {
		$temp = pathinfo ( $src );
		$name = $temp ["basename"]; // 文件名
		$dir = $temp ["dirname"]; // 文件所在的文件夹
		$extension = $temp ["extension"]; // 文件扩展名
		$savepath = "{$dir}/small-{$name}"; // 缩略图保存路径,新的文件名为*.thumb.jpg
		                                    
		// 获取图片的基本信息
		$info = getimagesize ( $src );
		$width = $info [0]; // 获取图片宽度
		$height = $info [1]; // 获取图片高度
		$per1 = round ( $width / $height, 2 ); // 计算原图长宽比
		$per2 = round ( $w / $h, 2 ); // 计算缩略图长宽比
		                              // 计算缩放比例
		if ($per1 > $per2 || $per1 == $per2) {
			// 原图长宽比大于或者等于缩略图长宽比，则按照宽度优先
			$per = $w / $width;
		}
		if ($per1 < $per2) {
			// 原图长宽比小于缩略图长宽比，则按照高度优先
			$per = $h / $height;
		}
		$temp_w = intval ( $width * $per ); // 计算原图缩放后的宽度
		$temp_h = intval ( $height * $per ); // 计算原图缩放后的高度
		$temp_img = imagecreatetruecolor ( $temp_w, $temp_h ); // 创建画布
		$im = self::create ( $src );
		imagecopyresampled ( $temp_img, $im, 0, 0, 0, 0, $temp_w, $temp_h, $width, $height );
		if ($per1 > $per2) {
			imagejpeg ( $temp_img, $savepath, 100 );
			imagedestroy ( $im );
			return self::addBg ( $savepath, $w, $h, "w" );
		}
		if ($per1 == $per2) {
			imagejpeg ( $temp_img, $savepath, 100 );
			imagedestroy ( $im );
			return $savepath;
		}
		if ($per1 < $per2) {
			imagejpeg ( $temp_img, $savepath, 100 );
			imagedestroy ( $im );
			return self::addBg ( $savepath, $w, $h, "h" );
		}
	}
	private static function addBg($src, $w, $h, $fisrt = "wh") {
		$bg = imagecreatetruecolor ( $w, $h );
		$white = imagecolorallocate ( $bg, 255, 255, 255 );
		imagefill ( $bg, 0, 0, $white ); // 填充背景
		                                 
		// 获取目标图片信息
		$info = getimagesize ( $src );
		$width = $info [0]; // 目标图片宽度
		$height = $info [1]; // 目标图片高度
		$img = self::create ( $src );
		if ($fisrt == "wh") {
			return $src;
		} else {
			if ($fisrt == "w") {
				$x = 0;
				$y = ($h - $height) / 2; // 垂直居中
			}
			if ($fisrt == "h") {
				$x = ($w - $width) / 2; // 水平居中
				$y = 0;
			}
			imagecopymerge ( $bg, $img, $x, $y, 0, 0, $width, $height, 100 );
			imagejpeg ( $bg, $src, 100 );
			imagedestroy ( $bg );
			imagedestroy ( $img );
			return $src;
		}
	}
}
?>
		
}
