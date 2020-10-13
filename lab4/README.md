part1a: firstly find the root node in the document, then find their childrenNodes and return their value.
        Using recursion to make sure each tag name have correct number of dash before
        then using innerHTML to print the result.
        
part1b: For part1a, we locate each element in the document by using nodes, and apply nodeName to find their tags.
        However, in part1b, we find each element in the document by using elements.

        Nodes are all the different components that a webpage is made up of and elements are one type of node.
        The return values of the functions of both 1a and 1b are the combination string of all the tag name. However, when we use .tagName in part1b, it returns the tag name of the element. When we use .nodeName in part1a, it returns the name of all nodes (elements, text, comments). So in part1a, I set the if statement that only allows the tag name to add to the return string.
        In conclusion, Using node or using element could both get all the tag name, but the functions call may be different. For example, .children only return element children, but .childNodes return all node children, and element is one kind of node. If we want the return value to be the same, for 1a, we need to set the condition to only get names of the element nodes(which is the tag name), except getting all the nodes.

part2: When we click on the element, an event happens on an element. Since all the elements share an event handler, it will first run the even handler on the element we click and then on its parents and all the way up through the DOM. The order for event bubbling will be from child element to parent element.
        
part3: We use cloneNode to copy a quote in the page, and use appendChild to add that element node to the document. Using .getElementsByTagName("DIV"), we could get all the element with the tag div, and addEventListener to each of those element by looping through them. The function could be realized by using mouseover and mouseout to addEventListener. When the event occurs, we would change the css as requests.

        Note: When we were making our web page more appealing, we changed the background color from white to another color. For adding the onmouseout event for each div, the event change background color back to its original background color instead of changing it to white. In this way, our webpage could be more appealing. If we make the background color change to white, the web page looks a bit weird, so we make it change back to its original background color and the functionality is the same. We also add a span tag in the title for adding a creative css animation.

what each of we did:

Jennifer Zhan: Finished most of the Javascript for all the parts; added css animation to the title; completed readme for part2 and added some details for other parts of readme base on Jensen's explanations.

Jensen Chen: Finished the stylesheet of the webpage for the lab and helped to construct a part of part3 and most part of explanations in readme.

Jiahui Wu: Finished part2 and debugged for all three files.

Jonathan Yang: Not good at JavaScript, gave suggestion for part1b.

Shuhan Li: A little bit confused about Javascript, searched for relevant js function examples and gave some ideas about part3.

reference:
https://www.w3schools.com/
