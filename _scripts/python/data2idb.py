import urllib3
import requests
import urllib.request
from bs4 import BeautifulSoup
import datetime
import influxdb


def RecurseLinks(base):
    # Recursively crawl through all subdirectories on the base directory
    # if link/file ends with "txt", add its location to a list

    f = urllib.request.urlopen(base)
    soup = BeautifulSoup(f.read())
    for anchor in soup.find_all('a'):
        href = anchor.get('href')
        if (href.startswith('/')):
            pass
#             print ('skip, most likely the parent folder -> ' + href)
        elif (href.endswith('/')):
#             print ('crawl -> [' + base + href + ']')
            RecurseLinks(base + href) # make recursive call w/ the new base folder
        else:
            if href[-3:] == 'txt':
                files.append(base+href)
#             print ('some file, check if xyz.txt -> ' + href) # save it to a list or return 

def str_to_sec(timestr):
    # calculate time since epoch in seconds from the datetime string format given in text file.
    epoch0 = datetime.datetime(1970,1,1)
    dt = datetime.datetime.strptime(timestr,'%Y%m%d_%H%M%S')
    return str(int((dt - epoch0).total_seconds()))


# Root directory for Chlorinator Data
root = 'http://iwisfe.its.uiowa.edu/data/archival/SCN0001/'


host = 'HOSTNAME'
port = 8086
username = 'USERNAME'
password = 'PASSWORD'
database = 'DATABASE'

influx_client = influxdb.InfluxDBClient(host=host, port=port, database=database,username=username, password=password)


# call the initial root web folder
files =[]
RecurseLinks(root)

# Query IDB for last commit
results = influx_client.query('SELECT LAST(flow) FROM smart')

# Extract last time from return, format for file name comparison
last = results.raw['series'][0]['values'][0][0]
last = last.replace('-','').replace(':','').replace('Z','').replace('T','')
last = last[:8] + '_' + last[8:]

# Only add file strings that are newer than last idb commit
getFiles = []
for f in files:
    dt = f.split('/')[-1].split('.')[0].split('_')
    dt = dt[1] + '_' + dt[2]

    if dt > last:
        getFiles.append(f)
        

# Lines to commit to idb, in line protocol format.
lines = []
http = urllib3.PoolManager()
for file in getFiles:
    r = http.request('GET', file)
    sample = r.data.decode('ascii').split('\n')

    for line in sample[12:]:
        line = line.split(',')
        try:
            # This is the influxdb line protocol schema.
            # 'measure,<tag_key1>=<tag_value1>,... <field_name1>=<field_value1>... TIMESTAMP'
            insert = 'smart,sid={0} p="{1}",flow={2},ph={3},orp={4},orp_target={5},tablet={6},tank={7},valve={8},orp_warning={9} {10}'.format(
                sample[2].split(':')[1].strip(),
                line[1],line[2],line[3],
                line[4],line[5],line[6],
                line[7],line[8],line[9],
                str_to_sec(line[0])
            )
            lines.append(insert)
        except:
            # Do some qa/qc alert messaging here for real-time work.
            # Later.
            pass
        
# Send to IDB.
# Returns true.
influx_client.write_points(lines,protocol='line',time_precision='s')
