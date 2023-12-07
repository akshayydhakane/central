Redis in ubuntu

Installing and Configure Redis in ubuntu

# sudo apt update



# sudo apt install redis-server



# sudo nano /etc/redis/redis.conf



. . .

# If you run Redis from upstart or systemd, Redis can interact with your
# supervision tree. Options:
#   supervised no      - no supervision interaction
#   supervised upstart - signal upstart by putting Redis into SIGSTOP mode
#   supervised systemd - signal systemd by writing READY=1 to $NOTIFY_SOCKET
#   supervised auto    - detect upstart or systemd method based on
#                        UPSTART_JOB or NOTIFY_SOCKET environment variables
# Note: these supervision methods only signal "process is ready."
#       They do not enable continuous liveness pings back to your supervisor.
supervised systemd

. . .


And change the password for authentication so

# requirepass foobared 


replace foobared with your new password

# requirepass NewPassword


Then save and exit
After that you have to restart redis service

# sudo systemctl restart redis


For check redis service start, stop, restart and status

# sudo systemctl start redis



# sudo systemctl status redis



# sudo systemctl stop redis



# sudo systemctl restart redis


Then Enter,

# redis-cli


OUTPUT look like this

#127.0.0.1:6379>


Now you Authenticate your redis password

#127.0.0.1:6379> auth your_redis_password



Output
OK
