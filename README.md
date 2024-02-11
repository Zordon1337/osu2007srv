## osu backend emulator for version before bancho came out(b70-b222)

### notes
<pre>
  this server is just proof-on-concept
  i don't gurantee it will be stable

  server on first login attempt gonna create db tables, and insert default
  beatmap(disco prince) to beatmap checksum whitelist

  server DOES NOT include irc chat, you have to make one yourself 
  or use my <a href="https://github.com/Zordon1337/EIRC">very basic server</a>

  rating needs to be implemented in b222
  
  versions above b170 have problem with black box instead of profile picture because
  these use diffrent image rendering system
</pre>
### supported versions
<pre>
  b504 - experimental score server(not recommended to use)
  b222 - everything works except replays and profile picture being black box
  b196 - everything works except replays and profile picture being black box
  b170 - everything works except replays and profile picture being black box
  b162 - everything works except replays
  b144 - everything works except replays
  b130 - everything works except replays
  b99 - everything works except replays
  b86 - fully supported
  b70 - fully supported
</pre>
