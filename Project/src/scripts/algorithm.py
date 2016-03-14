import pymongo

def getAllRecipes(db):
    recipes = []
    cursor = db.recipes.find()
    for recipe in cursor:
        recipes.append(recipe['id'])
    return recipes

def getFavorites(db):
    # TODO: favorites in the database
    return ['Slow-Cooker-Chinese-Three-Cup-Chicken-1335215',
            'Chinese-Barbecued-Pork-_Char-Siu_-622609',
            'Orange-Chicken-1327985',
            'Har-Gow-1324819',
            'Ground-Beef-Bulgogi-1286788',
            'PotStickers-1329410',
            'Shrimp-Wonton-Soup-1315067',
            'Sesame-Soba-Noodles-623025',
            'Quick-and-Easy-Bacon-Fried-Rice-1300204',
            'Asian-Burgers-with-Spicy-Coleslaw-1332436',
            'Creamy-Mushroom-Soup-1217212',
            'Quick-and-Easy-Egg-Drop-Soup-1019556',
            'Chicken-Pho-1036448',
            'Asian-Chicken-Noodle-Soup-1300938']

def getClusters(db):
    clusters = {}
    for clusL in db.clustering.find():
        clusters[clusL['recipe']] = clusL['cluster']
    return clusters

def getScores(db, recipes, favorites):
    scores = {}
    for recipe in recipes:
        scores[recipe] = 0

    for simL in db.similarities.find():
        recipeA = simL['recipe_A']
        recipeB = simL['recipe_B']
        similarity = simL['similarity']
        if recipeA in scores and recipeB in scores:
            if similarity > scores[recipeA] and recipeB in favorites:
                scores[recipeA] = similarity
            if similarity > scores[recipeB] and recipeA in favorites:
                scores[recipeB] = similarity
    return scores

def getRequirements(db):
    pass

def getNutrition(db, element, recipes):
    results = []
    for res in db.nutrition.find({'attribute': element,
                                  'recipeID': {'$in': recipes}}):
        results.append((res['recipeID'], res['value']))
    return results

def getPossibles(values, minSum, maxSum):
    possibles = []
    values.sort(key=lambda value: value[1])
    for i in range(len(values)):
        minSumTwo = minSum - values[i][1]
        maxSumTwo = maxSum - values[i][1]
        j = i+1
        k1 = k2 = len(values)-1
        while k2 > j:
            while values[j][1] + values[k2][1] > maxSumTwo and k2 > j:
                k2 -= 1
            for k in range(k1+1,k2+1):
                possibles.append((values[i][0], values[j][0], values[k][0]))
            k1 = min(k1, k2)
            while values[j][1] + values[k1][1] >= minSumTwo and k1 > j:
                possibles.append((values[i][0], values[j][0], values[k1][0]))
                k1 -= 1
            j += 1
            k1 = max(k1, j)
    return possibles

def suggestRecipes(db):
    recipes = getAllRecipes(db)

    favorites = getFavorites(db)
    scores = getScores(db, recipes, favorites)
    topRecipes = [recipe[0] for recipe in sorted(scores.iteritems(),
                                                 key=lambda x: x[1],
                                                 reverse=True)[:1000]]

    calories = getNutrition(db, 'ENERC_KCAL', topRecipes)
    # TODO: get actual calorie values from database and user info
    triples = getPossibles(calories, 1950, 2000)

    clusters = getClusters(db)
    dayScores = map(lambda x: (x, sum([scores[i] for i in x])), triples)
    dayScores.sort(key=lambda x: x[1], reverse=True)

    takenClusters = set([])
    weekRecipes = []
    i = 0
    while len(weekRecipes) < 7 and i < len(dayScores):
        candidate = dayScores[i][0]
        candidateClusters = map(lambda x: clusters[x] if x in clusters
                                                      else 0, candidate)
        if not takenClusters.intersection(candidateClusters):
            weekRecipes.append(candidate)
            takenClusters.update(candidateClusters)
        i += 1

    return weekRecipes

def main():
    # TODO: get userid
    client = pymongo.MongoClient()
    db = client.users
    suggestRecipes(db)


if __name__ == '__main__':
    main()
