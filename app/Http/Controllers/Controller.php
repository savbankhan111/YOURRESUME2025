<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	private $googleAuthKey = "AAAAHpHAhJA:APA91bHozF31Hu-oKjlPBP3TVm9zBfM0HZ3lZMgzHfkXfr_Dy8_0YZtZNscKLpY-t_0nEICE6e3iYyvki7dXtuxmrnco6duBxlxfQFjrBnICnbHa7DZ8pXGp52oL1MZapyUqaXU4OQ2E";
	
	function sendGCM($message,$description,$id) {
		$url = 'https://fcm.googleapis.com/fcm/send';

		$fields = $message;
		$fields = json_encode ($fields);
		$headers = array (
				'Authorization: key='.$this->googleAuthKey,
				'Content-Type: application/json'
		);

		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

		$result = curl_exec($ch);
		//echo $result;
		curl_close ($ch);
    }
	
	function sendGCMess($message, $id) {
		$url = 'https://fcm.googleapis.com/fcm/send';

		$fields = array (
				'registration_ids' => array (
						$id
				),
				'data' => array (
						"message" => $message
				)
		);
		$fields = json_encode ( $fields );

		$headers = array (
				'Authorization: key='.$this->googleAuthKey,
				'Content-Type: application/json'
		);

		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

		$result = curl_exec ( $ch );
		//echo $result;
		curl_close($ch);
    }
}
