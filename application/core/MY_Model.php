<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    public $table_name;
    public $primary_key;
    public $column_order = array();
    public $column_search = array();
    public $order = array();


    public function __construct()
    {
        parent::__construct();
    }

    public function get_datatables()
    {
        $this->get_data_where();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->join_statement();
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->get_data_where();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }

    private function get_data_where()
    {

        $this->where_statement();


        $this->db->from($this->table_name);
        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_where($where = array())
    {
        user_activity($this->table_name, "Read", json_encode($where, JSON_UNESCAPED_UNICODE));
        $this->join_statement();
        $this->db->where($where);
        $row = $this->db->get($this->table_name)->row();

        return $row;

    }

    public function get_all($where = array())
    {

        $this->join_statement();
        $this->db->where($where);
        $query = $this->db->get($this->table_name);

        return $query->result();


    }


    public function get_all_order($where = array(),$order=array())
    {

        $this->join_statement();
        $this->db->where($where);
        $this->db->order_by($order);
        $query = $this->db->get($this->table_name);

        return $query->result();


    }

    public function get_all_like($where = array())
    {

        $this->join_statement();

        if (count($where) == 1) {
            $this->db->like($where);
        } else if (count($where) > 1) {
            for ($i = 0; $i < count($where); $i++) {
                if ($i == 0) {
                    $this->db->like($where);
                    continue;

                }
                $this->db->or_like($where);
            }
        }
        $query = $this->db->get($this->table_name);

        return $query->result();


    }

    public function get_like($fields = array(), $search)
    {
        $this->join_statement();
        foreach ($fields as $key => $row) {
            if ($key == 0) {
                $this->db->like($row, $search);
            } else {
                $this->db->or_like($row, $search);
            }
        }

        $query = $this->db->get($this->table_name);

        return $query->result();

    }


    public function join_statement()
    {

        return $this;
    }

    public function where_statement()
    {

        return $this;
    }

    public function get($id)
    {

        $this->join_statement();
        $this->db->where($this->primary_key, $id);
        $row = $this->db->get($this->table_name)->row();
        user_activity($this->table_name, "Read", json_encode($id, JSON_UNESCAPED_UNICODE));
        return $row;

    }

    public function add($data = array())
    {
        $this
            ->db
            ->insert($this->table_name, $data);

        $insert_id = $this->db->insert_id();

        user_activity($this->table_name, "Insert", json_encode($insert_id, JSON_UNESCAPED_UNICODE));

        return $insert_id;
    }

    public function update_where($where = array(), $data = array())
    {

        $update = $this->db
            ->where($where)
            ->update($this->table_name, $data);

        user_activity($this->table_name, "Update",json_encode($where, JSON_UNESCAPED_UNICODE));

        return $update;

    }

    public function update($id, $data = array())
    {

        $update = $this->db
            ->where($this->primary_key, $id)
            ->update($this->table_name, $data);
        user_activity($this->table_name, "Update", json_encode($id, JSON_UNESCAPED_UNICODE));
        return $update;

    }

    public function delete($id)
    {
        user_activity($this->table_name, "Delete", json_encode($id, JSON_UNESCAPED_UNICODE));

        $delete = $this->db
            ->where($this->primary_key, $id)
            ->delete($this->table_name);

        return $delete;
    }

    public function delete_where($where)
    {

        user_activity($this->table_name, "Delete", json_encode($where, JSON_UNESCAPED_UNICODE));

        $delete = $this->db
            ->where($where)
            ->delete($this->table_name);

        return $delete;
    }

    public function get_query($query)
    {
        $result = $this->db
            ->query($query)
            ->result();
        return $result();
    }

    public function get_last_id()
    {
        return $this->db->insert_id();
    }

    public function scurity($input)
    {
        return mysqli_real_escape_string($this->db->conn_id, $input);
    }


}



