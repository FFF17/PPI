<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Services extends CI_Controller{
  function index(){
    echo "ini api";
  }
  function register(){
	  
    $data["nomor_telpn"] = "0".$this->input->post("nomor_telpon");
    $this->db->where($data);
    $result = $this->db->get("m_anggota")->row();
    if($result){
      echo json_encode($result);
	  die();
    }
    $data["foto_ktp"] = "/foto/".$this->input->post("foto");
    $data["foto"] = "/foto/".$this->input->post("foto_profile");
    $data["nama"] = $this->input->post("nama");
    $data["email"] = $this->input->post("email");
    $data["password"] = md5($this->input->post("password"));
    $data["input_status"] = "0";
    $data["register_date"] = date("Y-m-d");
    $data["created_by"] = $this->input->post("user");
	
    $this->db->insert("m_anggota",$data);
    $id = $insert_id = $this->db->insert_id();
    $this->db->where("id",$id);
    $result = $this->db->get("m_anggota")->row();
    if($result){
      echo json_encode($result);
    }else{
      $result["id"] = "0";
      echo json_encode($result);
    }
  }
  function mobile_login(){
    $data["nomor_telpn"] = "0".$this->input->post("nomor_telpon");
    $this->db->where($data);
    $result = $this->db->get("m_anggota")->row();
    if($result){
      echo json_encode($result);
    }else{
      $result["id"] = "0";
      echo json_encode($result);
    }
  }
  function upload(){
      $base64Image = $this->input->post("image");
      $filename = $this->input->post("name");
      $decoded=base64_decode($base64Image);
      //file_put_contents($filename,$decoded);
      //echo FCPATH."/foto/".$filename;
      file_put_contents(FCPATH."foto/".$filename,$decoded);
  }
  function login(){
    $data["nomor_telpn"] = $this->input->post("username");
    $data["password"] = md5($this->input->post("password"));
    $this->db->where($data);
    $result = $this->db->get("m_anggota")->row();
    if($result){
      echo json_encode($result);
    }else{
      $result["id"] = "0";      
      echo json_encode($result);
    }
  }
  function getData(){
    $data["id"] = $this->input->get("id");
    $this->db->where($data);
    $result = $this->db->get("m_anggota")->row();
    if($result){
      echo json_encode($result);
    }else{
      $result["id"] = "0";
      echo json_encode($result);
    }
  }
  function getFoto(){    
    $data["id"] = $this->input->get("id");
    $this->db->where($data);
    $result = $this->db->get("m_anggota")->row();
    $filename = FCPATH."foto/user.png";
    if($result){
      if($result->foto!=""){
        $filename=FCPATH.$result->foto; //<-- specify the image  file        
      }
    }
    if(file_exists($filename)){ 
      $mime = mime_content_type($filename); //<-- detect file type
      header('Content-Length: '.filesize($filename)); //<-- sends filesize header
      header("Content-Type: $mime"); //<-- send mime-type header
      header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
      readfile($filename); //<--reads and outputs the file onto the output buffer
      die(); //<--cleanup
      exit; //and exit
    }
  }

  function ttd_ketua(){    
    $filename = FCPATH."foto/ttd_ketua.png";
    if(file_exists($filename)){ 
      $mime = mime_content_type($filename); //<-- detect file type
      header('Content-Length: '.filesize($filename)); //<-- sends filesize header
      header("Content-Type: $mime"); //<-- send mime-type header
      header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
      readfile($filename); //<--reads and outputs the file onto the output buffer
      die(); //<--cleanup
      exit; //and exit
    }
  }
  function ttd_sekjen(){    
    $filename = FCPATH."foto/ttd_sekjen.png";
    if(file_exists($filename)){ 
      $mime = mime_content_type($filename); //<-- detect file type
      header('Content-Length: '.filesize($filename)); //<-- sends filesize header
      header("Content-Type: $mime"); //<-- send mime-type header
      header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
      readfile($filename); //<--reads and outputs the file onto the output buffer
      die(); //<--cleanup
      exit; //and exit
    }
  }
  
	function update_info(){
		$id = $this->input->post("id");
		if($this->input->post("foto")!=""){
			$data["foto"] = "/foto/".$this->input->post("foto");
		}
		$data["nama"] = $this->input->post("nama");
		$password = $this->input->post("password");
		if($password!=""){
			$data["password"] = md5($password);
		}
		$data["nomor_ktp"] = $this->input->post("nomor_ktp");
		$this->db->where("id",$id);
		$this->db->update("m_anggota",$data);
		$msg["status"] = "1";
		echo json_encode($msg);
		
	}
	function upload_ktp(){
		$id = $this->input->post("id");
		if($this->input->post("foto")!=""){
			$data["foto_ktp"] = "/foto/".$this->input->post("foto");
		}
		$this->db->where("id",$id);
		$this->db->update("m_anggota",$data);
		$msg["status"] = "1";
		echo json_encode($msg);
		
	}
  
  function getQR(){
    $this->load->library('ciqrcode');
    $params["data"] = "BEGIN:VCARD\nVERSION:2.1\nN:John Doe\nTEL;HOME;VOICE:555-555-5555\nTEL;WORK;VOICE:666-666-6666\nEMAIL:email@example.com\nORG:TEC-IT\nURL:https://www.example.com\nEND:VCARD";
    $id = $this->input->get("id");
    $filename = FCPATH.'tes.png';
    $this->db->where("id",$id);
    $result = $this->db->get("m_anggota");
    foreach($result->result() as $tmp){
      $params["data"] = "BEGIN:VCARD\nVERSION:2.1\nN:".$tmp->nama."\nTEL;HOME;VOICE:".$tmp->nomor_telpn."\nEMAIL:".$tmp->email."\nORG:partaihanura\nEND:VCARD";    
      $filename = FCPATH.'qr/'.$tmp->id.'.png';
    }
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = $filename;
    $this->ciqrcode->generate($params);    
    if(file_exists($filename)){ 
      $mime = mime_content_type($filename); //<-- detect file type
      header('Content-Length: '.filesize($filename)); //<-- sends filesize header
      header("Content-Type: $mime"); //<-- send mime-type header
      header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
      readfile($filename); //<--reads and outputs the file onto the output buffer
      die(); //<--cleanup
      exit; //and exit
    }
    
  }
  function getQR2(){
    $this->load->library('ciqrcode');
    $params["data"] = "BEGIN:VCARD\nVERSION:2.1\nN:John Doe\nTEL;HOME;VOICE:555-555-5555\nTEL;WORK;VOICE:666-666-6666\nEMAIL:email@example.com\nORG:TEC-IT\nURL:https://www.example.com\nEND:VCARD";
    $id = $this->input->get("id");
    $filename = FCPATH.'tes.png';
    $this->db->where("id",$id);
	$this->db->select("id,nama,nomor_telpn,nomor_anggota");
    $result = $this->db->get("m_anggota");
    foreach($result->result() as $tmp){
      $params["data"] = json_encode($tmp);
      $filename = FCPATH.'qr/'.$tmp->id.'.png';
    }
    $params['level'] = 'H';
    $params['size'] = 10;
    $params['savename'] = $filename;
    $this->ciqrcode->generate($params);    
    if(file_exists($filename)){ 
      $mime = mime_content_type($filename); //<-- detect file type
      header('Content-Length: '.filesize($filename)); //<-- sends filesize header
      header("Content-Type: $mime"); //<-- send mime-type header
      header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
      readfile($filename); //<--reads and outputs the file onto the output buffer
      die(); //<--cleanup
      exit; //and exit
    }    
  }
  function sendOTP(){
	$otp = $this->input->post("otp");
	$config['protocol']    = 'smtp';
	$config['smtp_host']    = 'ssl://smtp.gmail.com';
	$config['smtp_port']    = '465';
	$config['smtp_timeout'] = '7';
	$config['smtp_user']    = 'hanura2020@gmail.com';
	$config['smtp_pass']    = 'Indonesia123';
	$config['charset']    = 'utf-8';
	$config['newline']    = "\r\n";
	$config['mailtype'] = 'html'; // or html
	$config['validation'] = TRUE; // bool whether to validate email or not

	$this->email->initialize($config);
	$this->email->from('hanura2020@gmail.com', 'Hanura');
	$this->email->to($this->input->post("email"));
	$this->email->cc('hanura2020@gmail.com');

	$this->email->subject('Kode OTP');
	$this->email->message("Mohon masukkan kode berikut pada aplikasi hanura <br/><br/><b>$otp</b>");

	$this->email->send();
	$this->load->view('success',$data);
  }
  function news(){
	$data = $this->db->query("select wp_posts.post_title,wp_posts.post_content,wp_posts.post_date,media.guid image  from wp_reg.wp_posts 
left join wp_reg.wp_postmeta on post_id = wp_posts.ID and meta_key = '_thumbnail_id'
left join wp_reg.wp_posts media on wp_postmeta.meta_value = media.ID
where wp_posts.post_type = 'post' and wp_posts.post_status = 'publish' order by  wp_posts.post_date desc limit 0,10");
	echo json_encode($data->result());
  }
  function nearme(){
	date_default_timezone_set("Asia/Jakarta");
	$lat  = isset($_POST["lat"])?$_POST["lat"]:"-6.252300";
	$lng  = isset($_POST["lng"])?$_POST["lng"]:"106.847336";
	$id= isset($_POST["id"])?$_POST["id"]:"13";
	$now  = date('Y-m-d H:i:s');

	$query = $this->db->query("select * from m_anggota where id<> '$id' and geo_lat !='' and geo_long !=''");

	$data = array();
	foreach ($query->result() as $tmp) {
	$distance = $this->haversineGreatCircleDistance($lat,$lng,$tmp->geo_lat,$tmp->geo_long);
		if($distance < 40000){
			/*and $tmp['last_seen'] < 30000*/
			//$tmp['distance'] = round($distance/1000,2);
			//$tmp['last_seen'] = round($tmp['last_seen']/60)." menit yang lalu";
			array_push($data,$tmp);
		}
	}
	$this->db->query("update m_anggota set geo_lat='$lat', geo_long='$lng' where id = '$id'");
	echo json_encode($data);
  }
  function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
	$latFrom = deg2rad($latitudeFrom);
	$lonFrom = deg2rad($longitudeFrom);
	$latTo = deg2rad($latitudeTo);
	$lonTo = deg2rad($longitudeTo);

	$latDelta = $latTo - $latFrom;
	$lonDelta = $lonTo - $lonFrom;

	$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
		cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	return $angle * $earthRadius;
	}
	
	function market_home(){
        $provinsi = $this->input->get("provinsi");
        $kabupaten = $this->input->get("kabupaten");
		$product = $this->input->get("product");
		$sql = "SELECT t_market_product.*,m_anggota.nama FROM `t_market_product` inner join m_anggota on m_anggota.id = t_market_product.created_by where product_name like('%$product%')";
		if($kabupaten!=""){
            $sql.= " and nomor_anggota like('$provinsi.".substr($kabupaten,2)."%')";
            $data["kab"] = $this->db->where("provinsi",$provinsi)->get("kabupaten");
        }else if($provinsi!=""){
            $sql.= " and nomor_anggota like('$provinsi%')";
        }
		$data = $this->db->query($sql." order by t_market_product.created_date desc limit 0,100");
		echo json_encode($data->result());
	}
	function add_product(){
		$data["product_name"] = $this->input->post("product_name");
		$data["product_description"] = $this->input->post("product_description");
		$data["product_category"] = $this->input->post("product_category");
		$data["price"] = $this->input->post("price");
		$data["stock"] = $this->input->post("stock");
		if( $this->input->post("product_image")!=""){
			$data["product_image"] = $this->input->post("product_image");
		}
		$id = $this->input->post("id");
		$user = $this->input->post("user");
		if($id=="0"){
			$data["created_by"] = $user;
			$data["created_date"] = date('Y-m-d H:i:s');
			$this->db->insert("t_market_product",$data);
		}else{
			$data["updated_by"] = $user;
			$data["updated_date"] = date('Y-m-d H:i:s');
			$this->db->where("id",$id);
			$this->db->update("t_market_product",$data);
		}
		$msg["status"] = "1";
		echo json_encode($msg);
	}
	
  function getProductFoto(){    
    $foto = $this->input->get("file");
    $filename = FCPATH."foto/user.png";
	if($foto !=""){
		$filename=FCPATH."foto/".$foto; //<-- specify the image  file        
	}
    if(file_exists($filename)){ 
      $mime = mime_content_type($filename); //<-- detect file type
      header('Content-Length: '.filesize($filename)); //<-- sends filesize header
      header("Content-Type: $mime"); //<-- send mime-type header
      header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
      readfile($filename); //<--reads and outputs the file onto the output buffer
      die(); //<--cleanup
      exit; //and exit
    }
  }
  function add_cart(){
	  $product = $this->input->post("product_id");
	  $user = $this->input->post("user");
	  
	  $tmp_product = $this->db->where("id",$product)->get("t_market_product")->row();
	  
	  $cek = $this->db->query("select * from t_market_order where order_by = '".$user."' and order_to = '".$tmp_product->created_by."' and order_status = '0'")->row();
	  if($cek){
		  $cekProduct = $this->db->query("select t_market_order_detail.*,t_market_product.stock from t_market_order_detail inner join t_market_product on t_market_product.id = t_market_order_detail.id_product where id_order ='".$cek->id."' and id_product = '".$product."'")->row();
		  if($cekProduct){
				if($cekProduct->total < $cekProduct->stock){
					$result = $this->db->query("update t_market_order_detail  set total = total+1 where t_market_order_detail.id = '".$cekProduct->id."'");
					$msg["status"] = "1";
					$msg["msg"] = "update t_market_order_detail  set total = total+1 where t_market_order_detail.id = '".$cekProduct->id."'";
					die(json_encode($msg));
				}else{
					$msg["status"] = "2";
					die(json_encode($msg));
				}
		  }else{
			  $order_detail["id_order"] = $cek->id;
			  $order_detail["id_product"] = $product;
			  $order_detail["total"] = "1";
			  $this->db->insert("t_market_order_detail",$order_detail);
		  }
	  }else{
		  $order["order_by"]= $user;
		  $order["order_to"]= $tmp_product->created_by;
		  $order["order_status"] = "0";
		  $this->db->insert("t_market_order",$order);
		  $order_detail["id_order"] = $this->db->insert_id();
		  $order_detail["id_product"] = $product;
		  $order_detail["total"] = "1";
		  $this->db->insert("t_market_order_detail",$order_detail);
	  }
		$msg["status"] = "1";
		echo json_encode($msg);
	  
  }
  function remove_cart(){
		$id_detail_order = $this->input->post("id_detail_order");
		$this->db->query("update t_market_order_detail set total = total-1 where id = '".$id_detail_order."'");
		$this->db->query("delete from t_market_order_detail where total < 1");
		$msg["status"] = "1";
		echo json_encode($msg);
	  
  }
  function get_cart(){
	  $user = $this->input->get("user");
	  $sql="select t_market_product.*,t_market_order_detail.id id_detail_order,t_market_order_detail.id_order,t_market_order_detail.total  from t_market_order 
inner join t_market_order_detail on t_market_order_detail.id_order = t_market_order.id
inner join t_market_product on t_market_product.id = t_market_order_detail.id_product 
where t_market_order.order_by = '".$user."' and t_market_order.order_status = '0'";
		$data = $this->db->query($sql);
		echo json_encode($data->result());
  }
  function check_out(){
	  $user = $this->input->post("user");
	  $tmpOrder = array();
	  $tmpData = $this->db->query("select distinct id from t_market_order where order_by = '".$user."' and order_status = '0'");
		foreach($tmpData->result() as $tmp){	  
		  $orderId = $tmp->id;
		  $order = "HNR".mt_rand(100000,999999);
		  $data["order_id"] = $order;
		  $data["order_status"] = 1;
		  $data["order_date"] = date('Y-m-d H:i:s');
		  $this->db->where("id",$orderId);
		  $this->db->update("t_market_order",$data);
		  $this->db->query("update t_market_order set total_order = (select sum(total*price ) from t_market_order_detail inner join t_market_product on t_market_product.id = t_market_order_detail.id_product where t_market_order_detail.id_order = t_market_order.id) where t_market_order.order_id = '$order'");
		  $this->db->query("update t_market_order set order_to = (select t_market_product.created_by from t_market_order_detail inner join t_market_product on t_market_product.id = t_market_order_detail.id_product where t_market_order_detail.id_order = t_market_order.id limit 0,1) where t_market_order.order_id = '$order'");
		  array_push($tmpOrder,$order);
		}
	  $msg["status"]="1";
	  $msg["order_id"] = join(",",$tmpOrder);
	  echo json_encode($msg);
  }
  function detail_pengiriman(){	  
	  $orderId = $this->input->post("order_id");
	  $data["penerima"] = $this->input->post("penerima");
	  $data["nomor"] = $this->input->post("nomor");
	  $data["alamat"] = $this->input->post("alamat");
	  $data["kodepos"] = $this->input->post("kodepos");
	  $data["order_status"] = "2";
	  $this->db->where("order_id",$orderId);
	  $this->db->update("t_market_order",$data);
	$msg["status"] = "1";
	echo json_encode($msg);
  }
  function order_by(){	  
	  $id = $this->input->get("id");
	  $data = $this->db->query("select t_market_order.*,m_anggota.nama,m_anggota.foto from t_market_order inner join m_anggota on t_market_order.order_to = m_anggota.id where order_by ='$id' and order_status <> '0' order by t_market_order.id desc ;");
	  echo json_encode($data->result());
  }
  function order_to(){	  
	  $id = $this->input->get("id");
	  $data = $this->db->query("select t_market_order.*,m_anggota.nama,m_anggota.foto from t_market_order inner join m_anggota on t_market_order.order_by = m_anggota.id where order_to ='$id' and order_status not in(0,1,2)  order by t_market_order.id desc;");
	  echo json_encode($data->result());
  }
  function pembayaran_success(){
	  $orderId = $this->input->get("order_id");
	  $data["order_status"] = "3";
	  $this->db->where("order_id",$orderId);
	  $this->db->update("t_market_order",$data);
  }
  function konfirmasi(){
	  $orderId = $this->input->post("order_id");
	  $data["order_status"] = "4";
	  $this->db->where("order_id",$orderId);
	  $this->db->update("t_market_order",$data);
	$msg["status"] = "1";
	echo json_encode($msg);
  }
  function pengiriman(){
	  $orderId = $this->input->post("order_id");
	  $data["order_status"] = "5";
	  $this->db->where("order_id",$orderId);
	  $this->db->update("t_market_order",$data);
	$msg["status"] = "1";
	echo json_encode($msg);
  }
  function selesai(){
	  $orderId = $this->input->post("order_id");
	  $data["order_status"] = "6";
	  $this->db->where("order_id",$orderId);
	  $this->db->update("t_market_order",$data);
	  $this->db->query("update t_market_product INNER JOIN t_market_order_detail on t_market_order_detail.id_product = t_market_product.id inner join t_market_order on t_market_order.id = t_market_order_detail.id_order 
set stock = stock - t_market_order_detail.total 
where t_market_order.order_id = '$orderId'");
		$msg["status"] = "1";
	echo json_encode($msg);
  }
  function get_order_detail(){
	  $orderId = $this->input->get("order_id");	  
	  $sql="select t_market_product.*,t_market_order_detail.id id_detail_order,t_market_order_detail.id_order,t_market_order_detail.total  from t_market_order 
inner join t_market_order_detail on t_market_order_detail.id_order = t_market_order.id
inner join t_market_product on t_market_product.id = t_market_order_detail.id_product 
where t_market_order.order_id = '".$orderId."'";
		$data = $this->db->query($sql);
		echo json_encode($data->result());
  }
  function get_list_product(){
	  $id = $this->input->get("id");	  
	  $sql="select t_market_product.* from t_market_product where created_by = '".$id."'";
		$data = $this->db->query($sql);
		echo json_encode($data->result());
  }
  function get_product(){
    $data["id"] = $this->input->get("id");
    $this->db->where($data);
    $result = $this->db->get("t_market_product")->row();
    if($result){
      echo json_encode($result);
    }else{
      $result["id"] = "0";
      echo json_encode($result);
    }
  }
  function delete_product(){
    $data["id"] = $this->input->post("id");
    $this->db->where($data);
    $result = $this->db->delete("t_market_product");
	$msg["status"] = "1";
	echo json_encode($msg);
  }
  function gedung_nearme(){
	date_default_timezone_set("Asia/Jakarta");
	$lat  = isset($_POST["lat"])?$_POST["lat"]:"-6.252300";
	$lng  = isset($_POST["lng"])?$_POST["lng"]:"106.847336";
	$id= isset($_POST["id"])?$_POST["id"]:"13";
	$now  = date('Y-m-d H:i:s');

	$query = $this->db->query("select * from m_building where geo_lat !='' and geo_long !=''");

	$data = array();
	foreach ($query->result() as $tmp) {
	$distance = $this->haversineGreatCircleDistance($lat,$lng,$tmp->geo_lat,$tmp->geo_long);
		//if($distance < 40000){
			array_push($data,$tmp);
		//}
	}
	echo json_encode($data);
  }
  function acara(){
    $query = $this->db->query("select distinct tanggal from t_event");
    $data = array();
    foreach($query->result() as $tmp){
      $item["tanggal"] = $tmp->tanggal;
      $qacara = $this->db->query("select * from t_event where tanggal = '".$tmp->tanggal."'");
      $item["acara"] = $qacara->result();
      array_push($data,$item);
    }
    echo json_encode($data);
  }
  function add_friend(){
	  $id = $this->input->post("id");
	  $id_friend = $this->input->post("id_friend");
	  $data["id_anggota"] = $id;
	  $data["id_friend"] = $id_friend;
	  $cek1 = $this->db->where($data)->get("t_friend")->row();
	  $data2["id_anggota"] = $id_friend;
	  $data2["id_friend"] = $id;
	  $cek2 = $this->db->where($data2)->get("t_friend")->row();
	  if(!$cek1 and !$cek2){
		  $this->db->insert("t_friend",$data);
		$msg["status"] = "1";
		echo json_encode($msg);
	  }else{
		$msg["status"] = "2";
		echo json_encode($msg);
	  }
  }
  function get_friends(){
	  $id = $this->input->get("id");
	  $result = $this->db->query("SELECT t_friend.id id_message,m_anggota.id, nama fullname, nomor_telpn username FROM m_anggota inner join t_friend on t_friend.id_friend = m_anggota.id where t_friend.id_anggota = '$id'
		union all 
		SELECT t_friend.id  id_message,m_anggota.id, nama fullname, nomor_telpn username FROM m_anggota inner join t_friend on t_friend.id_anggota = m_anggota.id where t_friend.id_friend = '$id'");
	  echo json_encode($result->result());
  }
  function pending_order(){
	  $id = $this->input->get("id");
	  $data["total"] = $this->db->query("select * from t_market_order where order_to = '$id' and order_status = '3'")->num_rows();
	  $data["status"] = "1";
	  echo json_encode($data);
  }
  function setFCM(){
	  $tlpn = $this->input->post("tlpn");
	  $token = $this->input->post("token");
	  $cek = $this->db->query("select * from t_token_fcm where nomor_telpn = '".$tlpn."'")->row();
	  if($cek){
		  $data["token"] = $token;
		  $this->db->where("nomor_telpn",$tlpn);
		  $this->db->update("t_token_fcm",$data);
	  }else{		  
		  $data["token"] = $token;
		  $data["nomor_telpn"] = $tlpn;
		  $this->db->insert("t_token_fcm",$data);
	  }
	  $data["status"] = "1";
	  echo json_encode($data);
  }
	function sendNotificaiton(){
		$tlpn = $this->input->get("to");
		$query = $this->db->query("select * from t_token_fcm where nomor_telpn = '".$tlpn."'");
		foreach($query->result() as $tmp){
			$json_data =[
				"to" => $tmp->token,
				"notification" => [
					"body" => $this->input->post("message"),
					"title" => $this->input->post("title"),
					"icon" => "logo_hanura"
				]
			];
			$data = json_encode($json_data);
			//FCM API end-point
			$url = 'https://fcm.googleapis.com/fcm/send';
			//api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
			$server_key = 'AAAA5ttkj6M:APA91bFlkmC0HD_JMDDjrrFJsHPEJQcseWFdaCuv71zRxgGOfkk8fTmBiYe0HzcJEejnTxE8r_ucnPqY902IIBM1fC40DvUBe6RMsxZH9_h3GXZLUiGUrZ-ia13pdlP5B2aT_Ou6ZgAI';
			//header with content_type api key
			$headers = array(
				'Content-Type:application/json',
				'Authorization:key='.$server_key
			);
			//CURL request to route notification to FCM connection server (provided by Google)
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			if ($result === FALSE) {
				die('Oops! FCM Send Error: ' . curl_error($ch));
			}
			curl_close($ch);
			echo $data;
		}
	}
	
  
	function input_berita(){
		if($this->input->post("foto")!=""){
			$data["foto"] = "/foto/".$this->input->post("foto");
		}
		$data["judul"] = $this->input->post("judul");
		$data["isi"] = $this->input->post("isi");
		$data["created_by"] = $this->input->post("id");
		$data["created_date"] = date('Y-m-d H:i:s');
		$this->db->insert("t_berita",$data);
		$msg["status"] = "1";
		echo json_encode($msg);
		
	}
	function provinsi(){
		$data = $this->db->get("provinsi");
		echo json_encode($data->result());
	}
	function kabupaten(){
		$provinsi = $this->input->get("provinsi");
		$data = $this->db->where("provinsi",$provinsi)->get("kabupaten");
		echo json_encode($data->result());
	}
	
	function provinsi_kpu(){
		$data = $this->db->get("m_geo_prov_kpu");
		echo json_encode($data->result());
	}
	function dprd1(){
		$provinsi = $this->input->get("provinsi");
		$data = $this->db->query("select prov.geo_prov_nama, bio.bio_nama_depan,nama_dapil  from sipol.r_bio_dprdi dprd1 inner join sipol.m_bio bio on bio.bio_id = dprd1.bio_id left join sipol.m_geo_prov_kpu prov on prov.geo_prov_id = dprd1.geo_prov_id inner join sipol.m_dapil dapil on dapil.dapil_id = dprd1.dapil_id where prov.geo_prov_id = '$provinsi'");
		echo json_encode($data->result());
	}
	
	function dprd2(){
		$provinsi = $this->input->get("provinsi");
		$data = $this->db->query("SELECT
			prov.geo_prov_nama,
			kab.geo_kab_nama,
			bio.bio_nama_depan,
			nama_dapil 
		FROM
			sipol.r_bio_dprdii dprd2
			INNER JOIN sipol.m_bio bio ON bio.bio_id = dprd2.bio_id
			inner JOIN sipol.m_geo_prov_kpu prov ON prov.geo_prov_id = dprd2.geo_prov_id
			inner JOIN sipol.m_geo_kab_kpu kab ON kab.geo_kab_id = dprd2.geo_kab_id
			left JOIN sipol.m_dapil dapil ON dapil.dapil_id = dprd2.dapil_id 
		WHERE
			prov.geo_prov_id = '$provinsi'");
		echo json_encode($data->result());
	}	
}
