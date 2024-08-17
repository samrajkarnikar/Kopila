<?php
get_template_part('/inc/customizer/custom-controls/customizer-notify/customizer-notify');

$config_customizer = array(
	'recommended_plugins'       => array(
		'britetechs-companion' => array(
			'recommended' => true,
			'description' => sprintf('Install and activate <strong>Britetechs Companion</strong> plugin for taking full advantage of all the features this theme has to offer %s.', 'shop2u'),
		),
		'woocommerce' => array(
			'recommended' => true,
			'description' => sprintf('Install and activate <strong>Wocommerce</strong> plugin for taking full advantage of all the shop features this theme has to offer %s.', 'shop2u'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'shop2u' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'shop2u' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'shop2u' ),
	'activate_button_label'     => esc_html__( 'Activate', 'shop2u' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'shop2u' ),
);
Shop2u_Customizer_Notify::init( apply_filters( 'shop2u_customizer_notify_array', $config_customizer ) );