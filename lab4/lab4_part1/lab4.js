function print_elements(node, txt, layer) {
  var item = node.nodeName.toLowerCase();
  if(item != "#text"){
  	txt = txt+layer+item+"\n";
  }
  layer+="-";
  for (var i = 0; i < node.childNodes.length; i++) {
    var child = node.childNodes[i];
    txt = print_elements(child, txt, layer);
  }  
  return txt;
}
