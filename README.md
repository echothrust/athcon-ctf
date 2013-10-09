Athc0n 2012 CTF setups
======

Intro

This is a release of the backend code that was written to run Athc0n 2k12 CTF, which was basically a hacker vs. admin contest, with winners from both teams. More on the CTF scenario on our blog post http://www.echothrust.com/blogs/putting-together-athcon-2012-ctf-part-i.

What is CTF?

According to wikipedia :"Capture the Flag (CTF) is a computer security competition. CTF contests are usually designed to serve as an educational exercise to give participants experience in securing a machine, as well as conducting and reacting to the sort of attacks found in the real world. Reverse-engineering, network sniffing, protocol analysis, system administration, programming, and cryptanalysis are all skills which have been required by prior CTF contests at DEF CON. There are two main styles of capture the flag competitions: attack/defense and jeopardy.

In an attack/defense style competition, each team is given a machine (or a small network) to defend on an isolated network. Teams are scored on both their success in defending their assigned machine and on their success in attacking other team's machines. Depending on the nature of the particular CTF game, teams may either be attempting to take an opponent's flag from their machine or teams may be attempting to plant their own flag on their opponent's machine."


What is Athc0n?

AthCon is an annual, European two-day conference targeting particular areas of information security. It’s aim: to bring leading information security experts together. Attacking techniques of exploitation and various forms of penetration testing have become an important component of any organisation. This conference aims to provide a venue for understanding the ever evolving changes as well as new threats. More details about the conference can be found @ http://athcon.org/ 

Technical Details:

The `webui` directory contains the PHP site used during gameplay by the users to register, keep scores, submit results, etc.
  * `webui/*.php` includes the frontend for the CTF participants
  * `webui/manager` includes the CTF moderators frontend

The `contrib` directory contains the db schema for the web-ui, where most of the game logic lies. Additionally, you will find all of the operating system configuration and scripts used to support the CTF: For example, in order to make the secluded CTF lan appear like it had normal internet traffic, we employed a syslog event spoofer that was used to generate realistic noise on [Echofish](http://www.echothrust.com/projects/echofish), the powerfull admin console that was given to the admins team, allowing hackers to hide within legitimate event noise, therefore enhancing gameplay for both teams. You will also find all the gource 'glue' used to generate the cool traffic visualisations that were running during the game and other cool stuff used internally on the CTF setup.


