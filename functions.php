<?

function cleanblog_style() {




    wp_enqueue_style( 'cleanblog-style', get_template_directory_uri() . '/css/styles.css');
    //wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/clean-blog.min.css' );
    wp_enqueue_style('cleanblog-bootstrap', get_template_directory_uri(). '/vendor/bootstrap/css/bootstrap.min.css');

     wp_enqueue_style('cleanblog-fontawesome', get_template_directory_uri(). 'vendor/font-awesome/css/font-awesome.css');

     wp_enqueue_style('cleanblog-fontawesome2', get_template_directory_uri(). 'vendor/font-awesome/css/font-awesome.min.css');


    
     

    wp_enqueue_script( 'cleanblog-jquery', get_template_directory_uri() . '/js/contact_me.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-bootstrap', get_template_directory_uri() . '/js/jqBootstrapValidation.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-javascript', get_template_directory_uri() . '/js/clean-blog.min.js', array(), '20150803', true );

	wp_enqueue_script( 'cleanblog-javasc2', get_template_directory_uri() . 'vendor/jquery/jquery.min.js', array(), '20150803', true );


wp_enqueue_script( 'cleanblog-javasc3', get_template_directory_uri() . 'vendor/bootstrap/js/bootstrap.min.js', array(), '20150803', true );


wp_enqueue_script( 'cleanblog-javasc3', get_template_directory_uri() . '/js/clean-blog.min.js', array(), '20150803', true );




  }
   add_action( 'wp_enqueue_scripts', 'cleanblog_style' );

   $default_header_image= array(
   	'default-image'=> get_template_directory_uri(). '/img/home-bg.jpg'
   	);

   add_theme_support('custom-header', $default_header_image);

  ?>