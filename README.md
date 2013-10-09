athcon
======

Athc0n 2012 CTF setups

This is a release of the backend code that was written to run Athc0n 2k12 CTF, which was basically a hacker vs. admin contest, with winners from both teams. More on the CTF scenario [here](http://www.echothrust.com/blogs/putting-together-athcon-2012-ctf-part-i).

The `webui` directory contains the PHP site used during gameplay by the users to register, keep scores, submit results, etc.

The `contrib` directory contains the db schema for the web-ui, where most of the game logic lies. Additionally, you will find all of the operating system configuration and scripts used to support the CTF: For example, in order to make the secluded CTF lan appear like it had normal internet traffic, we employed a syslog event spoofer that was used to generate realistic noise on [Echofish](http://www.echothrust.com/projects/echofish), the powerfull admin console that was given to the admins team, allowing hackers to hide within legitimate event noise, therefore enhancing gameplay for both teams. You will also find all the gource 'glue' used to generate the cool traffic visualisations that were running during the game and other cool stuff used internally on the CTF setup.
