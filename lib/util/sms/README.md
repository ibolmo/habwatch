Here is the requirement and operation.

1.) Get a Nokia phone (n80 or n95) that has unlimited SMS and unlimited data.
2.) Setup python on it.
3.) Run the Python script attached (and change the parameters).
4.) Setup the php file in some web server.

In the python script you must change:

domain = "cens.com" (where sms.php exists)
handler = "/sms.php?" (don't need to change)
keyword = "yourownaddress@gmail.com"  (this is the thing that the phone uses to send sms back)

In the SMS script you must change:
$to = "yourownaddress@gmail.com" (to an email address that you want all your SMSs off)


So the way it works is this... 

Basically, if you send a SMS to the phone's number - it contacts sms.php which emails the content to the address in the $to field.
If you want to go the other way (ie. make the phone send a SMS to someone).  Then you create an email message to the phone's number (@tmomail.net) from the keyword address with the subject as the number and the body as the content.