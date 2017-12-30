<?php

/**
 *	Generated by IceTea Framework 0.0.1
 *	Created at 2017-12-29 21:16:18
 *	Namespace App\Http\Controllers
 */

namespace App\Http\Controllers;

use IceTea\Http\Controller;
use App\User;
use App\GroupChat;
use App\Login;
use App\Http\Controllers\Auth\Authenticated;

class GroupChatController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('user/groupchat');
    }

    public function to($par)
    {
        Authenticated::login("", "/login?ref=unauthenticated_chat&w=".urlencode(rstr(64)));
        $info = GroupChat::getGroupChatInfo($selfid = Login::getUserId(), $par['groupname']);
        $selfinfo = User::getInfo($selfid, "a.user_id");
        if ($info !== false) {
            return view('user/groupchat_end', ["info" => $info, "boundary" => json_encode(
                    [
                        /*$info['user_id'] => [
                            "status" => "party",
                            "name" => htmlspecialchars($info['first_name'].(empty($info['last_name'])?"":" ".$info['last_name']), ENT_QUOTES, 'UTF-8'),
                            "photo" => ($info['photo'])
                        ],*/
                        $selfid     => [
                            "status" => "self",
                            "name" => htmlspecialchars($selfinfo['first_name'].(empty($selfinfo['last_name'])?"":" ".$selfinfo['last_name']), ENT_QUOTES, 'UTF-8'),
                            "photo" => ($selfinfo['photo'])
                        ]
                    ]
                ),
                "selfinfo" => $selfinfo
            ]
        );
        }
        abort(404);
    }

    public function get($par)
    {
        Authenticated::login();
        header("Content-type:application/json");
        if ($par['groupname'] !== false) {
            if (isset($_GET['realtime_update'])) {
                //print json_encode(array_reverse(GroupChat::getPrivateConversationRealtimeUpdate(Login::getUserId(), $par['groupname'])));
            } else {
                //print json_encode(array_reverse(GroupChat::getPrivateConversation(Login::getUserId(), $par['groupname'])));
            }
        }
    }

    public function post($par)
    {
        Authenticated::login();
        header("Content-type:application/json");
        $a = json_decode(file_get_contents("php://input"), true);
        $receiverId = $par['groupname'];
        if ($receiverId !== false) {
            print GroupChat::privatePost(Login::getUserId(), $receiverId, $a['text']);
            if ((trim($a['text']) == 0) !== 0 ){
                print GroupChat::privatePost(Login::getUserId(), $receiverId, trim($a['text']));
            }
        }
    }
}
