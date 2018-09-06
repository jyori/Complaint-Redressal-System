# Code for creation of a new complaint

import sys
import sqlite3
import settings
import time
import random

dB = sqlite3.connect(settings.test_db)
cur = dB.cursor()

# Obtain user details using session ID

session = sys.argv[1]
cpf_data = cur.execute('''SELECT cpf FROM sessions where sess_id = ?''',\
 (session,))
cpf = str(cpf_data.fetchone()[0])
user_data = cur.execute('''SELECT department from users where cpf = ?''',\
 (cpf,))
from_department = user_data.fetchone()[0]

# Obtain infromation regarding the complaint

to_department = sys.argv[2]
i = 3
content = ''
while True:
	try:
		content += sys.argv[i]
		content += ' '
		i += 1
	except:
		break
curr_time = time.strftime('%Y-%m-%d %H:%M:%S')

# Counter for complaints

counter_now = cur.execute(''' SELECT counter FROM comp_count WHERE from_deptt = ? AND \
to_deptt = ? ''', (from_department, to_department))
counter_now = int(counter_now.fetchone()[0]) + 1 

cur.execute(''' UPDATE comp_count SET counter = counter + 1 WHERE from_deptt = ? AND \
to_deptt = ? ''', (from_department, to_department))

# Complaint Number

comp_id = from_department + to_department + '{0}'.format(str(counter_now).zfill(5))

# Register complaint

cur.execute('''INSERT into complaints (num, cpf, from_deptt, for_deptt,\
 content, comp_time) VALUES (?,?,?,?,?,?)''', (comp_id, cpf, from_department,\
  to_department, content, curr_time,))

cur.execute('''INSERT into status (comp_num, created_on) VALUES (?,?)''',\
 (comp_id, curr_time, ))


dB.commit()

print(1)