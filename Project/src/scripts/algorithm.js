var mongodb = require('mongodb');

function getPossibles(values, minSum, maxSum) {
    var possibles = [];
    values.sort(function(a, b) { return a[1] - b[1]; });
    for (i = 0; i < values.length; i++) {
        var minSumTwo = minSum - values[i][1];
        var maxSumTwo = maxSum - values[i][1];
        var j = i + 1;
        var k1 = values.length - 1; 
        var k2 = values.length - 1;
        while (k2 > j) {
            while (values[j][1] + values[k2][1] > maxSumTwo && k2 > j) {
                k2--;
            }
            for (k = k1 + 1; k < k2 + 1; k++) {
                possibles.push([values[i][0], values[j][0], values[k][0]]);
            }
            k1 = Math.min(k1, k2);
            while (values[j][1] + values[k1][1] >= minSumTwo && k1 > j) {
                possibles.push([values[i][0], values[j][0], values[k1][0]]);
                k1--;
            };
            j++;
            k1 = Math.max(k1, j);
        }
    }
    return possibles;
}

function getAllRecipes(db, callback) {
    var recipes = [];
    var cursor = db.collection('recipes').find();
    cursor.forEach(function (doc) {
        recipes.push(doc['id']);
    }, function (err) {
        callback(recipes);
    });
}

function getFavorites(db, userID, callback) {
    var favorites = [];
    var cursor = db.collection('favourite').find({'userID': userID});
    cursor.forEach(function (doc) {
        favorites.push(doc['recipeID']);
    }, function (err) {
        callback(favorites);
    });
}

function getClusters(db, callback) {
    var clusters = {};
    var cursor = db.collection('clustering').find();
    cursor.forEach(function (doc) {
        clusters[doc['recipe']] = doc['cluster'];
    }, function (err) {
        callback(clusters);
    });
}

function getScores(db, recipes, favorites, callback) {
    var scores = {};
    for (i in recipes) {
        scores[recipes[i]] = 0;
    }
    // var favoritesSet = new Set(favorites);
    var favoritesSet = {};
    for (i in favorites) {
        favoritesSet[favorites[i]] = true;
    }

    var cursor = db.collection('similarities').find();
    cursor.forEach(function (doc) {
        recipeA = doc['recipe_A'];
        recipeB = doc['recipe_B'];
        similarity = doc['similarity'];
        if (recipeA in scores && recipeB in scores) {
            // if (similarity > scores[recipeA] && favoritesSet.has(recipeB)) {
            if (similarity > scores[recipeA] && recipeB in favoritesSet) {
                scores[recipeA] = similarity;
            }
            // if (similarity > scores[recipeB] && favoritesSet.has(recipeA)) {
            if (similarity > scores[recipeB] && recipeA in favoritesSet) {
                scores[recipeB] = similarity;
            }
        }
    }, function (err) {
        callback(scores);
    });
}

function getNutrition(db, element, recipes, callback) {
    var cursor = db.collection('nutrition').find({
                                     'attribute': element,
                                     'recipeID': {'$in': recipes}})
    results = [];
    cursor.forEach(function (doc) {
        results.push([doc['recipeID'], doc['value']]);
    }, function (err) {
        callback(results);
    });
}

function suggestRecipes(db, userID, numSuggestions, callback) {
    getAllRecipes(db, function (recipes) {
        getFavorites(db, userID, function (favorites) {
            getScores(db, recipes, favorites, function(scores) {
                recipes.sort(function(a, b) { return scores[b]-scores[a]; });
                var topRecipes = recipes.slice(0,1000);
                getNutrition(db, 'ENERC_KCAL', topRecipes, function (calories) {
                    // TODO: get actual calorie cutoffs form database and user info
                    var triples = getPossibles(calories, 1950, 2000);
                    getClusters(db, function (clusters) {
                        var dayScores = triples.map(function (x) {
                            var sum = x.map(function (r) {
                                return scores[r];
                            }).reduce(function (a,b) {
                                return a + b;
                            });
                            return [x, sum];
                        });
                        dayScores.sort(function (a,b) {
                            return b[1] - a[1];
                        });

                        // var takenClusters = new Set();
                        var takenClusters = {};
                        var weekRecipes = [];
                        var i = 0;
                        while (weekRecipes.length < numSuggestions && i < dayScores.length) {
                            var candidate = dayScores[i][0];
                            var candidateClusters = candidate.map(function (x) {
                                return clusters[x];
                            });

                            var duplicateExists = false;
                            candidateClusters.sort();
                            for (j = 1; j < candidateClusters.length; j++) {
                                if (candidateClusters[j] == candidateClusters[j-1]) {
                                    duplicateExists = true;
                                }
                            }

                            if (!duplicateExists) {
                                if (!candidateClusters.some(function (x) {
                                    return x in takenClusters;
                                })) {
                                    weekRecipes.push(candidate);
                                    for (j in candidateClusters) {
                                        takenClusters[candidateClusters[j]] = true;
                                    }
                                }
                            }
                            i++;
                        }

                        callback(weekRecipes);
                    });
                });
            });
        });
    });
}

function getRecipeSuggestions(userID, numSuggestions, callback) {
    var url = 'mongodb://localhost/users';
    mongodb.MongoClient.connect(url, function(err, db) {
        suggestRecipes(db, userID, numSuggestions, function (suggestions) {
            db.close();
            callback(suggestions);
        });
    });
}

exports.getPossibles = getPossibles;
exports.getAllRecipes = getAllRecipes;
exports.getFavorites = getFavorites;
exports.getClusters = getClusters;
exports.getScores = getScores;
exports.getNutrition = getNutrition;
exports.suggestRecipes = suggestRecipes;
exports.getRecipeSuggestions = getRecipeSuggestions;

// getRecipeSuggestions(console.log);

