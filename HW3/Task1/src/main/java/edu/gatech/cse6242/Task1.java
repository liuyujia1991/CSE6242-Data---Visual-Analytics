package edu.gatech.cse6242;

import java.io.IOException;
import java.util.*;

import org.apache.hadoop.fs.Path;
import org.apache.hadoop.conf.Configuration;
import org.apache.hadoop.io.*;
import org.apache.hadoop.mapreduce.*;
import org.apache.hadoop.util.*;
import org.apache.hadoop.mapreduce.lib.input.FileInputFormat;
import org.apache.hadoop.mapreduce.lib.output.FileOutputFormat;

public class Task1 {

  public static class Map extends Mapper<Object, Text, Text, IntWritable> {
    private Text node = new Text();
    private IntWritable weight = new IntWritable();

    public void map(Object key, Text value, Context context) throws IOException, InterruptedException {
	String line = value.toString();
        String[] content = line.split("\t");
        node.set(content[1]);
        weight.set(Integer.parseInt(content[2]));
        context.write(node, weight);
    }
  }

  public static class Reduce extends Reducer<Text, IntWritable, Text, IntWritable> {
    private IntWritable result = new IntWritable();

    public void reduce(Text key, Iterable<IntWritable> values, Context context) throws IOException, InterruptedException {
      int sum = 0;
      for (IntWritable val : values) {
	sum += val.get();
      }
      result.set(sum);
      context.write(key, result);
    }
  }
  
  public static void main(String[] args) throws Exception {
    Configuration conf = new Configuration();
    Job job = Job.getInstance(conf, "Task1");
    job.setJarByClass(Task1.class);

    job.setMapperClass(Map.class);
    job.setReducerClass(Reduce.class);

    job.setOutputKeyClass(Text.class);
    job.setOutputValueClass(IntWritable.class);

    FileInputFormat.addInputPath(job, new Path(args[0]));
    FileOutputFormat.setOutputPath(job, new Path(args[1]));
    System.exit(job.waitForCompletion(true) ? 0 : 1);
  }
}
