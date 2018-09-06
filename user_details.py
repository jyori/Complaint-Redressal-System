#code for fetching users details


import sys
import sqlite3
import settings
import time

dB = sqlite3.connect(settings.db)
cur = dB.cursor()


# Obtain users details 
session = sys.argv[1]
cpf_data = cur.execute('''SELECT cpf FROM sessions where sess_id = ?''',\
 (session,))
cpf = str(cpf_data.fetchone()[0])
# input data
fname=sys.argv[2]
lname=sys.argv[3]
user_email=sys.argv[4]
contact=sys.argv[5]
deptmnt=sys.argv[6]

#inserting details in users table

try:
	cur.execute('''INSERT INTO users(cpf , first_name , surname,\
		email , contact ,department ) VALUES (?,?,?,?,?,?)''',(cpf,fname,lname,\
    	user_email,contact,deptmnt,))
	dB.commit()
	print(1)

except Exception as e:
	curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
	error_file = open(settings.error_log, 'a')
	error_text = curr_time + ' ' + str(cpf) + ' ' + 'user_details.py Error: ' + \
	str(e) + '\n'
	error_file.write(error_text)
	print (4)





