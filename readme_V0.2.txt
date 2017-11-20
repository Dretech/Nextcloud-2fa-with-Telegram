Readme for version 0.2

How to use the PHP code?

1. You need to create a Telegram Bot. See: https://core.telegram.org/bots#3-how-do-i-create-a-bot and https://core.telegram.org/bots#6-botfather
2. After creating the bot, you will get a bot token. Copy the bot token to line 62 of the php script ($telegram_bot_token = )
3. From Telegram web, your telegram phone or tablet app send a message with "user_id and the contents of the unique key in line 62 of the php script)
4. Run the php script and you will get you Telegram user ID as a reply on Telegram web, Telegram phone or table app.
5 You can use the function send_telegram_message to send a message to a Telegram user id.

