# Department Head module code

import sqlite3
import sys
import json
import time
import settings



def view_outgoing_all(deptt):
	cur.execute('SELECT num, cpf, from_deptt, for_deptt, content, comp_time,\
	 approved_on, under_process_on, resolved_on from complaints, status where complaints.num = \
		status.comp_num and complaints.from_deptt = ?', (deptt,))
	db_data = cur.fetchall()
	result = dict()
	n = 1
	for i in db_data:
		s = ''
		for k in i:
			s += str(k)
			s += '#'
		result[n] = s
		n = n+1
	result = json.dumps(result)
	return (result)



def view_incoming(deptt):
	cur.execute('SELECT num, cpf, from_deptt, for_deptt, content, comp_time,\
	 approved_on, under_process_on, resolved_on, assigned_to from complaints, status where complaints.num =\
	 status.comp_num and complaints.for_deptt = ? and status.approved_on \
	 is NOT NULL', (deptt,))
	db_data = cur.fetchall()
	result = dict()
	n = 1
	for i in db_data:
		s = ''
		for k in i:
			s += str(k)
			s += '#'
		result[n] = s
		n = n+1
	result = json.dumps(result)
	return (result)


def approve(deptt):
	curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
	comp_num = sys.argv[3] 
	try:
		cur.execute('''SELECT from_deptt from complaints where num = ?''',\
		 (comp_num,))
		comp_deptt = cur.fetchone()[0]
		if (comp_deptt == deptt):
			cur.execute('''UPDATE status SET approved_on = ? WHERE comp_num \
				= ?''', (curr_time, comp_num,))
			dB.commit()
			return (2)		# Succesful updation
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

def view_outgoing_pending(deptt):
	cur.execute('SELECT num, cpf, from_deptt, for_deptt, content, comp_time,\
	 approved_on, under_process_on, resolved_on from complaints,\
	  status where complaints.num = status.comp_num and complaints.from_deptt\
	   = ? and status.approved_on IS NULL', (deptt,))
	db_data = cur.fetchall()
	result = dict()
	n = 1
	for i in db_data:
		s = ''
		for k in i:
			s += str(k)
			s += '#'
		result[n] = s
		n = n+1
	result = json.dumps(result)
	return (result)
	result = json.dumps(db_data)
	return (result)


def resolve(deptt):
	curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
	comp_num = sys.argv[3] 
	try:
		cur.execute('''SELECT for_deptt from complaints where num = ?''',\
		 (comp_num,))
		comp_deptt = cur.fetchone()[0]
		if (comp_deptt == deptt):
			cur.execute('''UPDATE status SET resolved_on = ? WHERE comp_num \
				= ?''', (curr_time, comp_num,))
			dB.commit()
			return (2)		# Succesful updation
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

def assign(deptt):
	comp_num = sys.argv[3]
	assign_cpf = sys.argv[4]
	try:
		cur.execute('''SELECT department from users where cpf = ?''',\
		 (assign_cpf,))
		assign_deptt = cur.fetchone()[0]
	except:
		return (9)
	if(assign_deptt == deptt):
		try:
			curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
			cur.execute('''UPDATE status SET assigned_to = ? WHERE comp_num \
				= ?''', (assign_cpf, comp_num,))
			dB.commit()
			cur.execute('''UPDATE status SET under_process_on = ? WHERE comp_num \
					= ?''', (curr_time, comp_num,))
			dB.commit()
			return (2)		# Succesful updation
		except Exception as e:
			error_file = open(settings.error_log, 'a')
			error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
			str(e) + '\n'
			error_file.write(error_text)
			return(4)
	else:
		return (7)



def not_approve(deptt, cpf):
	curr_time = time.strftime('%Y-%m-%d %H:%M:%S')
	comp_num = sys.argv[3] 
	try:
		cur.execute('''SELECT from_deptt, cpf from complaints where num = ?''',\
		 (comp_num,))
		data = cur.fetchone()
		comp_deptt = data[0]
		cpf_comp = data[1]
		if (comp_deptt == deptt):
			cur.execute('''DELETE from status WHERE comp_num \
				= ?''', (comp_num,))
			cur.execute('''DELETE from complaints WHERE num \
				= ?''', (comp_num,))
			dB.commit()
		record_file = open(settings.record_file, 'a')
		record_text = curr_time + " Department head of " + deptt + " with cpf " +\
		 str(cpf) + " removed the complaint with complaint number " + str(comp_num) + \
		 " of cpf number " + str(cpf_comp) + "\n"
		record_file.write(record_text)
		return (1)		# Succesful updation
	except Exception as e:
		print (e)
		error_file = open(settings.error_log, 'a')
		error_text = curr_time + ' ' + str(cpf) + ' ' + 'head.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)


# Initialize dB

dB = sqlite3.connect(settings.db)
cur = dB.cursor()
function = sys.argv[1]


# Look up CPF from session ID

try:
	sess_id = sys.argv[2]
	cpf_data =  cur.execute('SELECT cpf, role, active from sessions WHERE\
	 sess_id = ?', (sess_id,))
	cpf_data = cpf_data.fetchone()
	cpf = cpf_data[0]
	role = cpf_data[1]
	active = cpf_data[2]
	if ((role != 2) or (active != 1)):
		print (5)		# Unauthorized access
		exit()
except:
	print (5)
	exit()

deptt = cur.execute('SELECT department from dheads WHERE cpf = ?', (cpf, ))
deptt = deptt.fetchone()[0]
if (function == '1'):
	print (view_outgoing_all(deptt))
elif (function == '2'):
	print (view_incoming(deptt))
elif (function == '3'):
	print(approve(deptt))
elif (function == '4'):
	print (view_outgoing_pending(deptt))
elif (function == '5'):
	print (resolve(deptt))
elif (function == '6'):
	print (assign(deptt))
elif (function == '7'):
	print (not_approve(deptt, cpf))
