# web-controller-radio
A quick and dirty Web client as a radio remote controller for raspberry pi.

#### What is required to get it work?
 - php
 - omxplayer
 - alsamix
 - Adding the line `www-data ALL=(ALL) NOPASSWD: /usr/bin/amixer` in file `/etc/sudoers`.

#### How does it work?
The IHM is done with HTML, JS and AJAX. It sends POST to mute, unmute, set the volume, start or stop a radio. These actions triggered a specific `shell_exec` command using either `amixer` or `omxplayer` (and a `kill` for the stop-action).
