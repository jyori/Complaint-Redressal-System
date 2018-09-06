# Code for user module
import sys
import sqlite3
import settings
import time
import random
import json

dB = sqlite3.connect(settings.db)
cur = dB.cursor()

####code to register complaints####

def comp_reg():

# Obtain user details using session ID
    
    session = sys.argv[2]
    cpf_data = cur.execute('''SELECT cpf FROM sessions where sess_id = ?''',\
    	(session,))
    cpf = str(cpf_data.fetchone()[0])
    user_data = cur.execute('''SELECT department from users where cpf = ?''',\
    	(cpf,))
    from_department = user_data.fetchone()[0]

# Obtain information regarding the complaint

    to_department = sys.argv[3]
    i = 4
    content = ''
    while True:
    	try:
    		content += sys.argv[i]
    		content += ' '
    		i += 1
    	except:
    		break
    curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
    comp_id = from_department[0] + to_department[0] + str(random.randint(10000, 99999))

# Register complaint

    cur.execute('''INSERT into complaints (num, cpf, from_deptt, for_deptt,\
    	content, comp_time) VALUES (?,?,?,?,?,?)''', (comp_id, cpf, from_department,\
    		to_department, content, curr_time,))
    cur.execute('''INSERT into status (comp_num, created_on) VALUES (?,?)''',\
    	(comp_id, curr_time, ))
    
    dB.commit()
    print(1)

####code to enter user details####


def user_details():

# Obtain users details 

    session = sys.argv[2]
    cpf_data = cur.execute('''SELECT cpf FROM sessions where sess_id = ?''',\
    	(session,))
    cpf = str(cpf_data.fetchone()[0])

# input data
    fname=sys.argv[3]
    lname=sys.argv[4]
    user_email=sys.argv[5]
    contact=sys.argv[6]
    deptmnt=sys.argv[7]

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

#### code to check complaint status

def view_comp_status(cpf):
	#comp_num = sys.argv[2]
	#print (cpf)
	try:
		cur.execute('''SELECT num, for_deptt, content, comp_time, created_on, approved_on,\
			under_process_on, resolved_on FROM complaints, status where\
			complaints.num = status.comp_num and cpf = ?''', (cpf,))

		db_data = cur.fetchall()
		result = dict()
		n= 1
		s = ''
		for i in db_data:
			s = ''
			for k in i:
				s += str(k)
				s += '#'
			result[n] = s
			n = n+1
		result = json.dumps(result)
		return (result)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M:%S')
		error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

#### code to withdraw complaints

def withdraw_complaints(cpf):
	comp_num = sys.argv[3]
	try:
		#import pdb; pdb.set_trace()
		comp_cpf = cur.execute('''SELECT cpf FROM complaints where num = ?''',\
			(comp_num,))
		comp_cpf = comp_cpf.fetchone()[0]
		if(cpf == str(comp_cpf)):
			try:
				data = cur.execute('SELECT cpf, from_deptt, for_deptt, \
					content, approved_on, under_process_on, comp_time from\
					 complaints, status where comp_num = ?', (comp_num, ))
				data = data.fetchone()
				cpf = data[0]
				from_deptt = data[1]
				for_deptt = data[2]
				content = data[3]
				approved_on = data[4]
				under_process_on = data[5]
				comp_time = data[6]
				withdrawn_on = time.strftime('%Y-%m-%d %H:%M:%S')
				cur.execute('''INSERT INTO withdraw (num, cpf, from_deptt, for_deptt,\
					content, comp_time, approved_on, under_process_on,\
					 withdrawn_on) VALUES (?,?,?,?,?,?,?,?,?)''', (comp_num,\
					  cpf, from_deptt, for_deptt, content, comp_time,\
					   approved_on, under_process_on, withdrawn_on,))
				cur.execute('''DELETE FROM complaints where num = ?''', (comp_num,))
				cur.execute('''DELETE FROM status where comp_num = ?''', (comp_num,))
				dB.commit()
				return (1)
			except Exception as e:
				error_file = open(settings.error_log, 'a')
				curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
				error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
				str(e) + '\n'
				error_file.write(error_text)
				return (9)

		else:
			return (15)

	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return (4)

####code to view incoming complaints####


def  view_incoming_complaints(cpf):
	try:
		cur.execute('''SELECT num, cpf, from_deptt, content, created_on,\
		 under_process_on FROM complaints, status WHERE\
			complaints.num = status.comp_num and assigned_to=? ''',(cpf,))
		db_data = cur.fetchall()
		result = dict()
		n = 1
		s = ''
		for i in db_data:
			s = ''
			for k in i:
				s += str(k)
				s += '#'
			result[n] = s
			n = n+1
		result = json.dumps(result)
		return (result)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M:%S')
		error_text = curr_time + ' ' + str(cpf) + ' ' + 'user_module.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)



#entering user input
session = sys.argv[2]
cpf_data = cur.execute('''SELECT cpf FROM sessions where sess_id = ?''',\
	(session,))
cpf = str(cpf_data.fetchone()[0])
user_input = int(sys.argv[1])
if (user_input == 1):
	print (comp_reg())
elif (user_input == 2):
	print (user_details())
elif (user_input == 3):
	print(view_comp_status(cpf))
elif (user_input == 4):
	print (withdraw_complaints(cpf))
elif (user_input == 5):
	print(view_incoming_complaints(cpf))










