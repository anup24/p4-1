# Project 4
+ By: *Matthew McGrath*
+ Production URL: <https://p4.mcm223.me>

## Database
*This application uses the AWS Translate API to provide users with translations in several languages. Users enter the desired attributes in the form and the translated results are saved to the database.*

Primary tables:
  + `translations`
  + `sourcelanguages`
  + `targetlanguages`
  + `tags`
  
Pivot table(s):
  + `tag_translation`


## CRUD
*Users can create, view, edit, and delete translations within the app:*

__Create__
  + Visit <https://p4.mcm223.me/>
  + Fill out form with translation details (starting language, ending language, and text to translate)
  + Click *Translate*
  + Land on either successful landing page or an error. If it's a validation error, you will see the validation message. If the AWS service failed, you will see the failure code details.
  
__Read__
  + Visit <https://p4.mcm223.me/translations> to see a listing of all past translations
  
__Update__
  + Visit <https://p4.mcm223.me/translations> and click edit on an entry
  + Make some edit to the translation, including adding any desired tags. This will make another call to the AWS API to re-translate the new input.
  + Click *Confirm Edit*
  + Land on the edit page with updated entry or corresponding error
  
__Delete__
  + Visit <http://p4.mcm223.me/translations> and click the delete button next on an entry
  + Confirm deletion on interstitial page
  + Observe confirmation message

## Outside resources
+ [Amazon Web Service PHP SDK](https://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/installation.html)
+ [Debug Bar](https://github.com/barryvdh/laravel-debugbar) and [IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
+ Badge icons are from [icons8.com](https://icons8.com/)

## Code style divergences


## Notes for instructor 
