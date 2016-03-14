import os
import csv
import json
from operator import itemgetter

with open('arsenal_players.csv') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	rows = list(reader)

for row in rows:
	row['APPEARANCES'] = int(row['APPEARANCES'])
sorted_rows = sorted(rows, key=itemgetter('APPEARANCES'), reverse=True)
for row in rows:
	row['APPEARANCES'] = str(row['APPEARANCES'])

with open('afc.json', 'w') as o:
	o.write('{\n"nodes":[\n')	
	for node in sorted_rows[:50]:
		o.write('{"name":"' + node["NAME"] + '","position":"' + node["POSITION"] + '","appearances":' + node["APPEARANCES"] + ',"goals":' + node["GOALS"] + '},\n')
	o.seek(-2, os.SEEK_END)
	o.truncate()
	o.write('\n],\n"links":[\n')

source = -1
for i in sorted_rows[:50]:
	source = source + 1
	target = source
	for j in sorted_rows[target+1:50]:
		target = target + 1
		if int(i["START_SEASON"]) > int(j["END_SEASON"]) or int(i["END_SEASON"]) < int(j["START_SEASON"]):
			continue
		else:
			value = min(int(j["END_SEASON"])-int(i["START_SEASON"]),int(i["END_SEASON"])-int(j["START_SEASON"])) + 1
			with open('afc.json', 'a') as o:
				o.write('\t{"source":' + str(source) + ',"target":' + str(target) + ',"value":' + str(value) + '},\n')

with open('afc.json', 'r+') as o:
	o.seek(-2, os.SEEK_END)
	o.truncate()
	o.write('\n]\n}')

