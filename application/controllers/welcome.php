<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function draw($width=500, $height=500)
	{
		//create image from dimenssion
		$my_img = imagecreate( $width, $height );

		
		//create background color
		$background = imagecolorallocate( $my_img, 224, 224, 224 );

		//create text color
		$text_colour = imagecolorallocate( $my_img, 48, 48, 48 );
		//$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
		$text = $width.' x '.$height;

		// Set Path to Font File
  		$font_path = getcwd() . '/assets/fonts/ROCK.ttf';

		$bbox = imagettfbbox(25, 0, $font_path, $text);
		$xpos = ($width - $bbox[4])/2;
		$ypos = ($height - $bbox[5])/2;
		// echo ('<pre>');
		// var_dump($bbox); 
		// echo ('</pre>');
		// die();

		imagettftext($my_img, 25, 0, $xpos, $ypos, $text_colour, $font_path, $text);
		//imagealphablending($my_img, true);
		imagesavealpha($my_img, true);
		// imagestring( $my_img, 5, $xpos, $ypos, $text, $text_colour );
		// imagesetthickness ( $my_img, 5 );
		//imageline( $my_img, 30, 45, 165, 45, $line_colour );
		// imagecopymerge($my_img, $bg, 10, 10, 0, 0, 100, 50, 75);
		header( "Content-type: image/png" );
		imagepng( $my_img );
		//imagecolordeallocate( $line_color );
		imagecolordeallocate( $text_color );
		imagecolordeallocate( $background );
		imagedestroy( $my_img );
	}

	public function draw2($width=500, $height=500)
	{
		// $file = 'img.png';
		// $sFile = file_get_contents($file);

		$my_img = imagecreate( $width, $height );
		// $bg = imagecreatefromstring($sFile);

		$background = imagecolorallocate( $my_img, 240, 240, 240 );
		$text_colour = imagecolorallocate( $my_img, 0, 0, 0 );
		//$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
		$text = $width.'x'.$height;

		$fw = imagefontwidth(100);     // width of a character
		$l = strlen($text);          // number of characters
		$tw = $l * $fw;              // text width

		$fh = imagefontheight(100);     // height of a character

		$xpos = ($width - $tw)/2;
		$ypos = ($height - $fh)/2;

		imagestring( $my_img, 5, $xpos, $ypos, $text, $text_colour );
		imagesetthickness ( $my_img, 5 );
		//imageline( $my_img, 30, 45, 165, 45, $line_colour );
		// imagecopymerge($my_img, $bg, 10, 10, 0, 0, 100, 50, 75);
		header( "Content-type: image/png" );
		imagepng( $my_img );
		//imagecolordeallocate( $line_color );
		imagecolordeallocate( $text_color );
		imagecolordeallocate( $background );
		imagedestroy( $my_img );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */