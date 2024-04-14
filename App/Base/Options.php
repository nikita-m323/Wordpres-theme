<?php

namespace App\Base;

use App\Acf\Acf;

class Options {
    /**
     *  Creating an Options Page
     */
    public function __construct() {
		if(Acf::isAcfPluginActivated() && current_user_can('administrator')) {
			acf_add_options_page();
            acf_set_options_page_menu( __('Theme options', 'wordpress-theme') );
		}
	}
}