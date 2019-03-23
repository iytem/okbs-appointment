<?php
/**
 * Created by PhpStorm.
 * User: cskncms
 * Date: 28.04.2018
 * Time: 15:56
 */


function get_option($option_name)
{
    $CI =& get_instance();

    $result = $CI->db->get_where('cms_options', array("option_name" => $option_name));

    if ($row = $result->row()) {
        return trim($row->option_value);
    }

    return false;
}

function get_option_id($option_name)
{
    $CI =& get_instance();

    $result = $CI->db->get_where('cms_options', array("option_name" => $option_name));

    if ($row = $result->row()) {
        return $row->id;
    }

    return false;
}

function set_option($option_name = null, $option_value = null)
{

    $CI =& get_instance();
    $query = $CI->db->where(['option_name' => $option_name])
        ->update('cms_options', ['option_value' => $option_value]);
    return $query;

}

function cms_theme_assets_folder($uri = "")
{
    return base_url("assets/cms/" . get_option("cms_theme") . "/" . $uri);
}

function web_theme_assets_folder($uri = "")
{
    return base_url("assets/web/" . get_option("web_theme") . "/" . $uri);
}

function flash_message($alert, $type)
{
    $CI =& get_instance();
    $CI->session->set_userdata(
        array(
            "alert" => true,
            "alert-message" => $alert,
            "alert-type" => $type
        )
    );
}

function _htmlent($string = null)
{
    return htmlentities($string);
}

function get_menu($parent, $level, $menu_type)
{
    $CI =& get_instance();
    $CI->load->database();
    $CI->load->model('cms/model_menu');
    $result = $CI->model_menu->get_menu($parent, $menu_type);

    $ret = '';
    if ($result) {
        if (($level > 1) AND ($parent > 0)) {
            $ret .= '<ul tabindex="-1" class="treeview-menu">';
        } else {
            $ret = '';
        }
        foreach ($result as $row) {
            $perms = 'navigation_' . seo_link($row->label);

            $links = explode('/', $row->link);

            $segments = array_slice($CI->uri->segment_array(), 0, count($links));

            if (implode('/', $segments) == implode('/', $links)) {
                $active = 'active';
            } else {
                $active = '';
            }
            if ($row->type == 'label') {
                if ($CI->aauth->is_allowed($perms)) {
                    $ret .= '<li tabindex="-1" class="header" style="font-weight:bold;border-bottom:1px solid #d5d5d5;font-size:13px;color: ' . _htmlent($row->icon_color) . '">' . _htmlent($row->label) . '</li>';
                }
            } else {
                if ($row->Count > 0) {
                    if ($CI->aauth->is_allowed($perms)) {
                        $ret .= '<li tabindex="-1" class="treeview ' . $active . '"> 
										        	<a tabindex="-1" href="' . base_url($row->link) . '">';

                        if ($parent) {
                            $ret .= '<i class="fa ' . _htmlent($row->icon) . '" style="color: ' . _htmlent($row->icon_color) . ';"></i> <span>' . _htmlent($row->label) . '</span>
									            <span class="pull-right-container">
									              <i class="fa fa-angle-left pull-right"></i>
									            </span>
									          </a>';
                        } else {
                            $ret .= '<i class="fa ' . _htmlent($row->icon) . '" style="color: ' . _htmlent($row->icon_color) . '"></i> <span>' . _htmlent($row->label) . '</span>
									            <span class="pull-right-container">
									              <i class="fa fa-angle-left pull-right"></i>
									            </span>
									          </a>';
                        }

                        $ret .= get_menu($row->id, $level + 1, $menu_type);
                        $ret .= "</li>";
                    }
                } elseif ($row->Count == 0) {
                    if ($CI->aauth->is_allowed($perms)) {
                        $ret .= '<li tabindex="-1" class="' . $active . '"> 
										        	<a tabindex="-1" href="' . base_url($row->link) . '">';

                        if ($parent) {
                            $ret .= '<i class="fa ' . _htmlent($row->icon) . '" style="color: ' . _htmlent($row->icon_color) . ';"></i> <span>' . _htmlent($row->label) . '</span>
									            <span class="pull-right-container"></i>
									            </span>
									          </a>';
                        } else {
                            $ret .= '<i class="fa ' . _htmlent($row->icon) . '" style="color: ' . _htmlent($row->icon_color) . '"></i> <span>' . _htmlent($row->label) . '</span>
									            <span class="pull-right-container"></i>
									            </span>
									          </a>';
                        }

                        $ret .= "</li>";
                    }
                }
            }
        }
        if ($level != 1) {
            $ret .= '</ul>';
        }
    }

    return $ret;
}

function menu_module($parent, $level, $menu_type)
{
    $CI =& get_instance();
    $CI->load->database();
    $CI->load->model('cms/model_menu');
    $result = $CI->model_menu->get_modul_menu($parent, $menu_type);


    $ret = '';
    if ($result) {
        $ret .= '<ol class="dd-list">';
        foreach ($result as $row) {
            if ($row->Count > 0) {
                $ret .= '<li class="dd-item dd3-item" data-id="' . $row->id . '">
		   <div class="dd-handle dd3-handle"></div><div class="dd3-content">' . _htmlent($row->label);

                $ret .= '<span class="pull-right"><a style="color: tomato;padding: 5px;" class="remove-data" href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Sil" data-href="' . site_url('cms/menu/delete/' . $row->id) . '"><i class="fa fa-trash btn-action"></i></a>
				                </span>';

                $ret .= '<span class="pull-right"><a style="padding: 5px;" href="' . site_url('cms/menu/edit/' . $row->id) . '" data-toggle="tooltip" data-placement="top" title="Güncelle"><i class="fa fa-pencil btn-action"></i></a>
		                        </span>';

                $ret .= '</div>';
                $ret .= menu_module($row->id, $level + 1, $menu_type);
                $ret .= "</li>";
            } elseif ($row->Count == 0) {
                $ret .= '<li class="dd-item dd3-item" data-id="' . $row->id . '">
		                                          <div class="dd-handle dd3-handle"></div><div class="dd3-content">' . _htmlent($row->label);

                $ret .= '<span class="pull-right"><a class="remove-data"  style="color: tomato;padding: 5px;"  href="javascript:void()" data-href="' . site_url('cms/menu/delete/' . $row->id) . '" data-toggle="tooltip" data-placement="top" title="Sil"><i class="fa fa-trash btn-action"></i></a>
				                </span>';

                $ret .= '<span class="pull-right"><a style="padding: 5px;" href="' . site_url('cms/menu/edit/' . $row->id) . '" data-toggle="tooltip" data-placement="top" title="Güncelle"><i class="fa fa-pencil btn-action"></i></a>
		                        </span>';

                $ret .= '</div></li>';
            }
        }
        $ret .= "</ol>";
    }

    return $ret;
}

function is_allowed($permission, Closure $func)
{
    $CI =& get_instance();
    $reflection = new ReflectionFunction($func);
    $arguments = $reflection->getParameters();


    if ($CI->aauth->is_allowed($permission)) {
        call_user_func($func, $arguments);
    } else {
        ob_start();
        call_user_func($func, $arguments);
        $buffer = ob_get_contents();
        ob_end_clean();

    }
}

function generate_key($length = 40)
{
    $CI =& get_instance();
    $salt = base_convert(bin2hex($CI->security->get_random_bytes(64)), 16, 36);
    if ($salt === FALSE) {
        $salt = hash('sha256', time() . mt_rand());
    }
    $CI->load->config('config');

    $new_key = substr($salt, 0, $length);
    return $new_key;
}

function clean_snake_case($text = '')
{
    $text = preg_replace('/_/', ' ', $text);

    return $text;
}

function db_get_all_data($table_name = null, $where = false, $order_by = "", $desc_asc = "")
{
    $CI =& get_instance();
    if ($where) {
        $CI->db->where($where);
    }
    if ($order_by) {
        $CI->db->order_by($order_by, $desc_asc);
    }
    $query = $CI->db->get($table_name);

    return $query->result();
}

function redirect_back($url = '')
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        redirect($url);
    }
    exit;
}

function breadcrumbs($title, $icon, $uri = array())
{
    $bread = '<section class="content-header" style="background-color: #fff;padding: 15px;border-bottom: 1px solid #d2d6de">
    <h1>
    <i class="fa ' . $icon . '"></i>
        ' . $title . '
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                Ana Sayfa
            </a>
        </li>';


    $bread .= '</ol>
</section>';
    return $bread;
}

function dateConvert($tarih, $isaret = "-")
{
    if ($tarih == null) {
        return "---";
    } else {
        list($gun, $ay, $yil) = explode("-", $tarih);
        $yeniTarih = $yil . $isaret . $ay . $isaret . $gun;

        return $yeniTarih;
    }
}

function dateTimeConvertDate($tarih, $ayraç = "-")
{
    $date_time = explode(" ", $tarih);
    list($yil, $ay, $gun) = explode($ayraç, $date_time[0]);
    $yeniTarih = $gun . $ayraç . $ay . $ayraç . $yil . " " . $date_time[1];
    return $yeniTarih;

}

function encode($string)
{

    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr("cskncms", ($i % strlen("cskncms")) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return urlencode(base64_encode($result));
}

function decode($string)
{
    $result = '';
    $string = base64_decode(urldecode($string));

    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr("cskncms", ($i % strlen("cskncms")) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }

    return $result;

}

function seo_link($str, $cms_options = array())
{
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $cms_options = array_merge($defaults, $cms_options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($cms_options['replacements']), $cms_options['replacements'], $str);
    if ($cms_options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $cms_options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($cms_options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($cms_options['limit'] ? $cms_options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $cms_options['delimiter']);
    return $cms_options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function get_user_field($id, $field)
{
    $CI =& get_instance();

    $result = $CI->db->get_where('cms_aauth_users', array("id" => $id));

    if ($row = $result->row()) {
        return $row->$field;
    }

    return false;
}

function list_files($dir)
{
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != "." && $file != ".." && $file != "Thumbs.db") {
                    echo '<a target="_blank" href="' . $dir . $file . '">' . $file . '</a><br>' . "\n";
                }
            }
            closedir($handle);
        }
    }
}

function get_page_list()
{
    return array(
        "home" => "Home",


    );
}

function get_popup($page_url = "")
{
    $CI =& get_instance();

    $CI->load->model("cms/model_popup");
    $popup = $CI->model_popup->get_all(array("page_url" => $page_url, "status" => 1));
    if ($popup) {
        return $popup;
    } else {
        false;
    }
}

function upload_picture($file, $uploadPath, $width, $height, $name)
{

    $CI = &get_instance();
    $CI->load->library("image");


    if (!is_dir("{$uploadPath}/{$width}x{$height}")) {
        mkdir("{$uploadPath}/{$width}x{$height}");
    }

    $upload_error = false;
    try {

        $simpleImage = $CI->image->image_instance();


        $simpleImage
            ->fromFile($file)
            ->resize($width, $height)
            ->toFile("{$uploadPath}/{$width}x{$height}/$name", 'image/png');

    } catch (Exception $err) {
        $error = $err->getMessage();
        $upload_error = true;
    }

    if ($upload_error) {
        echo $error;
    } else {
        return true;
    }


}

function get_picture($path = "", $resolution = "50x50", $picture = "")
{

    if ($picture != "") {

        if (file_exists(FCPATH . "storage/$path/$resolution/$picture")) {
            $picture = base_url("storage/$path/$resolution/$picture");
        } else {
            $picture = base_url("storage/no_image.png");

        }

    } else {

        $picture = base_url("storage/no_image.png");

    }

    return $picture;

}

function get_user_picture($path = "", $resolution = "50x50", $picture = "", $gender)
{

    if ($picture != "") {

        if (file_exists(FCPATH . "storage/$path/$resolution/$picture")) {
            $picture = base_url("storage/$path/$resolution/$picture");
        } else {
            if ($gender == 1) {
                $picture = base_url("storage/user/male.png");
            } else if ($gender == 2) {
                $picture = base_url("storage/user/female.png");
            }


        }

    } else {

        $picture = base_url("storage/no_image.png");

    }

    return $picture;

}

function get_delete($path = "", $resolution, $picture = "")
{

    if (file_exists(FCPATH . "storage/$path/$resolution/$picture")) {
        unlink("storage/$path/$resolution/$picture");
    } else {
        return false;

    }
}

function tt($lang)
{
    $CI = &get_instance();

    return $CI->lang->line($lang);
}

function tt_site_lang()
{
    $CI = &get_instance();

    if ($CI->session->userdata('site_lang') == null) {
        $CI->session->set_userdata('site_lang', 'tr');
        return $CI->session->userdata('site_lang');
    } else {
        return $CI->session->userdata('site_lang');
    }

}

function user_activity($table_name, $action, $data_where)
{
    $CI =& get_instance();
    if ($CI->aauth->is_loggedin()) {
        $user_id = $CI->aauth->get_user()->id;
    } else {
        $user_id = 0;
    }

    $data = array(
        "user_id" => $user_id,
        "table_name" => $table_name,
        "action" => $action,
        "data_where" => $data_where,
        "url" => uri_string(),
        "ip_addres" => $CI->input->ip_address(),

    );

    return $CI->db->insert("cms_user_activity", $data);

}

function format_money($veri, $decimals = 2)
{
    return number_format($veri, $decimals, ',', '.');

}


function db_get_data_row($table_name, $where = array(), $field)
{
    $CI =& get_instance();

    $result = $CI->db->get_where($table_name, $where);

    if ($row = $result->row()) {
        return $row->$field;
    }

    return "-";
}

function get_pdf($file_name, $html, $title, $orientation = "")
{
    ob_start();

    $CI =& get_instance();

    // Include the main TCPDF library (search for installation path).
    $CI->load->library('pdf');
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ankara Sosyal Güvenlik İl Müdürülüğü');
    $pdf->SetTitle($title);

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(0);
    $pdf->SetFooterMargin(0);

    // set auto page breaks
    //$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetAutoPageBreak(TRUE, 0);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // set font
    $pdf->SetFont('dejavusans', '', 10);

    $pdf->AddPage($orientation);

    // add a page


    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');


    // reset pointer to the last page
    $pdf->lastPage();
    ob_end_clean();
    //Close and output PDF document
    //$pdf->Output($file_name, 'I'); Vide Mode
    $pdf->Output($file_name, 'D'); //Download Mode
}

function tr_strtoupper($text)
{
    $search = array("ç", "i", "ı", "ğ", "ö", "ş", "ü");
    $replace = array("Ç", "İ", "I", "Ğ", "Ö", "Ş", "Ü");
    $text = str_replace($search, $replace, $text);
    $text = strtoupper($text);
    return $text;
}

