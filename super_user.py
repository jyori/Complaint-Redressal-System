import sys
import sqlite3
import settings
import sqlite3
import json
import time 

dB = sqlite3.connect(settings.db)
cur = dB.cursor()


# code to remove user


def rem_user():
	cpf = sys.argv[2]
	
	try:
		cur.execute('''DELETE from users where cpf=?''', (cpf,))
		dB.commit()
		print ("Total number of rows deleted : ", dB.total_changes)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

# code to remove complaints using id

def rem_complaint_id():
	comp_id = sys.argv[2]
	try:
		cur.execute('''DELETE from complaints where id=?''', (comp_id,))
		dB.commit()
		#print(1)
		print("Total number of rows deleted :", dB.total_changes)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

# code to remove complaints using cpf

def rem_complaint_cpf():
	cpf_no = sys.argv[2]
	try:
		cur.execute('''DELETE from complaints where cpf=?''', (cpf_no,))
		dB.commit()
		print ("Total number of rows deleted :", dB.total_changes)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

# code to view complaint

def view_complaint():
	
	comp_num = sys.argv[3]
	try:
		cur.execute('''SELECT comp_num, cpf, from_deptt, for_deptt, content, comp_time,\
			created_on, approved_on, under_process_on, resolved_on\
			FROM complaints, status where complaints.num= status.comp_num and\
			comp_num= ?''',(comp_num,))
		db_data = cur.fetchall()
		result = dict()
		n= 1
		s = ''
		for i in db_data:
			for k in i:
				s += str(k)
				s += '#'
			result[n] = s
			n = n+1
		result = json.dumps(result)
		return (result)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)


# code to view complaint and its status using cpf

def view_complaint_status():
    cpf= sys.argv[3]
    n=1
    result = dict()
    try:
    	#import pdb; pdb.set_trace()
    	cur.execute('''SELECT num FROM complaints where cpf=?''',\
    		(cpf,))
    	fetch_num= cur.fetchall()
    	for p in fetch_num:
    		cur.execute('''SELECT comp_num, cpf, from_deptt, for_deptt, content, comp_time,\
			created_on, approved_on, under_process_on, resolved_on\
			FROM complaints, status where complaints.num= status.comp_num and\
			comp_num= ?''',(p[0],))
    		db_data = cur.fetchone()
    		s = '' 
    		for i in db_data:
    			s += str(i)
    			s += '#'
    		result[n] = s
    		n = n+1
    	result = json.dumps(result)
    	return (result)
    except Exception as e:
    	error_file = open(settings.error_log, 'a')
    	curr_time= time.strftime('%Y-%m-%d %H:%M;%S')
    	error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' +\
    	str(e) + '\n'
    	error_file.write(error_text)
    	return(4)
# view complaints for department 

def comp_for_department():
	for_dept= sys.argv[3]
	#import pdb;pdb.set_trace()
	try:
	 	cur.execute('''SELECT comp_num, cpf, from_deptt, for_deptt, content, comp_time,\
			created_on, approved_on, under_process_on, resolved_on\
			 FROM complaints join status on complaints.num=\
			status.comp_num and for_deptt =?''', (for_dept,))
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
	 	result =json.dumps(result)
	 	return (result)
	except Exception as e:
	 	error_file= open(settings.error_log, 'a')
	 	curr_time= time.strftime('%Y-%m-%d %H:%M;%S')
	 	error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
	 	str(e) + '\n'
	 	error_file.write(error_text)
	 	return(4)

#view complaints from department

def comp_from_department():
	from_dept= sys.argv[3]
	try:
		cur.execute('''SELECT comp_num, cpf, from_deptt, for_deptt, content, comp_time,\
			created_on, approved_on, under_process_on, resolved_on\
			 FROM complaints join status on complaints.num=\
			status.comp_num and from_deptt =?''',\
	 		(from_dept,))
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
	 	result =json.dumps(result)
	 	return (result)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)

# view complaint from department for department

def comp_from_for_department():
	from_dept= sys.argv[2]
	for_dept= sys.argv[3]
	try:
		cur.execute('''SELECT cpf, content, created_on, approved_on, under_process_on,\
			resolved_on from complaints, status where complaints.num = status.comp_num and\
			complaints.from_deptt = ? and complaints.for_deptt = ?''', (from_dept, for_dept,))
		db_data = cur.fetchall()
		#print(db_data)
		result = dict()
		n = 1
		s = ''
		for i in db_data:
		    for k in i:
		    	s += str(k)
		    	s += '#'
		    result[n] = s
		    n = n+1
		result = json.dumps(result)
		return (result)
	except Exception as e:
		error_file = open(settings.error_log, 'a')
		curr_time=time.strftime('%Y-%m-%d %H:%M;%S')
		error_text = curr_time + ' ' + "super"+ ' ' + 'super_user.py Error: ' + \
		str(e) + '\n'
		error_file.write(error_text)
		return(4)



#Authentication

sess_id = sys.argv[2]




#entering user input

user_input = int(sys.argv[1])
if (user_input==1):
	ret_user_input = rem_user()
elif(user_input==2):
	ret_user_input = rem_complaint_id()
elif(user_input==3):
    ret_user_input = rem_complaint_cpf()
elif(user_input==4):
	print((view_complaint()))
elif(user_input==5):
	print((view_complaint_status()))
elif(user_input==6):
	print((comp_for_department()))
elif(user_input==7):
	print((comp_from_department()))
else:
	print((comp_from_for_department()))