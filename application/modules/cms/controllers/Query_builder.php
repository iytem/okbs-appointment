<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Query_builder extends APP_Controller
{

    public function __construct()
    {
        parent::__construct();


    }

    public function auto()
    {
        $this->is_allowed("otomatik-sorgular");

        $this->template->write('title', 'Sorgular', TRUE);

        $this->template->add_css("assets/cms/default/plugins/datatables/css/dataTables.bootstrap.min.css");
        $this->template->add_css("assets/cms/default/plugins/chosen/chosen.css");

        $this->template->add_js("assets/cms/default/plugins/datatables/js/jquery.dataTables.min.js");
        $this->template->add_js("assets/cms/default/plugins/datatables/js/dataTables.bootstrap.min.js");
        $this->template->add_js("assets/cms/default/plugins/chosen/chosen.jquery.js");

        $this->template->write_view('content', 'query_builder/query_builder_list', $this->data, TRUE);
        $this->template->render();


    }

    public function manuel()
    {
        $this->is_allowed("manuel-sorgular");

        $this->template->write('title', 'Sorgular', TRUE);


        $this->template->write_view('content', 'query_builder/manuel_query_builder_list', $this->data, TRUE);
        $this->template->render();


    }

    public function execute_query()
    {

        $this->form_validation->set_rules('table_name', 'Tablo Adı', 'trim|required');


        $this->form_validation->set_message('required', '%s alanı zorunludur');


        if ($this->form_validation->run()) {

            if ($this->input->post('field_name') == "") {
                $this->data = array(
                    'result' => false,
                    'message' => "Alan Adı seçiniz.",
                );
            } else {
                $select_query = $this->input->post("select_query");
                $table_name = $this->input->post("table_name");

                if ($this->input->post("where") == "WHERE " || $this->input->post("where") == "") {
                    $where = "";
                } else {
                    $where = $this->input->post("where");
                }

                $this->data["field_name"] = $this->input->post('field_name');
                $this->data["query"] = $this->db->query($select_query . " " . implode(',', (array)$this->input->post('field_name')) . " FROM " . $table_name . " " . $where);


                if ($this->data["query"]) {
                    $this->data = array(
                        'result' => true,
                        'message' => $this->load->view("query_builder/query_builder_list_result", $this->data, TRUE),
                    );
                } else {
                    $this->data = array(
                        'result' => false,
                        'redirect' => "Sorgu oluşturulmadı."
                    );
                }
            }
        } else {
            $this->data = array(
                'result' => false,
                'message' => validation_errors(),
            );
        }

        return $this->response($this->data);


    }

    public function field_query()
    {

        $this->data['table_name'] = $this->input->post("table_name");

        if ($this->data['table_name']) {
            $this->data = array(
                'result' => true,
                'message' => $this->load->view("query_builder/field_list", $this->data, TRUE),
            );
        } else {
            $this->data = array(
                'result' => false,
                'redirect' => "Lütfen tablo seçiniz"
            );
        }

        return $this->response($this->data);


    }


}
