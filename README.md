# KnownRead

Publish IndieWeb style [Read](http://indieweb.org/read) posts with [Known](https://withknown.com/) to indicate 
articles, stories, pages you've read on the internet.

Similar to the bookmark functionality within Known, but meant to indicate that a post/page was already read (as opposed 
bookmarked to be read in the future.

## Installation

* [Download](https://github.com/chrisaldrich/KnownRead/archive/master.zip) the 
[repository](https://github.com/chrisaldrich/KnownRead). 
* Upload it to your server into a folder named <code>Read</code> within the <code>IdnoPlugins</code> folder 
your [Known](https://github.com/idno/Known) installation. 
* Go to the plugins tab of the <code>Site Configuration</code> for your Known site (typically http://www.yoursitname.com/admin/plugins) 
and click "Enable" on the Read plugin. 
* The "Read" icon and functionality should then be available in your posting interface. 

## Recommendation

While this plugin saves the Title and URL of the post as well as comments/notes for future reference, it does not save 
the content of that bookmarked post. One can install and configure the 
[Archive/Wayback Machine plugin](https://github.com/mapkyca/KnownWaybackMachine) which provides support for saving new 
and updated items, and saved bookmarks, to archive.org's wayback machine for future reference. This will allow one to 
review what the post looked liked when it was initally read rather than its present (modified or possibly non-existant) state.


## To Do

* Add book icon to the post to visually indicate "Read" (past tense)
* Modify microformats to allow for indication beyond bookmark? Perhaps u-read-of and h-cite
* Fix syndication
* Merge into bookmarklet, for easier use
* Consider putting link to archived version into "syndication" section of post
* Support status updates (with additional fields for page number or percent finished) for books, magazines, and other 
physical media as well as possibly syndication to [GoodReads.com](http://www.goodreads.com)

Pull Requests gladly accepted.

## Changelog

- 0.1.0 - 2017-04-13 Put on GitHub 
- 0.0.2 - 2017-04-12 Minimally working example
- 0.0.1 - 2017-02-18 Initially building
