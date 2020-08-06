<?php

class Board_m extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->table="g5_write_".$this->uri->segment(3);
        $this->bo_no=$this->uri->segment(4);

    }
    public function getList_DB($board_name)
    {
      return $this->db->query("SELECT * FROM $board_name ORDER BY num DESC")->result_array();
    }
    public function getList($board_name)
    {
      return $this->db->query("SELECT * FROM $board_name WHERE `wr_id`= `wr_parent` and `wr_reply`!='A' ORDER BY wr_id DESC")->result_array();
    }
    public function getList_selfie($board_name,$where)
    {
      return $this->db->query("SELECT * FROM $board_name WHERE `wr_id`= `wr_parent` and `wr_reply`!='A' $where ORDER BY wr_id DESC")->result_array();
    }
    function getLists_count($board_name)    {
      $query = $this->db->query("SELECT count(*) as cnt from $board_name");

      return $query->row();
    }
    function view_m($board_name,$bo_no)
    {
      $board_name = "g5_write_".$board_name;
      return $this->db->query("SELECT * FROM $board_name WHERE wr_id=$bo_no")->row_array();
    }

    function getImage($bo_name,$bo_no)
    {
      $this->db->where('wr_id',$bo_no)->where('bo_table',$bo_name);
      $query=$this->db->get('g5_board_file');
      return $query->result_array();
    }
    function getImages($bo_name)
    {
      $this->db->where('bo_table',$bo_name);
      $this->db->order_by('wr_id','DESC');
      $query=$this->db->get('g5_board_file');
      return $query->result_array();
    }

    function get_selfie($new_id)
    {
      
        $this->db->where('wr_id',$new_id);
        $query=$this->db->get('g5_write_selfie_kor');
        return $query->result_array();

    }

    function updateHit(){
        $this->db->set('wr_hit', 'wr_hit + 1', false);
        $this->db->where('wr_id', $this->bo_no);
        $this->db->update($this->table);
    }
    function setComent($bo_name,$bo_no){
      $bo_name= $bo_name;
      $IP = $_SERVER['REMOTE_ADDR'];
      $bo_for = $this->db->query("SELECT * FROM $bo_name WHERE wr_id = $bo_no")->row_array();
      $this->db
          ->set('wr_reply',"A")
          ->set('wr_password',$bo_for['wr_password'])
          ->set('wr_num',$bo_for['wr_num'])
          ->set('wr_name',$_POST['wr_name'])
          // ->set('wr_1',$_POST['wr_1'])
          ->set('wr_subject',"Re: " . $bo_for['wr_subject'])
          ->set('wr_content',$_POST['wr_content'])
          ->set('wr_1',$bo_for['wr_password'])
          ->set('wr_parent',$bo_for['wr_id'])
          ->set('mb_id',$this->session->userdata('id'))
          ->set('wr_ip',$IP)
          ->set('wr_last',DATE("Y-m-d h:i:s",time()))
          ->set('wr_datetime',DATE("Y-m-d h:i:s",time()));
          // if ($_POST['wr_id']=="")
          // {
          //   $this->db->set('wr_id',$_POST['wr_id']);
          // }
          return $this->db->insert($this->table);
    }

    function coment(){
      $bo_name = $this->table;
      $bo_no = $this->bo_no;
      $bo_ori = $this->db->query("SELECT * FROM $bo_name WHERE `wr_id` = $bo_no")->row_array();
      $wr_num = $bo_ori['wr_num'];
      return $this->db->query("SELECT * FROM $bo_name WHERE `wr_num` = $wr_num and `wr_reply`='A' ORDER BY wr_id DESC")->result_array();
    }

    function comment_re($bo_name){
      return $this->db->query("SELECT * FROM g5_write_$bo_name WHERE `wr_reply`='A' ORDER BY wr_id")->result_array();
    }

    function delComent($bo_name,$bo_no){
      $bo_name = $bo_name;
      $bo_name_re = "g5_write_".$bo_name;
      $bo_no = $bo_no;
      $del_no = $_POST['target'];
      $this->db->where("wr_id",$del_no);
      $query = $this->db->delete("$bo_name_re");
      if ($this->db->affected_rows() > 0) {
        return TRUE;
      }
    }

    function setContent(){
      $IP = $_SERVER['REMOTE_ADDR'];
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      // 파일 업로드
      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      if (!$this->upload->do_upload('wr_file3')) {
        $url3 = "";
      }else {
        $data3 = $this->upload->data();
        $filename3 = $data3['file_name'];
        $file_name3 = $data3['orig_name'];
        $file_size3 = $data3['file_size'];
        $url3 =$filename3;
      }

        $prevnum = $this->db->query('select MIN(wr_num) from '.$this->table)->row_array();
        $parent_num = $this->db->query('select MAX(wr_parent) from '.$this->table)->row_array();

        $wr_num = $prevnum['MIN(wr_num)']-1;
        $pr_num = $parent_num['MAX(wr_parent)']+1;
        $this->db
        ->set('wr_subject', $_POST['wr_subject'])
        ->set('wr_content', $_POST['wr_content'])
        ->set('wr_num', $wr_num)
        ->set('wr_parent', $pr_num)
        ->set('wr_name', $_POST['wr_name'])
        ->set('mb_id', $_POST['mb_id'])
        ->set('wr_ip', $IP)
        ->set('wr_1', $_POST['wr_1'])
        ->set('wr_file', '0')
        ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
        ->set('wr_last',DATE("Y-m-d h:i:s",time()))
        ->set('wr_password',md5($_POST['wr_1']));
        $this->db->insert($this->table);

       

        $last_db = $this->db->insert_id();
        $bo_name=$this->uri->segment(3);
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name)
          ->set('bf_file',$data['raw_name'].$data['file_ext'])
          ->set('bf_filesize',$file_size)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '1');
        }

        if ($url2 != "") {
          $this->db
            ->set('wr_file', '2');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name2)
          ->set('bf_file',$data2['raw_name'].$data2['file_ext'])
          ->set('bf_filesize',$file_size2)
          ->set('bf_no',1)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }

        if ($url3 != "") {
          $this->db
            ->set('wr_file', '3');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name3)
          ->set('bf_file',$data3['raw_name'].$data3['file_ext'])
          ->set('bf_filesize',$file_size3)
          ->set('bf_no',2)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }




        $this->db->set('wr_parent',$last_db);
        $this->db->where('wr_id', $last_db);
        return $this->db->update($this->table);



    }

    function setContent_event(){
      $IP = $_SERVER['REMOTE_ADDR'];
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      // 파일 업로드
      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      if (!$this->upload->do_upload('wr_file3')) {
        $url3 = "";
      }else {
        $data3 = $this->upload->data();
        $filename3 = $data3['file_name'];
        $file_name3 = $data3['orig_name'];
        $file_size3 = $data3['file_size'];
        $url3 =$filename3;
      }

        $prevnum = $this->db->query('select MIN(wr_num) from '.$this->table)->row_array();
        $parent_num = $this->db->query('select MAX(wr_parent) from '.$this->table)->row_array();

        $wr_num = $prevnum['MIN(wr_num)']-1;
        $pr_num = $parent_num['MAX(wr_parent)']+1;
        $this->db
        ->set('wr_subject', $_POST['wr_subject'])
        ->set('wr_content', $_POST['wr_content'])
        ->set('wr_num', $wr_num)
        ->set('wr_parent', $pr_num)
        ->set('wr_name', $_POST['wr_name'])
        ->set('mb_id', $_POST['mb_id'])
        ->set('wr_ip', $IP)
        ->set('wr_file', '0')
        ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
        ->set('wr_last',DATE("Y-m-d h:i:s",time()))
        ->set('wr_password','bioface11!@');
        $this->db->insert($this->table);

       

        $last_db = $this->db->insert_id();
        $bo_name=$this->uri->segment(3);
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name)
          ->set('bf_file',$data['raw_name'].$data['file_ext'])
          ->set('bf_filesize',$file_size)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '1');
        }

        if ($url2 != "") {
          $this->db
            ->set('wr_file', '2');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name2)
          ->set('bf_file',$data2['raw_name'].$data2['file_ext'])
          ->set('bf_filesize',$file_size2)
          ->set('bf_no',1)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }

        if ($url3 != "") {
          $this->db
            ->set('wr_file', '3');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name3)
          ->set('bf_file',$data3['raw_name'].$data3['file_ext'])
          ->set('bf_filesize',$file_size3)
          ->set('bf_no',2)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }




        $this->db->set('wr_parent',$last_db);
        $this->db->where('wr_id', $last_db);
        return $this->db->update($this->table);



    }
    
    function setContent_promotion(){
      $IP = $_SERVER['REMOTE_ADDR'];
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      // 파일 업로드
      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      if (!$this->upload->do_upload('wr_file3')) {
        $url3 = "";
      }else {
        $data3 = $this->upload->data();
        $filename3 = $data3['file_name'];
        $file_name3 = $data3['orig_name'];
        $file_size3 = $data3['file_size'];
        $url3 =$filename3;
      }

        $prevnum = $this->db->query('select MIN(wr_num) from '.$this->table)->row_array();
        $parent_num = $this->db->query('select MAX(wr_parent) from '.$this->table)->row_array();

        $wr_num = $prevnum['MIN(wr_num)']-1;
        $pr_num = $parent_num['MAX(wr_parent)']+1;
        $this->db
        ->set('wr_subject', $_POST['wr_subject'])
        ->set('wr_content', $_POST['wr_content'])
        ->set('wr_num', $wr_num)
        ->set('wr_parent', $pr_num)
        ->set('wr_name', $_POST['wr_name'])
        ->set('mb_id', $_POST['mb_id'])
        ->set('wr_ip', $IP)
        ->set('wr_file', '0')
        ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
        ->set('wr_last',DATE("Y-m-d h:i:s",time()))
        ->set('wr_password','bioface11!@');
        $this->db->insert($this->table);

       

        $last_db = $this->db->insert_id();
        $bo_name=$this->uri->segment(3);
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name)
          ->set('bf_file',$data['raw_name'].$data['file_ext'])
          ->set('bf_filesize',$file_size)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '1');
        }

        if ($url2 != "") {
          $this->db
            ->set('wr_file', '2');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name2)
          ->set('bf_file',$data2['raw_name'].$data2['file_ext'])
          ->set('bf_filesize',$file_size2)
          ->set('bf_no',1)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }

        if ($url3 != "") {
          $this->db
            ->set('wr_file', '3');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name3)
          ->set('bf_file',$data3['raw_name'].$data3['file_ext'])
          ->set('bf_filesize',$file_size3)
          ->set('bf_no',2)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }




        $this->db->set('wr_parent',$last_db);
        $this->db->where('wr_id', $last_db);
        return $this->db->update($this->table);



    }
	
	function setContent_exhibitions(){
      $IP = $_SERVER['REMOTE_ADDR'];
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      // 파일 업로드
      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      if (!$this->upload->do_upload('wr_file3')) {
        $url3 = "";
      }else {
        $data3 = $this->upload->data();
        $filename3 = $data3['file_name'];
        $file_name3 = $data3['orig_name'];
        $file_size3 = $data3['file_size'];
        $url3 =$filename3;
      }

        $prevnum = $this->db->query('select MIN(wr_num) from '.$this->table)->row_array();
        $parent_num = $this->db->query('select MAX(wr_parent) from '.$this->table)->row_array();

        $wr_num = $prevnum['MIN(wr_num)']-1;
        $pr_num = $parent_num['MAX(wr_parent)']+1;
        $this->db
        ->set('wr_subject', $_POST['wr_subject'])
        ->set('wr_content', $_POST['wr_content'])
        ->set('wr_num', $wr_num)
        ->set('wr_parent', $pr_num)
        ->set('wr_name', $_POST['wr_name'])
        ->set('mb_id', $_POST['mb_id'])
        ->set('wr_ip', $IP)
        ->set('wr_file', '0')
        ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
        ->set('wr_last',DATE("Y-m-d h:i:s",time()))
        ->set('wr_password','bioface11!@');
        $this->db->insert($this->table);

       

        $last_db = $this->db->insert_id();
        $bo_name=$this->uri->segment(3);
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name)
          ->set('bf_file',$data['raw_name'].$data['file_ext'])
          ->set('bf_filesize',$file_size)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '1');
        }

        if ($url2 != "") {
          $this->db
            ->set('wr_file', '2');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name2)
          ->set('bf_file',$data2['raw_name'].$data2['file_ext'])
          ->set('bf_filesize',$file_size2)
          ->set('bf_no',1)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }

        if ($url3 != "") {
          $this->db
            ->set('wr_file', '3');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name3)
          ->set('bf_file',$data3['raw_name'].$data3['file_ext'])
          ->set('bf_filesize',$file_size3)
          ->set('bf_no',2)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
        }




        $this->db->set('wr_parent',$last_db);
        $this->db->where('wr_id', $last_db);
        return $this->db->update($this->table);



    }

    function setContent_selfie(){
      $IP = $_SERVER['REMOTE_ADDR'];
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      // 파일 업로드
      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $image_width = $data['image_width'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $image_width2 = $data2['image_width'];
        $url2 =$filename2;
      }
      if (!$this->upload->do_upload('wr_file3')) {
        $url3 = "";
      }else {
        $data3 = $this->upload->data();
        $filename3 = $data3['file_name'];
        $file_name3 = $data3['orig_name'];
        $file_size3 = $data3['file_size'];
        $image_width3 = $data3['image_width'];
        $url3 =$filename3;
      }

        $prevnum = $this->db->query('select MIN(wr_num) from '.$this->table)->row_array();
        $parent_num = $this->db->query('select MAX(wr_parent) from '.$this->table)->row_array();

        $wr_num = $prevnum['MIN(wr_num)']-1;
        $pr_num = $parent_num['MAX(wr_parent)']+1;
        $this->db
        ->set('wr_subject', $_POST['wr_subject'])
        ->set('wr_content', $_POST['wr_content'])
        ->set('wr_num', $wr_num)
        ->set('wr_parent', $pr_num)
        ->set('wr_name', $_POST['wr_name'])
        ->set('mb_id', $_POST['mb_id'])
        ->set('wr_ip', $IP)
        ->set('wr_file', '0')
        ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
        ->set('wr_last',DATE("Y-m-d h:i:s",time()))
        ->set('wr_password','bioface11!@')
        ->set('wr_1', $_POST['wr_name'])
        ->set('wr_2', $_POST['wr_age'])
        ->set('wr_3', $_POST['cate']);
        $this->db->insert($this->table);

       

        $last_db = $this->db->insert_id();
        $bo_name=$this->uri->segment(3);
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name)
          ->set('bf_file',$data['raw_name'].$data['file_ext'])
          ->set('bf_filesize',$file_size)
          ->set('bf_width',$image_width)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '1');
        }

        if ($url2 != "") {
          $this->db
            ->set('wr_file', '2');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name2)
          ->set('bf_file',$data2['raw_name'].$data2['file_ext'])
          ->set('bf_filesize',$file_size2)
          ->set('bf_width',$image_width2)
          ->set('bf_no',1)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '2');
        }

        if ($url3 != "") {
          $this->db
            ->set('wr_file', '3');
          $this->db->insert('g5_write_star_kor');

          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$last_db)
          ->set('bf_source',$file_name3)
          ->set('bf_file',$data3['raw_name'].$data3['file_ext'])
          ->set('bf_filesize',$file_size3)
          ->set('bf_width',$image_width3)
          ->set('bf_no',2)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '3');
        }




        $this->db->set('wr_parent',$last_db);
        $this->db->where('wr_id', $last_db);
        return $this->db->update($this->table);



    }

    function del_process()
    {
      $this->db->where('wr_id',$this->bo_no);
      return $this->db->delete($this->table);
    }

    function modify_process()
    {
      $bo_name=$this->uri->segment(3);
      $bo_no =$this->uri->segment(4);
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      $config['allowed_types'] = 'gif|jpg|png';

      $config['max_size'] = '0';

      $config['max_width']  = '0';

      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $url =$filename;
      }
      $this->db
      ->set('wr_subject', $_POST['wr_subject'])
      ->set('wr_content', $_POST['wr_content'])
      ->set('wr_name', $_POST['wr_name'])
      ->set('wr_1', $_POST['wr_1'])
      ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
      ->set('wr_password',md5($_POST['wr_1']));
      $this->db->where('wr_id',$bo_no);
      $result = $this->db->update($this->table);
      $row = $this->db->query("SELECT * FROM $this->table where wr_id = $bo_no")->row_array();
      if ($row['wr_file']>0) {
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url);
          $this->db->where('wr_id',$bo_no)->where('bo_table',$bo_name);
          return $img_result = $this->db->update("g5_board_file");
        }
      }else {
        if ($url != "") {
          $bo_name=$this->uri->segment(3);
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_no',0)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url);
          $this->db->insert("g5_board_file");
          $this->db->set('wr_file', '1');
        }else {
          $this->db->set('wr_file',0);
        }
        $this->db->where('wr_id', $bo_no);
        return $this->db->update($this->table);
      }
    return $result;

    }

    function modify_process_event()
    {
      $bo_name=$this->uri->segment(3);
      $bo_no =$this->uri->segment(4);
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      $config['allowed_types'] = 'gif|jpg|png';

      $config['max_size'] = '0';

      $config['max_width']  = '0';

      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      $this->db
      ->set('wr_subject', $_POST['wr_subject'])
      ->set('wr_content', $_POST['wr_content'])
      ->set('wr_name', $_POST['wr_name'])
      ->set('wr_datetime',DATE("Y-m-d h:i:s",time()));
      $this->db->where('wr_id',$bo_no);
      $result = $this->db->update($this->table);
      $row = $this->db->query("SELECT * FROM $this->table where wr_id = $bo_no")->row_array();
      if ($row['wr_file']>0) {
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url);
          $this->db->where('wr_id',$bo_no)->where('bf_no',0)->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
        }
        if ($url2 != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url2);
          $this->db->where('wr_id',$bo_no)->where('bf_no',1)->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
        }
        return true;
      }
    return $result;

    }
    
    function modify_process_promotion()
    {
      $bo_name=$this->uri->segment(3);
      $bo_no =$this->uri->segment(4);
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      $config['allowed_types'] = 'gif|jpg|png';

      $config['max_size'] = '0';

      $config['max_width']  = '0';

      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      $this->db
      ->set('wr_subject', $_POST['wr_subject'])
      ->set('wr_content', $_POST['wr_content'])
      ->set('wr_name', $_POST['wr_name'])
      ->set('wr_datetime',DATE("Y-m-d h:i:s",time()));
      $this->db->where('wr_id',$bo_no);
      $result = $this->db->update($this->table);
      $row = $this->db->query("SELECT * FROM $this->table where wr_id = $bo_no")->row_array();
      if ($row['wr_file']>0) {
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url);
          $this->db->where('wr_id',$bo_no)->where('bf_no',0)->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
        }
        if ($url2 != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url2);
          $this->db->where('wr_id',$bo_no)->where('bf_no',1)->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
        }
        return true;
      }
    return $result;

    }
	
	function modify_process_exhibitions()
    {
      $bo_name=$this->uri->segment(3);
      $bo_no =$this->uri->segment(4);
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      $config['allowed_types'] = 'gif|jpg|png';

      $config['max_size'] = '0';

      $config['max_width']  = '0';

      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('wr_file')) {
        $url = "";
      }else {
        $data = $this->upload->data();
        $filename = $data['file_name'];
        $file_name = $data['orig_name'];
        $file_size = $data['file_size'];
        $url =$filename;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      $this->db
      ->set('wr_subject', $_POST['wr_subject'])
      ->set('wr_content', $_POST['wr_content'])
      ->set('wr_name', $_POST['wr_name'])
      ->set('wr_datetime',DATE("Y-m-d h:i:s",time()));
      $this->db->where('wr_id',$bo_no);
      $result = $this->db->update($this->table);
      $row = $this->db->query("SELECT * FROM $this->table where wr_id = $bo_no")->row_array();
      if ($row['wr_file']>0) {
        if ($url != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url);
          $this->db->where('wr_id',$bo_no)->where('bf_no',0)->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
        }
        if ($url2 != "") {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url2);
          $this->db->where('wr_id',$bo_no)->where('bf_no',1)->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
        }
        return true;
      }
    return $result;

    }

    function modify_process_selfie()
    {
      $bo_name=$this->uri->segment(3);
      $bo_no =$this->uri->segment(4);
      $config['upload_path'] = "./data/file/".$this->uri->segment(3);
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size'] = '0';
      $config['max_width']  = '0';
      $config['max_height']  = '0';
      $config['encrypt_name'] = TRUE;
      $this->load->library('upload', $config);

      $this->db
      ->set('wr_subject', $_POST['wr_subject'])
      ->set('wr_content', $_POST['wr_content'])
      ->set('wr_name', $_POST['wr_name'])
      ->set('wr_last',DATE("Y-m-d h:i:s",time()))
      ->set('wr_1', $_POST['wr_name'])
      ->set('wr_2', $_POST['wr_age'])
      ->set('wr_3', $_POST['cate']);
      $this->db->where('wr_id',$bo_no);
      $result = $this->db->update($this->table);
      

      if (!$this->upload->do_upload('wr_file1')) {
        $url1 = "";
      }else {
        $data1 = $this->upload->data();
        $filename1 = $data1['file_name'];
        $file_name1 = $data1['orig_name'];
        $file_size1 = $data1['file_size'];
        $url1 =$filename1;
      }
      if (!$this->upload->do_upload('wr_file2')) {
        $url2 = "";
      }else {
        $data2 = $this->upload->data();
        $filename2 = $data2['file_name'];
        $file_name2 = $data2['orig_name'];
        $file_size2 = $data2['file_size'];
        $url2 =$filename2;
      }
      if (!$this->upload->do_upload('wr_file3')) {
        $url3 = "";
      }else {
        $data3 = $this->upload->data();
        $filename3 = $data3['file_name'];
        $file_name3 = $data3['orig_name'];
        $file_size3 = $data3['file_size'];
        $url3 =$filename3;
      }


      $this->db->select('*');
      $this->db->from('g5_board_file');
      $this->db->where("wr_id = $bo_no AND bf_no = '0'");
      $row = $this->db->get();

      $this->db->select('*');
      $this->db->from('g5_board_file');
      $this->db->where("wr_id = $bo_no AND bf_no = '1'");
      $row2 = $this->db->get();

      $this->db->select('*');
      $this->db->from('g5_board_file');
      $this->db->where("wr_id = $bo_no AND bf_no = '2'");
      $row3 = $this->db->get();

      // $row = $this->db->query("SELECT * FROM g5_board_file where ")->row_array();
      // $row2 = $this->db->query("SELECT * FROM g5_board_file where wr_id = $bo_no AND bf_no = '2'")->row_array(); 
      // $row3 = $this->db->query("SELECT * FROM g5_board_file where wr_id = $bo_no AND bf_no = '3'")->row_array(); 


      if ($url1 != "") {
        if ($row->num_rows() > 0) {
          // 만약에 원래 존재하면 update
          $this->db
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url1);
          $this->db->where('wr_id',$bo_no)->where('bf_no','0')->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");          

          $this->db
          ->set('wr_file', '1')
          ->where('wr_id',$bo_no);
          $result = $this->db->update('g5_write_selfie_kor');
        } else {
           $this->db
            ->set('bo_table',$bo_name)
            ->set('wr_id',$bo_no)
            ->set('bf_source', $file_name1)
            ->set('bf_file',$data1['raw_name'].$data1['file_ext'])
            ->set('bf_filesize',$file_size1)
            ->set('bf_no','0')
            ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
            // ->set('bf_file', $file);
            $this->db->insert("g5_board_file");
            
            $this->db
            ->set('wr_file', '1')
            ->where('wr_id',$bo_no);
            $result = $this->db->update('g5_write_selfie_kor');
        }
      }

      if ($url2 != "") {
        if ($row2->num_rows() > 0) {
          // 만약에 원래 존재하면 update
          $this->db
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url2);
          $this->db->where('wr_id',$bo_no)->where('bf_no','1')->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
          
           $this->db
          ->set('wr_file', '2')
          ->where('wr_id',$bo_no);
          $result = $this->db->update('g5_write_selfie_kor');
        } else {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_source', $file_name2)
          ->set('bf_file',$data2['raw_name'].$data2['file_ext'])
          ->set('bf_filesize',$file_size2)
          ->set('bf_no','1')
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          
          $this->db
          ->set('wr_file', '2')
          ->where('wr_id',$bo_no);
          $result = $this->db->update('g5_write_selfie_kor');
        }
      }

      if ($url3 != "") {
        if ($row3->num_rows() > 0) {
          // 만약에 원래 존재하면 update
          $this->db
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('bf_file', $url3);
          $this->db->where('wr_id',$bo_no)->where('bf_no','2')->where('bo_table',$bo_name);
          $this->db->update("g5_board_file");
          
           $this->db
          ->set('wr_file', '3')
          ->where('wr_id',$bo_no);
          $result = $this->db->update('g5_write_selfie_kor');
          
        } else {
          $this->db
          ->set('bo_table',$bo_name)
          ->set('wr_id',$bo_no)
          ->set('bf_file',$data3['raw_name'].$data3['file_ext'])
          ->set('bf_filesize',$file_size3)
          ->set('bf_width',$image_width3)
          ->set('bf_no','2')
          ->set('bf_datetime',DATE("Y-m-d h:i:s",time()));
          // ->set('bf_file', $file);
          $this->db->insert("g5_board_file");
          
          $this->db
          ->set('wr_file', '3')
          ->where('wr_id',$bo_no);
          $result = $this->db->update('g5_write_selfie_kor');
        }
      }
      
    return $result;

    }
    function modify($board_name,$bno)
    {
      $board_name_re = "g5_write_".$board_name;
      return $this->db->query("SELECT * FROM $board_name_re WHERE `wr_id`= $bno")->row_array();
    }

    function pass_check($board_name,$bno)
    {
      $board_name_re = "g5_write_".$board_name;
      // 비밀번호 확인
      $check = $this->db->query("SELECT * FROM $board_name_re WHERE `wr_id`= $bno")->row_array();
      $parent = $check['wr_password'];

      // 입력 값과 비밀번호가 일치하는지 확인
      if($parent == md5($_POST['mb_password'])){
        return true;
      } else {
        return false;
      }
    }

    function setKakao($bo_name){
      // $bo_name = $bo_name;
      $this->table=$bo_name;

      $this->db
          ->set('name', $_POST['k_name'])
          ->set('tel', $_POST['k_tel'])
          ->set('part', $_POST['ka_part'])
          ->set('date',DATE("Y-m-d"))
          ->set('memo', $_POST['k_content']);

          return $this->db->insert($this->table);
    }

    function setCost($bo_name){
      $IP = $_SERVER['REMOTE_ADDR'];
      $this->table=$bo_name;

      $prevnum = $this->db->query('select MIN(wr_num) from '.$this->table)->row_array();
      $parent_num = $this->db->query('select MAX(wr_parent) from '.$this->table)->row_array();

      $wr_num = $prevnum['MIN(wr_num)']-1;
      $pr_num = $parent_num['MAX(wr_parent)']+1;
      $this->db
          ->set('wr_subject', $_POST['p_part'])
          ->set('wr_content', '상담시간 : '.$_POST['ampm'].'<br>상담 내용 : '.$_POST['p_content'])
          ->set('wr_num', $wr_num)
          ->set('wr_parent', '0')
          ->set('wr_name', $_POST['p_name'])
          ->set('mb_id', $_POST['p_name'])
          ->set('wr_ip', $IP)
          ->set('wr_1', $_POST['p_tel'])
          ->set('wr_file', '0')
          ->set('wr_datetime',DATE("Y-m-d h:i:s",time()))
          ->set('wr_last',DATE("Y-m-d h:i:s",time()))
          ->set('wr_password',md5($_POST['p_tel']));

          $this->db->insert($this->table);

          $last_db = $this->db->insert_id(); 
          $this->db->set('wr_parent',$last_db);
          $this->db->where('wr_id', $last_db);
          return $this->db->update($this->table);

    }



}
?>
