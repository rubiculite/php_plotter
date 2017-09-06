<?php
// define data point types
define("PLT_POINT" ,1);
define("PLT_CIRCLE",2);
define("PLT_SQUARE",3);

// define data point colors
define("PLT_BLACK", 1);
define("PLT_RED",   2);
define("PLT_ORANGE",3);
define("PLT_YELLOW",4);
define("PLT_GREEN", 5);
define("PLT_BLUE",  6);
define("PLT_VIOLET",7);
define("PLT_PINK",  8);

// for color maps see: http://rapidtables.com/web/color/RGB_Color.htm
$PLT_COLOR_PALLETE_1=array(PLT_RED,PLT_ORANGE,PLT_GREEN,PLT_BLUE,PLT_VIOLET);

class rgb_color {
  private $rgb_black  = array("r" =>   0, "g" =>   0, "b" =>   0);
  private $rgb_red    = array("r" => 255, "g" =>   0, "b" =>   0);
  private $rgb_orange = array("r" => 255, "g" => 128, "b" =>   0);
  private $rgb_yellow = array("r" => 255, "g" => 255, "b" =>   0);
  private $rgb_green  = array("r" =>  76, "g" => 153, "b" =>   0);
  private $rgb_blue   = array("r" =>   0, "g" =>   0, "b" => 204);
  private $rgb_violet = array("r" => 204, "g" =>   0, "b" => 204);
  private $rgb_pink   = array("r" => 255, "g" =>   0, "b" => 157);
  private $rgb_color  = array();

  function __construct() {
    $this->set_rgb_color();
  } // __construct

  public function set_rgb_color($color="") {
    switch ($color) {
    case PLT_RED:
      $this->rgb_color = $this->rgb_red;
      break;
    case PLT_ORANGE:
      $this->rgb_color = $this->rgb_orange;
      break;
    case PLT_YELLOW:
      $this->rgb_color = $this->rgb_yellow;
      break;
    case PLT_GREEN:
      $this->rgb_color = $this->rgb_green;
      break;
    case PLT_BLUE:
      $this->rgb_color = $this->rgb_blue;
      break;
    case PLT_VIOLET:
      $this->rgb_color = $this->rgb_violet;
      break;
    case PLT_PINK:
      $this->rgb_color = $this->rgb_pink;
      break;
    case PLT_BLACK:
    default:
      $this->rgb_color = $this->rgb_black;
      break;
    }
  } // set_rgb_color

  public function get_rgb_color($color="") {
    switch ($color) {
    case PLT_RED:
      $rgb = $this->rgb_red;
      break;
    case PLT_ORANGE:
      $rgb = $this->rgb_orange;
      break;
    case PLT_YELLOW:
      $rgb = $this->rgb_yellow;
      break;
    case PLT_GREEN:
      $rgb = $this->rgb_green;
      break;
    case PLT_BLUE:
      $rgb = $this->rgb_blue;
      break;
    case PLT_VIOLET:
      $rgb = $this->rgb_violet;
      break;
    case PLT_PINK:
      $rgb = $this->rgb_pink;
      break;
    case PLT_BLACK:
      $rgb = $this->rgb_black;
      break;
    default:
      $rgb = $this->rgb_color;
      break;
    }
    return $rgb;
  } // get_rgb_color

  function __destruct() {
  } // __destruct
} // class rgb_color

class plot_color extends rgb_color {
  private $black;
  private $red;
  private $orange;
  private $yellow;
  private $green;
  private $blue;
  private $violet;
  private $pink;
  private $color;

  private $image;

  function __construct($handle) {
    $this->image=$handle;
    parent::__construct();

    $c=$this->get_rgb_color(PLT_BLACK);
    $this->black  = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_RED);
    $this->red    = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_ORANGE);
    $this->orange = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_YELLOW);
    $this->yellow = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_GREEN);
    $this->green  = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_BLUE);
    $this->blue   = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_VIOLET);
    $this->violet = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $c=$this->get_rgb_color(PLT_PINK);
    $this->pink   = imagecolorallocate($this->image,$c["r"],$c["g"],$c["b"]);
    $this->set_color();
  } // __construct
  
  public function set_color($color="") {
    switch ($color) {
    case PLT_RED:
      $this->color = $this->red;
      break;
    case PLT_ORANGE:
      $this->color = $this->orange;
      break;
    case PLT_YELLOW:
      $this->color = $this->yellow;
      break;
    case PLT_GREEN:
      $this->color = $this->green;
      break;
    case PLT_BLUE:
      $this->color = $this->blue;
      break;
    case PLT_VIOLET:
      $this->color = $this->violet;
      break;
    case PLT_PINK:
      $this->color = $this->pink;
      break;
    case PLT_BLACK:
    default:
      $this->color = $this->black;
      break;
    }
  } // set_color

  public function get_color() {
    return $this->color;
  } // get_color

  function __destruct() {
    imagecolordestruct($this->black);
    imagecolordestruct($this->red);
    imagecolordestruct($this->orange);
    imagecolordestruct($this->yellow);
    imagecolordestruct($this->green);
    imagecolordestruct($this->blue);
    imagecolordestruct($this->violet);
    imagecolordestruct($this->pink);
    parent::__destruct();
  } // __destruct
} // class plot_color

class plot_point extends plot_color {
  private $plot_point_size;
  private $plot_point_type;
  private $plot_line_thickness;

  private $image;

  function __construct($handle) {
    $this->image = $handle;
    parent::__construct($this->image);

    $this->set_point_type();
    $this->set_plot_point_line_thickness(1);
    $this->plot_point_size=3.0*imagefontwidth(2)/4.0;
  } // __construct

  public function set_plot_point_line_thickness($thickness=1) {
    $this->plot_line_thickness = ($thickness > 1) ? $thickness : 1;
  } //  set_plot_point_line_thickness

  public function set_point_type($type="") {
    switch($type) {
    case PLT_CIRCLE:
      $this->plot_point_type=PLT_CIRCLE;
      break;
    case PLT_SQUARE:
      $this->plot_point_type=PLT_SQUARE;
      break;
    case PLT_POINT:
    default:
      $this->plot_point_type=PLT_POINT;
      break;
    }
  } // set_point_type

  public function get_point_type() {
    return $this->plot_point_type;
  } // get_point_type

  public function put_point($x,$y) {
    $color=$this->get_color();
    $s=$this->plot_point_size;
    $o=$s/2;
    imagesetthickness($this->image,$this->plot_line_thickness);
    switch($this->plot_point_type) {
    case PLT_CIRCLE:
      imageellipse($this->image,$x,$y,$s,$s,$color);
      break;
    case PLT_SQUARE:
      imagerectangle($this->image,$x-$o,$y-$o,$x+$o,$y+$o,$color);
      break;
    case PLT_POINT:
    default:
      imagesetpixel($this->image,$x,$y,$color);
      break;
    }
    imagesetthickness($this->image,1);
  } // put_point
  
  function __destruct() {
    parent::__destruct();
  } // __destruct
} // class plot_point

class plot_region extends plot_point {
  private $x_min;
  private $x_max;
  private $y_min;
  private $y_max;
  private $d_x;
  private $d_y;
  private $o_x;
  private $o_y;
  private $width;
  private $height;
  private $image;
  
  function __construct($handle,$o_x,$o_y,$w,$h) {
    $this->image  = $handle;
    $this->o_x    = $o_x;
    $this->o_y    = $o_y;
    $this->width  = $w;
    $this->height = $h;
    $this->x_min  = 0;
    $this->x_max  = $w;
    $this->y_min  = 0;
    $this->y_max  = $h;
    $this->d_x    = $w;
    $this->d_y    = $h;
    parent::__construct($this->image);
    
    $this->black  = imagecolorallocate($this->image,  0,  0,  0);
    $this->red    = imagecolorallocate($this->image,255,  0,  0);
    $this->orange = imagecolorallocate($this->image,255,128,  0);
    $this->yellow = imagecolorallocate($this->image,255,255,  0);
    $this->green  = imagecolorallocate($this->image,  0,255,  0);
    $this->blue   = imagecolorallocate($this->image,  0,  0,255);
    $this->violet = imagecolorallocate($this->image,127,  0,255);
    $this->pink   = imagecolorallocate($this->image,255,  0,157);
    $this->color=$this->black;
  } // __construct
  
  public function set_x_range($x_min,$x_max) {
    $this->x_min=$x_min;
    $this->x_max=$x_max;
    $this->d_x = $x_max - $x_min;
  } // set_x_range

  public function set_y_range($y_min,$y_max) {
    $this->y_min=$y_min;
    $this->y_max=$y_max;
    $this->d_y = $y_max - $y_min;
  } // set_y_range

  public function set_region($x_min,$x_max,$y_min,$y_max) {
    $this->set_x_range($x_min,$x_max);
    $this->set_y_range($y_min,$y_max);
  } // set_region

  public function put_point($x,$y,$type="",$color="") {
    if ($type) {
      $this->set_point_type($type);
    }
    
    if ($color) {
      $this->set_color($color);
    }
    
    $xc=$this->map_x($x);
    $yc=$this->map_y($y);
    if ($this->is_in_region($x,$y)) {
      //print "Child: p=($x, $y) => ($xc, $yc)<br>\n";
      parent::put_point($xc,$yc);
    }
  } // put_point

  private function is_in_region($x,$y) {
    return ($this->x_min <= $x && $x <= $this->x_max) &&
           ($this->y_min <= $y && $y <= $this->y_max);
  } // is_in_region

  private function map_x($x) {
    if ($this->d_x != 0) {
      $xp = $this->o_x+($x - $this->x_min)*$this->width/$this->d_x;
    } else {
      $xp = 0;
    }
    return $xp;
  } // map_x

  private function map_y($y) {
    if ($this->d_y != 0) {
      $yp = $this->o_y+($this->y_max-$y)*$this->height/$this->d_y;
    } else {
      $yp = $this->height;
    }
    return $yp;
  } // map_y

  function __destruct() {
    pwrent::__destruct();
  } // __destruct
} // clase plot_region

class plotter extends plot_region {
  // layout
  private $pz_h = 200; // plot zone min height
  private $pz_w = 200; // plot zone min width
  private $tz_h = 7;   // tick zone horizontal tick mark height
  private $tz_w;       // tick zone vertical tick mark width
  private $az_h;       // annotation zone horizontal label height
  private $az_w;       // annotation zone vertical label width
  private $lz_h;       // label zone horizontal label height
  private $lz_w;       // label zone vertical label width

  // extent
  private $img_h;
  private $img_w;

  // colors
  private $background;
  private $foreground;

  // font
  private $font = 4; // use 1..5
  private $pad  = 2;
  private $v_offset = 0.5;

  // image resource
  private $image;

  //
  // constructor
  //

  function __construct($width,  // suggested image width
		       $height, // suggested image height
		       $x_min,  // min x-scale value
		       $x_max,  // max x-scale value
		       $y_min,  // min x-scale value
		       $y_max,  // max y-scale value
		       $grid_on=false) // plot grid
  {
    // layout calculations
    $this->tz_w = $this->tz_h;
    $this->az_h = imagefontheight($this->font)+2*$this->pad;
    $this->az_w = $this->az_h;
    $this->lz_h = (1+2*$this->v_offset)*imagefontheight($this->font)
                  +2*$this->pad;
    $this->lz_w = $this->lz_h;

    // tick marking schemes (adjust to taste)
    $ticks=array(10,5,3);

    // determine plot zone axis size in terms of tick marking schemes
    sort($ticks,SORT_NUMERIC);
    $ticks = array_reverse($ticks);
    $an_x_lens=array();
    $an_y_lens=array();
    foreach ($ticks as $num) {
      array_push($an_x_lens,$this->an_len($num,$x_min,$x_max));
      array_push($an_y_lens,$this->an_len($num,$y_min,$y_max));
    }

    // compute left (h) and bottom (w) boarder clearances
    // for aixis ticks, annotations, and labels
    $boarder_h = $this->tz_h + $this->az_h + 2*$this->lz_h;
    $boarder_w = $this->tz_w + $this->az_w + $this->lz_w
                 + imagefontwidth($this->font);
    
    // determine plot zone x-tick marks
    $num_x_ticks = $ticks[count($ticks)-1];
    $this->pz_w  = $an_x_lens[count($an_x_lens)-1];
    for ($i=0;$i<count($ticks);$i++) {
      if ($an_x_lens[$i]<=($width-$boarder_w)) {
	$num_x_ticks=$ticks[$i];
	break;
      }
    }

    // determine plot zone y-tick marks
    $num_y_ticks = $ticks[count($ticks)-1];
    $this->pz_h  = $an_y_lens[count($an_y_lens)-1];
    for ($i=0;$i<count($ticks);$i++) {
      if ($an_y_lens[$i]<=($height-$boader_h)) {
	$num_y_ticks=$ticks[$i];
	break;
      }
    }

    // determine image width
    if ( ($width - $boarder_w) > $this->pz_w ) {
      $this->img_w = $width;
      $this->pz_w  = $this->img_w - $boarder_w;
    } else {
      $this->img_w = $this->pz_w + $boarder_w;
    }

    // determine image height
    if ( ($height - $boarder_h) > $this->pz_h ) {
      $this->img_h = $height;
      $this->pz_h  = $this->img_h - $boarder_h;
    } else {
      $this->img_h = $this->pz_h + $boarder_h;
    }

    // image setup
    $this->image = imagecreate($this->img_w,$this->img_h);
    $this->background = imagecolorallocate($this->image,255,255,255);
    $this->foreground = imagecolorallocate($this->image,0,0,0);
    imagesetthickness($this->image,1);

    // plot zone setup
    parent::__construct($this->image,
                        $this->lz_w+$this->az_w+$this->tz_w,$this->lz_h,
			$this->pz_w,$this->pz_h);
    $this->set_region($x_min,$x_max,$y_min,$y_max);
    
    // accoutrements
    $this->draw_plot_boarder();
    $this->draw_w_ticks($num_x_ticks,$grid_on);
    $this->draw_h_ticks($num_y_ticks,$grid_on);
    $this->annotate_w($num_x_ticks,$x_min,$x_max);
    $this->annotate_h($num_y_ticks,$y_min,$y_max);
  } // __construct

  //
  // public
  //

  public function title($text="") {
    $df_x=imagefontwidth($this->font);
    $df_y=$this->v_offset*imagefontheight($this->font);
    $x_pos = $this->lz_w + $this->az_w + $this->tz_w
            + ($this->pz_w - $this->label_width($text))/2;
    $y_pos = $this->pad+$df_y;
    for ($i=0;$i<strlen($text);$i++) {
      if (!strcmp($text[$i],"_")) {
	$y_offset=$df_y;
      } else if (!strcmp($text[$i],"^")) {
	$y_offset=-$df_y;
      } else {
       	imagestring($this->image,$this->font,$x_pos,$y_pos+$y_offset,
		    $text[$i],$this->foreground);
	$x_pos+=$df_x;
	$y_offset=0;
      }
    }
  } // title

  public function x_label($text="") {
    $df_x=imagefontwidth($this->font);
    $df_y=$this->v_offset*imagefontheight($this->font);
    $x_pos=$this->lz_w+$this->az_w+$this->tz_w+$this->pz_w/2.0
           -$this->label_width($text)/2.0;
    $y_pos=$this->lz_h+$this->pz_h+$this->tz_h+$this->az_h+$this->pad+$df_y;
    for ($i=0;$i<strlen($text);$i++) {
      if (!strcmp($text[$i],"_")) {
	$y_offset=$df_y;
      } else if (!strcmp($text[$i],"^")) {
	$y_offset=-$df_y;
      } else {
	imagestring($this->image,$this->font,$x_pos,$y_pos+$y_offset,
		    $text[$i],$this->foreground);
	$x_pos+=$df_x;
 	$y_offset=0;
      }
    }
  } // x_label

  public function y_label($text="") {
    $df_x=$this->v_offset*imagefontheight($this->font);
    $df_y=imagefontwidth($this->font);
    $x_pos=$this->pad+$df_x;
    $y_pos=$this->lz_h+$this->pz_h/2.0+$this->label_width($text)/2.0;
    for ($i=0;$i<strlen($text);$i++) {
      if (!strcmp($text[$i],"_")) {
	$x_offset=$df_x;
      } else if (!strcmp($text[$i],"^")) {
	$x_offset=-$df_x;
      } else {
	imagestringup($this->image,$this->font,$x_pos+$x_offset,$y_pos,
		      $text[$i],$this->foreground);
	$y_pos-=$df_y;
	$x_offset=0;
      }
    }
  } // y_label

  //
  // private
  //

  private function label_width($label) {
    return strlen(preg_replace("/[\^\_]/","",$label))
           *imagefontwidth($this->font);
  } // label_width

  private function an_len($num_ticks,$min_val,$max_val) {
    $dv=($max_val-$min_val)/((($num_ticks>1)?$num_ticks:2)-1);
    for ($i=0;$i<$num_ticks;$i++) {
      $an_len=strlen($this->chomp_digits($min_val+$i*$dv));
      if ($i==0) {
	$max_len=$an_len;
      } else if ($max_len<$an_len) {
	$max_len=$an_len;
      }
    }
    $len=$max_len*$num_ticks+$max_len*($num_ticks-1)/2.0+($num_ticks-1);
    return $len*imagefontwidth($this->font);
  } // an_len

  private function chomp_digits($number) {
    $val=floatval(sprintf("%.1e",floatval($number)));
    $val=(strlen("$val")>8)?sprintf("%.1e",$val):"$val";
    return $val;
  } // chomp_digits

  private function draw_plot_boarder() {
    $x_ul = $this->lz_w + $this->az_w + $this->tz_w;
    $y_ul = $this->lz_h;
    $x_br = $x_ul + $this->pz_w;
    $y_br = $y_ul + $this->pz_h;
    imagerectangle($this->image,$x_ul,$y_ul,$x_br,$y_br,$this->foreground);
  } // draw_plot_boarder

  private function draw_w_ticks($number,$grid_on=true) {
    $w_min = $this->lz_w + $this->az_w + $this->tz_w;
    $w_max = $w_min + $this->pz_w;
    $h_min = $this->lz_h;
    $h_max = $h_min + $this->pz_h;

    $th_end=$h_max+$this->tz_h;
    $dw = ($w_max-$w_min)/((($number>1)?$number:2)-1);
    for ($iw=0;$iw<$number;$iw++) {
      $w_tick = $w_min+$iw*$dw;
      imageline($this->image,$w_tick,$h_max,$w_tick,$th_end,
		$this->foreground);
      if ($grid_on) {
	$this->draw_w_grid_line($w_tick);
      }
    }
  } // draw_w_ticks
  
  private function draw_h_ticks($number,$grid_on=true) {
    $w_min = $this->lz_w + $this->az_w + $this->tz_w;
    $w_max = $w_min + $this->pz_w;
    $h_min = $this->lz_h;
    $h_max = $h_min + $this->pz_h;

    $tw_begin=$w_min-$this->tz_w;
    $dh = ($h_max-$h_min)/((($number-1)?$number:2)-1);
    for ($ih;$ih<$number;$ih++) {
      $h_tick = $h_min + $ih*$dh;
      imageline($this->image,$tw_begin,$h_tick,$w_min,$h_tick,
		$this->foreground);
      if ($grid_on) {
	$this->draw_h_grid_line($h_tick);
      }
    }
  } // draw_h_ticks

  private function draw_w_grid_line($x) {
    $x_min = $this->lz_w+$this->az_w+$this->tz_w;
    $x_max = $x_min + $this->pz_w;
    if ($x_min < $x && $x < $x_max) {
      $y_min = $this->lz_h;
      $y_max = $y_min + $this->pz_h;
      $dy=3; // space between pixels
      $max_pts=($y_max-$y_min)/$dy;
      $y=$y_min+$dy;
      while ($y<$y_max && $iter++ < $max_pts) {
	imagesetpixel($this->image,$x,$y,$this->foreground);
	$y+=$dy;
      }
    }
  } // draw_w_grid_line
  
  private function draw_h_grid_line($y) {
    $y_min = $this->lz_h;
    $y_max = $y_min + $this->pz_h;
    if ($y_min < $y && $y < $y_max) {
      $x_min = $this->lz_w+$this->az_w+$this->tz_w;
      $x_max = $x_min + $this->pz_w;
      $dx=3; // space between pixels
      $max_pts = ($x_max-$x_min)/$dx;
      $x=$x_min+$dx;
      while ($x<$x_max && $iter++ < $max_pts) {
	imagesetpixel($this->image,$x,$y,$this->foreground);
	$x+=$dx;
      }
    }
  } // draw_h_grid_line

  private function annotate_w($num_ticks,$x_min,$x_max) {
    $dfont=imagefontwidth($this->font);
    $dt=$this->pz_w/((($num_ticks>1)?$num_ticks:2)-1);
    $t0=$this->lz_w+$this->az_w+$this->tz_w;
    $dx=($x_max-$x_min)/((($num_ticks>1)?$num_ticks:2)-1);
    $y_pos=$this->lz_h+$this->pz_h+$this->tz_h+$this->pad;
    for ($i=0;$i<$num_ticks;$i++) {
      $value=$this->chomp_digits($x_min+$i*$dx);
      $length=strlen($value)*$dfont;
      if ($i==0) {
	$x_pos=$t0-$dfont/2.0;
      } else if ($i==($num_ticks-1)) {
	$x_pos=$t0+$i*$dt-$length+$dfont/2.0;
      } else {
	$x_pos=$t0+$i*$dt-$length/2.0;
      }
      imagestring($this->image,$this->font,$x_pos,$y_pos,$value,
		  $this->foreground);
    }
  } // annotate_w

  private function annotate_h($num_ticks,$y_min,$y_max) {
    $dfont=imagefontwidth($this->font);
    $dt=$this->pz_h/((($num_ticks>1)?$num_ticks:2)-1);
    $t0=$this->lz_h+$this->pz_h;
    $dy=($y_max-$y_min)/((($num_ticks>1)?$num_ticks:2)-1);
    $x_pos=$this->lz_w+$this->az_w-$this->pad-imagefontheight($this->font);
    for ($i=0;$i<$num_ticks;$i++) {
      $value=$this->chomp_digits($y_min+$i*$dy);
      $length=strlen($value)*$dfont;
      if ($i==0) {
	$y_pos=$t0+$dfont/2.0;
      } else if ($i==($num_ticks-1)) {
	$y_pos=$t0-$this->pz_h+$length-$dfont/2.0;
      } else {
	$y_pos=$t0-$i*$dt+$length/2.0;
      }
      imagestringup($this->image,$this->font,$x_pos,$y_pos,$value,
		    $this->foreground);
    }
  } // annotate_h

  //
  // destructor
  //

  function __destruct() {
    $image_type=imagetypes();
    if ($image_type & IMG_PNG) {
      header("Content-type: image/png");
      imagepng($this->image);
    } else if ($image_type & IMG_GIF) {
      header("Content-type: image/gif");
      imagegif($this->image);
    } else { // IMG_JPG
      header("Content-type: image/jpeg");
      imagejpeg($this->image);
    }
    imagecolordeallocate($this->background);
    imagecolordeallocate($this->foreground);
    imagedestroy($this->image);
    parent::__destruct();
  } // __destruct
} // class plotter
?>