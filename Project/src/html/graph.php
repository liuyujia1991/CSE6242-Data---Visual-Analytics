<?php session_start(); ?>

<?php  
	$url = "http://52.91.113.244:8080/similarity_graph?recipeID=".$_SESSION['dislike'];
	$data = file_get_contents($url);
?>


<!DOCTYPE html>
<meta charset="utf-8">
<head>
    <!--This page is designed and built by Yi-Nung Yeh-->
	<link href="bootstrap.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Palanquin:700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Sigmar+One|Fredericka+the+Great|Cabin+Sketch|Denk+One|Racing+Sans+One|Carter+One|Lemon|Knewave' rel='stylesheet' type='text/css'>
</head>
<style>

.title2{
  display: block;
  color: black;
   
  margin-top: 0px;
  font-family: 'Racing Sans One', cursive;
  font-weight: normal; 
  font-size: 50px;
  line-height:80px;
   
}

h3{
  display: block;
  color: black;
   
  margin-top: 0px;
  font-family: 'Racing Sans One', cursive;
  font-weight: normal; 
  font-size: 30px;
}

li{
  font-size:24px;
  line-height:30px;
  padding-left::10px;
 }

body{
padding:15px;
font-family: 'Palanquin:700', sans-serif;
width:1350px;
 }
 
p{
 font-size:large;
 }

.link {
  stroke: #999;
}

.node text {
  pointer-events: none;
  font: 22px sans-serif;
  text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
}

text {
  font: 14px sans-serif;
  pointer-events: none;
  text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
}

.text2 {
  font: 16px sans-serif;
  pointer-events: none;
  text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
}

select
{
  width:300px;
  height:40px;
  font-size:24px;
}

</style>

<style>
.axis path,
.axis line {
  fill: none;
  stroke: #000;
  stroke-width:2px;
  shape-rendering: crispEdges;
}

.bar {
  fill: orange;
}

.bar2 {
  fill: red;
}

.bar:hover {
  fill: #cc6600;
}

.bar2:hover {
  fill: #990000;
}

.x.axis path {
  display: none;
}

.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}

.bu{
  height:30px;
  width:150px;
  font-size:20px;
  background:none;
  border:2px solid black;
 }
 
.bu:hover{
  background:black;
  color:white;
  border:2px solid black;
 }

</style>
<body style="overflow-x:yes;">
<script src="//d3js.org/d3.v3.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<br>
<br>
<h1 class="title2" align="center">Similarity Graph</h1>
<h3>Definiiton:</h3>
<ui>
<li style="font-size:18px"><b><font color="red">Red node:</font></b> the recipe which you want to change.</li>
<li style="font-size:18px"><b><font color="#004c99">Blue node:</font></b> the most similar recipes to the recipe which you want to change.</li>
<li style="font-size:18px"><b><font color="yellow">Yellow node:</font></b> the most similar recipes to all orange nodes.</li>
<li style="font-size:18px">The thicker stroke indicates higher similarity.</li>
<li style="font-size:18px">Change recipe by <b>clicking a node</b>.</li>
</ui>
<input type="hidden" name="test" value="2"> 
<input type="hidden" name="abc" id="abc"/>
<input type="hidden" name="kk" id="kk"/>
<br>
<h3>Return to Last Page:</h3>
<input class="bu" type ="button" onclick="history.back()" value="Return"></input>
<div align="right" style="padding-right:30px">
<h3>Select A Nutrition:</h3>
<select id="comboA" onchange="get_nutrition(this)">
<option value="Vitamin A, IU" selected>Vitamin A</option>
<option value="Vitamin B-12">Vitamin B-12</option>
<option value="Vitamin C, total ascorbic acid">Vitamin C</option>
<option value="Vitamin D">Vitamin D</option>
<option value="Vitamin E (alpha-tocopherol)">Vitamin E</option>
<option value="Iron, Fe">Iron</option>
<option value="Calcium, Ca">Calcium</option>
<option value="Sodium, Na">Sodium, Na</option>
<option value="Potassium, K">Potassium, K</option>
<option value="Fiber, total dietary">Fiber, total dietary</option>
<option value="Sugars, total">Sugars, total</option>
<option value="Carbohydrate, by difference">Carbohydrate, by difference</option>
<option value="Cholesterol">Cholesterol</option>
<option value="">Fat Calorie</option>
<option value="Total lipid (fat)">Total lipid (fat)</option>
<option value="Fatty acids, total saturated">Fatty acids, total saturated</option>
<option value="Protein">Protein</option>
<option value="Energy">Energy</option>
</select>
</div>
<br>
<script>

var width = 850,
    height = 1000;
	
var ori_json=null;
var new_json=null;

var selected_node=null;
var legenddata=null;


var filtervalue="Vitamin A, IU";


var rid='<?php echo $_SESSION['dislike'];?>';
alert(111);
var main_node='<?php echo $data;?>';



var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height);
	
						  
var margin = {top: 130, right: 30, bottom: 50, left: 80};
width2 = 500 - margin.left - margin.right,
height2 = 800 - margin.top - margin.bottom;

var bar_gap=30;
							
var x = d3.scale.ordinal().range([3*width2/10-bar_gap/2-50, 7*width2/10-bar_gap/2+50]);
var y = d3.scale.linear().range([height2, 50]);

var xAxis = d3.svg.axis()
.scale(x)
.orient("bottom");

var yAxis = d3.svg.axis()
.scale(y)
.orient("left");


var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
    if(d.description=="")
	{
	    return "Fat calorie: " + d.value + " ("+d.unitName+")"+"</span>";
	}
	else
        return d.description+": " + d.value + " ("+d.unitName+")"+"</span>";
  })

var svg2 = d3.select("body").append("svg")
    .attr("width", width2 + margin.left + margin.right)
    .attr("height", height2 + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(100,0)");


svg2.call(tip);

	


var force = d3.layout.force()
    .gravity(.05)
    .distance(300)
    .charge(-60)
    .size([width, height]);

  json = JSON.parse( main_node );

  force
      .nodes(json.nodes)
      .links(json.edges)
      .start();

  
    var adjust=[];
	var adjust2=[];
	

  var link = svg.selectAll(".link")
      .data(json.edges)
    .enter().append("line")
      .attr("class", "link")
	  .style("stroke", function(d) { if(d.source.name===rid){adjust.push(d.target.name); return "black";} else if(d.target.name===rid){adjust.push(d.source.name); return "black";} else {return "black";} })
	  .style("stroke-width", function(d) { if(d.source.name===rid){return 10*d.value;} else if(d.target.name===rid){return 10*d.value;} else if(adjust.indexOf(d.target.name)>-1){ adjust2.push(d.source.name); return 5*d.value;} else if(adjust.indexOf(d.source.name)>-1){ adjust2.push(d.target.name); return 1*d.value;} else {return 0;} });
	  
  var node = svg.selectAll(".node")
      .data(json.nodes)
    .enter().append("circle")
      .attr("class", "node")
      .attr("r", function(d){if(d.name==rid){return 50+d.score;} else if(adjust.indexOf(d.name)>-1){return 25+d.score;} else if(adjust2.indexOf(d.name)>-1){return 10+d.score;} else{return 0;}})
	  .style("fill", function(d){if(d.name==rid){return "red";} else if(adjust.indexOf(d.name)>-1){return "#004c99";} else if(adjust2.indexOf(d.name)>-1){return "yellow";} else {return "black";}})
      .call(force.drag);

  	  
  
  var text = svg.append("g").selectAll("text")
    .data(json.nodes)
  .enter().append("text")
    .attr("class","text2")
    .attr("x", 12)
    .attr("y", ".31em")
    .text(function(d) { var target="-|_|1|2|3|4|5|6|7|8|9|0"; var myRegExp=new RegExp(target, 'g'); var replaceText=" "; if(d.name==rid){return d.name.replace(myRegExp, replaceText);} else if(adjust.indexOf(d.name)>-1){return d.name.replace(myRegExp, replaceText);} else if(adjust2.indexOf(d.name)>-1){return d.name.replace(myRegExp, replaceText);}})
	.style("fill", function(d){if(d.name==rid){return "red";}else if(adjust.indexOf(d.name)>-1){return "#004c99";} else if(adjust2.indexOf(d.name)>-1){return "black";}});
  
  
  node.append("title")
      .text(function(d) { var target2="-|_|1|2|3|4|5|6|7|8|9|0"; var myRegExp=new RegExp(target2, 'g'); var replaceText=" "; if(d.name==rid){return d.name.replace(myRegExp, replaceText);} else if(adjust.indexOf(d.name)>-1){return d.name.replace(myRegExp, replaceText);} else if(adjust2.indexOf(d.name)>-1){return d.name.replace(myRegExp, replaceText);}})

	
	node.on("click", function(d)
                      {
                          	if(d.name!=rid)
							{
							
							selected_node=d.name;
							
							var a = document.getElementById("abc");
							var nutrition_new = null;
							var nutrition_ori = null;
	  						a.value = d.name;
	  						$.ajaxSetup({async:false}); 
	  						var id2 = $('input[name="abc"]').val();  
	  						$.post('nu_new.php',{id2:id2},function(data){  
	  						    nutrition_new=data;
  	  						});
      						a.value = rid;
	  						id2 = $('input[name="abc"]').val(); 
	  						$.post('nu_new.php',{id2},function(data){  
	  						    nutrition_ori=data;
	  						});
	  						$.ajaxSetup({async:true});
	  						new_json = JSON.parse( nutrition_new );
	  						ori_json = JSON.parse( nutrition_ori );
							
							
							var target2="-|_|1|2|3|4|5|6|7|8|9|0"; var myRegExp2=new RegExp(target2, 'g'); var replaceText2=" ";
							var target3="   "; var myRegExp3=new RegExp(target3, 'g'); var replaceText3="";
							
							var xname=[d.name.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3),rid.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3)];

	  						x.domain(xname.map(function(d) { return d; }));
      						y.domain([0, Math.max(d3.max(new_json, function(d) { if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d.value;}} else {if(d.description==filtervalue){return d.value;} }}), d3.max(ori_json, function(d) { if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d.value;}} else {if(d.description==filtervalue){return d.value;}} }))*1.2]);
							
                            svg2.select("#xaxis").remove();
							svg2.select("#yaxis").remove();
  
  							svg2.append("g")
      						.attr("class", "x axis")
							.attr("id", "xaxis")
      						.attr("transform", "translate(0," + height2 + ")")
      						.call(xAxis)
							
							

 							 svg2.append("g")
      						 .attr("class", "y axis")
							 .attr("id", "yaxis")
      						 .call(yAxis)
    						 .append("text")
      						 .attr("transform", "rotate(-90)")
      						 .attr("y", 6)
      						 .attr("dy", ".71em")
      						 .style("text-anchor", "end")
      						 .text(function(d){if(filtervalue=="") {return "Amount of Fat calorie";}else {return "Amount of "+filtervalue;}});
							 
							 


							 svg2.selectAll(".bar").remove();
							 svg2.selectAll(".bar2").remove();
							 svg2.selectAll(".legend").remove();

  							 svg2.selectAll(".bar")
      						 .data(new_json)
    						 .enter().append("rect")
							 .filter(function(d){if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d;}} else {if(d.description==filtervalue){return d;}}})
      						 .attr("class", "bar")
      						 .attr("x", function(d) { return 1*width2/5-50; })
      						 .attr("width", width2/5-bar_gap)
      						 .attr("y", function(d) { return y(d.value); })
      						 .attr("height", function(d) { return height2 - y(d.value); })
      						 .on('mouseover', tip.show)
      						 .on('mouseout', tip.hide);
							 
							 svg2.selectAll(".bar2")
      						 .data(ori_json)
    						 .enter().append("rect")
							 .filter(function(d){if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d;}} else {if(d.description==filtervalue){return d;}}})
      						 .attr("class", "bar2")
      						 .attr("x", function(d) { return 3*width2/5+50; })
      						 .attr("width", width2/5-bar_gap)
      						 .attr("y", function(d) { return y(d.value); })
      						 .attr("height", function(d) { return height2 - y(d.value); })
      						 .on('mouseover', tip.show)
      						 .on('mouseout', tip.hide);
							 
							 legenddata=[d.name, rid];
							 
							 var legend2 = svg2.selectAll(".legend")
      						 .data(legenddata)
    						 .enter().append("g")
      						 .attr("class", "legend")
      						 .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });


  							 legend2.append('rect')
      						 .attr("x", width2-100)
      						 .attr("width", 18)
      						 .attr("height", 18)
      						 .style("fill", function(d,i){
  							 if(i==0) return "orange";
							 else if(i==1) return "red";
							 });
  
  							 legend2.append("text")
      						 .attr("x", width2 - 110)
      						 .attr("y", 10)
      						 .attr("dy", ".35em")
      						 .style("text-anchor", "end")
      						 .text(function(d){return d.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3);});
							 

						  if(d.name!=rid)
						  {
						      if(confirm("Replace "+rid.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3)+" by "+d.name.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3)+"?"))
                          	  {
								  var b = document.getElementById("kk");
								  b.value = d.name;
	  							  id3 = $('input[name="kk"]').val();
	  							  $.post('change.php',{id3:id3},function(data){
								  data.preventDefault();
								  alert(data);
	  							  });
								  window.history.back();
							  }
						  }
						  
						  }
                      })


  force.on("tick", function() {
    link.attr("x1", function(d) { return d.source.x; })
        .attr("y1", function(d) { return d.source.y; })
        .attr("x2", function(d) { return d.target.x; })
        .attr("y2", function(d) { return d.target.y; });

    node.attr("cx", function(d) { return d.x; })
        .attr("cy", function(d) { return d.y; });

    text.attr("transform", transform);
  });

  

function transform(d) {
  return "translate(" + d.x + "," + d.y + ")";
}

function get_nutrition(sel) {
  filtervalue = sel.value;
	  
  var target2="-|_|1|2|3|4|5|6|7|8|9|0"; var myRegExp2=new RegExp(target2, 'g'); var replaceText2=" ";
  var target3="   "; var myRegExp3=new RegExp(target3, 'g'); var replaceText3="";
  var xname=[selected_node.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3),rid.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3)];

  x.domain(xname.map(function(d) { return d; }));
  y.domain([0, Math.max(d3.max(new_json, function(d) { if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d.value;}} else {if(d.description==filtervalue){return d.value;} }}), d3.max(ori_json, function(d) { if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d.value;}} else {if(d.description==filtervalue){return d.value;}} }))*1.2]);
							
  svg2.select("#xaxis").remove();
  svg2.select("#yaxis").remove();
  svg2.append("g")
  .attr("class", "x axis")
  .attr("id", "xaxis")
  .attr("transform", "translate(0," + height2 + ")")
  .call(xAxis)

  svg2.append("g")
  .attr("class", "y axis")
  .attr("id", "yaxis")
  .call(yAxis)
  .append("text")
  .attr("transform", "rotate(-90)")
  .attr("y", 6)
  .attr("dy", ".71em")
  .style("text-anchor", "end")
  .text(function(d){if(filtervalue=="") {return "Amount of Fat calorie";}else {return "Amount of "+filtervalue;}});

  svg2.selectAll(".bar").remove();
  svg2.selectAll(".bar2").remove();
  svg2.selectAll(".legend").remove();

  svg2.selectAll(".bar")
  .data(new_json)
  .enter().append("rect")
  .filter(function(d){if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d;}} else {if(d.description==filtervalue){return d;}}})
  .attr("class", "bar")
  .attr("x", function(d) { return 1*width2/5-50; })
  .attr("width", width2/5-bar_gap)
  .attr("y", function(d) { return y(d.value); })
  .attr("height", function(d) { return height2 - y(d.value); })
  .on('mouseover', tip.show)
  .on('mouseout', tip.hide);
							 
  svg2.selectAll(".bar2")
  .data(ori_json)
  .enter().append("rect")
  .filter(function(d){if(d.description=="Energy"){if(d.description==filtervalue && d.attribute=="ENERC_KCAL"){return d;}} else {if(d.description==filtervalue){return d;}}})
  .attr("class", "bar2")
  .attr("x", function(d) { return 3*width2/5+50; })
  .attr("width", width2/5-bar_gap)
  .attr("y", function(d) { return y(d.value); })
  .attr("height", function(d) { return height2 - y(d.value); })
  .on('mouseover', tip.show)
  .on('mouseout', tip.hide);
  
  
   legenddata=[selected_node, rid];
							 
   var legend2 = svg2.selectAll(".legend")
   .data(legenddata)
   .enter().append("g")
   .attr("class", "legend")
   .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });


  	legend2.append('rect')
    .attr("x", width2-100)
    .attr("width", 18)
    .attr("height", 18)
    .style("fill", function(d,i){
  	if(i==0) return "orange";
	else if(i==1) return "red";
	});
  
  	legend2.append("text")
    .attr("x", width2 - 110)
    .attr("y", 10)
    .attr("dy", ".35em")
    .style("text-anchor", "end")
    .text(function(d){return d.replace(myRegExp2, replaceText2).replace(myRegExp3, replaceText3);});
						  
}

</script>

