# WordPress Email Notifications #
This plugin enables managing e-mail content and settings that can be later sent through template or plugin files.


## Features ##
* Simple responsive layout
* Settings for
    * Background color
    * Container background color
    * Textcolor
* Logo / Image
* Attachments

## Usage ##
    $jb_wpen = new JB_WPEN( $post_id );
    $jb_wpen->send( [ 'email@domain.com' ] );

## Notes ##
Requires metabox.io plugin for WordPress