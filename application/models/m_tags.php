<?php
class M_tags extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function has_tag($whereArray)
    {
        $this->db->select('*')->from('tags')->where($whereArray);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all()
    {
        $this->db->select('*')->from('tags');
        $query = $this->db->get();
        return $query->result_array();
    }

    //取得tags筆數
    public function get_counts($whereArray = NULL)
    {
        if (!$whereArray) {
            return $this->db->count_all('tags');
        } else {
            $this->db->where($whereArray);
        }
        $this->db->from('tags');
        return $this->db->count_all_results();
    }

    //取得tag列表 分頁(有條件)
    public function select_list($per_page = NULL, $page = 1, $whereArray = NULL, $sort = "DESC", $like = NULL)
    {
        $this->db->select('*')->from('tags');

        if ($whereArray) {
            $this->db->where($whereArray);
        }
        if ($like) {
            $this->db->like('tag_name', $like);
        }
        if ($per_page) {
            $this->db->limit($per_page, ($page-1) * $per_page);
        }
        $this->db->order_by("tags.usage", $sort);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_like_data($keyword)
    {
        $this->db->like('name', $keyword);
        $query = $this->db->get('tags');
        return $query->result_array();
    }

    //一次傳回陣列中所有的tag
    public function get_tags($tags_id_array)
    {
        $tags = array();
        if ($tags_id_array) {
            foreach ($tags_id_array as $key => $t_id) {
                if ($this->get_tag($t_id)) {
                    $tags[] = $this->get_tag($t_id);
                }
            }
        }
        return $tags;
    }

    //傳回單一tag
    public function get_tag($t_id)
    {
        $this->db->select('*')->from('tags')->where('t_id', $t_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function insert($insert_array)
    {
        //新增完回傳id
        $this->db->insert('tags', $insert_array);
        return $this->db->insert_id();
    }

    public function delete_tags($tags_id_array)
    {
        foreach ($tags_id_array as $key => $t_id) {
            $tags[] = $this->delete_tag($t_id);
        }
        return true;
    }

    public function delete_tag($t_id)
    {
        return $this->db->delete('tags', array('t_id' => $t_id));
    }

    //增加tag 使用次數
    public function update_tag_usage($t_id, $method = '+1')
    {
        $this->db->set("usage", "`usage`$method", FALSE);
        $this->db->where('t_id', $t_id);
        $this->db->update('tags');
    }
}
?>