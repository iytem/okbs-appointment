<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


//Backend Theme
$template['active_template'] = get_option("cms_theme");

$template[get_option("cms_theme")]['template'] = 'templates/cms/'.get_option("cms_theme").'/_master_layout';
$template[get_option("cms_theme")]['regions'] = array(
    'title',
    'content',
);
$template[get_option("cms_theme")]['parser'] = 'parser';
$template[get_option("cms_theme")]['parser_method'] = 'parse';
$template[get_option("cms_theme")]['parse_template'] = TRUE;



//Frontend Theme

$template[get_option("frontend_theme")]['template'] = 'templates/web/'.get_option("web_theme").'/_master_layout';
$template[get_option("frontend_theme")]['regions'] = array(
    'title',
    'content',
);
$template[get_option("frontend_theme")]['parser'] = 'parser';
$template[get_option("frontend_theme")]['parser_method'] = 'parse';
$template[get_option("frontend_theme")]['parse_template'] = TRUE;





