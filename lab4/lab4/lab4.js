window.onload = function () {
  //part1a
  var headnode=document.documentElement;
  var txt="";
  var layer="";
  document.getElementById("info").innerHTML = print_elements(headnode,txt,layer);

  //part1b
  var root_element=document.getElementsByClassName("root");
  var txt_b="";
  var layer_b="";
  document.getElementById("part1b").innerHTML = print_elements_b(root_element[0],txt_b,layer_b);

  //part3
  //copy favorite quote.
  var node=document.getElementsByClassName("quote")[1].cloneNode(true);
  document.body.appendChild(node);

  //bind new onmouseover event listeners to each div.
  var div_elements=document.getElementsByTagName("DIV");
  for (var i=0; i<div_elements.length; i++){
    div_elements[i].addEventListener("mouseover", mouseOver);
    div_elements[i].addEventListener("mouseout", mouseOut);
  }
}

function print_elements(node, txt, layer) {
  var item = node.nodeName.toLowerCase();
  if (item != "#text") {
  	txt = txt + layer + item + "\n";
  }
  layer += "-";
  for (var i = 0; i < node.childNodes.length; i++) {
    var child = node.childNodes[i];
    // add part2 - modify the function for part1a and 
    // add onclick event listener to each element.
    node.childNodes[i].addEventListener("click", click_alert);
    txt=print_elements(child,txt,layer);
  }
  return txt;
}

function print_elements_b(element,txt,layer){
  var item=element.tagName.toLowerCase();
  txt=txt+layer+item+"\n";
  layer+="-";
  for (var i = 0; i < element.children.length; i++) {
    var child = element.children[i];
    txt=print_elements_b(child,txt,layer);
  }
  return txt;
}

function click_alert(){
  alert(this.nodeName.toLowerCase());
}

function mouseOver() {
  this.style.backgroundColor = "#1DA1F2";
  this.style.marginLeft = "10px";
}

function mouseOut() {
  this.style.backgroundColor = "#243447";
  this.style.marginLeft = "0px";
}


