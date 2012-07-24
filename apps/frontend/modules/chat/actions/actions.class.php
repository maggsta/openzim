<?php

class chatActions extends sfActions {

	public function executeChat(sfWebRequest $request) {
		$chatfile = 'ozchat/chat.txt';
		$function = $request->getPostParameter('function');

		$log = array();
		
		switch($function) {
		
			case('getState'):
				if(file_exists($chatfile)){
					$lines = file($chatfile);
				}
				$log['state'] = count($lines);
				break;
				 
			case('update'):
				$state = $request->getPostParameter('state');
				if(file_exists($chatfile)){
					$lines = file($chatfile);
				}
				$count =  count($lines);
				$log['state'] = $count;
				if($state == $count){
					$log['text'] = false;
				}
				else{
					$text= array();
					foreach ($lines as $line_num => $line)
					{
						if($line_num >= $state){
							$text[] =  $line = str_replace("\n", "", $line);
						}
					}
					$log['text'] = $text;
				}
				 
				break;
		
			case('send'):
				$nickname = $request->getPostParameter('nickname');
				$nickname = htmlentities(strip_tags($nickname));
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
				$message = $request->getPostParameter('message');
				$message = htmlentities(strip_tags($message),ENT_QUOTES, "UTF-8");
		
				if(($message) != "\n"){
					 
					if(preg_match($reg_exUrl, $message, $url)) {
						$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
					}
					 
					fwrite(fopen($chatfile, 'a'), "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "\n");
				}
				break;				 
		}
		
		return $this->renderText(json_encode($log));
	}
	
}