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

	public function generate($param = '')
	{
		$arr = $this->uri->segment_array();
		$width=500; $height=500; $text=''; $bg_color='E0E0E0'; $fg_color='A0A0A0'; //default param
		foreach ($arr as $key => $value) {
			if(strrpos($value, '-') === false){
				if(strrpos($value, 'x') !== false){
					$dimenssion = explode('x', $value);
					if(count($dimenssion == 2)){
						$width = $dimenssion[0];
						$height = $dimenssion[1];
					}
				}
			}
			else{
				$par = explode('-', $value);
				switch ($par[0]) {
					case 'T':
						$text = $par[1];
						break;
					case 'BG':
						$bg_color = $par[1];
						break;
					case 'FG':
						$fg_color = $par[1];
						break;
					default:
						# code...
						break;
				}
			}
		}
		$this->draw($width, $height, $text, $bg_color, $fg_color);
	}

	public function draw($width=500, $height=500, $text='', $bg_color='E0E0E0', $fg_color='A0A0A0')
	{
		//create image from dimenssion
		$my_img = imagecreate( $width, $height );

		
		//create background color
		$rgb = $this->hex2rgb($bg_color);
		$background = imagecolorallocate( $my_img, $rgb[0], $rgb[1], $rgb[2]);

		//create text color
		$rgb = $this->hex2rgb($fg_color);
		$text_colour = imagecolorallocate( $my_img, $rgb[0], $rgb[1], $rgb[2]);
		//$line_colour = imagecolorallocate( $my_img, 128, 255, 0 );
		if($text==''){
			$text = $width.' x '.$height;
		}

		// Set Path to Font File
  		$font_path = getcwd() . '/assets/fonts/ROCK.TTF';
  		$font_size = 1;
		$bbox = imagettfbbox($font_size, 0, $font_path, $text);
		while($bbox[4] < $width/3 && $bbox[5]/3){
			$font_size++;
			$bbox = imagettfbbox($font_size, 0, $font_path, $text);
		}
		$xpos = ($width - $bbox[4])/2;
		$ypos = ($height - $bbox[5])/2;

		imagettftext($my_img, $font_size, 0, $xpos, $ypos, $text_colour, $font_path, $text);
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

	function hex2rgb($hex, $default='000000') {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			if(strlen($hex) != 6){
				$hex = $default;
			}
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */