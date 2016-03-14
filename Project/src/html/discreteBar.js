function load(v)
{
    function example(v)
    {
        return v;
    }
	
	var datas=example();
	
nv.addGraph(function() {

  var chart = nv.models.discreteBarChart()
      .x(function(d) { return d.attribute })    //Specify the data accessors.
      .y(function(d) { return d.value })
      .staggerLabels(true)    //Too many bars and not enough room? Try staggering labels.
      .tooltips(false)        //Don't show tooltips
      .showValues(true)       //...instead, show the bar value right on top of each bar.
      .transitionDuration(350)
      ;

  d3.select('#chart svg')
      .datum(datas)
      .call(chart);
alert(321);
  nv.utils.windowResize(chart.update);
  
  return chart;
});

window.setTimeout(function () {
  datas.length = 0;

  chart.update();
}, 3000);       


}

