***************** Node.Js Setup With Multiple Version ************************
Node.js is a JavaScript runtime for server-side programming. It allows developers to create scalable backend functionality using JavaScript, a language many are already familiar with from browser-based web development
+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


*Installing Node.js
# sudo apt update  
# sudo apt install nodejs  
# sudo apt install npm
*checking node version
# node -v
*Installing Node Version Manager NVM
# curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh
# curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | bash
# source ~/.bashrc
*list all node version
# nvm list-remote
*Now you can install any of this node version using this command
# nvm install v16.13.1
*You can see all installed node version using
# nvm list
*Now you installed so many version of node then you have to switch to different version then
# nvm use v14.10.0
