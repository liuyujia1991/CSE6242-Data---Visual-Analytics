# CSE6242/CX4242 Homework 4 Sketch Code
# Please use this outline to implement your decision tree. You can add any code around this.

import csv
from math import log

# Enter You Name Here
myname = "Yujia-Liu-" # or "Doe-Jane-"

def Entropy(dataSet):
    numEntries = len(dataSet)
    if numEntries == 0:
        return 0
    count0 = 0
    count1 = 0
    for featVec in dataSet: #the the number of unique elements and their occurance
        if featVec[-1] == "0":
            count0 += 1
        else:
            count1 += 1
    prob0 = float(count0)/numEntries
    prob1 = float(count1)/numEntries
    if prob0 == 0 or prob1 == 0:
        return 0
    else:
        return - prob0 * log(prob0,2) - prob1 * log(prob1,2)

def splitDataSet(dataSet, axis, value):
    retDataSet1 = []
    retDataSet2 = []
    for featVec in dataSet:
        if featVec[axis] <= value:
            retDataSet1.append(featVec)
        else:
            retDataSet2.append(featVec)
    return (retDataSet1, retDataSet2)
    
def chooseBestFeatureToSplit(dataSet):
    numFeatures = len(dataSet[0]) - 1
    baseEntropy = Entropy(dataSet)
    bestInfoGain = 0.0; bestFeature = -1
    for i in range(numFeatures):        
        featList = [example[i] for example in dataSet]
        uniqueVals = set(featList) 
        for value in uniqueVals:
            newEntropy = 0.0
            subDataSet1, subDataSet2 = splitDataSet(dataSet, i, value)
            prob1 = len(subDataSet1)/float(len(dataSet))
            prob2 = len(subDataSet2)/float(len(dataSet))
            newEntropy = prob1 * Entropy(subDataSet1) + prob2 * Entropy(subDataSet2)    
            infoGain = baseEntropy - newEntropy     
            if (infoGain > bestInfoGain):
                bestInfoGain = infoGain
                bestFeature = i
                bestValue = value
    return (bestFeature, bestValue)

def createTree(dataSet, depth):
    classList = [example[-1] for example in dataSet]
    if classList.count(classList[0]) == len(classList):
        return classList[0]
    if len(dataSet[0]) == 1:
        return str(int(classList.count("1") > len(classList)/2))
    depth += 1;
    if depth > 7:
        return str(int(classList.count("1") > len(classList)/2))
    bestFeat, bestVal = chooseBestFeatureToSplit(dataSet)
    myTree = {bestFeat:{}}
    subDataSet1, subDataSet2 = splitDataSet(dataSet, bestFeat, bestVal)
    myTree[bestFeat]["<=" + str(bestVal)] = createTree(subDataSet1, depth);
    myTree[bestFeat][">" + str(bestVal)] = createTree(subDataSet2, depth);

    return myTree

# Implement your decision tree below
class DecisionTree():
    trees = [dict() for x in range(3)]

    def learn(self, training_set):
        # implement this function
        N = 3
        training_set1 = [x for i, x in enumerate(training_set) if i % N == 0]
        training_set2 = [x for i, x in enumerate(training_set) if i % N == 1]
        training_set3 = [x for i, x in enumerate(training_set) if i % N == 2]


        self.trees[0] = createTree(training_set1, 0)
        self.trees[1] = createTree(training_set2, 0)
        self.trees[2] = createTree(training_set3, 0)
        #print self.tree
        
    # implement this function
    def classify(self, test_instance):
        result = 0
        for i in range(3):
            myTree = self.trees[i]
            while(myTree != "0" and myTree != "1"):
                feature = myTree.keys()[0]
                value = float(test_instance[feature])
                myTree = myTree[feature]
                myValueString = myTree.keys()[0]
                if ">" in myValueString:
                    myValue = float(myValueString[1:])
                    if value <= myValue:
                        myTree = myTree[myTree.keys()[1]]
                    else:
                        myTree = myTree[myTree.keys()[0]]
                else:
                    myValue = float(myValueString[2:])
                    if value <= myValue:
                        myTree = myTree[myTree.keys()[0]]
                    else:
                        myTree = myTree[myTree.keys()[1]]
            result += int(myTree)
        
        if result >= 2:
            return "1"
        else:
            return "0"


def run_decision_tree():

    # Load data set
    with open("hw4-data.csv") as f:
        next(f, None)
        data = [line for line in csv.reader(f, delimiter=",")]
    print "Number of records: %d" % len(data)

    # Split training/test sets
    # You need to modify the following code for cross validation.
    K = 10
    training_set = [x for i, x in enumerate(data) if i % K != 0]
    test_set = [x for i, x in enumerate(data) if i % K == 0]

    tree = DecisionTree()
    # Construct a tree using training set
    tree.learn( training_set )

    # Classify the test set using the tree we just constructed
    results = []
    
    for instance in test_set:
        result = tree.classify( instance[:-1] )
        results.append( result == instance[-1])

    # Accuracy
    accuracy = float(results.count(True))/float(len(results))
    print "accuracy: %.4f" % accuracy       
    
    # Writing results to a file (DO NOT CHANGE)
    f = open(myname+"result.txt", "w")
    f.write("accuracy: %.4f" % accuracy)
    f.close()


if __name__ == "__main__":
    run_decision_tree()
