import geocoder
import time
from time import strftime, gmtime
import requests
while True:
    g = geocoder.ip('me')
    t = strftime("%Y-%m-%d %H:%M:%S", gmtime())
    arg = g.latlng;
    url = 'https://forgd.me/lc.php?n='+str(arg[0])+'&e='+str(arg[1])+'&lt='+t    
    r = requests.get(url)
    if('Success' in str(r.content)):
        print('[{}] Send success. {}'.format(t,g.latlng))
    else:
        print('Connect Corrupt. [{}]'.format(url),r.content)
    
    time.sleep(1)
