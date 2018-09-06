import sqlite3
import settings
import datetime
import subprocess

# Getting the date

date = datetime.datetime.now()
curr_date = date.strftime("%Y-%m-%d")
curr_time = date.strftime("%H:%M:%S")

# Making backup

script =  "sqlite3 " + settings.test_db +  " .dump >" + curr_date + ".bak"
create_backup = subprocess.Popen(script, shell = True) 

# Copying the backup
# Wait for subprocess to complete
create_backup.wait()

script2 = "copy " + curr_date + ".bak backups\ "
subprocess.Popen(script2, shell = True)

# Deleting redundant one
try:
	# Kill the subprocess first
	create_backup.kill()

	script3 = "del " + curr_date + ".bak"
	subprocess.Popen(script3, shell = True)

except Exception as e:
	error_file = open(settings.error_log, 'a')
	error_text = curr_time + ' ' + 'backup.py Error: ' + \
	str(e) + '\n'
	error_file.write(error_text)       

print("Backup made successfully!")