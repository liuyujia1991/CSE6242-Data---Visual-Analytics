package edu.gatech.cse6242

import org.apache.spark.SparkContext
import org.apache.spark.SparkContext._
import org.apache.spark.SparkConf

object Task2 {
  def main(args: Array[String]) {
    val sc = new SparkContext(new SparkConf().setAppName("Task2"))

    // read the file
    val file = sc.textFile("hdfs://localhost:8020" + args(0))

    /* TODO: Needs to be implemented */
    val output = file.map(_.split("\t")).map(node => (node(1),node(2).toInt)).reduceByKey(_ + _).map(t => t._1 + "\t" + t._2.toString)

    // store output on given HDFS path.
    // YOU NEED TO CHANGE THIS
    output.saveAsTextFile("hdfs://localhost:8020" + args(1))
  }
}
