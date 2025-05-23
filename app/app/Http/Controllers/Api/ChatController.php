<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Response;

class ChatController extends Controller
{

    public function messageList($alertId)
    {
        $data = Chat::where("alert_id", $alertId)->with("users")->latest()->paginate(15);
        $data = array("message" => "success", "data" => $data);
        return response($data, Response::HTTP_OK);
    }
}
