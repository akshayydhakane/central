Wordpress Setup On Ubuntu Server


Befor you have to setup LAMP-stack in your server then after install wordpress


Install wordpress

WordPress comes with a simple, intuitive and easy to use dashboard. The dashboard doesn’t require any knowledge in web programming languages like PHP, HTML5, and CSS3 and you can build a website with just a few clicks on a button.


# sudo apt update && apt upgrade



# cd /tmp && wget https://wordpress.org/latest.tar.gz



# tar -xvf latest.tar.gz



# cp -R wordpress /var/www/html/



# chown -R www-data:www-data /var/www/html/wordpress/



# chmod -R 755 /var/www/html/wordpress/



# mkdir /var/www/html/wordpress/wp-content/uploads



# chown -R www-data:www-data /var/www/html/wordpress/wp-content/uploads/




Open Wordpress using server ip


Open your browser and go to the server’s URL.Then after Deploy Wordpress Project on server



Clone Repository To Dev Server


Login To DreamHost And Create A Database

Website > Mysql Database > Create Database
Hostname : mysql.artoonsolutions.com



Back To Dev Server

Configure Database Credentials

# Vim wp-config.php



Add Command For Store A Git Credentials

# vim .git/config
    [credential]
        helper = store



Login To Server Game With Pals

Create A Deploy Link

# cd /var/www/all_projects



# cp -a amit_kakadiya [project-name]



Configuration of deploy link

Replace amit_kakadiya To (Project Name) and update git url in adminupdate.sh file
If you deplo project in different server so also you have to change server details


# vim admininfo.sh
# vim adminupdate.sh 
# vim adminreset.sh 



Update Project Name

Replace amit_kakadiya To (Project Name)


# nano index.html
