# FULL STACK BASIC ECOM
### PROJECT DIRECTORIES
* cms `(Admin panel) In PHP using Code Igniter Framework`
* webservice `In PHP using Slim Framework`
* website `Angular 5 with Progressive Web App (Mobile only layout)`

### PROJECT SETUP

Download the zip or pull the repo in your local. Copy the folder "webuy" in your root `localhost:8888/webuy/..`. 

    MAKE SURE '644' or '777' PERMISSION GIVEN TO `/webservice/uploads` DIRECTORY


The default port address used is `:8888` if you want to change the port address then modify the following pages.
* cms/application/config/config.php `change ['base_url] value`
* cms/application/config/constants.php `change define(API_URI) value`
* website/src/app/providers/api.service.ts `change HOST value and compile the production build again using angular-cli`

##### PLEASE NOTE : 
Frontend Website is made such a way that if you want to set the host address of API then add baseurl query parameter.
 
 ##### for ex: 
 `http://localhost:4200/?base_url=api.example.com`
 or
  `http://localhost:4200/?base_url=192.168.1.5:8888`

 The website will start sending API request to the specific host.
 
 ##### INSTALL NODE DEPENDENCIES:
 
`cd /website && npm install`


 ### DATABASE SETUP
 Import the `webuy.sql` file which is in /webuy to your local MySQL database 
 and change the connection config in
* webservice/src/constant.php `Modifiy the DB config array `

## Progressive Web App (PWA)
Frontend Website is made using Angular 5 Typescript with Material Design Bootstrap CSS v.4+ (using SASS).

PRPL strategy cannot be fully applied because of its time consuming task and performance modifications.

_Development Source Directory_ :
`website/src/`

_Production Source Directory_ :
`website/dist/`

**PLEASE NOTE :** 
_Service worker are only enabled in production server and will not available in development._

### EXPERIENCE PWA IN LIVE SERVER

    https://mynaukridemo.firebaseapp.com/
    OR
    https://mynaukridemo.firebaseapp.com/?base_url=YOUR_LOCAL_IP:PORT

 
 