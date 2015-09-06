<?php

crop($_POST['image'], 'uploads/test.jpg', array($_POST['x1'], $_POST['y1'], $_POST['w'], $_POST['h']));

function crop($file_input, $file_output, $crop = 'square',$percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Unable to get the length and width of the image';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Некорректный формат файла';
		return;
    }
	if ($crop == 'square') {
		$min = $w_i;
		if ($w_i > $h_i) $min = $h_i;
		$w_o = $h_o = $min;
	} else {
		list($x_o, $y_o, $w_o, $h_o) = $crop;
		if ($percent) {
			$w_o *= $w_i / 100;
			$h_o *= $h_i / 100;
			$x_o *= $w_i / 100;
			$y_o *= $h_i / 100;
		}
    	//if ($w_o < 0) $w_o += $w_i;
	//    $w_o -= $x_o;
	//   	if ($h_o < 0) $h_o += $h_i;
	//	$h_o -= $y_o;
	}
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
	if ($type == 3) {
		imagesavealpha($img_o, true);
		$trans_colour = imagecolorallocatealpha($img_o, 0, 0, 0, 127);
		imagefill($img_o, 0, 0, $trans_colour);
	}
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
}





/*
cropImage(
    $_POST['i'],
    (($_POST['w'] < 1)?1:$_POST['w']),
    (($_POST['h'] < 1)?1:$_POST['h']), $_POST['x'], $_POST['y']
);
*/



?>

<span class="big_avatar" style="background-image:url(/uploads/test.jpg<?php echo '?'.rand(1,101)?>)"></span>