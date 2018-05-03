# Project 4
+ By: *Matthew McGrath*
+ Production URL: <https://p4.mcm223.me>

## Database
*This application acts as a user interface for the Amazon Web Service's Translate service. Users enter the desired attributes in the form, and the translated results are saved to the database.*

Primary tables:
  + `translations`
  + `sourcelanguages`
  + `targetlanguages`
  + `tags`
  
Pivot table(s):
  + `tag_translation`


## CRUD
*Describe what action I need take in order to see an example of all 4 CRUD operations in your app. I've filled this out with examples from the Foobooks app - delete this and replace with your own info. If one operation is performed multiple times (e.g. Read), you only need to provide 1 example.*

__Create__
  + Visit <https://p4.mcm223.me/>
  + Fill out form with translation details
  + Click *Translate*
  + Land on either successful landing page or error page
  
__Read__
  + Visit <https://p4.mcm223.me/translations> see a listing of all past translations
  
__Update__
  + Visit <https://p4.mcm223.me/translations> and click edit on an entry
  + Make some edit to form
  + Click *Save*
  + Land on the translations page with updated entry
  
__Delete__
  + Visit <http://p4.mcm223.me/translations> and click the delete button next on an entry
  + Confirm deletion on interstitial page
  + Observe confirmation message

## Outside resources
+ Amazon Web Services PHP SDK
+ Debug Bar and IDE Helper
+ Badge icons are from icons8.com

## Code style divergences
*List any divergences from PSR-1/PSR-2 and course guidelines on code style*

## Notes for instructor
*Any notes for me to refer to while grading; if none, omit this section*
