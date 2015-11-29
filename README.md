# StudioForty9 Magento Schema Module

This will add hidden schema tags to your product, category, cms and contact pages.

## 1. Installation

### 1.1. Composer

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
            "magento-deploystrategy": "copy",
            "magento-force": true,
            "magento-root-dir": "./"
         }
     }


### 1.2. Modman
    
    modman init
    modman clone git@github.com:colinmurphy/studioforty9-schema.git


## 2. Testing

You can test to check if the schema tags are correct here - [https://developers.google.com/structured-data/testing-tool/](https://developers.google.com/structured-data/testing-tool/)

## 3. Contact Page

Information for the contact page is taken from the store information in the System Configuration.