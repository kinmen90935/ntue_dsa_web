<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sa extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('m_news'));
    }

	public function index()
	{
        //pagination
        $pg_count = ceil($this->m_news->get_counts() / 8);
        if ($pg_count > 5) {
        	$data['total_pages'] = 5;
        } else {
        	$data['total_pages'] = $pg_count;
        }
        $data['start_page'] = 1;

		//最新消息
		$data['news'] = $this->m_news->select_list(8);
		$this->load->view('page/index', $data);
	}

	//ajax取得最新消息 分頁 分類
	public function ajax_get_news()
	{
		$page = $this->input->get('page');
		$nc_id = $this->input->get('nc_id');
		$data['news'] = $this->m_news->select_list(8, $page, $nc_id);
		$data_html = $this->load->view('data/news_data_grid', $data, TRUE);
		echo json_encode(array('status' => TRUE, 'data_html' => $data_html));
	}

	public function ajax_change_pagination()
	{
		$direct = $this->input->get('direct');
		$tp = $this->input->get('tp');

        $pg_count = ceil($this->m_news->get_counts() / 8);
		if ($direct == 'forward') {
        	if ($tp * 5 > $pg_count) {
        		//到最後一頁了
				echo json_encode(array('status' => FALSE));
        	} else {
        		//可以再往後
        		$data['total_pages'] = $tp * 5;
        		$data['start_page'] = ($tp-1) * 5 + 1;
        		$pg_html = $this->load->view('data/pagination', $data, TRUE);
				echo json_encode(array('status' => TRUE, 'pg_html' => $pg_html));
        	}
		} else {
        	if ($tp < 1) {
        		//最前面那頁了
				echo json_encode(array('status' => FALSE));
        	} else {
        		//可以再往前
        		$data['total_pages'] = $tp * 5;
        		$data['start_page'] = ($tp-1) * 5 + 1;
        		$pg_html = $this->load->view('data/pagination', $data, TRUE);
				echo json_encode(array('status' => TRUE, 'pg_html' => $pg_html));
        	}
		}
	}

}
