# Count-content-signs
Count the number of signs (characters + whitespaces) of a WordPress post (TinyMCE editor).

This is a fork of the following plugin : https://wordpress.org/plugins/count-content-characters/

Changes :
* Add french translation
* Tweak : The count of signs is now in real time (every 500ms) when you're editing you're content (only update the count if the content lenght has changed)
* Tweak : Also count the white spaces (signs = characters + white spaces)
* Tweak : Move markup location to avoid fixed layout (you had to scroll to the bottom of the post, it was annoying for long posts)
