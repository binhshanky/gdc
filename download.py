import requests
import re
from pathlib import Path
Path("downloads").mkdir(parents=True, exist_ok=True)

url = "A"
s = open("url.txt", "r")

while(url != ""):


    url = s.readline()
    r = requests.get(url)
    if(r.status_code == 200):
        d = r.headers['content-disposition']
        fname = re.findall("filename=(.+)", d)[0]
        print(fname)
        with open('downloads/'+fname, 'wb') as f:
            f.write(r.content)
