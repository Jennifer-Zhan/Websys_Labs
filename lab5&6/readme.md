For JS:
We finished most part of the computation based on jquery, some javascript as well. For displaying the swatch and creating slider, we largely use jquery to realize them. In our jquery plugin, we added some HTML element to help to structure the game layout. So in this way, whatever element user choose, our game could be layout well inside that element. 
We made a function called slider_maker() for making the sliders, and set the default value as 20, 178, 60. In the swatch_generate() function, we use Math.random() * 256 to generate the random number from 0 to 255. When the new game starts (user clicks on the new game button), we will call the swatch_generate() function to generate a new random color swatch, replace the new game button with the submit button, make the setting change div to be hidden, and call the timer function. 
Inside submit_guess function, we set some conditions. When the number of time user click on submit button in this round reachs the turns in the setting or the user get the correct answer, we will clearTimeout(interval) to stop the timer, make the timer text back to 00:00:00, change the submit button back to new game button, and make the setting change div to be visible.

How do we deal with invalid value?
When the user types in the value that is larger than 255 in the slider text box, the value will be set to 255.
When the user enters the value for the turns in setting that is not the integer between 1-5, there will be a alert appear and will automatically set the value to 5.

For CSS:
Halloween is very close to the deadline of the lab, so we inspired to create a page with some "Halloween styles". For the background image, we choose a picture of a witch.
Moreover, the main color choice of the page is Halloween orange, which could not only enrich the atmosphere, but also trick users have more fun to finish the hexed game.
In addition, when you are ready to start your game but not start it yet, the swatches for displaying aimed hue would be a picture of halloween pumpkin, hoping the easter egg could help you to spend less time to finish the game.

There is another terrifying thing need you to discover by yourself. Hint: After you spend more than 20s to finish the game, and turn on your computer sound
Happy Halloween and enjoy the game!

What we did:

Jennifer Zhan: finish the js and html files, implement the required functions, help with some of the game layout and styling editing.

Jensen Chen: finish the stylesheet, and help to arrange the layout of the page

Jiahui Wu: Modify and test js file

Jonathan: Validity check of Html css and js file and help to modify js file.~~~~

Reference: 
https://jqueryui.com/slider/#colorpicker 
https://www.w3schools.com/