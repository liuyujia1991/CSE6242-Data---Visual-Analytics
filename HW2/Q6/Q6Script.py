import os
import csv
import json

months = ["January","February","March","April","May","June","July","August","September","October","November","December"]
countries = ["Austria","France","Germany","Italy","Netherlands","Sweden","Switzerland","Turkey"]

with open('Data.csv','rU') as csvfile:
	reader = csv.DictReader(csvfile, delimiter=',')
	rows = list(reader)
with open('Q6.json', 'w') as o:
	o.write('[\n')
	for country in countries:
		for i in range(12):	
			sum = 0	
			for row in rows:
				if row["Country"] == country and row["Year"] == "2013" and row["Month"] == months[i]:
					if row["Value"].isdigit(): 
						sum = sum + int(row["Value"]) 
			if i+1>=10:
				m = str(i+1)
			else:
				m = '0'+str(i+1)
			o.write('\t{"name": "' + country + '", "value": "' + str(sum) + '", "time": "' + m + '/13"},\n' )
	for country in countries:
		for i in range(12):	
			sum = 0	
			for row in rows:
				if row["Country"] == country and row["Year"] == "2014" and row["Month"] == months[i]:
					if row["Value"].isdigit(): 
						sum = sum + int(row["Value"]) 
			if i+1>=10:
				m = str(i+1)
			else:
				m = '0'+str(i+1)
			o.write('\t{"name": "' + country + '", "value": "' + str(sum) + '", "time": "' + m + '/14"},\n' )
	for country in countries:
		for i in range(6):	
			sum = 0	
			for row in rows:
				if row["Country"] == country and row["Year"] == "2015" and row["Month"] == months[i]:
					if row["Value"].isdigit(): 
						sum = sum + int(row["Value"]) 
			m = '0'+str(i+1)
			o.write('\t{"name": "' + country + '", "value": "' + str(sum) + '", "time": "' + m + '/15"},\n' )
	o.seek(-2, os.SEEK_END)
	o.truncate()
	o.write('\n]')