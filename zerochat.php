<?php
		
		/*
		Plugin Name: ZeroChat Chatroom
		Plugin URI: http://www.zeroirc.com
		Description: Plugin to embed a free chatroom into your wordpress blog/website.
		Author: ZeroIRC
		Version: 1.2.2
		Author URI: http://www.zeroirc.com
		*/
		
function zchat_admin_actions() {  
  add_options_page( 'ZeroChat Options', 'ZeroChat', 'manage_options', 'zerochat-conf', 'zchat_admin' ); 
}
	add_action('admin_menu', 'zchat_admin_actions');
	
		add_action( 'admin_notices', 'zchat_setup');
	
		function zchat_admin() { 
			if($_POST['zchat_hidden'] == 'Y') {
			//Form data sent
			$channel = $_POST['zchat_channel'];
			update_option('zchat_channel', $channel);
			
			$width = $_POST['zchat_width'];
			update_option('zchat_width', $width);
			
			$height = $_POST['zchat_height'];
			update_option('zchat_height', $height);
			
			$nick = $_POST['zchat_nick'];
			update_option('zchat_nick', $nick);
			
			$nickserv = $_POST['zchat_nickserv'];
			update_option('zchat_nickserv', $nickserv);
			
			$ucount = $_POST['zchat_ucount'];
			update_option('zchat_ucount', $ucount);
			
			$style = $_POST['zchat_style'];
			update_option('zchat_style', $style);
			
			$cpage = $_POST['zchat_cpage'];
			update_option('zchat_cpage', $cpage);
			
			$poby = $_POST['zchat_poby'];
			update_option('zchat_poby', $poby);
			
			$ctype = $_POST['zchat_ctype'];
			update_option('zchat_ctype', $ctype);
			
			$autocon = $_POST['zchat_autocon'];
			update_option('zchat_autocon', $autocon);

			?>
			<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
			<?php
		} else {
			//Normal page display
			$channel = get_option('zchat_channel');
			$width = get_option('zchat_width');
			$height = get_option('zchat_height');
			$nick = get_option('zchat_nick');
			$nickserv = get_option('zchat_nickserv');
			$ucount = get_option('zchat_ucount');
			$style = get_option('zchat_style');
			$cpage = get_option('zchat_cpage');
			$poby = get_option('zchat_poby');
			$ctype = get_option('zchat_ctype');
			$autocon = get_option('zchat_autocon');

			
		}
	?>
	

<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div>
			<?php    echo "<h2>" . __( 'ZeroChat Configuration Options', 'zchat_trdom' ) . "</h2>"; ?>
To being using this plugin, you must fill in the options below. For more Documentation on usage <a href="http://ww.zeroirc.com/zerochat-wp" title="Documentation">Click here.</a>

<form name="zchat_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
				<input type="hidden" name="zchat_hidden" value="Y">
	  <?php    echo "<h4>" . __( 'Settings', 'zchat_trdom' ) . "</h4>"; ?>
<table width="100%" border="0">
  <tr>
    <td><strong><?php _e("Chatroom Name:" ); ?></strong></td>
    <td><input type="text" name="zchat_channel" value="<?php if ($channel == "") { echo '#TheHangout'; } else { echo $channel; } ?>" size="20"></td>
    <td><em>The name of your chatroom. (Default is #Main)</em></td>
  </tr>
  <tr>
    <td><strong><?php _e("Width:" ); ?></strong></td>
    <td><input type="text" name="zchat_width" value="<?php if ($width == "") { echo '550'; } else { echo $width; } ?>" size="20"></td>
    <td><em>Width of your chatroom. (Default is 550)</em></td>
  </tr>
  <tr>
    <td><strong><?php _e("Height:" ); ?></strong></td>
    <td><input type="text" name="zchat_height" value="<?php if ($height == "") { echo '450'; } else { echo $height; } ?>" size="20"></td>
    <td><em>Height of your chatroom. (Default is 450)</em></td>
  </tr>
  <tr>
    <td><strong><?php _e("Nickname Suggestion:" ); ?></strong></td>
    <td><input type="text" name="zchat_nick" value="<?php if ($nick == "") { echo 'WPGuest_%'; } else { echo $nick; } ?>" size="20"></td>
    <td><em>Default nickname for your chatroom's guests. (Default is WPGuest_%) [% is replaced with a random number]</em></td>
  </tr>
    <tr>
    <td><strong><?php _e("Chat Type:" ); ?></strong></td>
    <td><select name="zchat_ctype"><option value="flash" <? if ($ctype == "flash" || $ctype == "") { echo 'selected' ;} ?>>Flash</option><option value="ajax" <? if ($ctype == "ajax") { echo 'selected' ;} ?>>AJAX</option></select></td>
    <td><em>Type of the chat client. (Default is Flash)</em></td>
  </tr>
    <tr>
    <td><strong><?php _e("Auto Connect:" ); ?></strong></td>
    <td><select name="zchat_autocon"><option value="false" <? if ($autocon == "false") { echo 'selected' ;} ?>>Yes</option><option value="true" <? if ($autocon == "true" || $autocon == "") { echo 'selected' ;} ?>>No</option></select></td> <td><em>Should the chat auto connect? This will override the "Show NickServ Password Box" setting. (Default is no) <strong>Not available on AJAX Chat.</strong></em></td>  
    </tr>
  <tr>
    <td><strong><?php _e("Show NickServ Password Box:" ); ?></strong></td>
    <td><select name="zchat_nickserv"><option value="true" <? if ($nickserv == "true" || $nickserv == "") { echo 'selected' ;} ?>>Yes</option><option value="false" <? if ($nickserv == "false") { echo 'selected' ;} ?>>No</option></select></td> <td><em>Should the nickserv password box be shown before login? If no, the chat will automatically connect. (Default is yes)</em></td>  
    </tr>
  <tr>
    <td><strong><?php _e("Style:" ); ?></strong></td>
    <td><select name="zchat_style"><option value="default" <? if ($style == "default" || $style == "") { echo 'selected' ;} ?>>Default</option><option value="black" <? if ($style == "black") { echo 'selected' ;} ?>>Black</option><option value="blue" <? if ($style == "blue") { echo 'selected' ;} ?>>Blue</option><option value="darkorange" <? if ($style == "darkorange") { echo 'selected' ;} ?>>Orange</option><option value="green" <? if ($style == "green") { echo 'selected' ;} ?>>Green</option><option value="lightblue" <? if ($style == "lightblue") { echo 'selected' ;} ?>>LightBlue</option><option value="yellow" <? if ($style == "yellow") { echo 'selected' ;} ?>>Yellow</option></select></td>
    <td><em>Color style of the chatroom. (Default is default) <strong>NOTE: AJAX chat client does not support black.</strong></em></td>
  </tr>
  <tr>
    <td><strong><?php _e("Chat Page:" ); ?></strong></td>
    <td><?php wp_dropdown_pages( array( 'name' => 'zchat_cpage', 'echo' => 1, 'show_option_none' => 'Select', 'option_none_value' => '0', 'selected' => $cpage ) ); ?></td>
    <td><em>Page to show the chatroom on.</em></td>
  </tr>
  <tr>
    <td><strong><?php _e("Powered By:" ); ?></strong></td>
    <td><select name="zchat_poby"><option value="true" <? if ($poby == "true" || $poby == "") { echo 'selected' ;} ?>>Yes</option><option value="false" <? if ($poby == "false") { echo 'selected' ;} ?>>No</option></select></td> <td><em>Should we display a powered by link under the chatroom? (Default is yes)</em></td>  
    </tr>
</table>
	  <p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'zchat_trdom' ) ?>" />
				</p>
			</form>
		</div>
<?
		}
		
function zchat_setup() {
	if (get_option('zchat_channel') == "" ) {
		echo '<div class="updated fade"><p><strong>ZeroChat:</strong> Please visit the ZeroChat <a href="options-general.php?page=zerochat-conf">settings page</a> to complete the  setup.</p></div>';
	}
}		
	
	function zchat_cpage($content) {
	global $post;
	
	if ($post->ID == get_option('zchat_cpage')) {
	   
         return  zchat_showchat();
	}
	else {
		return $content;
	}
}

add_filter( 'the_content', 'zchat_cpage' );
	
function zchat_showchat() {
	
			$channel = get_option('zchat_channel');
			$width = get_option('zchat_width');
			$height = get_option('zchat_height');
			$nickserv = get_option('zchat_nickserv');
			$ucount = get_option('zchat_ucount');
			$style = get_option('zchat_style');
			$poby = get_option('zchat_poby');
			$ctype = get_option('zchat_ctype');
			$autocon = get_option('zchat_autcon');
			if (is_user_logged_in()) {
			global $current_user;
            get_currentuserinfo();
			$nick = $current_user->user_login;
			} else { $nick = get_option('zchat_nick'); }


if ($style == black) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/black.css"; $astyle = ""; }
elseif ($style == blue) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/blue.css"; $astyle = "&uio=OT0xOTc60"; }
elseif ($style == darkorange) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/darkorange.css"; $astyle = "&uio=OT0yNQa1"; }
elseif ($style == green) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/green.css"; $astyle = "&uio=OT0xMTE05"; }
elseif ($style == lightblue) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/lightblue.css"; $astyle = "&uio=OT0xODU98"; }
elseif ($style == yellow) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/yellow.css"; $astyle = "&uio=OT00OQbc"; }

else { $fstyle = ""; }

$nicken = urlencode($nick);

$channelen = urlencode($channel);

if (stristr($nick,"_%")) { $nickaj1 = substr($nick, 0, -1); $nickaj = $nickaj1."...."; } else { $nickaj = $nick; }

if ($nickserv == "true") { $nsaprompt = "1"; } else { $nsaprompt = "0"; }

if ($poby == "true") { $powered = '<br /><div align="center"><a href="http://www.zeroirc.com/"><img src="http://zeroirc.com/poweredby.png" alt="Powered by ZeroIRC" /></a></div>'; }

	
if ($ctype == "flash") {	return '<iframe src="http://flash.zeroirc.com/chat.swf?host=flashirc.zeroirc.com&showNickSelection='.$autocon.''.$fstyle.'&autojoin='.$channel.'&nick='.$nicken.'&showIdentifySelection='.$nickserv.'&showTranslationButton=false&showRegisterChannelButton=true&showRegisterNicknameButton=true" style="width:'.$width.'px; height:'.$height.'px; border:0;"></iframe>'.$powered;
}
if ($ctype == "ajax") { return '<iframe src="http://ajax.zeroirc.com:9090?nick='.$nickaj.'&channels='.$channel.'&prompt='.$nsaprompt.''.$astyle.'" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no"></iframe>'.$powered; }

}
	

function zchat_shortcode($atts){
 $thechat = zchat_showchat();
 return $thechat;
}
add_shortcode( 'zerochat', 'zchat_shortcode' );

function zchat_cu_shortcode($atts) {
   extract( shortcode_atts( array(
      'channel' => get_option('zchat_channel'),
	  'type' => get_option('zchat_ctype'),
	  'nickname' => get_option('zchat_nick'),
	  'style' => get_option('zchat_style'),
	  'width' => get_option('zchat_width'),
	  'height' => get_option('zchat_height'),
	  'autoconnect' => get_option('zchat_autocon'),
      ), $atts ) );

// STYLES
if ($style == black) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/black.css"; $astyle = ""; }
elseif ($style == blue) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/blue.css"; $astyle = "&uio=OT0xOTc60"; }
elseif ($style == darkorange) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/darkorange.css"; $astyle = "&uio=OT0yNQa1"; }
elseif ($style == green) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/green.css"; $astyle = "&uio=OT0xMTE05"; }
elseif ($style == lightblue) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/lightblue.css"; $astyle = "&uio=OT0xODU98"; }
elseif ($style == yellow) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/yellow.css"; $astyle = "&uio=OT00OQbc"; }

else { $fstyle = ""; }
   
   $nickname1 = urlencode($nickname);
   $channel2 = urlencode($channel);
 
if (stristr($nickname,"_%")) { $nickaj1 = substr($nickname, 0, -1); $nickaj = $nickaj1."...."; } else { $nickaj = $nickname; }

if ($poby == "true") { $powered = '<br /><div align="center"><a href="http://www.zeroirc.com/"><img src="http://zeroirc.com/poweredby.png" alt="Powered by ZeroIRC" /></a></div>'; }

	
if ($type == "flash") {	return '<iframe src="http://flash.zeroirc.com/chat.swf?host=flashirc.zeroirc.com&showNickSelection='.$autoconnect.''.$fstyle.'&autojoin='.$channel2.'&nick='.$nickname1.'&showIdentifySelection=false&showTranslationButton=false&showRegisterChannelButton=true&showRegisterNicknameButton=true" style="width:'.$width.'px; height:'.$height.'px; border:0;"></iframe>'.$powered;
}
if ($type == "ajax") { return '<iframe src="http://ajax.zeroirc.com:9090?nick='.$nickaj.'&channels='.$channel2.'&prompt=0'.$astyle.'" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no"></iframe>'.$powered; }
}

add_shortcode( 'zchat', 'zchat_cu_shortcode' );


function zchat_ajax_shortcode($atts) {
			$channel = get_option('zchat_channel');
			$width = get_option('zchat_width');
			$height = get_option('zchat_height');
			$nickserv = get_option('zchat_nickserv');
			$ucount = get_option('zchat_ucount');
			$style = get_option('zchat_style');
			$poby = get_option('zchat_poby');
			if (is_user_logged_in()) {
			global $current_user;
            get_currentuserinfo();
			$nick = $current_user->user_login;
			} else { $nick = get_option('zchat_nick'); }

if ($style == black) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/black.css"; $astyle = ""; }
elseif ($style == blue) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/blue.css"; $astyle = "&uio=OT0xOTc60"; }
elseif ($style == darkorange) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/darkorange.css"; $astyle = "&uio=OT0yNQa1"; }
elseif ($style == green) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/green.css"; $astyle = "&uio=OT0xMTE05"; }
elseif ($style == lightblue) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/lightblue.css"; $astyle = "&uio=OT0xODU98"; }
elseif ($style == yellow) { $fstyle = "&amp;styleURL=http://flash.zeroirc.com/css/yellow.css"; $astyle = "&uio=OT00OQbc"; }

else { $fstyle = ""; }

$nicken = urlencode($nick);

$channelen = urlencode($channel);

if (stristr($nick,"_%")) { $nickaj1 = substr($nick, 0, -1); $nickaj = $nickaj1."...."; } else { $nickaj = $nick; }

if ($nickserv == "true") { $nsaprompt = "1"; } else { $nsaprompt = "0"; }

if ($poby == "true") { $powered = '<br /><div align="center"><a href="http://www.zeroirc.com/"><img src="http://zeroirc.com/poweredby.png" alt="Powered by ZeroIRC" /></a></div>'; }

return '<iframe src="http://ajax.zeroirc.com:9090?nick='.$nickaj.'&channels='.$channel.'&prompt='.$nsaprompt.''.$astyle.'" width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no"></iframe>'.$powered;

}

add_shortcode( 'zcajax', 'zchat_ajax_shortcode' );


function zchat_flash_shortcode($atts) {
			$channel = get_option('zchat_channel');
			$width = get_option('zchat_width');
			$height = get_option('zchat_height');
			$nickserv = get_option('zchat_nickserv');
			$ucount = get_option('zchat_ucount');
			$style = get_option('zchat_style');
			$poby = get_option('zchat_poby');
			if (is_user_logged_in()) {
			global $current_user;
            get_currentuserinfo();
			$nick = $current_user->user_login;
			} else { $nick = get_option('zchat_nick'); }

if ($style == black) { $fstyle = "&amp;styleURL=http://flashchat.zeroirc.com/css/black.css"; $astyle = ""; }
elseif ($style == blue) { $fstyle = "&amp;styleURL=http://flashchat.zeroirc.com/css/blue.css"; $astyle = "&uio=OT0xOTc60"; }
elseif ($style == darkorange) { $fstyle = "&amp;styleURL=http://flashchat.zeroirc.com/css/darkorange.css"; $astyle = "&uio=OT0yNQa1"; }
elseif ($style == green) { $fstyle = "&amp;styleURL=http://flashchat.zeroirc.com/css/green.css"; $astyle = "&uio=OT0xMTE05"; }
elseif ($style == lightblue) { $fstyle = "&amp;styleURL=http://flashchat.zeroirc.com/css/lightblue.css"; $astyle = "&uio=OT0xODU98"; }
elseif ($style == yellow) { $fstyle = "&amp;styleURL=http://flashchat.zeroirc.com/css/yellow.css"; $astyle = "&uio=OT00OQbc"; }

else { $fstyle = ""; }

$nicken = urlencode($nick);

$channelen = urlencode($channel);

if ($poby == "true") { $powered = '<br /><div align="center"><a href="http://www.zeroirc.com/"><img src="http://zeroirc.com/poweredby.png" alt="Powered by ZeroIRC" /></a></div>'; }

	
return '<iframe src="http://flashchat.zeroirc.com/chat.swf?host=flashirc.zeroirc.com&policyPort=8004&showNickSelection=true'.$fstyle.'&autojoin='.$channel.'&nick='.$nicken.'&showIdentifySelection='.$nickserv.'&showTranslationButton=false&showRegisterChannelButton=true&showRegisterNicknameButton=true" style="width:'.$width.'px; height:'.$height.'px; border:0;"></iframe>'.$powered;
}
add_shortcode( 'zcflash', 'zchat_flash_shortcode' );



function zchat_uco_shortcode($atts) {
   extract( shortcode_atts( array(
      'channel' => get_option('zchat_channel'),
	  'type' => 'image',
      ), $atts ) );
   
   $channel2 = urlencode($channel);
   $channel3 = ltrim($channel, '#');
 
  	if ($type == "image") { return '<img src="http://rstats.zeroirc.com/ucount.php?chan='.$channel2.'" alt="Chatroom Statistics" />'; }
	
	else {
	
	echo '<script type="text/javascript" src="http://rstats.zeroirc.com/uroom.php?chan='.$channel3.'"></script>'; }
}

add_shortcode( 'zcount', 'zchat_uco_shortcode' );


class UserCountWidget extends WP_Widget
{
  function UserCountWidget()
  {
    $widget_ops = array('classname' => 'UserCountWidget', 'description' => 'Displays user count within ZeroChat' );
    $this->WP_Widget('UserCountWidget', 'ZeroChat User Count', $widget_ops);
  }
 
  function form($instance)
  {
        $title = esc_attr($instance['title']);
		$widchan = esc_attr($instance['channel']);
		$widtype = esc_attr($instance['type']);
		$widalign = esc_attr($instance['align']);


        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>          
        <label for="<?php echo $this->get_field_id('channel'); ?>"><?php _e('Channel:'); ?></label>

          <input id="<?php echo $this->get_field_id('channel'); ?>" name="<?php echo $this->get_field_name('channel'); ?>" type="text" value="<? echo $widchan; ?>"/>
        </p>

		<p>          
        <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Display Type?'); ?></label>

        <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>"><option value="image" <? if ($widtype == "image" || $widtype == "") { echo "selected"; } ?>>Image</option><option value="text" <? if ($widtype == "text") { echo "selected"; } ?>>Text</option></select>  
        
        </p>
        
        <p>          
        <label for="<?php echo $this->get_field_id('align'); ?>"><?php _e('Align:'); ?></label>

        <select id="<?php echo $this->get_field_id('align'); ?>" name="<?php echo $this->get_field_name('align'); ?>"><option value="left" <? if ($widalign == "left" || $widalign == "") { echo "selected"; } ?>>Left</option><option value="center" <? if ($widalign == "center") { echo "selected"; } ?>>Center</option><option value="right" <? if ($widalign == "right") { echo "selected"; } ?>>Right</option></select>  
        
        </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['channel'] = strip_tags($new_instance['channel']);
		$instance['align'] = strip_tags($new_instance['align']);
        return $instance;
		
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 	
	if ($instance['channel']) { $chanstat = $instance['channel']; }
	else {
	$chanstat = get_option('zchat_channel'); }
	$chanstaten = ltrim($chanstat, '#');
	$chanstatim = urlencode ($chanstat);
	
	if ($instance['align'] == "center") { $walign = "<center>"; $walign1 = "</center>"; }
	
	if ($instance['type'] == "image") { echo ''.$walign.'<img src="http://rstats.zeroirc.com/ucount.php?chan='.$chanstatim.'" alt="Chatroom Statistics" align="'.$instance['align'].'" />'.$walign1; }
	
	else {
	
	echo '<script type="text/javascript" src="http://rstats.zeroirc.com/uroom.php?chan='.$chanstaten.'"></script>'; }
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("UserCountWidget");') );

	?>