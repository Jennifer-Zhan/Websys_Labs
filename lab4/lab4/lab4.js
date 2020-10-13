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
    node.childNodes[i].addEventListener("click", function () {
           alert(this.nodeName.toLowerCase());
    }, false);
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

function mouseOver() {
  this.style.backgroundColor = "#1DA1F2";
  this.style.marginLeft = "10px";
}

function mouseOut() {
  this.style.backgroundColor = "#243447";
  this.style.marginLeft = "0px";
}


