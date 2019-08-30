<?php
require_once('config.php');

function getSites(){
	//balikin semua sites yang terdaftar
	global $db;
	try{
		$sql = "SELECT * FROM master_sites ORDER BY msstName asc;";
		$stmt = $db->prepare($sql);
		if($stmt->execute()){
			$dataSites = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode(['error'=>0,'error_message'=>null,'data'=>$dataSites]);
		}else{
			echo json_encode(['error'=>1,'error_message'=>'Terjadi kesalahan mengambil data lokasi.','error_code'=>'E02']);
		}
	}catch(PDOException $e){
		echo json_encode(['error'=>1,'error_message'=>'Terjadi kesalahan mengambil data lokasi.','error_code'=>'E01']);
	}
}
function getClientId(){
	global $db;
	//ambil software ID berdasarkan GUID yg dikirim
	//jika GUID belum tersedia di DB, maka buat dulu di DB dan balikin response datanya
	//jika GUID sudah ada, balikin langsung response-nya
	$guid = $_POST['guid'];
	$siteId = $_POST['siteId'];
	try{
		$stmtCek = $db->prepare('SELECT * FROM client_software WHERE clswGuid=:guid;');
		$stmtCek->bindValue(':guid',$guid);
		if($stmtCek->execute()){
			$count = $stmtCek->rowCount()
			if($count<=0){
				
			}else{
				$data = $stmtCek->fetch();
			}
			
		}else{
			
		}
	}catch(PDOException $e){
		
	}
}
function setClientSite(){
	//sebelum ini, aplikasi melakukan setting Client ID berdasarkan GUID
	//POST client ID dan Site ID
}
function getBarangSite(){
	//balikin semua barang yg ada di site tertentu, sesuai konfigurasi
	$siteId = $_POST['msstId'];
	
	
}
function uploadTransaksi(){
	//upload transaksi di lokal ke server
	
}

$path = isset($_GET['path']) ? $_GET['path'] : 'home';
switch($path){
	case 'home':
	case '':
	default:
		echo 'Hsstt...jangan iseng.';
	break;
	case 'site':
		getSites();
	break;
	case 'client_id': //get client ID
		getClientId();
	break;
	case 'set_client_site':
		setClientSite();
	break;
	case 'get_site_barang':
		getBarangSite();
	break;
	case 'upload_transaksi':
		uploadTransaksi();
	break;
}