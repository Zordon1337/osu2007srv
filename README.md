## osu backend emulator for version before bancho came out(b70-b222)
### How to setup
1. Clone repo
2. rename file conn_ex.php to conn.php in utils directory
3. (optional but recommended) Create new DB user
4. Create Database with any name you want
5. enter you database credentials in utils/db.php
6. go to SERVER_IP:PORT/register.php and create account(server will automatically create tables in database)
7. Redirect osu.ppy.sh connections to server ip(you can use: server switcher, fiddler, hosts method or just patch client using for ex. DnSpy)
8. Start client and login, Enjoy
### notes
<pre>
  server DOES NOT include irc chat, you have to make one yourself 
  or use my <a href="https://github.com/Zordon1337/EIRC">very basic server</a>
  rating needs to be implemented in b222

  if you want to use it with tcp bancho, you can use <a href="https://github.com/Zordon1337/BanchoTP">bancho "proxy"</a> that redirects socket requests to http backend
  
</pre>
### supported versions
<pre>
  b282-b1XXX - experimental score server(not recommended to use)
  b222 - everything works except replays
  b196 - everything works except replays
  b170 - everything works except replays
  b162 - everything works except replays
  b144 - everything works except replays
  b130 - everything works except replays
  b99 - everything works except replays
  b86 - fully supported
  b70 - fully supported
</pre>
