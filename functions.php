<?

add_theme_support('title-tag');
add_theme_support( 'custom-background');
register_nav_menu('mainmenubar', 'Main Menu');
register_nav_menu('footermen', 'footer Menu');
add_theme_support('post-thumbnails');

require_once('lib/ReduxCore/framework.php');
require_once('lib/sample/cleanblog-config.php');
//for comments section---------->
require get_template_directory() . "/mail/template-tags.php";


function theme_queue_js(){
if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') )
  wp_enqueue_script( 'comment-reply' );
}
add_action('wp_print_scripts', 'theme_queue_js');


#For Get All Styles and Java Scripts----------------------->

function cleanblog_style() {



	wp_enqueue_style('cleanblog-bootstrap', get_template_directory_uri(). '/vendor/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css');
	wp_enqueue_style( 'cleanblog-style', get_template_directory_uri() . '/css/styles.css');
	
	
	wp_enqueue_style( 'cleanblog-style5', get_template_directory_uri() . '/css/owl.theme.default.min.css');
	
	
	


	wp_enqueue_style('cleanblog-fontawesome', get_template_directory_uri(). '/vendor/font-awesome/css/font-awesome.css');

	wp_enqueue_style('cleanblog-fontawesome2', get_template_directory_uri(). '/vendor/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('fontsupportcdn', 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
	wp_enqueue_style('fontsupportcdn2', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');





wp_enqueue_script( 'cleanblog-javascript8', get_template_directory_uri() . '/js/jquery.min.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-javascript9', get_template_directory_uri() . '/js/owl.carousel.js', array(), '', true );
	wp_enqueue_script( 'cleanblog-javasc98', get_template_directory_uri() . '/js/clean-blog.js', array(), '20150803', true );


	wp_enqueue_script( 'cleanblog-javasc2', get_template_directory_uri() . '/vendor/jquery/jquery.min.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-javasc3', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-bootstrap', get_template_directory_uri() . '/js/jqBootstrapValidation.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-jquery', get_template_directory_uri() . '/js/contact_me.js', array(), '20150803', true );
	
	wp_enqueue_script( 'cleanblog-javascript5', get_template_directory_uri() . '/js/clean-blog.min.js', array(), '20150803', true );
	

	


	


	


	




}
add_action( 'wp_enqueue_scripts', 'cleanblog_style' );


#Custom Header Image and Default Header image------------------>
$defaults = array(
	'default-image'  => get_template_directory_uri().'/img/home-bg.jpg',
	
	);

add_theme_support( 'custom-header', $defaults );

#Footer Widget 1------------>
function footersidebar(){
	register_sidebar(array(

		'name'=>'Copyright Information',
		'id'=>'footer_sidebar1',
		'before_widget'=>' ',
		'after_widget'=>'',
		'description'=>'Drag and Drop Text Field from Left Side and Add your Copyright Text',
		));

}

add_action('widgets_init','footersidebar');

#Footer Widget 2-------------->

function footersidebar2(){
	register_sidebar(array(

		'name'=>'Social Media Links',
		'id'=>'footer_sidebar2',
		'before_widget'=>' ',
		'after_widget'=>'',
		'description'=>'Drag and Drop Social Media from Left Side(Dont need to add the Title) ',
		));

}

add_action('widgets_init','footersidebar2');



#Custom Logo---------------->
function themename_custom_logo_setup() {
	$defaults = array(
		'height'      => 45,
		'width'       => 151,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
		);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );



#Add User Profile Field on Wordpress Profile---------------->

function my_new_contactmethods( $contactmethods ) {
    // Add Twitter
	$contactmethods['twitter'] = 'Twitter';
    //add Facebook
	$contactmethods['facebook'] = 'Facebook';

    //add Github
	$contactmethods['github'] = 'Github';

    //add Instagram
	$contactmethods['instagram'] = 'Instagram';

    //add Printerest
	$contactmethods['pinterest'] = 'Pinterest';

    //add google+
	$contactmethods['google'] = 'Google+';



	return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

#Custom Meta Box For Adding Header Imgage and title Every Page------------------->

function cd_meta_box_add()
{
	add_meta_box( 'my-title-id', 'Title meta box', 'cd_meta_box_cb', 'page', 'normal', 'high' );
	add_meta_box( 'my-desc-id', 'Description Meta Box', 'cd_meta_box_desc_cb', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'cd_meta_box_add' );



function cd_meta_box_cb($post)
{ 
	?>

	<label for="title">Page Title</label>
	<input type="text" name="page_title" class="widefat" id="title" value="<?php echo get_post_meta($post->ID,'page_title',true) ?>"  >
	<?php
}
/*Update value*/
function  title_update($post_id){
	update_post_meta($post_id,'page_title',$_POST['page_title']);
}
add_action('save_post','title_update');
function cd_meta_box_desc_cb($post)
{
	?>

	<label for="desc"></label>
	<input type="text" name="desc" class="widefat" value="<?php echo get_post_meta($post->ID,'desc', true) ?>"  >

	<?php
}
function des_output($post_id){
	update_post_meta($post_id,'desc',$_POST['desc']);
}
add_action('save_post','des_output');


#Custom Widget for Social Media--------------------->




class social_widget extends WP_Widget {

	public function __construct() {
		$widget_options = array( 
			'classname' => 'social_widget',
			'description' => 'This is a Social Widget',
			);
		parent::__construct( 'social_widget', 'Social Widget', $widget_options );
	}



	public function widget( $args, $instance ) {

		?>
		<ul class="list-inline text-center">

			<?php
			$walt_id = 1; 
			$userdata = get_user_meta( $walt_id );

			if(!empty($userdata['twitter'][0])){
				?>
				<li class="list-inline-item">
					<a href="<?php  echo $userdata['twitter'][0]; ?>" target="_blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<?php 
			} 

			if(!empty($userdata['facebook'][0])){
				?>

				<li class="list-inline-item">
					<a href="<?php  echo $userdata['facebook'][0]; ?>" target="_blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<?php 
			} 

			if(!empty($userdata['github'][0])){
				?>

				<li class="list-inline-item">
					<a href="<?php  echo $userdata['github'][0]; ?>" target="_blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-github fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<?php 
			} 
			if(!empty($userdata['instagram'][0])){
				?>

				<li class="list-inline-item">
					<a href="<?php  echo $userdata['instagram'][0]; ?>" target="_blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<?php 
			} 

			if(!empty($userdata['google'][0])){
				?>

				<li class="list-inline-item">
					<a href="<?php  echo $userdata['google'][0]; ?>" target="_blank">
						<span class="fa-stack fa-lg">
							<i class="fa fa-circle fa-stack-2x"></i>
							<i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
						</span>
					</a>
				</li>
				<?php 
			}

			?>
		</ul>
		<?php
	}



	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />



		</p>



		<?php 
	}     



	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		return $instance;
	}
}





function register_social_widget() { 
	register_widget( 'social_widget' );
}
add_action( 'widgets_init', 'register_social_widget' );





#Popular Post Custom Widget------------------------------------------------------------->



class sparkling_popular_posts extends WP_Widget {

    function __construct() {

        $widget_ops = array('classname' => 'sparkling-popular-posts', 'description' => esc_html__("Popular Posts Widget", 'sparkling'));
        parent::__construct('sparkling_popular_posts', esc_html__('Popular Posts Widget', 'sparkling'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Popular Posts', 'sparkling');
        $limit = isset($instance['limit']) ? $instance['limit'] : 5;

        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget Content
         */
        ?>

        <!-- popular posts -->
        <div class="popular-posts-wrapper">

            <?php
            query_posts(array(
                'meta_key' => 'post_views_count',
                'posts_per_page' => $limit,
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            ));
            if (have_posts()) : while (have_posts()) : the_post();
                    ?>


                    <?php if (get_the_content() != '') : ?>
                        <!-- post -->
                        <div class="post">

                            <!-- image -->
                            <div class="post-image <?php echo get_post_format(); ?>">

                                <a href="<?php echo get_permalink(); ?>"><?php
                        if (get_post_format() != 'quote') {
                            
                        }
                        ?></a>

                            </div> <!-- end post image -->

                            <!-- content -->
                            <div class="post-content">

                                <a href="<?php echo get_permalink(); ?>"><?php echo trim(substr(get_the_title(), 0, 40)); ?></a>
                               
                                <div class="posts_style">
                                    <span class="posts-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date('d M , Y'); ?> </span>
                                </div>


                                	<br>
                            </div><!-- end content -->
                        </div><!-- end post -->

                    <?php endif; ?>

                    <?php
                endwhile;
            endif;
            wp_reset_query();
            ?>




        </div> <!-- end posts wrapper -->

        <?php
        echo $after_widget;
    }

    function form($instance) {

        if (!isset($instance['title']))
            $instance['title'] = esc_html__('Popular Posts', 'sparkling');
        if (!isset($instance['limit']))
            $instance['limit'] = 5;
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'sparkling') ?></label>

            <input  type="text" value="<?php echo esc_attr($instance['title']); ?>"
                    name="<?php echo $this->get_field_name('title'); ?>"
                    id="<?php $this->get_field_id('title'); ?>"
                    class="widefat" />
        </p>

        <p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Limit Posts Number', 'sparkling') ?></label>

            <input  type="text" value="<?php echo esc_attr($instance['limit']); ?>"
                    name="<?php echo $this->get_field_name('limit'); ?>"
                    id="<?php $this->get_field_id('limit'); ?>"
                    class="widefat" />
        <p>

            <?php
        }

    }
   

    //post counter 
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
// popular post
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

    function register_sidebarwidget() { 
	register_widget( 'sparkling_popular_posts' );
}
add_action( 'widgets_init', 'register_sidebarwidget' );




     register_sidebar(array(
    'id'            => 'sidebar-widget-1',
    'name'          =>  esc_html__( 'Sidebar Widget', 'cleanblog' ),
    'description'   =>  esc_html__( 'Used for popular post ', 'cleanblog' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));



#REMOVE REDUX DEMO TEXTS---------------------------------------------->

function removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'removeDemoModeLink');



?>