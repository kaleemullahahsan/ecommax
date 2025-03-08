<?php
/**
 * RisingBambooTheme Package
 *
 * @package rising-bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
	[
		'title'         => esc_html__('Modal', 'ecommax'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
		'description'   => esc_html__('This section contains advanced configurations for "Modal".', 'ecommax'),
	]
);

/**
 * Scroll to top.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Modal', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
		'label'       => esc_html__('Background Blur', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER),
		'priority'    => $priority++,
		'choices'     => [],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER_SIZE,
		'label'           => esc_html__('Blur Level', 'ecommax'),
		'description'     => esc_html__('Unit : pixel', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 5,
			'max'  => 50,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_COLOR,
		'label'           => esc_html__('Background Color', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
				'operator' => '==',
				'value'    => false,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_OPACITY,
		'label'           => esc_html__('Opacity', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_OPACITY),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
				'operator' => '==',
				'value'    => false,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT,
		'label'       => esc_html__('Effect', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT),
		'placeholder' => esc_html__('Select an effect...', 'ecommax'),
		'priority'    => $priority++,
		'choices'     => [
			'none'            => esc_html__('None', 'ecommax'),
			'slideInOutDown'  => esc_html__('Slide In Out Down', 'ecommax'),
			'slideInOutTop'   => esc_html__('Slide In Out Top', 'ecommax'),
			'slideInOutLeft'  => esc_html__('Slide In Out Left', 'ecommax'),
			'slideInOutRight' => esc_html__('Slide In Out Right', 'ecommax'),
			'zoomInOut'       => esc_html__('Zoom In Out', 'ecommax'),
			'rotateInOutDown' => esc_html__('Rotate In Out Down', 'ecommax'),
			'mixInAnimations' => esc_html__('Mix In Animations', 'ecommax'),
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE,
		'label'       => esc_html__('Click outside to close', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_ESC_CLOSE,
		'label'       => esc_html__('"ESC" to close', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_ESC_CLOSE),
		'priority'    => $priority++,
	]
);
