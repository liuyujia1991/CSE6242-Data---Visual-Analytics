// BASE SETUP

// =============================================================================

// call the packages we need
var express    = require('express');
var app        = express();
var bodyParser = require('body-parser');
var mongojs    = require('mongojs');

var algorithm  = require('./scripts/algorithm.js')
var graph_similarities = require('./scripts/graph_similarities.js')

// configure app to use bodyParser()
// this will let us get the data from a POST
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());


var port = process.env.PORT || 8080;        // set our port

// ROUTES FOR OUR API
// =============================================================================
var router = express.Router();              // get an instance of the express Router
router.use(function(req, res, next) {
    // do logging
    console.log('router is on');
    next(); // make sure we go to the next routes and don't stop here
});
// test route to make sure everything is working (accessed at GET http://localhost:8080/api)
router.get('/', function(req, res) {
    res.json({ message: 'hooray! welcome to our api!' });   
});

db = mongojs('users');

router.route('/users')
      .get(function(req, res) {
         db.collection('users').find({}, function(err, item) {
           res.send(item);
         });
      });

router.route('/user')
      .get(function(req, res) {
         var name = req.query.name;
         var password = req.query.password;
         db.collection('users').find({'name' : name, 'password':password}, function(err, item) {
           res.send(item);
         });
      })
      .post(function(req, res) {
         var name = req.query.name;
         var password = req.query.password;
         db.collection('users').insert({'name' : name, 'password':password}, function(err, item) {
           if (err)
             res.send({"error" : "An error occured"});
           else
             res.send(item);
         })
      })

      .put(function(req,res){
         var id = req.query.id;
         var age = req.query.age;
         var weight = req.query.weight;
         var height = req.query.height;
         var gender = req.query.gender;
         var looking_for = req.query.looking_for;
         var budget_pref = req.query.budget_pref;
         var dietary_pref = req.query.dietary_pref;
         ObjectID = require('mongodb').ObjectID;
         
         if (age != null)
           db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'age':age}},{safe:true}, function(err, result) {
           if (err) 
             res.send({'error':'An error has occurred'});
           else 
             res.send(result);
        });
        
         if (weight != null)
           db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'weight':weight,}},{safe:true}, function(err, result) {
           if (err)
             res.send({'error':'An error has occurred'});
           else 
             res.send(result);
        });
    
         if (height != null)
           db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'height':height,}},{safe:true}, function(err, result) {
           if (err)
             res.send({'error':'An error has occurred'});
           else
             res.send(result);
        });

        if (gender != null)
           db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'gender':gender,}},{safe:true}, function(err, result) {
           if (err)
             res.send({'error':'An error has occurred'});
           else
             res.send(result);
        });

        if (looking_for != null)       
          db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'looking_for' : looking_for}},{safe:true}, function(err, result) {
           if (err)
             res.send({'error':'An error has occurred'});
           else 
             res.send(result);
        });
       
       if (budget_pref != null) 
          db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'budget_pref' : budget_pref}},{safe:true}, function(err, result) {
           if (err) 
             res.send({'error':'An error has occurred'});
           else 
             res.send("success updating preferences");
        });
       if (dietary_pref != null) 
          db.collection('users').update({'_id':new ObjectID(id)}, {$set:{'dietary_pref' : dietary_pref}},{safe:true}, function(err, result) {
           if (err) 
             res.send({'error':'An error has occurred'});
           else 
             res.send(result);
        });
      })
      
      .delete(function(req, res){
         var id = req.query.id;
         ObjectID = require('mongodb').ObjectID;
         db.collection('users').remove({'_id':new ObjectID(id)},{safe:true}, function(err, result) {
           if (err) {
             res.send({'error':'An error has occurred'});
           } 
           else {
             res.send(result);
           }
        });
      });

router.route('/favourite')
      .get(function(req, res) {
         var userID = req.query.userID;
         db.collection('favourite').find({'userID': userID}, function(err, item) {
           res.send(item);
         });
      })

      .post(function(req, res) {
         var userID = req.query.userID;
         var recipeID = req.query.recipeID;
         db.collection('favourite').insert({'userID' : userID, 'recipeID':recipeID}, function(err, item) {
           if (err)
             res.send({"error" : "An error occured"});
           else
             res.send(item);
         })
      })

      .delete(function(req, res){
         var userID = req.query.userID;
         var recipeID = req.query.recipeID;
         ObjectID = require('mongodb').ObjectID;
         db.collection('favourite').remove({'userID': userID, 'recipeID':recipeID},{safe:true}, function(err, result) {
           if (err) 
             res.send({'error':'An error has occurred'});
           else 
             res.send(result);
        });
      });

router.route('/courses')
      .get(function(req, res) {
         var recipeID = req.query.recipeID;
         db.collection('courses').find({'recipeID': recipeID}, function(err, item) {
           res.send(item);
         });
      });

router.route('/cuisines')                                      
      .get(function(req, res) {                               
         var recipeID = req.query.recipeID;                   
         db.collection('cuisines').find({'recipeID': recipeID}, function(err, item) {
           res.send(item);                                    
         });                                                  
      });

router.route('/nutrition')                                      
      .get(function(req, res) {                               
         var recipeID = req.query.recipeID;                   
         db.collection('nutrition').find({'recipeID': recipeID}, function(err, item) {
           res.json(item);                                    
         });                                                  
      });

router.route('/recipes')                                      
      .get(function(req, res) {                               
         var recipeID = req.query.recipeID;                   
         db.collection('recipes').find({'id': recipeID}, function(err, item) {
           res.send(item);                                    
         });                                                  
      });

router.route('/holidays')                                      
      .get(function(req, res) {
         var recipeID = req.query.recipeID;                   
         db.collection('holidays').find({'recipeID': recipeID}, function(err, item) {                                                          
           res.send(item);                                    
         });                                                  
      });
        
router.route('/requirement')
      .get(function(req, res) {
         var gender = req.query.gender;
         var age = +req.query.age;
         db.collection('requirement').find({'gender': gender, 'age' : age}, function(err, item) {
           res.send(item);
         });
      });

router.route('/ingredient')
      .get(function(req, res) {
         var recipeID = req.query.recipeID;
         db.collection('ingredients').find({'recipeID': recipeID}, function(err, item) {
           res.send(item);
         });
      });

router.route('/rating')
      .get(function(req, res) {
         db.collection('rating').find({}, function(err, item) {
           res.send(item);
         });
      })
     .post(function(req, res) {
         var userID = req.query.id;
         var star = req.query.star;
         db.collection('rating').insert({'userID' : userID, 'star': star}, function(err, item) {
           if (err)
             res.send({"error" : "An error occured"});
           else
             res.send(item);
         })
      });

router.route('/recommendation')
      .get(function(req, res) {
         req.connection.setTimeout(600000);
         var userID = req.query.userID;
         var numSuggestions = req.query.numsuggestions || 7;
         algorithm.getRecipeSuggestions(userID, numSuggestions, function (suggestions) {
            res.json(suggestions);
         })
      });

router.route('/similarity_graph')
      .get(function(req, res) {
         var recipeID = req.query.recipeID;
         var depth = req.query.depth || 3;
         graph_similarities.getGraph(recipeID, depth, function (graph) {
            res.json(graph);
         })
      })

    
// more routes for our API will happen here
// REGISTER OUR ROUTES -------------------------------
// all of our routes will be prefixed with /api
app.use('/', router);

// START THE SERVER
// =============================================================================
app.listen(port);
console.log('Server start listening on port ' + port);
