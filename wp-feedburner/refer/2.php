<?php

class FeedBurnerFormWidget extends WP_Widget {

    function FeedBurnerFormWidget() {
        parent::WP_Widget(false, $name = 'FeedBurnerFormWidget', $widget_options = array('name' => _x('Feedburner Form','plugin name','fbf'),'description' => __('Add a Feedburner Form','fbf')));;
    }

    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
        $text = apply_filters( 'widget_text', $instance['text'], $instance );
        $user = apply_filters( 'widget_text', $instance['user'], $instance );
        $c = $instance['counter'] ? '1' : '0';
        $style = empty( $instance['style'] ) ? 'static' : $instance['style'];
        $bgcolor = apply_filters( 'widget_text', $instance['bgcolor'], $instance );
        $ftcolor = apply_filters( 'widget_text', $instance['ftcolor'], $instance );
        $textcount = apply_filters( 'widget_text', $instance['textcount'], $instance );
        $button = apply_filters( 'widget_text', $instance['button'], $instance );
        $placeholder = apply_filters( 'widget_text', $instance['placeholder'], $instance );
        $cre = $instance['credit'] ? '1' : '0';
        $image = apply_filters( 'widget_text', $instance['image'], $instance );
        ?>


    <?php echo $before_widget; ?>

    <div class="fb-container">
        <?php if ( $title )  echo $before_title . $title . $after_title; ?>
        <div class="fbf-text">
        <?php if ( !empty($image) ) {  ?><img class="feed-image" src="<?php echo $image; ?>" alt="RSS" title=""/><?php } ?>
        <?php echo $instance['filter'] ? wpautop($text) : $text; ?>
        </div>
        <form  class="fbf-widget" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $user; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
        <input class="subscription_email" type="text" name="email" placeholder="<?php echo $placeholder; ?>" /><input type="hidden" value="<?php echo $user; ?>" name="uri"/>
        <input type="hidden" name="loc" value="<?php echo get_locale(); ?>"/>
        <input class="subscription_btn" type="submit" value ="<?php echo $button; ?>"/>
        </form>

    <?php if ( $cre ) {  ?>
    <p class="fb-credits"><a href="http://wordpress.org/extended/plugin/feedburner-form" target="_blank">FBF</a> &#9642; <a href="http://google.feedburner.com" target="_blank"><?php _e( 'Powered by &reg;Google Feedburner','fbf' ); ?></a></p>
    <?php } ?>

    <?php if ( $c ) {  ?>
    <div class="fb-counter-img"><a href="http://feeds2.feedburner.com/<?php echo $user; ?>" rel="nofollow"><img src="http://feeds.feedburner.com/~fc/<?php echo  $user.'?bg='.$bgcolor.'&amp;'.'fg='.$ftcolor.'&amp;'.'anim='.$style.'&amp;'.'label='.$textcount; ?>" height="26" width="88" style="border:0" alt="" /></a></div>
    <?php } ?>

    </div>
		<?php echo $after_widget; ?>

<img src="http://type the url of the image"></br>
<img src="http://type the url of the image"></br>
<img src="http://type the url of the image">
    <?php
}


    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['counter'] = !empty($new_instance['counter']) ? 1 : 0;
      $instance['credit'] = !empty($new_instance['credit']) ? 1 : 0;

	 		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		    else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		  $instance['filter'] = isset($new_instance['filter']);


      if ( in_array( $new_instance['style'], array( '0', '1' ) ) ) {
			$instance['style'] = $new_instance['style'];
	    	} else {
			$instance['style'] = '1';
	    	}

      if ( !empty( $new_instance['user'] ) ) {
			$instance['user'] = $new_instance['user'];
	    	} else {
			$instance['user'] = 'feedname';
	    	}

      if ( !empty( $new_instance['textcount'] ) ) {
			$instance['textcount'] = $new_instance['textcount'];
	    	} else {
			$instance['textcount'] = 'readers';
	    	}

      if ( !empty( $new_instance['bgcolor'] ) ) {
			$instance['bgcolor'] = $new_instance['bgcolor'];
	    	} else {
			$instance['bgcolor'] = 'FF9900';
	    	}

      if ( !empty( $new_instance['ftcolor'] ) ) {
			$instance['ftcolor'] = $new_instance['ftcolor'];
	    	} else {
			$instance['ftcolor'] = '000000';
	    	}

      $instance['button'] = ($new_instance['button']);

      $instance['placeholder'] = ($new_instance['placeholder']);

      $instance['image'] = ($new_instance['image']);

     return $instance;
    }

    function form($instance) {
    $instance = wp_parse_args( (array) $instance, array(  'title' => '','text'=>'','user' => 'dianakcury','counter' => 1,'style' => '1','bgcolor'=>'FF9900', 'ftcolor'=> '000','textcount' => 'readers','button'=> 'Ok','credit' => 1, 'placeholder' =>'', 'image' => '' ) );

    $regex = array('#[^\w()/.%\-&]#','#\/#','#http\:\/\/#','#http#','#feeds2.feedburner.com#','#\%#','#\&#','#\(#','#\)#');


		$title = $instance['title'];
    $text = esc_textarea($instance['text']);
    $user = preg_replace($regex, '', substr($instance['user'], strrpos($instance['user'], '/')));
    $counter = isset($instance['counter']) ? (bool) $instance['counter'] :false;
    $bgcolor = ($instance['bgcolor']);
    $ftcolor = ($instance['ftcolor']);
    $textcount = ($instance['textcount']);
    $button = ($instance['button']);
    $placeholder = ($instance['placeholder']);
    $credit = isset($instance['credit']) ? (bool) $instance['credit'] :false;
    $image = ($instance['image']);
    ?>

<style type="text/css">
#fb-prev-base {margin:0 auto;background: url( <?php echo PLUGIN_URL ."/".FB_DIR_NAME."/img/prev.png" ?> ) no-repeat 0px 8px;width:88px;height:25px}
#fb-text{float:left;;overflow:hidden;width:40px;height:16px;margin:2px 0;font-size:9px;}
p.fb-credits a, .fb-credits{
  color:#ccc;font-size:10px;text-decoration:none;text-align:center
 margin:0 auto; font-family:arial;
}


</style>

    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?> (<?php _e('Optional'); ?>)<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

         <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Arbitrary text or HTML'); ?> (<?php _e('Optional'); ?>)</label>
	      	<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Icon URL','fbf'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>" />
          <br /><span style="font-size:10px;color:#ccc">http://site.com/images/<strong style="background:#fff;color:#333">feed.png</strong></span>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button text','fbf'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo $button; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('placeholder'); ?>"><?php _e('Field text','fbf'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo $placeholder; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('user'); ?>"><?php _e('Feed URL name','fbf'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $user; ?>" />
          <br /><span style="font-size:10px;color:#ccc">http://feeds2.feedburner.com/<strong style="background:#fff;color:#333"><?php _e('MyFeedName','fbf'); ?></strong></span>
        </p>

        <br />

        <p class="fb-credits"><a href="http://wordpress.org/extended/plugin/feedburner-form" target="_blank">FBF</a> &#9642; <a href="http://google.feedburner.com" target="_blank"><?php _e( 'Powered by &reg;Google Feedburner','fbf' ); ?></a></p>

        <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('counter'); ?>" name="<?php echo $this->get_field_name('counter'); ?>"<?php checked( $counter ); ?> />
	     	<label for="<?php echo $this->get_field_id('counter'); ?>"><?php _e( 'Display counter','fbf' ); ?></label><br /><br />

    		<p>
    			<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e( 'Counter style:','fbf' ); ?></label>
    			<select style="width:100px;float:right" name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
    				<option value="0"<?php selected( $instance['style'], '0' ); ?>><?php _e('Static','fbf'); ?></option>
    				<option value="1"<?php selected( $instance['style'], '1' ); ?>><?php _e('Animated','fbf'); ?></option>
    			</select>
    		</p>

        <p>
          <label for="<?php echo $this->get_field_id('bgcolor'); ?>"><?php _e('Background Color'); ?></label>
          <input style="width:100px;float:right;" maxlength="6" id="<?php echo $this->get_field_id('bgcolor'); ?>" name="<?php echo $this->get_field_name('bgcolor'); ?>" type="text" value="<?php echo $bgcolor; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('ftcolor'); ?>"><?php _e('Counter text color','fbf'); ?></label>
          <input style="width:100px;float:right" maxlength="6" id="<?php echo $this->get_field_id('ftcolor'); ?>" name="<?php echo $this->get_field_name('ftcolor'); ?>" type="text" value="<?php echo $ftcolor; ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('textcount'); ?>"><?php _e('Counter text','fbf'); ?></label>
          <input style="width:100px;float:right" id="<?php echo $this->get_field_id('textcount'); ?>" name="<?php echo $this->get_field_name('textcount'); ?>" type="text" value="<?php echo $textcount; ?>" />


</p>



        <?php
    }

} // class FeedBurnerFormWidget

add_action('widgets_init', create_function('', 'return register_widget("FeedBurnerFormWidget");'));

?>
