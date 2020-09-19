<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$inv_id=$_GET['inv_id'];
$shp_item=$_GET['shp_item'];
$shp_from=$_GET['shp_from'];
$out_summ=$_GET['out_summ'];
$date=time();


if (isset($_GET['inv_id'])) {
include "conn.php";
$req = $bdd->prepare("INSERT INTO payments(InvId, ToId, FromId, Payment, Date) VALUES(:InvId, :ToId, :FromId, :Payment, :Date)");
$req->execute(
	array(

		'InvId'=>$inv_id,
		'ToId'=>$shp_item,
		'FromId'=>$shp_from,
		'Payment'=>$out_summ,
		'Date'=>$date

	));
	

$crc=$_GET['crc'];
$mrh_pass2 = "ibragimgad1992";
$my_crc=md5("$out_summ:$inv_id:$mrh_pass2:shp_from=$shp_from:shp_item=$shp_item");

if (strtoupper($my_crc) != strtoupper($crc))
{
  echo "bad sign\n";
  exit();
}

// print OK signature
echo "OK$inv_id\n";
}
?>