<?php

/**
 * @copyright Copyright (c) 2017, Dretech software
 *
 * @author Dretech <dretech@hetnetwerk.org>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 * 2017-11-20: Version 0.2 Object Oriented implementation of PHP functions for 2fa with Telegram
 */


class Telegram {
	const TELEGRAM_BOT_SITE = 'https://api.telegram.org/bot';
	private $_telegramId;

	public function __construct($uniqueKey, $telegramBotToken) {
	
		$url = self::TELEGRAM_BOT_SITE.$telegramBotToken;
		$update = file_get_contents($url."/getupdates");
		$updateArray=json_decode($update, TRUE);
		$numberMessages=count($updateArray['result'])-1;
		$searchtext = strtolower("user_id " . $uniqueKey);

		for ($x = 0; $x <= $numberMessages; $x++)
		{
			if (strip_tags(strtolower($updateArray['result'][$x]['message']['text'])) == $searchtext)
			{
				$userId = $updateArray['result'][$x]['message']['chat']['id'];
				self::sendTelegramMessage(self::TELEGRAM_BOT_SITE, $telegramBotToken, $userId, "Telegram 2 factor authentication has been succesfully configured for user id " . $userId);
				$this->_telegramId = $userId;
				break;
			}
		}
	}

	public function getTelegramId() {
	
		return $this->_telegramId;
	}
	
	public function sendTelegramMessage ($telegramBotSite, $telegramBotToken, $userId, $message)
	{
        $url = $telegramBotSite.$telegramBotToken."/sendMessage?chat_id=".$userId."&disable_web_page_preview=1&text=".$message;
        file_get_contents($url);
	}
}

$telegramUser = new Telegram('your email adresss', 'your telegram bot code');
echo "Telegram user id is: " . $telegramUser->getTelegramId() . "\n";


?>
