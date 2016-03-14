import os
import csv
import json

with open('unhcr_persons_of_concern.csv','rU') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	rows = list(reader)
	for row in rows:
		del row['Internally displaced persons (IDPs)']
		del row['Others of concern']
		del row['Returned refugees']
		del row['Asylum-seekers (pending cases)']
		del row['Stateless persons']
		del row['Refugees (incl. refugee-like situations)']
		del row['Returned IDPs']
		row['Population'] = row.pop('Total Population')
		row['Source'] = row.pop('Origin')
		row['Target'] = row.pop('Country / territory of asylum/residence')


with open('poc.json', 'w') as o:
	o.write('{\n')	
	for year in range(2005,2015):
		o.write('"' + str(year) + '":[\n')
		source_list = []
		target_list = []
		for row in rows:
			if row['Year'] == str(year) and row['Population'] != "*":
				newrow  = row.copy()
				del newrow['Year']
				if newrow['Source'] == "Serbia and Kosovo (S/RES/1244 (1999))":
					newrow['Source'] = "Serbia and Kosovo"
				if newrow['Source'] == "Iran (Islamic Rep. of)":
					newrow['Source'] = "Iran"
				json_str = json.dumps(newrow)
				o.write('\t' + json_str + ',\n')
		o.seek(-2, os.SEEK_END)
		o.truncate()
		o.write('\n\t],\n')
	o.seek(-2, os.SEEK_END)
	o.truncate()
	o.write('\n}')