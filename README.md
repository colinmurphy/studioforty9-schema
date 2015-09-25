# StudioForty9 Magento Schema Module

This will add hidden schema tags to your product pages.

## 1. Requirements
The main page templates must have the block **before_body_end** in order for the module to add the additional HTML to your page.

## 2. Installation

In your composer file you would add the following:

     {
         "repositories": [
             {
                 "type": "composer",
                 "url": "http://packages.firegento.com"
             },
             {
                 "url": "https://github.com/colinmurphy/studioforty9-schema.git",
                 "type": "git"
             }
         ],
         "require": {
             "magento-hackathon/magento-composer-installer": "*",
             "colinmurphy/studioforty9-schema": "dev-master"
         },
         "extra": {
             "magento-root-dir": "./"
         }
     }

# 3. Testing

You can test to check if the schema tags are correct here - [https://developers.google.com/structured-data/testing-tool/](https://developers.google.com/structured-data/testing-tool/)

# 4. TODO

- Ratings
- Configurable Product
- Virtual Products
- Downloadable Products
- Bundle Products
- CMS pages
- Category Pages