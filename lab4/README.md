part1a: firstly find the root element in the document, then find their children and return their value.
        Using recursion to make sure each tag name have correct number of dash before
        then using innerHTML to print the result.
        
part1b: For part1a, we locate each element in the document by using nodes, and apply nodeName to find their tags.
        However, in part1b, we find each element in the document by using elements.
        Nodes are all the different components that a webpage is made up of and elements are one type of node.
        So actually, there is no quit difference when using node or element overall, however, the functions called may be different.
        tagName is only use for returning the tag name,
        while nodeName could return various value based on the type of node, in particular, in this lab case, we only use element node, so it would return the tag name of the node

part2: When we click on the element, an event happens on an element. Since all the elements share an event handler, it will first run the even handler on the element we click and then on its parents and all the way up through the DOM. The order for event bubbling will be from child element to parent element.
        
part3: The function could be realized by using mouseover and mouseout to addEventListener.
        when the event occurs, we would change the css as requests.

what each of we did:

Jennifer Zhan: Finished most of the Javascript for all the parts; added css animation to the title; completed readme for part2 and added some details for other parts of readme base on Jensen's explanations.

Jensen Chen: Individually finish the stylesheet of the lab and help to construct a part of part3 and most part of explanations in readme

Jiahui Wu: Finish part2 and dubug for all three files.
