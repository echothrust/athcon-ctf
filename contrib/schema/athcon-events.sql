DROP VIEW IF EXISTS vulns_FULL;
CREATE VIEW vulns_FULL AS
	SELECT t1.*,t2.nickname as reporter FROM `vuln` t1 LEFT JOIN users t2 ON t2.id=t1.users_id;
	
	
	
DROP VIEW IF EXISTS arphistory;
CREATE VIEW arphistory AS
	SELECT id,srchw mac, srcip ip,ts timestamp FROM tcpdump group by mac,ip;


-- TOTAL PACKETS PER MAC
DROP VIEW IF EXISTS srchw_counters;
CREATE VIEW srchw_counters AS
	SELECT DISTINCT srchw,count(*) packets FROM tcpdump GROUP BY srchw ORDER BY srchw;

-- TOTAL VALID PACKETS PER MAC
DROP VIEW IF EXISTS srchw_valid_targets_counters;
CREATE VIEW srchw_valid_targets_counters AS
	SELECT DISTINCT srchw,count(*) packets FROM tcpdump 
	WHERE dstip IN (inet_aton('172.0.0.2'), inet_aton('172.0.0.3'),inet_aton('172.0.0.4'),
	inet_aton('192.0.0.2'), inet_aton('192.0.0.3'),inet_aton('192.0.0.4'),inet_aton('192.0.0.5'))
	GROUP BY srchw ORDER BY srchw;


DROP VIEW IF EXISTS report_counters_mac;
CREATE VIEW report_counters_mac AS 
	SELECT DISTINCT  mac,count(*) reportcount FROM reports WHERE resolved>0 GROUP BY mac ORDER BY mac;

DROP VIEW IF EXISTS report_counters_admin;
CREATE VIEW report_counters_admin AS 
	SELECT DISTINCT  reporter,count(*) counter FROM reports WHERE resolved!=0 GROUP BY reporter ORDER BY reporter;

DROP VIEW IF EXISTS report_counters_valid;
CREATE VIEW report_counters_valid AS
	SELECT DISTINCT reporter,count(*) counter FROM reports WHERE mac is not null and resolved>0 GROUP BY reporter ORDER BY reporter;


DROP VIEW IF EXISTS reports_with_users;
CREATE VIEW reports_with_users AS 
	SELECT t1.*,t2.id report_id, t2.subject,t2.attacker,t2.server,t2.abuse,t2.message,t2.logs,t2.resolved,t2.thru,t2.comments  FROM users t1 JOIN reports t2 ON t1.id=t2.reporter;

DROP VIEW IF EXISTS reports_with_fqdn;
CREATE VIEW reports_with_fqdn AS 
	SELECT t1.id,t1.subject,t1.attacker,t1.server,t1.abuse,t1.message,t1.logs,t1.resolved,t1.thru,t1.comments,t1.mac as hacker_mac,t2.nickname, t3.nickname as reporter,t3.mac as reporter_mac FROM `reports` t1 
	LEFT JOIN users t2 on t2.mac=t1.mac
	LEFT JOIN users t3 on t3.id=t1.reporter;

DROP VIEW IF EXISTS union_achievements;
CREATE VIEW union_achievements AS
	SELECT * FROM users_treasures UNION select * from system_users_treasures;

DROP VIEW IF EXISTS user_treasure_points;
CREATE VIEW user_treasure_points AS
	SELECT DISTINCT t2.*,sum(t3.points) as points FROM union_achievements t1
	LEFT JOIN users t2 on t1.users_id=t2.id
	left join treasures t3 ON t1.treasures_id=t3.id
    group by nickname;


DROP VIEW IF EXISTS hacker_pct;
CREATE VIEW hacker_pct AS
 select id,
 (valid_packets/total_packets) user_percent,
 (valid_packets/(select sum(valid_packets) from users)) as total_percent 
 from users t1 where t1.category='hacker';

DROP VIEW IF EXISTS hacker_scores;
CREATE VIEW hacker_scores AS
	SELECT t1.id,
	t1.nickname,
	t1.team,
	t1.mac,
	t1.total_packets as total, 
	t1.valid_packets as valid,
	t2.reportcount reported,
	t3.points treasure,
	t4.user_percent,
	t4.total_percent,
	round(((t4.user_percent*'0.4')*t3.points)+t3.points)+((t4.total_percent*100)+(t4.user_percent*100)) as points
	FROM users t1 
	LEFT JOIN report_counters_mac t2 on t2.mac=t1.mac
	LEFT JOIN user_treasure_points t3 on t3.id=t1.id
	LEFT JOIN hacker_pct AS t4 on t4.id=t1.id
	WHERE t1.category='hacker';

DROP VIEW IF EXISTS _hackerteam_scores;
CREATE VIEW _hackerteam_scores AS
	SELECT DISTINCT if( trim( t1.team ) != '', t1.team, t1.nickname ) AS nickname, 
	sum( t1.total ) AS total, 
	sum( t1.valid ) AS valid, 
	sum( t1.reported ) AS reported, 
	sum( t1.treasure ) as treasure,
	AVG(t1.user_percent) AS user_percent,
	AVG(t1.total_percent) as total_percent
	FROM `hacker_scores` t1
	GROUP BY if( trim( t1.team ) != '', t1.team, t1.nickname );

DROP VIEW IF EXISTS hackerteam_scores;
CREATE VIEW hackerteam_scores AS
	SELECT *,round(((user_percent*'0.4')*treasure)+treasure+(total_percent*100)) as points FROM `_hackerteam_scores`
	order by points desc;

DROP VIEW IF EXISTS admin_scores;
CREATE VIEW admin_scores AS
	SELECT t1.*,
	t2.counter  total, 
	t3.counter valid,
	t4.points treasure,
	round((((t3.counter/t2.counter)*'0.6')*t4.points)+t4.points) as points
	FROM users t1
	LEFT JOIN report_counters_admin t2 ON t2.reporter=t1.id
	LEFT JOIN report_counters_valid t3 ON t3.reporter=t1.id
	LEFT JOIN user_treasure_points t4 ON t4.id=t1.id
	WHERE t4.category='admin' ORDER BY points DESC;


DROP VIEW IF EXISTS uid_achievements;
CREATE VIEW uid_achievements AS
	SELECT t1.*,t2.name,t2.description,t2.points FROM union_achievements t1
	LEFT JOIN treasures t2 on t2.id=t1.treasures_id;


DROP VIEW IF EXISTS union_achievements_FULL;
CREATE VIEW union_achievements_FULL AS
	SELECT t1.id,
			t1.ts,
			t2.pubname as achievement,
			t2.name as private_title,
			IF(t3.team='',t3.nickname,concat('team ',t3.team)) as nickname,
			t2.points
	FROM `union_achievements` t1 
	LEFT JOIN treasures t2 on t1.treasures_id=t2.id
	LEFT JOIN users t3 on t1.users_id=t3.id;

DROP VIEW IF EXISTS uid_dst_ports_counters;
CREATE VIEW uid_dst_ports_counters AS
		SELECT distinct id,dstip,count(*) as counter FROM `uid_dst_ports` group by id,dstip;

DROP VIEW IF EXISTS uid_inet_dst_ports_counters;
CREATE VIEW uid_inet_dst_ports_counters AS
		SELECT distinct id,inet_ntoa(dstip) as dstip,count(*) as counter FROM `uid_dst_ports` group by id,dstip;

DROP VIEW IF EXISTS uid_inet_dst_ports;
CREATE VIEW uid_inet_dst_ports as SELECT id,inet_ntoa(dstip) dstip,dstport,proto FROM `uid_dst_ports`;		

DROP VIEW IF EXISTS uid_dst_ports;
CREATE VIEW uid_dst_ports AS
		select distinct t2.id,`dstip`,dstport,proto
		from tcpdump t1 
		LEFT JOIN users t2 on t1.srchw=t2.mac 
		where  (
-- mail.acmesec.fake
		   (dstip=inet_aton('172.0.0.2') and ((dstport in (25,27622,110,143) and proto='tcp') or (dstport in (123,514,161) and proto='UDP,')))
-- pbx.acmesec.fake
		OR (dstip=inet_aton('172.0.0.3') and ((dstport in (3306,11211,5038,111,22,1720,4445,50888,63452) and proto='tcp') or (dstport in (69,11211,5060,5353,111,123,161) and proto='UDP,'))) 
-- web.acmesec.fake
		OR (dstip=inet_aton('172.0.0.4') and ( (dstport in (22,80,443) and proto='tcp') OR (dstport=123 and proto='UDP,')  )) 
-- dbserv.acmesec.fake
		OR (dstip=inet_aton('172.0.0.5') and ( (dstport in (3489,111,22) and proto='tcp') or (dstport in (111,123) and proto='UDP,' )))
-- lamp.acmesec.fake
		OR (dstip=inet_aton('192.0.0.2') and ( (dstport in (111,3306,22,80,443) and proto='tcp') or (dstport in (111,5353) and proto='udp,') )) 
-- oamp.acmesec.fake
		OR (dstip=inet_aton('192.0.0.3') and ( (dstport in (3306,80,22) and proto='tcp') or (dstport in (161,514) and proto='udp,'))) 
-- freenas.acmesec.fake
		OR (dstip=inet_aton('192.0.0.4') and ( (dstport in (21,548,22,139,445,111,34823) and proto='tcp') or (dstport in (138,137,123,161,69,5353,514,111) and proto='udp,'))) 
-- solaris11.acmesec.fake
		OR (dstip=inet_aton('192.0.0.5') and ((dstport in (111,22) and proto='tcp') or (dstport in (111,68,161) and proto='UDP,') ) ) 
-- orcl.acmesec.fake
		OR (dstip=inet_aton('192.0.0.6') and ( (dstport in (111,22,3938,1521,1158,5520) and proto='tcp') or (dstport in (681,5353,111,9608) and proto='udp,') )) 
-- honeyd.acmesec.fake
		OR (dstip=inet_aton('192.0.0.60') and ((dstport=54546 and proto='tcp') or ((dstport=514 or dstport=161) and proto='UDP,')))
--		OR (dstip=inet_aton('192.0.0.111') and dstport=7 and proto='tcp')
		)
		group by t1.srchw,t1.dstip,t1.dstport,t1.proto;
		

		
delimiter |

DROP EVENT IF EXISTS e_halfhour |

CREATE EVENT e_halfhour ON SCHEDULE EVERY 1 MINUTE
    COMMENT 'Updates treasures for hackers/admins'
    DO
BEGIN
  DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SET @x2 = 1;
  -- mail.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 40,id,NOW()-8 FROM uid_dst_ports_counters WHERE counter=7 and dstip=inet_aton('172.0.0.2'); 
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 46,id,NOW()-7 FROM uid_dst_ports WHERE  dstip=inet_aton('172.0.0.2') and dstport=27622 and proto='tcp';
  -- pbx.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 41,id,NOW()-6 FROM uid_dst_ports_counters WHERE counter=16 and dstip=inet_aton('172.0.0.3'); 
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 47,id,NOW()-5 FROM uid_dst_ports WHERE  dstip=inet_aton('172.0.0.3') and dstport=50888 and proto='tcp';
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 139,id,NOW()-4 FROM uid_dst_ports WHERE  dstip=inet_aton('172.0.0.3') and dstport=63452 and proto='tcp';
  -- web.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 43,id,NOW()-3 FROM uid_dst_ports_counters WHERE counter=4 and dstip=inet_aton('172.0.0.4'); 
  -- dbserv.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 48,id,NOW()-2 FROM uid_dst_ports WHERE dstip=inet_aton('172.0.0.5') and dstport=3489 and proto='tcp';
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 42,id,NOW()-1 FROM uid_dst_ports_counters WHERE counter=5 and dstip=inet_aton('172.0.0.5'); 
  -- lamp.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 36,id,NOW() FROM uid_dst_ports_counters WHERE counter=7 and dstip=inet_aton('192.0.0.2'); 
  -- oamp.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 37,id,NOW()+1 FROM uid_dst_ports_counters WHERE counter=5 and dstip=inet_aton('192.0.0.3'); 
  -- freenas.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 44,id,NOW()+2 FROM uid_dst_ports_counters WHERE counter=15 and dstip=inet_aton('192.0.0.4'); 
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 49,id,NOW()+3 FROM uid_dst_ports WHERE  dstip=inet_aton('192.0.0.4') and dstport=34823 and proto='tcp';
  -- solaris11.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 38,id,NOW()+4 FROM uid_dst_ports_counters WHERE counter=5 and dstip=inet_aton('192.0.0.5'); 
  -- orcl.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 121,id,NOW()+5 FROM uid_dst_ports WHERE dstip=inet_aton('192.0.0.6') and dstport=1521 and proto='tcp';
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 122,id,NOW()+6 FROM uid_dst_ports WHERE dstip=inet_aton('192.0.0.6') and dstport=1158 and proto='tcp';
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 39,id,NOW()+7 FROM uid_dst_ports_counters WHERE counter=10 and dstip=inet_aton('192.0.0.6'); 
-- honeyd.acmesec.fake
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 50,id,NOW()+8 FROM uid_dst_ports WHERE  dstip=inet_aton('192.0.0.60') and dstport=54546 and proto='tcp';
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 113,id,NOW()+9 FROM uid_dst_ports WHERE  dstip=inet_aton('192.0.0.111') and dstport=7 and proto='tcp';
  INSERT INTO users_treasures (treasures_id,users_id,ts) SELECT 90,id,NOW()+10 FROM uid_dst_ports_counters WHERE dstip=inet_aton('192.0.0.60') and counter=3;
-- All open open ports
  INSERT INTO users_treasures (users_id,treasures_id) SELECT DISTINCT users_id,45 FROM `users_treasures` WHERE treasures_id IN ( 40, 46,41,47,139,43,48,42,36,37,44,49,38,121,122,39,50,113,90) group by users_id having count(*)=14;
END |


DROP PROCEDURE IF EXISTS add_final_achievements |

CREATE PROCEDURE add_final_achievements ()
BEGIN
  DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SET @x2 = 1;
-- Filled a report for every server
	INSERT INTO users_treasures (treasures_id,users_id) 
	SELECT 125,reporter 
	FROM `reports` 
	WHERE resolved>0  
	and server in ('172.0.0.2','172.0.0.3','172.0.0.4','172.0.0.5',
	'192.0.0.2','192.0.0.3','192.0.0.4','192.0.0.5','192.0.0.6','192.0.0.60') 
	group by reporter 
	having count(distinct server)=10;
-- Finished the CTF without an invalid report
	INSERT INTO users_treasures (treasures_id,users_id) SELECT 123,id FROM users WHERE category='admin' and 
	id not in (SELECT reporter FROM `reports` WHERE resolved=-1 GROUP BY reporter HAVING count(*)=0)
	and id in (SELECT DISTINCT reporter from reports GROUP BY reporter);
-- Each and every hacker on the CTF
	INSERT INTO users_treasures (users_id,treasures_id) SELECT reporter,59 FROM reports
	WHERE mac in (SELECT DISTINCT mac FROM users WHERE category='hacker')
	group by reporter
	having count(distinct mac)=(SELECT count(DISTINCT mac) FROM users WHERE category='hacker');
END |
