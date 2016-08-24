# Count-content-signs
Count the number of signs (characters + whitespaces) of a WordPress post (TinyMCE editor).

This is a fork of the following plugin : https://wordpress.org/plugins/count-content-characters/

Changes :
* New : Add french translation
* Edit : Use native function of WordPress (word count) to count chars with spaces
* Edit : Remove useless dupplicated code
* Edit : Remove number of selected characters (useless)
* Tweak : Better performances
* Tweak : The count of signs is now in real time (every 500ms) when you're editing you're content (only update the count if the content lenght has changed)
* Tweak : Also count the white spaces (signs = characters + white spaces)
* Tweak : Move markup location to avoid fixed layout (you had to scroll to the bottom of the post, it was annoying for long posts)
