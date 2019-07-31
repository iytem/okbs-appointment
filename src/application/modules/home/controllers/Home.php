<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        if (!$this->aauth->is_loggedin()) {
            redirect('/', 'refresh');
        }


        $year = date("Y");
        $month = date("m");
        redirect(base_url("home/calendar/" . $year . '/' . $month));

        $this->template->write('title', 'Ana Sayfa', TRUE);

        $this->template->write_view('content', 'home', '', TRUE);
        $this->template->render();
    }


    public function calendar($year, $month)
    {

        if (!$this->aauth->is_loggedin()) {
            redirect('/', 'refresh');
        }

        $config = array(
            "start_day" => "monday",
            "show_next_prev" => true,
            "next_prev_url" => base_url("home/calendar"),
            "day_type" => "long",
            "template" => '
            {table_open}<table class="calendar">{/table_open}
            {week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
            {cal_cell_content}<span class="day_listing">{day}</span>&nbsp; {content}&nbsp;{/cal_cell_content}
            {cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span> {content}</div>{/cal_cell_content_today}
            {cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}',


        );

        $this->load->library('calendar', $config);

        $data = $this->get_data($year, $month);


        $this->data["calendar"] = $this->calendar->generate($year, $month, $data);

        $this->template->write('title', 'Ana Sayfa', TRUE);

        $this->template->write_view('content', 'home/home', $this->data, TRUE);
        $this->template->render();
    }

    public function get_data($year, $month)
    {

        $user_birim = $this->aauth->get_user()->user_birim;
        $query = $this->db->select('*')->from('okbs_randevu')
            ->order_by('randevu_tarih ASC, randevu_saat ASC')
            ->like('randevu_tarih', "$year-$month")
            ->where(array('randevu_durum'=>1,'randevu_birim'=>$user_birim ))
            ->get();
        foreach ($query->result() as $row) {
            $exp = explode("-", $row->randevu_tarih);
            if ($exp[2] < 10) {
                $str = 9;
            } else {
                $str = 8;
            }


            @$data[substr($row->randevu_tarih, $str, 2)] .= "


            <div class='alert alert-info' style='margin: 10px;padding: 5px'>
             <strong>RANDEVU</strong> <br> " . $row->randevu_ad_soyad . '-' . $row->randevu_saat . '<br>(' . get_randevu_durum($row->randevu_durum) . '<div class="clearfix margin-bottom"></div>
</div>    
           ';
        }



        return @$data;
    }

}

