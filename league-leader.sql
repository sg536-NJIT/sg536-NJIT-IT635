--good query for points

select a.EventDate, c.displayname, a.StatType,a.Points, a.Rank 
from nightlyleaders a 
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid 
where a.leagueid ='00' and a.statType='points'  
and a.eventDate = "2016-02-20"
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10

-- good query for blocks

select a.EventDate, c.displayname, a.StatType,a.blocks, a.Rank 
from nightlyleaders a 
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid 
where a.leagueid ='00' and a.statType='blocks'  
and a.eventDate = "2016-01-02"
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10

-- Good query for assists

select a.EventDate, c.displayname, a.StatType,a.assists, a.Rank 
from nightlyleaders a 
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid 
where a.leagueid ='00' and a.statType='assists'  
and a.eventDate = "2016-02-20"
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10

--good query for rebounds

select a.EventDate, c.displayname, a.StatType,a.rebs, a.Rank 
from nightlyleaders a 
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid 
where a.leagueid ='00' and a.statType='rebounds'  
and a.eventDate = "2016-02-20"
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10

--good query for steals

select a.EventDate, c.displayname, a.StatType,a.steals, a.Rank 
from nightlyleaders a 
inner join roster b on a.playerid=b.playerid and a.leagueid=b.leagueid
inner join player c on b.playerid=c.playerid 
where a.leagueid ='00' and a.statType='steals'  
and a.eventDate = "2016-02-20"
and b.season=2015 and b.status='1' and b.teamid not in (1610616844,1610616833,1610616834,1610616837,1610616838,1611665409,1611665410,1612709906,1612709907,1610616841,1610616842)
order by rank limit 10





--assists, blocks, points, rebounds, steals
