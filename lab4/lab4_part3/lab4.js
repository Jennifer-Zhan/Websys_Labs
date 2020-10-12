function print_elements(node,txt, layer) {
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
  this.style.backgroundColor = "blue";
  this.style.right=this.style.right-"10px";
}

function mouseOut() {
  this.style.backgroundColor = "white";
  this.style.right=this.style.right+"10px";
}


