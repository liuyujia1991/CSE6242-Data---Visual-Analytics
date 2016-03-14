var mongodb = require('mongodb');

function getGraphFromDB(db, startRecipeID, maxLevel, callback) {
    var queue = [startRecipeID, null];
    var expandedSet = {};
    var nodeSet = {};
    var edges = [];
    var level = 0;

    function convert(nodeSet, edges) {
        var nodes = [];
        var i = 0;
        for (node in nodeSet) {
            nodes.push({'name': node, 'score': nodeSet[node]});
            nodeSet[node] = i;
            i++;
        }
        var edges = edges.map(function (edge) {
            return {
                'source': nodeSet[edge['source']],
                'target': nodeSet[edge['target']],
                'value': edge['value']
            };
        });
        return [nodes, edges];
    }

    function addChildren(recipeID) {
        var cursor = db.collection('similarities_short').find({'source': recipeID})
        function childCallback(err, doc) {
            if (doc) {
                nodeSet[doc['target']] = 0;
                edges.push(doc);
                if (!(doc['target'] in expandedSet)) {
                    queue.push(doc['target']);
                }
                cursor.nextObject(childCallback);
            } else {
                processQueue();
            }
        }
        cursor.nextObject(childCallback);
    }

    function processQueue() {
        var current = queue.shift();

        if (current == null) {
            if (level < maxLevel) {
                level++;
                queue.push(null);
                processQueue();
            } else {
                var graph = convert(nodeSet, edges);
                callback(graph[0], graph[1]);
            }
        } else {
            expandedSet[current] = true;
            addChildren(current);
        }
    }

    nodeSet[startRecipeID] = 0;
    processQueue();
}

function getGraph(recipeID, levels, callback) {
    var url = 'mongodb://localhost/users';
    mongodb.MongoClient.connect(url, function(err, db) {
        getGraphFromDB(db, recipeID, levels, function (nodes, edges) {
            db.close();
            callback({'nodes': nodes, 'edges': edges});
        });
    });
}

exports.getGraph = getGraph;

// getGraph('Slow-Cooker-Chinese-Three-Cup-Chicken-1335215', 3, console.log)