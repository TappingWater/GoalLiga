$(document).ready(function() {
  //Set article id to nill by default
  var id = null;
  //Create cookie for redirecting
  document.cookie = 'redirect=false;path=/';

  //Event handler for create article
  $('#createPanel').on('click', '#createArticleBtn', function() {
      document.cookie = 'redirect=true;path=/';
      window.location.href = base_url + '/postArticle';
  });

  //Event handler for when a user clicks the details button
  $('#panel').on('click', '#detailBtn', function() {
        if (id != null) {
          window.location.href = base_url + '/news/' + id;
        }
  });

  //Event handler for when a user clicks the edit article button
  $('#pButtons').on('click', '#editArticleBtn', function() {
    if (id != null) {
      document.cookie = 'redirect=true;path=/';
      window.location.href = base_url + '/news/edit/' + id;
    }
  });

  //Event handler for when a user clicks the delete article button
  $('#pButtons').on('click', '#deleteArticleBtn', function() {
    $('#dltCnfrm').show();
  });

  //Event handler for when user confirms the delete article action
  $('#dltCnfrm').on('click', '#dltYes', function() {
    document.cookie = 'redirect=true;path=/';
    var deleteURL = base_url + '/news/delete/' + id;
    window.location.href = deleteURL;
  });

  //Even handler if user does not confirm delete article action
  $('#dltCnfrm').on('click', '#dltNo', function() {
    $('#dltCnfrm').hide();
  });

  /**
  * Sets the title in the panel when the user clicks on a circle
  * node
  **/
  $('diagram').on('click', 'circle.article', function() {
    //Get the required information about the article from the node
    id = $(this).parent().attr('id');
    var uID = $(this).parent().attr('creatorID');
    var title = $(this).parent().attr('artTitle');
    $('#editTitle').val(title);
    var logID = $( "g[artTitle='Users']" ).attr('logID');
    var admin = $( "g[artTitle='Users']" ).attr('logID');
    //If the user is looking at his own articles or the user is an admin
    if (uID == logID || admin == true) {
      $('#pButtons').show();
    }
    //If the user is not an admin or it is not one of his/her articles
    else {
      $('#pButtons').hide();
      $('#dltCnfrm').hide();
    }
  });

  //The following code has been extracted from:
  //https://bl.ocks.org/d3noob/8375092
  //and has been editted slightly to fullfill requirements
  $.getJSON(base_url + '/viz', function(treeData) {

  // ************** Generate the tree diagram	 *****************
  var margin = {top: 20, right: 120, bottom: 20, left: 120},
  	width = 960 - margin.right - margin.left,
  	height = 500 - margin.top - margin.bottom;

  var i = 0,
  	duration = 750,
  	root;

  var tree = d3.layout.tree()
  	.size([height, width]);

  var diagonal = d3.svg.diagonal()
  	.projection(function(d) { return [d.y, d.x]; });

  var svg = d3.select("diagram").append("svg")
  	.attr("width", width + margin.right + margin.left)
  	.attr("height", height + margin.top + margin.bottom)
    .append("g")
  	.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  root = treeData[0];
  root.x0 = height / 2;
  root.y0 = 0;

  update(root);

  d3.select(self.frameElement).style("height", "500px");

  function update(source) {

    // Compute the new tree layout.
    var nodes = tree.nodes(root).reverse(),
  	  links = tree.links(nodes);

    // Normalize for fixed-depth.
    nodes.forEach(function(d) { d.y = d.depth * 180; });


    // Update the nodes…
    var node = svg.selectAll("g.node")
  	  .data(nodes, function(d) { return d.id || (d.id = ++i); });

    // Enter any new nodes at the parent's previous position.
    var nodeEnter = node.enter().append("g")
  	  .attr("class", "node")
      .attr("id",  function(d) { return d.articleID; })
      .attr("admin",  function(d) { return d.admin; })
      .attr("logID",  function(d) { return d.logID; })
      .attr("creatorID",  function(d) { return d.userID; })
      .attr("artTitle",  function(d) { return d.name; })
  	  .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
  	  .on("click", click);

    nodeEnter.append("circle")
  	  .attr("r", 1e-6)
      .attr("class",  function(d) { return d.identifier; })
  	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

    nodeEnter.append("text")
  	  .attr("x", function(d) { return d.children || d._children ? -13 : 13; })
  	  .attr("dy", ".35em")
  	  .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
  	  .text(function(d) { return d.name; })
  	  .style("fill-opacity", 1e-6);

    // Transition nodes to their new position.
    var nodeUpdate = node.transition()
  	  .duration(duration)
  	  .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

    nodeUpdate.select("circle")
  	  .attr("r", 10)
  	  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

    nodeUpdate.select("text")
  	  .style("fill-opacity", 1);

    // Transition exiting nodes to the parent's new position.
    var nodeExit = node.exit().transition()
  	  .duration(duration)
  	  .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
  	  .remove();

    nodeExit.select("circle")
  	  .attr("r", 1e-6);

    nodeExit.select("text")
  	  .style("fill-opacity", 1e-6);

    // Update the links…
    var link = svg.selectAll("path.link")
  	  .data(links, function(d) { return d.target.id; });

    // Enter any new links at the parent's previous position.
    link.enter().insert("path", "g")
  	  .attr("class", "link")
  	  .attr("d", function(d) {
  		var o = {x: source.x0, y: source.y0};
  		return diagonal({source: o, target: o});
  	  });

    // Transition links to their new position.
    link.transition()
  	  .duration(duration)
  	  .attr("d", diagonal);

    // Transition exiting nodes to the parent's new position.
    link.exit().transition()
  	  .duration(duration)
  	  .attr("d", function(d) {
  		var o = {x: source.x, y: source.y};
  		return diagonal({source: o, target: o});
  	  })
  	  .remove();

    // Stash the old positions for transition.
    nodes.forEach(function(d) {
  	d.x0 = d.x;
  	d.y0 = d.y;
    });
  }

  // Toggle children on click.
  function click(d) {
    if (d.children) {
  	d._children = d.children;
  	d.children = null;
    } else {
  	d.children = d._children;
  	d._children = null;
    }
    update(d);
  }

  });

});
