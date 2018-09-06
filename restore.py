import sqlite3
import subprocess

# Get the restore point

res_pt = raw_input("Enter the restore point date\n")

# Restoring

script = "cd backups & sqlite3 Restored_DB.db < "+ res_pt + ".bak"
restore = subprocess.Popen(script, shell = True)
restore.wait()
print("Database Restored successfully")
restore.kill()