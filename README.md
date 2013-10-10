Athc0n 2012 CTF setups
======

## Intro

This is a release of the backend code that was written to run Athc0n 2k12 CTF, which was basically a hacker vs. admin contest, with winners from both teams. More on the CTF scenario on our blog post http://www.echothrust.com/blogs/putting-together-athcon-2012-ctf-part-i.

## What Athc0n?

AthCon is an annual, European two-day conference targeting particular areas of information security. It’s aim: to bring leading information security experts together. More details about the conference can be found @ http://athcon.org/ 


## What CTF?

In computer security, Capture the Flag (CTF) refers to computer security competitions that allow participants to demonstrate their level of skills on practical IT security. As stated [on wikipedia](http://en.wikipedia.org/wiki/Capture_the_flag#Computer_security), there are two main styles of capture the flag competitions: attack/defense and jeopardy. 

Attack/defense usually require each of the participant teams to prepare a predefined setup and defend it, while the teams attack each others setups. Naturally, a jeopardy-style CTF, where points are predefined and teams race to capture them but do not attack each other, would be better suited since no specific timeslot was allocated for the CTF in the conference schedule.

Well, for Athc0n 2k12 we wanted to create a unique, hybrid style of CTF, and decided to do so by allowing participants/teams to join either the attackers scenario (hackers party) or the defenders scenario (admins party) in a LAN we had already prepared for them, involving situations and findings that would yield or substract different point values from the participants/teams. 

More specifically, participants in the Hackers party were required to bring their own laptops and attempt earning points by gathering pre-planted "easter eggs" from hosts and services that comprised the scenario LAN. On the oposite side, Admins were equiped with all sorts of monitoring consoles and earned their points by reporting attackers correctly (with log justification) to the CTF committee, which would also substract points from the reported attacker's total score. Incomplete or otherwise bad attack reports from a participant Admin, would result in point subtraction from his total score.

What we came up with was a joepardy-style CTF, that also involved teams and parties and winner standings from each party. Having introduced the Admins party in the scenario, required for the attacks to be more realistic, since they had to pass undetected in a realistic up-to-date network with many monitoring services. Even though the game came out almost unannounced, it attracted more than 25 participant teams. Game moderation and scoring was supported by purpose-built solutions, requiring only 2 monitoring moderators.

## Why release this?

The code was created for the sole purpose of hosting the 2012 CTF event, but is in escence a generic CTF game engine for our special jeopardy-style CTF gametype. We are releasing the engine behind the CTF, which -in our belief- can easily be used to re-accommodate a CTF contest, and would be happy to see this project evolve. 

## Technical Details

The `webui` directory contains the PHP site used during gameplay by the users to register, keep scores, submit results, etc
  * `webui/*.php` the frontend for the CTF participants, plus misc pages like the scoreboard.
  * `webui/manager` the CTF moderators frontend.

The `contrib` directory contains the db schema for the web-ui, where most of the game logic lies. Additionally, you will find all of the operating system configuration and scripts used to support the CTF: For example, in order to make the secluded CTF lan appear like it had normal internet traffic, we employed a syslog event spoofer that was used to generate realistic noise on [Echofish](http://www.echothrust.com/projects/echofish), the powerfull admin console that was given to the admins team, allowing hackers to hide within legitimate event noise, therefore enhancing gameplay for both teams. You will also find all the gource 'glue' used with tcpdump to generate the [cool traffic visualisations](http://www.youtube.com/watch?v=2hlvEVSe24M) that were running during the game and other cool stuff used internally on the CTF setup.


