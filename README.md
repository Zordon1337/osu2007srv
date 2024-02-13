## osu backend emulator for version before bancho came out(b70-b222)
### How to setup
1. Clone repo
2. rename file conn_ex.php to conn.php in utils directory
3. (optional but recommended) Create new DB user
4. Create Database with any name you want
5. rename file conn_ex.php to conn.php in utils directory
6. enter you database credentials in utils/conn.php
7. go to SERVER_IP:PORT/register.php and create account(server will automatically create tables in database)
8. Redirect osu.ppy.sh connections to server ip(you can use: server switcher, fiddler, hosts method or just patch client using for ex. DnSpy)
9. Start client and login, Enjoy
### notes
<pre>
  server DOES NOT include irc chat, you have to make one yourself 
  or use my <a href="https://github.com/Zordon1337/EIRC">very basic server</a>
  rating needs to be implemented in b222

  if you want to use it with tcp bancho, you can use <a href="https://github.com/Zordon1337/BanchoTP">bancho "proxy"</a> that redirects socket requests to http backend
  if you wanna see screenshots look at the bottom of readme
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

# screenshots
### website:
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/7b5746be-8d82-41d9-8e4a-d4cdea539afe)
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/35f5a99a-312b-4c45-8191-3dcd1c9578af)
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/53c6477a-cc89-4faa-9c5f-cf67aa0ea6eb)
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/c30b00df-7409-4a92-b1c5-f321275cb010)
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/78217ffe-2145-4154-9043-109cbc674781)
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/e55c0d06-5e0e-4562-8928-045f73369558)
### ingame:
#### b1077a connected through proxy
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/d9c7addc-970b-4c60-80d8-b50beaec3e66)
#### b699 connected through proxy
![image](https://github.com/Zordon1337/osu2007srv/assets/65111609/881a55da-ef42-4c27-8663-68ad34cbc969)
#### b222 connected
![screenshot001](https://github.com/Zordon1337/osu2007srv/assets/65111609/9a86c4e1-2b79-44c9-a387-eaf89ece8d42)
