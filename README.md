libo_conf_webpage_scripts
=========================

This is a *hack* but it fits my need :P

You'll need (unclear licenses, won't ship the code in my repo):
* https://github.com/PHPMailer/PHPMailer (release 5.2.8) -> save in the directory called *phpmailer*
* https://github.com/raulferras/simplexlsx (release 4b8597ac3d5621e99aeaa66c6721ff3614cd6743) -> save in the directory called *simplexlsx*

The base is the sheet *talks_bios.ods*, you have to save it with Microsoft
Excel (yeah, go on and kill me...) as an xlsx file, which can then be parsed
by *simplexslx*  see https://github.com/raulferras/simplexlsx
(don't know why, but this library won't be able to read an xlsx generated by LibO 4.3).
If you find a lib which is able to read an ods file, go ahead and directly
use the ods file - currently there is no easy-to-use lib for reading ods
files (and I don't want to use the PHP xml functions by hand).

There are two scripts:
* web_content_bios.php
* web_content_talks.php

And they include:
* functions.php

You probably need to adjust the following things in order to get something useful:
* mapping name <-> picture filename in *functions.php* (see _$speaker_) and you need to upload the pictures manually
* adjust the URLs, see _$speakerURL_ and _$URLPicture_ in *functions.php*

Run the script on a command line (ignore or fix the notices):
```
$ php web_content_talks.php

$ php web_content_bios.php
```

This will then generate some HTML files which can be used to copy & paste to the CMS.

There is a third script called *review_mail.php* this can be used to send
a reminder email to every speaker - please update the template and the mail
settings to fit your need.
