import settings
import sqlite3


# Connecting the database

db = sqlite3.connect(settings.test_db)
cur = db.cursor()

# Extracting dept. abb. from table "abb" 

cur.execute('''SELECT deptt_id FROM abb''')
dept_list = cur.fetchall()
new_dept_list = []
s = ''
for t in dept_list:
		t = s.join(t)
		new_dept_list.append(t)

# Inserting all possible combinations
'''
for f_dept in new_dept_list:
	for t_dept in new_dept_list:
		cur.execute(''' INSERT INTO comp_count (from_deptt, to_deptt)\
		 VALUES (?,?) ''', (f_dept, t_dept,)) 
'''
db.commit()
