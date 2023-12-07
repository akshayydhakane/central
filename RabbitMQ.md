How To Setup RabbitMQ Server in Ubuntu


Install RabbitMq

# sudo apt-get update
# sudo apt-get upgrade
# sudo apt-get purge erlang*



enable RabbitMQ PPA repository on your system. Also, import rabbitmq signing key on your system.


# echo 'deb http://www.rabbitmq.com/debian/ testing main' | sudo tee /etc/apt/sources.list.d/rabbitmq.list



# wget -O- https://www.rabbitmq.com/rabbitmq-release-signing-key.asc | sudo apt-key add -



# sudo apt-get update



# sudo apt-get install rabbitmq-server



Manage RabbitMQ Service

After completing installations, enable the RabbitMQ service on your system. Also, start the RabbitMQ service


# sudo update-rc.d rabbitmq-server defaults



# sudo service enable rabbitmq-server



# sudo service rabbitmq-server start



# sudo service rabbitmq-server stop



# sudo service rabbitmq-server restart



# sudo service rabbitmq-server status




Uisng Systemctl –


# sudo systemctl enable rabbitmq-server
# sudo systemctl start rabbitmq-server
# sudo systemctl stop rabbitmq-server
# sudo systemctl restart rabbitmq-server
# sudo systemctl status rabbitmq-server



Create Admin User in RabbitMQ

By default rabbitmq creates a user named “guest” with password “guest”. You can also create your own administrator account on RabbitMQ server.


# sudo rabbitmqctl add_user admin password



# sudo rabbitmqctl set_user_tags admin administrator



# sudo rabbitmqctl set_permissions -p / admin ".*" ".*" ".*"



Setup RabbitMQ Web Management Console

# sudo rabbitmq-plugins enable rabbitmq_management




RabbitMQ server work on port 15672


You can start server usign http://your_server_ip:15672.




you will get the RabbitMQ management web interface dashboard.

