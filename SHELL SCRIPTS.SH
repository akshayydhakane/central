SHELL SCRIPTS:

######  BACKUP SCRIPT  ########

#!/bin/bash

# Source directory to be backed up
source_dir="/home/user/Documents""

# Destination directory for backups
backup_dir="/home/backup"

# Create a timestamp to append to the backup folder name (e.g., "backup_2023-09-27_14-30-00")
timestamp=$(date +"%Y-%m-%d_%H-%M-%S")

# Create the backup folder with the timestamp
backup_folder="$backup_dir/backup_$timestamp"

# Create the backup using the 'rsync' command (can be replaced with 'cp' for a simple copy)
rsync -a "$source_dir/" "$backup_folder"

# Check if the backup was successful
if [ $? -eq 0 ]; then
  echo "Backup completed successfully to $backup_folder"
else
  echo "Backup failed."
fi

###########   File Cleanup: Remove old or unnecessary files and directories.   ###################


#!/bin/bash

# Directory to clean up
cleanup_dir="/home/user/Documents"

# Number of days to retain files/directories (adjust as needed)
retain_days=7

# Current timestamp in seconds since epoch
current_time=$(date +%s)

# Iterate through files and directories in the cleanup directory
for item in "$cleanup_dir"/*; do
  # Check if the item is a directory
  if [ -d "$item" ]; then
    # Get the item's modification time in seconds since epoch
    item_mtime=$(date -r "$item" +%s)
    # Calculate the age of the item in days
    age_days=$(( (current_time - item_mtime) / 86400 ))

    # Remove the item if it's older than the specified retention period
    if [ "$age_days" -gt "$retain_days" ]; then
      echo "Removing old directory: $item"
      rm -rf "$item"
    fi
  fi
done

# Print a summary message
echo "Cleanup completed."


###########     File Synchronization: Synchronize files between different directories or systems.   ##########

#!/bin/bash

# Source directory (the directory you want to sync from)
source_dir="/home/user/Documents"

# Destination directory (the directory you want to sync to)
destination_dir="/home/backup"

# Rsync options (customize as needed)
rsync_options="-av --delete"

# Synchronize the directories using rsync
rsync $rsync_options "$source_dir/" "$destination_dir/"

# Check if the rsync command was successful
if [ $? -eq 0 ]; then
  echo "Synchronization completed successfully."
else
  echo "Synchronization failed."
fi


################    Log Rotation: Rotate and manage log files to prevent them from consuming too much disk space.   ############

#!/bin/bash

# Log file to rotate
log_file="/var/log/myapp.log"

# Log rotation configuration file (you can customize this as needed)
config_file="/etc/logrotate.d/myapp"

# Check if the log file exists
if [ -f "$log_file" ]; then
  # Perform log rotation using logrotate
  logrotate -v "$config_file"

  # Check if log rotation was successful
  if [ $? -eq 0 ]; then
    echo "Log rotation completed successfully."
  else
    echo "Log rotation failed."
  fi
else
  echo "Log file does not exist: $log_file"
fi


################      write shell script for Package Updates: Automate the process of checking for and installing software updates. explain with example    ######################

#!/bin/bash

# Update package information
sudo apt update

# Check for available package updates
updates=$(sudo apt list --upgradable | grep -cE '\[upgradable')

# Check if updates are available
if [ "$updates" -gt 0 ]; then
  # Perform package upgrade
  sudo apt upgrade -y

  # Check if the upgrade was successful
  if [ $? -eq 0 ]; then
    echo "Package upgrade completed successfully."
  else
    echo "Package upgrade failed."
  fi
else
  echo "No package updates available."
fi




#################################################

# Create the script (e.g., update_packages.sh) and make it executable with chmod +x update_packages.sh

# Run the script to check for and install updates
./update_packages.sh


################################################

# Edit the crontab for the current user
crontab -e

# Add the following line to run the script daily at a specific time (e.g., 3 AM)
0 3 * * * /path/to/update_packages.sh


###########   System Monitoring: Create scripts to monitor system resources (CPU, memory, disk space) and send alerts when thresholds are exceeded.    ###############


#!/bin/bash

# Thresholds for CPU usage, memory usage, and disk space (adjust as needed)
cpu_threshold=90      # CPU usage percentage
mem_threshold=90      # Memory usage percentage
disk_threshold=90     # Disk space usage percentage

# Email settings
email_recipient="akshay.private009@email.com"
email_subject="System Alert: Resource Threshold Exceeded"
email_message="Resource threshold exceeded on $(hostname)"

# Check CPU usage
cpu_usage=$(top -b -n1 | grep "Cpu(s)" | awk '{print $2}' | cut -d. -f1)

# Check memory usage
mem_usage=$(free | grep Mem | awk '{print $3/$2 * 100}' | cut -d. -f1)

# Check disk space usage
disk_usage=$(df -h / | tail -n 1 | awk '{print $5}' | cut -d% -f1)

# Function to send email alert
send_email_alert() {
  echo "$email_message" | mail -s "$email_subject" "$email_recipient"
  echo "Alert sent to $email_recipient"
}

# Check and send alerts if thresholds are exceeded
if [ "$cpu_usage" -gt "$cpu_threshold" ]; then
  echo "CPU usage exceeds threshold ($cpu_threshold%)"
  send_email_alert
fi

if [ "$mem_usage" -gt "$mem_threshold" ]; then
  echo "Memory usage exceeds threshold ($mem_threshold%)"
  send_email_alert
fi

if [ "$disk_usage" -gt "$disk_threshold" ]; then
  echo "Disk space usage exceeds threshold ($disk_threshold%)"
  send_email_alert
fi


#######################################################################################


##########################    
daily uses of shell scripting

##########################



Shell scripting is a powerful tool for automating tasks and performing various operations on a Unix-like or Linux system. Here are some common daily uses of shell scripting:

1. **File and Directory Operations:**
   - **File Backup:** Automate the process of creating backups of important files or directories.
   - **File Cleanup:** Remove old or unnecessary files and directories.
   - **File Synchronization:** Synchronize files between different directories or systems.

2. **System Maintenance:**
   - **Log Rotation:** Rotate and manage log files to prevent them from consuming too much disk space.
   - **Package Updates:** Automate the process of checking for and installing software updates.
   - **System Monitoring:** Create scripts to monitor system resources (CPU, memory, disk space) and send alerts when thresholds are exceeded.

3. **Data Processing:**
   - **Data Extraction:** Write scripts to extract and format data from various sources (e.g., log files, databases, web services).
   - **Data Transformation:** Transform data from one format to another (e.g., CSV to JSON).
   - **Data Cleaning:** Remove or modify data based on specific criteria.

4. **Automation of Repetitive Tasks:**
   - **Scheduled Jobs:** Use cron jobs to automate tasks that need to run at specific times or intervals.
   - **Batch Processing:** Process a large number of files or tasks in a batch mode.

5. **User and Account Management:**
   - **User Provisioning:** Automate the creation of user accounts and assign permissions.
   - **Password Management:** Enforce password policies and automate password changes.

6. **Network and Server Management:**
   - **Remote Server Administration:** Write scripts to automate tasks on remote servers via SSH.
   - **Firewall Configuration:** Automate firewall rule management.

7. **Data Backup and Recovery:**
   - **Data Backup:** Automate data backup tasks to ensure data integrity.
   - **Data Restoration:** Create scripts to restore data from backups.

8. **Security and Access Control:**
   - **User Access Control:** Monitor and control user access to sensitive resources.
   - **Security Scanning:** Automate security scans and vulnerability assessments.

9. **Notification and Reporting:**
   - **Alerts and Notifications:** Send alerts and notifications via email, SMS, or other channels.
   - **Report Generation:** Generate and distribute reports automatically.

10. **Custom Tools and Utilities:**
    - **Custom Commands:** Create custom shell commands or utilities to simplify complex tasks.
    - **Workflow Automation:** Combine multiple commands into a single script for streamlined workflows.

11. **Web Scraping and API Interaction:**
    - **Web Scraping:** Write scripts to extract data from websites.
    - **API Integration:** Automate interactions with web APIs for data retrieval or integration with other services.

12. **Data Archiving:**
    - **Data Archiving:** Archive and compress files or directories to save disk space.

13. **Error Handling and Logging:**
    - **Error Handling:** Implement error handling and logging to track script execution and troubleshoot issues.

Shell scripting is a versatile tool, and its applications can vary widely depending on the specific needs of the user or organization. It can save time, reduce human error, and ensure that routine tasks are performed consistently and reliably.
