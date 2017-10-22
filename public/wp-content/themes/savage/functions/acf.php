<?php

namespace Savage;

if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page();
    acf_add_options_sub_page( 'Global' );
}
if ( function_exists( 'acf_set_options_page_menu' ) ) {
    acf_set_options_page_menu( __( 'UO Settings' ) );
}
