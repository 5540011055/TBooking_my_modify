<?php 
 			$details_url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=".$_GET["place_id"]."&key=AIzaSyCZqxDmw7dChWFXfh0_MdspEe1Y6swUdQ0&language=en";
  			$curl_post_data = '';
			$curl_response = '';
			$headers = array();                              
			$url = $details_url;                               
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_HTTPHEADER , array(
			     'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
			));
			curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_REFERER, $url);
			curl_setopt($curl, CURLOPT_URL, $url);  
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
			$curl_response = curl_exec($curl);
			curl_close($curl);
			$aaaa = json_decode($curl_response);
//   			echo print_r($aaaa->result->photos[0]->photo_reference);
//   			echo print_r($curl_response);
			
			$data[status] = $aaaa->status;
			$data[photo_ref] = $aaaa->result->photos[0]->photo_reference;
			$data[url] = $aaaa->result->url;
			header('Content-Type: application/json');
			echo json_encode($data);
?>