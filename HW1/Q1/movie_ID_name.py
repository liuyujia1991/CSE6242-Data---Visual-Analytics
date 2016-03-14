from urllib2 import Request, urlopen
import json
import sys

reload(sys)
sys.setdefaultencoding("utf-8")

headers = {
    'Accept': 'application/json'
}
pageNum = 1
movieNum = 1
text_file = open("movie_ID_name.txt", "w")

while movieNum < 301:
    response = urlopen(Request('http://api.themoviedb.org/3/search/movie?api_key=8c1afcaa3ae226e90aa8b19de84685d1&query=life&page=%d' %pageNum, headers=headers))
    response_body = json.load(response)
    movieList = response_body["results"]
    for movie in movieList:
        if "life" not in movie["title"] and "Life" not in movie["title"]: continue
        resultLine = "<%d, %s>\n" %(movie["id"], movie["title"])
        text_file.write(resultLine)
        movieNum += 1
        if movieNum == 301: break
    pageNum += 1

text_file.close()
