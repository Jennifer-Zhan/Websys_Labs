function print_elements(node,txt,layer) {
  var item=node.nodeName.toLowerCase();
  if(item!="#text"){
  	txt=txt+layer+item+"\n";
  }
  layer+="-";
  for (var i = 0; i < node.childNodes.length; i++) {
    var child = node.childNodes[i];
    node.childNodes[i].addEventListener("click", function () {
           alert(this.nodeName.toLowerCase());
    }, false);
    txt=print_elements(child,txt,layer);
  }
  return txt;
}

function mouseOver() {
  this.style.backgroundColor = "#1DA1F2";
  this.style.marginLeft = "10px";
}

function mouseOut() {
  this.style.backgroundColor = "white";
  this.style.marginLeft = "0px";
}


