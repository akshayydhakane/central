**************** MongoDB Setup On Ubuntu ***********************************************************************


*Install gnupg and its required libraries using the following command:
# sudo apt-get install gnupg
*Once installed, retry importing the key:
# wget -qO - https://www.mongodb.org/static/pgp/server-6.0.asc | sudo apt-key add -
*Create the /etc/apt/sources.list.d/mongodb-org-6.0.list file for Ubuntu 20.04 (Focal):
# echo "deb [ arch=amd64,arm64 ] https://repo.mongodb.org/apt/ubuntu focal/mongodb-org/6.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-6.0.list
# sudo apt-get update
*Install the latest stable version
# sudo apt-get install -y mongodb-org
*After installation the data directory /var/lib/mongodb and the log directory /var/log/mongodb are created
*Mongo DB configuration file path
# /etc/mongo.conf
*Start MongoDB
# sudo systemctl start mongod
# sudo systemctl stop mongod
# sudo systemctl status mongod
# sudo systemctl restart mongod
*If you receive an error similar to the following when starting mongod
# sudo systemctl daemon-reload
*Using this command you dont have to start mongod service everytime when system reboot
# sudo systemctl enable mongod
*Begin using MongoDB
# mongo
*Create An admin user before we enable admin authentication
*Create Admin User
# mongo
# use admin
db.createUser(
  {
    user: "admin",
    pwd: "abc123",
    roles: [ { role: "userAdminAnyDatabase", db: "admin" } ]
  }
)

# db.auth('admin','passwd')
*Enable MongoDb Authentication
# nano /etc/mongod.conf
net:
    bindIp: 0.0.0.0   //for Out Side access
    port: 27017
security:
    authorization: "enabled"     //for admin authentication

*Create New DB or Switch to Existing DB
> use local
*switched to local
*Create New User for Current db
db.createUser({user:"local",pwd:"password",roles:["readWrite","dbAdmin","dbOwner"]})
db.auth('local','password')
*Check the DB currently in use
> db
local
Drop Database : The given command helps the user to drop the required database.
> use local
*switched to db local
> db.dropDatabase()
  { "dropped" : "local", "ok" : 1 }
*Create Mongodb Backup
# mongodump --db databasename --host 127.0.0.1 --port 27017 --username admin --password userpasswd --authenticationDatabase admin
*Mongodb Restore command
# mongorestore --host 127.0.0.1 -d database_name --username username   /path/to/backupfile/
*Create mongodb Table Dump
# mongodump --db dbname --collection=table_name --out=data/ --host 127.0.0.1 --port 27017 --username admin --password password --authenticationDatabase admin
