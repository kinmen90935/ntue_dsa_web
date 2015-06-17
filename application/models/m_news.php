<?php
class M_news extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('*')->from('news');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function has($n_id)
    {
        $this->db->select('*')
            ->from('news')
            ->where('n_id', $n_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    //取得熱門問題
    public function get_hottest_newss($limit = 4)
    {
        $this->db->select(array(
            'news.n_id',
            'news.title',
            'news.post_time',
            'news.views',
            'members.name',
            'members.fb_id'
        ));
        $this->db->from('news')
            ->join('members', 'news.m_id = members.m_id')
            ->limit($limit)
            ->order_by("news.views", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }

    //取得消息列表
    public function select_list($per_page, $page = 1, $nc_id = 0, $order_by = 'news.views', $keyword = NULL)
    {
        $this->db->select('*')->from('news');

        if ($nc_id != 0) {
            $this->db->where('news.nc_id', $nc_id);
        }

        // if ($keyword) {
        //     $this->db->like('content', $keyword);
        //     $this->db->or_like('title', $keyword);
        // }
        $this->db->join('category', 'news.c_id = category.c_id');
        $this->db->join('news_category', 'news.nc_id = news_category.nc_id');
        $this->db->order_by($order_by, "desc");
        $this->db->limit($per_page, ($page-1) * $per_page);
        $query = $this->db->get();
        return $query->result_array();
    }

    //取得問題筆數
    public function get_counts($whereArray = NULL)
    {
        if (!$whereArray) {
            return $this->db->count_all('news');
        } else {
            $this->db->where($whereArray);
        }
        $this->db->from('news');
        return $this->db->count_all_results();
    }

    //取得問題詳情
    public function get_detail($n_id)
    {
        $this->db->select('*')
            ->join('members', 'news.m_id = members.m_id')
            ->join('news_category', 'news.nc_id = news_category.nc_id')
            ->from('news')
            ->where('n_id', $n_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    public function plus_field($n_id, $field)
    {
        $this->db->where('n_id', $n_id);
        $this->db->set($field, "`$field`+ 1", FALSE);
        $this->db->update('news');
    }

    //新增Q
    public function insert($dataArray)
    {
        //新增完回傳id
        $this->db->insert('news', $dataArray);
        return $this->db->insert_id();
    }

    public function update($n_id, $dataArray)
    {
        return $this->db->update('news', $dataArray, array('n_id' => $n_id));
    }

}
?>
