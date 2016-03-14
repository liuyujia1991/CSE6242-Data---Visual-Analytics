from pymongo import MongoClient
import pymongo

client = MongoClient()
db = client.users

recipes = {}
for recipe in db.recipes.find():
    recipes[recipe['id']] = [('', 0) for _ in range(5)]

for entry in db.similarities.find():
    recipeA = entry['recipe_A']
    recipeB = entry['recipe_B']
    similarity = entry['similarity']
    if recipeA in recipes and recipeB in recipes:
        i = 0
        while i < 5 and similarity < recipes[recipeA][i][1]:
            i += 1
        recipes[recipeA].insert(i, (recipeB, similarity))
        recipes[recipeA] = recipes[recipeA][:5]

        i = 0
        while i < 5 and similarity < recipes[recipeB][i][1]:
            i += 1
        recipes[recipeB].insert(i, (recipeA, similarity))
        recipes[recipeB] = recipes[recipeB][:5]

for recipeA in recipes:
    for recipeB, similarity in recipes[recipeA]:
        db.similarities_short.insert_one({'source': recipeA,
                                          'target': recipeB,
                                          'value': similarity})