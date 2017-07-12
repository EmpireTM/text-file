به نام خدا جان خرد
یا الله
<?php
/*
نویسنده سورس: @Htmlsudo
نام: امیر 
ایدی کانال: @EmpireTm , @RoBorSazi
*/
define('API_KEY','توکن');
//----------
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$result=json_decode($message,true);
//0000000|API_REQ|
function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    error_log("Method name must be a string\n");
    return false;
  }
  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    error_log("Parameters must be an array\n");
    return false;
  }
  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {
      $val = json_encode($val);
    }
  }
}
//+++++function++++++
function SendChatAction($chatid,$action){
bot('sendChatAction',[
'chat_id'=>$chatid,
'action'=>$action
]);
}
function SendMessage($ChatId, $TextMsg){
 bot('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendDocument($chatid,$document,$keyboard,$caption){
bot('SendDocument',[
'chat_id'=>$chatid,
'document'=>$document,
'caption'=>$caption,
'reply_markup'=>$keyboard
]);
}
function save($filename,$TXTdata){
 $myfile = fopen($filename, "w") or die("Unable to open file!");
 fwrite($myfile, "$TXTdata");
 fclose($myfile);
 }
//+++++++++++++++++++
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
$chat_id = $update->message->chat->id;
$message_id = $update->message->message_id;
$from_id = $update->message->from->id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $update->message->from->username;
$text = $update->message->text;
$admin = آیدی عددی ادمین;
$channel = "ایدی کانال";
$creator = "ایدی اصلی ادمین بدون ادساین";
$date = file_get_contents("http://api.teambot.ir/date/");
$time = file_get_contents("http://api.teambot.ir/time/");
$command = file_get_contents("data/$from_id/command.txt");
//===================
if ($text == '/start') {
SendChatAction($chat_id,"typing");	
if (!file_exists("data/$from_id/command.txt")) {
mkdir("data/$from_id");	
save("data/$from_id/command.txt","none");
$myfile2 = fopen("data/user.txt", "a") or die("Unable to open file!"); 
fwrite($myfile2, "$from_id\n");
fclose($myfile2);
}
bot('sendMessage',[
'chat_id'=>$update->message->chat->id,
'text'=>"🏠 سلام $first_name کاربر عزیز\n\nبه ربات متن به فایل خوش امدید☺️\nمن برای شما متن هاتون رو تبدیل میکنم به فایل (txt) ☑️\n\nبه همین راحتی فایل هات در کامپبوتر , گوشی و... باز میشه❤️\n\n📚راهنما: اول متن خود را ارسال کنید ‼️ تا فایل بشه🔻",
 'parse_mode'=>'MarkDown',
 'reply_markup'=>json_encode([
 'inline_keyboard'=>[
 [
 ['text'=>"💠سازنده | creator💠",'url'=>"https://telegram.me/$creator"],['text'=>"کانال ما😘",'url'=>"https://telegram.me/$channel"]
 ],
 ]
 ])
 ]);
}
elseif($text == 'پیام همگانی' and $from_id == $admin){
save("data/".$from_id."/command.txt","send");
SendMessage($chat_id," پیامتون رو ارسال کنید: ");
}
elseif($command == 'send' and $from_id == $admin){
save("data/$from_id/command.txt","none");
sendMessage($admin,"پیام شما با موفقیت ارسال شد به تمام کاربران\n\nدر تاریخ: $date\nساعت: $time");
$all_member = fopen("data/user.txt", 'r');
while( !feof( $all_member)) {
$user = fgets( $all_member);
bot('sendmessage',[
'chat_id'=>$user,
'text'=>$text,
'parse_mode'=>'MarkDown'
]);
}
}
elseif($text == 'آمار' and $from_id == $admin){
$mer = file_get_contents('data/user.txt');
$member = explode("\n",$mer);
$memberkol = count($member) -1;
sendmessage($chat_id,"💠آمار | Amar💠\n\n👥 تعداد کاربران : $memberkol\n⏲ در تاریخ: $date\n🕰 ساعت: $time");
}
elseif ($text == '/panel' and $from_id == $admin) {
bot('sendMessage',[
        'chat_id'=>$update->message->chat->id,
        'text'=>"سلام ادمین عزیز
به پنل مدیریت خوش آمدید",
 'parse_mode'=>'MarkDown',
            'reply_markup'=>json_encode([
                'keyboard'=>[
                [
                ['text'=>"آمار"],['text'=>"پیام همگانی"]
                ]
                
                ],
                'resize_keyboard'=>true,
            ])
            ]);
}

elseif($update->message->text){
$rand = rand(33411,8858);
$ce = $rand;	
file_put_contents("file$ce.txt","$text");
bot('SendDocument',[
    'chat_id'=>$chat_id,
    'document'=>new CURLFILE("file$ce.txt"),
    'caption'=>"
    اینم فایل شما😄

🔸متن شما الان داخل این فایله
🔸به فرمت (txt.) تبدیل شده
🔸ساخته شده در ربات فایل تو تکست

🤖 @FileToForBot
    ",
 ]);
}

// T.me/EmpireTm
// T.me/RoBotSazi
// T.me/HtmlSudo سازنده

// نوشته شده توسط تیم ربات سازی ویستا
?>