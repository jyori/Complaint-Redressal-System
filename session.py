# Create session on login
import random
import string
import sqlite3
import time
import sys
import settings



def id_generator(size=10, chars=string.ascii_uppercase + string.digits):
	return ''.join(random.choice(chars) for _ in range(size))

# Create session on log in

def log_in():
	cpf = sys.argv[2]
	#role = sys.argv[3]

	# Database

	dB = sqlite3.connect(settings.db)
	cur = dB.cursor()


	#Check for position of the user
	cur.execute('SELECT email from dheads WHERE cpf = ?', (cpf,))
	data = cur.fetchone()
	if (data):
		role = 2
	else:
		role = 1

	# Enter the login details into database

	sess_id = id_generator()
	log_in = time.strftime('%Y-%m-%d %H:%M:%S')
	cur.execute('''INSERT INTO sessions (sess_id, cpf, role, log_in, active)\
	 VALUES (?,?,?,?,?)''', (sess_id, cpf, role, log_in, 1))
	dB.commit()
	cur.execute('SELECT contact from users WHERE cpf = ?',(cpf,))
	data = cur.fetchone()
	if (data):
		val = 1
	else:
		val = 2
	ret_val = sess_id + '#' + str(val) + '#' + str(role)

	print(ret_val)

# Set session status on log out

def log_out():
	sess_id = sys.argv[2]
	dB = sqlite3.connect(settings.db)
	cur = dB.cursor()
	cur.execute('''UPDATE sessions SET active = ? WHERE sess_id = ?''', 
		(2, sess_id,))
	dB.commit()
	print(1)



function = sys.argv[1]

if (function == '1'):
	log_in()
else:
	log_out()
