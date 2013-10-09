athcon
======

Athc0n 2012 CTF setups

This is a release of the backend code that was written to run Athc0n 2k12 CTF, which was basically a hacker vs. admin contest, with winners from both teams. More on the CTF scenario [here](http://www.echothrust.com/blogs/putting-together-athcon-2012-ctf-part-i)

The `webui` directory contains the PHP site used during gameplay by the users to register, keep scores, submit results, etc.

The `contrib` directory contains the db schema for the web-ui, where most of the game logic lies. Additionally, you will find all of the operating system configuration and scripts used to support the CTF and further enhance gameplay, such as a syslog event spoofer that was used to generate realistic noise on Echofish, the powerfull admin console we gave to the admins team, in order to make the otherwise secluded CTF lan to appear like it had normal internet traffic.
