<?php

function bikcraft_scripts()
{
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/js/libs/jquery-1.11.2.min.js', [], '1.11.2', true);
	wp_register_script('plugins-script', get_template_directory_uri() . '/js/plugins.js', ['jquery'], false, true);
	wp_register_script('main-script', get_template_directory_uri() . '/js/main.js', ['jquery', 'plugins-script'], false, true);
	wp_register_script('modernizr', get_template_directory_uri() . '/js/libs/modernizr.custom.45655.js', [], '45655', false);
	wp_enqueue_script(['modernizr']);
	wp_enqueue_script(['main-script']);

	// wp_register_script('simple-slide', get_template_directory_uri() . '/js/simple-slide.js', [], false, true);
	// wp_register_script('simple-anime', get_template_directory_uri() . '/js/simple-anime.js', [], false, true);
	// wp_register_script('simple-form', get_template_directory_uri() . '/js/simple-form.js', [], false, true);
	// wp_register_script('script', get_template_directory_uri() . '/js/script.js', ['simple-slide', 'simple-form', 'simple-anime'], false, true);

	// wp_enqueue_script(['script']);
};
add_action('wp_enqueue_scripts', 'bikcraft_scripts');

function bikcraft_css()
{
	wp_register_style('bikcraft-style', get_template_directory_uri() . '/style.css', [], false, false);
	wp_enqueue_style(['bikcraft-style']);
}
add_action('wp_enqueue_scripts', 'bikcraft_css');


// Funções para Limpar o Header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

add_theme_support("menus");

function register_my_menu()
{
	register_nav_menu('menu-principal', __('Menu Principal'));
}
add_action('init', 'register_my_menu');


// .current_page_item

function my_custom_sizes()
{
	add_image_size('large', 1400, 380, true);
	add_image_size('medium', 768, 380, true);
}
add_action('after_setup_theme', 'my_custom_sizes');

function custom_post_type_produtos()
{
	register_post_type('produtos', array(
		'label' => 'Produtos',
		'description' => 'Produtos',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'produtos', 'with_front' => true),
		'query_var' => true,
		'supports' => array('title', 'editor', 'page-attributes', 'post-formats'),

		'labels' => array(
			'name' => 'Produtos',
			'singular_name' => 'Produto',
			'menu_name' => 'Produtos',
			'add_new' => 'Adicionar Novo',
			'add_new_item' => 'Adicionar Novo Produto',
			'edit' => 'Editar',
			'edit_item' => 'Editar Produto',
			'new_item' => 'Novo Produto',
			'view' => 'Ver Produto',
			'view_item' => 'Ver Produto',
			'search_items' => 'Procurar Produtos',
			'not_found' => 'Nenhum Produto Encontrado',
			'not_found_in_trash' => 'Nenhum Produto Encontrado no Lixo',
		)
	));
}
add_action('init', 'custom_post_type_produtos');
