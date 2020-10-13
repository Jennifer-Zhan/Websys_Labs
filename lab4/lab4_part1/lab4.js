function print_elements(node,txt,layer) {
    var item=node.nodeName.toLowerCase();
    if(item!="#text"){
        txt=txt+layer+item+"\n";
    }
    layer+="-";
    for (var i = 0; i < node.childNodes.length; i++) {
        var child = node.childNodes[i];
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
        txt=print_elements(child,txt,layer);
    }
    return txt;
}
