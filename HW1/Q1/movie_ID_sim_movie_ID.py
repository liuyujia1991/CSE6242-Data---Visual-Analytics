from urllib2 import Request, urlopen
import json
import time
import re
import sys

reload(sys)
sys.setdefaultencoding("utf-8")

headers = {
    'Accept': 'application/json'
}
pageNum = 1
movieNum = 1
text_file = open("movie_ID_sim_movie_ID.txt", "w")

while(movieNum < 301):
    response = urlopen(Request('http://api.themoviedb.org/3/search/movie?api_key=8c1afcaa3ae226e90aa8b19de84685d1&query=life&page=%d' %pageNum, headers=headers))
    response_body = json.load(response)
    movieList = response_body["results"]
    for movie in movieList:
        if "life" not in movie["title"] and "Life" not in movie["title"]: continue
        response_sim = urlopen(Request('http://api.themoviedb.org/3/movie/%d/similar?api_key=8c1afcaa3ae226e90aa8b19de84685d1' %movie["id"], headers=headers))        
        response_sim_body = json.load(response_sim)
        simList = response_sim_body["results"]
        simNum = 1
        for sim in simList:
            resultLine = "<%d, %d>\n" %(movie["id"], sim["id"])
            text_file.write(resultLine)
            simNum += 1
            if simNum == 6: break
        movieNum += 1
        if movieNum == 301: break
        time.sleep(0.25)
    pageNum += 1

text_file = open('movie_ID_sim_movie_ID.txt','r+')
arrayOfPair = text_file.read().split('\n')
del arrayOfPair[-1]
for pair in arrayOfPair:
    numPair = map(int, re.findall(r'\d+', pair))
    reversePair = '<%d, %d>' % (numPair[1],numPair[0])
    if reversePair in arrayOfPair and numPair[1] < numPair[0]:
        arrayOfPair.remove(pair)
    
text_file = open('movie_ID_sim_movie_ID.txt','w')
for pair in arrayOfPair:
    text_file.write(pair+'\n')

text_file.close()

