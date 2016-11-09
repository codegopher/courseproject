<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Task;

class SendTelegramNotification extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $tasktosend;
    protected $action;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task, string $action)
    {
        $this->tasktosend = $task;
        $this->action = $action;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        error_log("handling telegram task: ".$this->tasktosend->id." - ".$this->action);
        if ($this->action === "upd") {error_log("updating if");}
        // What comes below is an prototype for telegram messaging. Also need to create a case depending on action
        // Need to register a bot, find a way to get chat id's by phone number and to attach an images
        /*
    // usual message
        $url="https://api.telegram.org/bot[ТОКЕН]/sendMessage?disable_web_page_preview=true&chat_id=[ЧАТ ИД]&text=Нам написали тикет скорее отвечайте http://we4u.ru";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$url");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
    // photo
        $bot_url = "https://api.telegram.org/bot<bot_id>/";
        $url = $bot_url . "sendPhoto?chat_id=" . $chat_id ;
        $post_fields = array('chat_id' => $chat_id, 'photo'  => new CURLFile(realpath("/path/to/image.png")));
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
        $output = curl_exec($ch);
        */
    }
}
