import csv
import math
import itertools
from collections import Counter

ingredientLines = None
with open('../CSVs/cleaned_ingredients.csv', 'r') as f:
    reader = csv.reader(f)
    ingredientLines = list(reader)

recipes = set([line[0] for line in ingredientLines])
recipeIngredients = {}
for recipe in recipes:
    recipeIngredients[recipe] = set([])
for line in ingredientLines:
    recipeIngredients[line[0]].add(line[3])

ingredients = Counter([line[3] for line in ingredientLines])
uniqueIngredients = [k for k, v in ingredients.iteritems() if v > 1]

ingredientBooleans = {}
for recipe in recipes:
    vector = [1 if ingredient in recipeIngredients[recipe] else 0 \
                    for ingredient in uniqueIngredients]
    if sum(vector) > 0:
        ingredientBooleans[recipe] = vector
vectorMagnitudes = {}
for recipe in ingredientBooleans:
    vector = ingredientBooleans[recipe]
    # skip squaring because all booleans
    vectorMagnitudes[recipe] = math.sqrt(sum(vector))

with open('../CSVs/cosine_similarities.csv', 'wb') as f:
    writer = csv.writer(f)
    writer.writerow(['recipe_A', 'recipe_B', 'similarity'])
    # for recipeA, recipeB in list(itertools.combinations(ingredientBooleans, 2))[:10000]:
    boolRecipes = list(ingredientBooleans)
    for i, recipeA in enumerate(boolRecipes):
        for recipeB in boolRecipes[i+1:]:
            vectorA = ingredientBooleans[recipeA]
            vectorB = ingredientBooleans[recipeB]
            similarity = sum([a * b for a, b in zip(vectorA, vectorB)])
            similarity /= vectorMagnitudes[recipeA] * vectorMagnitudes[recipeB]
            writer.writerow([recipeA, recipeB, similarity])
