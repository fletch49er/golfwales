<?php

function myhome_child_enqueue_styles() {
	$options           = get_option( 'myhome_redux' );
	$dependency_parent = array();
	$dependency_child  = array( 'myhome-style' );
	if ( ! is_rtl() ) {
		$parent_style = '/style.min.css';
	} else {
		$parent_style = '/style-rtl.min.css';
	}
	if ( ! isset( $options['mh-performance_css'] ) || empty( $options['mh-performance_css'] ) ) {
		$dependency_parent[] = 'normalize';
		$dependency_child[]  = 'normalize';
		if ( ! is_rtl() ) {
			$parent_style = '/style.css';
		} else {
			$parent_style = '/style-rtl.css';
		}
	}

	wp_enqueue_style( 'myhome-style', get_template_directory_uri() . $parent_style, $dependency_parent, My_Home_Theme()->version );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', $dependency_child, My_Home_Theme()->version );
}

add_action( 'wp_enqueue_scripts', 'myhome_child_enqueue_styles' );

function myhome_lang_setup() {
	load_child_theme_textdomain( 'myhome', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'myhome_lang_setup' );

add_action( 'wp_dashboard_setup', 'remove_welcome_panel' );
function remove_welcome_panel() {
    global $wp_filter;
    unset( $wp_filter['welcome_panel'] );
}

add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'gt-sidebar',
            'name'          => __( 'Golf Travel Sidebar' ),
            'description'   => __( 'Sidebar to host MPUs on Golf Travel page.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
		register_sidebar(
        array(
            'id'            => 'ged-sidebar',
            'name'          => __( 'Golf Education Sidebar' ),
            'description'   => __( 'Sidebar to host MPUs on Golf Education page.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
		register_sidebar(
        array(
            'id'            => 'pga-sidebar',
            'name'          => __( 'PGA News Sidebar' ),
            'description'   => __( 'Sidebar to host MPUs on PGA News page.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}
