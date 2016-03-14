var mongodb = require('mongodb');

function test(callback) {
    var url = 'mongodb://localhost/users';
    mongodb.MongoClient.connect(url, function(err, db) {
        var cursor = db.collection('similarities_short').find({'source': 'Slow-Cooker-Chinese-Three-Cup-Chicken-1335215'})
                                                        .sort({'similarity': -1})
        
        var callbackChild = function (err, doc) {
            if (doc) {
                console.log(doc);
                cursor.nextObject(callbackChild);
            } else{
                callback("success");
                db.close();
            }
        }
        cursor.nextObject(callbackChild);
    });
}

test(console.log);