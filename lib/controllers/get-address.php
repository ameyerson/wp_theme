<?php 

namespace Controllers\BusinessInfo;


function get_address() {
    $options = get_option('business_options_field');
    $address_text = $options['address1'];

    return $address_text;
}