<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//Custom Constants
define('SUPERADMIN_USER_ID', 1);
define('IS_STAFF', 1);
define('IS_NOT_STAFF', 0);


//Date Formats
define('DEFAULT_SQL_DATE_FORMAT', 'Y-m-d H:i:s');
define('DEFAULT_DATE_FORMAT', 'd-m-Y');
define('DEFAULT_DATE_FORMAT_MONTH', 'd-M-Y');
define('DEFAULT_APP_DATE_FORMAT', 'dd-MM-yyyy');
define('DEFAULT_DATETIME_FORMAT', 'd-m-Y h:i:s A');
define('DEFAULT_SQL_TIME_FORMAT', 'H:i:s');
define('DEFAULT_SQL_ONLY_DATE_FORMAT', 'Y-m-d');
define('DEFAULT_API_TIME_FORMAT', 'H:i:s');
define('DEFAULT_PRINT_TIME_FORMAT', 'h:i A');
define('DEFAULT_SQL_DATE_FORMAT_FIRST_DATE', 'Y-m-01');
define('DEFAULT_SQL_DATE_FORMAT_LAST_DATE', 'Y-m-t');
define('DEFAULT_DATEPICKER_DATE_FORMAT', 'dd-mm-yyyy');
define('VIEW_DATETIME_FORMAT', 'd M Y h:i A');
define('VIEW_DATE_FORMAT', 'd M, Y');
define('MILITARY_TIME_FORMAT', 'H:i');
define('REGULAR_TIME_FORMAT', 'h:i A');
define('SQL_ADDED_DATE', date(DEFAULT_SQL_DATE_FORMAT));
define('UTC_DATE_TIME', date( DEFAULT_SQL_DATE_FORMAT,strtotime("-5 hours",strtotime("-30 minutes")) )  );//UTC 
define('UTC_TIME', date( DEFAULT_SQL_TIME_FORMAT,strtotime(UTC_DATE_TIME) )  );//UTC 

// for superadmin global format
define('DEFAULT_TIME_FORMAT', 'H:i');
define('DEFAULT_MAX_BOOK_DATE', 30);

// For Time Difference
define('YEAR', 'y');
define('MONTH', 'm');
define('DAY', 'd');
define('HOUR', 'h');
define('MINUTE', 'i');
define('SECOND', 's');

// DINEIN REQUEST
define('FLAG_SUCCESS',1);
define('FLAG_ERROR',0);


//Images Path
define('BASE_ASSETS_PATH', 'assets/');
define('BASE_MEDIA_PATH', 'assets/media/');
define('BASE_IMAGE_PATH', BASE_MEDIA_PATH.'images/');

define('BASE_SUPERADMIN_CSS_PATH', 	'assets/superadmin/css/');
define('BASE_SUPERADMIN_JS_PATH', 'assets/superadmin/js/');

define('BASE_WEB_CSS_PATH','assets/web/css/');
define('BASE_WEB_JS_PATH', 'assets/web/js/');
define('BASE_WEB_IMAGES_PATH', 'assets/web/images/');

define('API_BASE_URL','http://localhost:3000/');
define('BASE_USER_IMAGE_PATH', BASE_MEDIA_PATH."uploads/users/");
define('BASE_LISTING_LOGO_PATH', BASE_MEDIA_PATH."uploads/listing/logo/");
define('BASE_LISTING_COVER_IMAGE_PATH', BASE_MEDIA_PATH."uploads/listing/cover_image/");

define('BASE_DRAFT_LISTING_LOGO_PATH', BASE_MEDIA_PATH."uploads/listing/draft/logo/");
define('BASE_DRAFT_LISTING_COVER_IMAGE_PATH', BASE_MEDIA_PATH."uploads/listing/draft/cover_image/");

define('BASE_LISTING_TYPE_IMAGE_PATH', BASE_MEDIA_PATH."uploads/listing_types/");
define('BASE_AMENITIES_IMAGE_PATH', BASE_MEDIA_PATH."uploads/amenities/");
define('BASE_CLAIM_LISTING_PERSONAL_DOCUMENTS_IMAGE_PATH', BASE_MEDIA_PATH."uploads/listing/claim_institute/personal_document/");
define('BASE_CLAIM_LISTING_LEGAL_DOCUMENTS_IMAGE_PATH', BASE_MEDIA_PATH."uploads/listing/claim_institute/legal_document/");
define('USER_IMAGE_PATH','uploads/users/');
define('USERS_IMG_PATH','uploads/users/');
define('BASE_PAGES_IMAGES_PATH',BASE_MEDIA_PATH."uploads/pages/");
define('BASE_BANNER_IMAGES_PATH',BASE_MEDIA_PATH."uploads/banners/");
define('BASE_WEB_FONTS_PATH',"assets/web/fonts/");


///db actions
define('ACTION_INSERT', 'insert');
define('ACTION_UPDATE', 'update');
define('ACTION_DELETE', 'delete');


define('IMAGE_UPLOAD_TYPES', 'jpg|png|jpeg');
define('IMAGE_ACCEPT_UPLOAD_TYPES', '.png, .jpg, .jpeg');
define('IMAGE_UPLOAD_TYPES_JPEG_PNG', 'jpg|png|jpeg');
define('IMAGE_UPLOAD_TYPES_JPEG', 'jpg|png|jpeg');
define('UPLOAD_TYPES_IMG_DOC', 'jpg|png|jpeg|pdf|doc');
define('MAX_FILE_UPLOAD_RESTAURANT_GALLERY_IMG', 15);
define('MAX_FILE_UPLOAD_SIZE', '8');

//Emails
define('VERFICATION_PROCESS_COMPLETED', '1');
define('VERFICATION_PROCESS_UNCOMPLETED', '0');

define('FEATURE_TYPE_CHECKBOX',1);
define('FEATURE_TYPE_RADIO',2);
define('FEATURE_TYPE_DROPDOWN',3);
define('FEATURE_TYPE_INPUT',4);
define('FEATURE_TYPE_TEXT',5);

// Status
define('INACTIVE',0);
define('ACTIVE',1);

/****wallet****/
define('DELETED', 1);
define('NOT_DELETED', 0);


define('SUPERADMIN','superadmin');
define('MODULE_NAME_WEB','web');
define('MODULE_NAME_API','api');
define('DEFAULT_LANGUAUGE_ID','1');

/**********user groups************/
define('SUPERADMIN_GROUP_ID', 1);
define('PRIMADMIN_GROUP_ID', 2);
define('EMPLOYEE_GROUP_ID', 3);
define('CUSTOMER_GROUP_ID', 4);
define('GUEST_GROUP_ID',6);
define('LISTING_ADMIN_GROUP_ID',7);
define('LISTING_EDITOR_GROUP_ID',8);
define('LISTING_VIWER_GROUP_ID',9);
/**********user groups************/

/*dashboard login*/
define('BLOCK_AFTER_REQUEST',3);
define('MAX_SESSION_LIMIT',1);
/*dashboard login*/

/*platforms*/
define('LOGIN_FROM_WEB',1);
/*platforms*/

/*followup*/

define('FOLLOWUP_TYPE_CALL',1);
define('FOLLOWUP_TYPE_VISIT',2);
define('FOLLOWUP_STATUS_PENDING',0);
define('FOLLOWUP_STATUS_COMPLETE',1);
define('FOLLOWUP_STATUS_CANCEL',2);
/*followup*/

//pagging
define('DEFAULT_RECORDS_PAGELIMIT',25);
define('DEFAULT_WEB_RECORDS_PAGELIMIT',15);
define('PASSWORD_MIN_LENGTH',8);

define("CLASSHUD_SITE_URL","https://www.classhud.com");
define("SITE_NAME","ClassHud");

define('CART_FROM_WEB',1);
define('CART_FROM_APP',2);
define('CART_FROM_ADMIN',3);
define('CART_FROM_POS',4);

define('MENU_SHOW',1);
define('MENU_HIDE',0);

define('unique_notification_id',uniqid());

define('OPTIONS_FOR_ORGNIZATION',1);

define('OPTIONS_TYPES_RADIO',1);
define('OPTIONS_TYPES_CHECKBOX',2);
define('OPTIONS_TYPES_INPUT',3);
define('OPTIONS_TYPES_TEXT',4);
define('OPTIONS_TYPES_DROP_DOWN',5);

define('EMAIL_VERIFIED',1);
define('EMAIL_UNVERIFIED',0);

define('PHONE_NO_VERIFIED',1);
define('PHONE_NO_UNVERIFIED',0);

define('PRIMERY_GROUP',1);
define('NOT_PRIMERY_GROUP',0);

define('IS_SUPERADMIN',1);
define('IS_NOT_SUPERADMIN',0);

define("OTP_TYPE_REGISTER_OTP",1);
define("OTP_TYPE_LOGIN_OTP",2);
define("OTP_TYPE_LISTING_CLAIM_OTP",3);

define("OTP_SEND_TYPE_OTP",1);
define("OTP_SEND_TYPE_EMAIL",2);

define("OTP_USE_STATUS_USED",1);
define("OTP_USE_STATUS_UNUSED",0);

define("ACCOUNT_VERIFIED_TYPE_UNVERIFIED",0);
define("ACCOUNT_VERIFIED_TYPE_PHONE",1);
define("ACCOUNT_VERIFIED_TYPE_EMAIL",2);

define("PHONE_TYPE_PHONE",1);
define("PHONE_TYPE_WHATSAPP",2);


//define("GOOGLE_LOCATION_API_KEY","AIzaSyDerfbDilQmRkFz10fM8jvIY1-7YIz-ICM");
define("GOOGLE_LOCATION_API_KEY","AIzaSyDTUFYe2IPKKJ4l7S1RO1tG7fh4v3kiDJ8");
define('GOOGLEAPI_MAP_URL','https://maps.googleapis.com/maps/api/geocode/json?key='.GOOGLE_LOCATION_API_KEY);


define("LISTING_REQUEST_STATUS_REQUESTED",1);
define("LISTING_REQUEST_STATUS_APPROVED",2);
define("LISTING_REQUEST_STATUS_DISAPPROVED",0);

define("DAY_TYPE_NORMAl",1);
define("MAX_ADD_EMAIL",5);
define("MAX_ADD_PHONE_NO",5);

define("PASSWORD_SET",1);
define("HOMEPAGE_RECORDS_PAGELIMIT",6);
define("IS_LISTING_OPEN",1);
define("IS_LISTING_CLOSED",0);

define("COMPANY_PUBLIC_EMAIL","help@classhud.com");
define("COMPANY_PUBLIC_MOBILE_NO","+91 70531-80531");

define("ENQUIRY_TYPE_CONTACT_US","1");
define("PHONE_MIN_LENGTH",10);
define("PHONE_MAX_LENGTH",10);

define("LISTING_IS_CLAIMABLE",1);
define("LISTING_IS_UNCLAIMABLE",0);

define("LISTING_IS_CLAIMED",1);
define("LISTING_IS_UNCLAIMED",0);

define("LISTING_CLAIM_REQUEST_PENDING",0);
define("LISTING_CLAIM_REQUEST_REQUESTED",1);
define("LISTING_CLAIM_REQUEST_APPROVED",2);
define("LISTING_CLAIM_REQUEST_REJECT",3);

define("PAGE_TYPES_BLOG","1");

define("PAGE_CATEGORIES_TYPES_BLOG","1");

define("REVIEW_TYPES_BLOG","1");
define("REVIEW_TYPES_LISTING","2");

define("REVIEW_CATEGORIES_TYPES_BLOG","1");
define("REVIEW_CATEGORIES_TYPES_LISTING","2");

define("TAGS_TYPES_BLOG","1");
define("TAGS_TYPES_LISTING","2");

define("REVIEW_STATUS_PENDING","0");
define("REVIEW_STATUS_APPROVE","1");
define("REVIEW_STATUS_DISAPPROVE","2");

define("GENDER_MALE",1);
define("GENDER_FEMALE",2);

define('PAYMENT_MODE_CASH',1);//for offline payment through app/web and  admin
define('PAYMENT_MODE_PIN',2);//for only payment through app/web
define('PAYMENT_MODE_ONLINE',3);// for offline payment through app/web and  admin
define('PAYMENT_MODE_CHEQUE',4);// for offline payment through app/web and  admin

define('DEFAULT_CURRENCY_SEPERATOR', '.');
define('CURRENCY_SYMBOL', '₹');

define('CART_ITEM_STATUS_PENDING', '0');
define('CART_ITEM_STATUS_ORDERED', '1');


define("ORDER_STATUS_PENDING",0);
define("ORDER_STATUS_CONFIRMED",1);
define("DEFAUILT_ORDER_STATUS",ORDER_STATUS_PENDING);

define('PAYMENT_STATUS_PENDING', '0');
define('PAYMENT_STATUS_DONE', '1');
define('PAYMENT_STATUS_PARTIAL_PENDING', '2');

define('ORDER_SPLIT_TYPE_PERSONS', 'persons');
define('ORDER_SPLIT_TYPE_ITEMS', 'items');

define('BANNER_CATEGORY_TYPE_LISTING', '1');

define('PRODUCT_TYPE_FULL_SUBSCRIPTION', '1');
define('PRODUCT_TYPE_PACKAGE_SUBSCRIPTION', '2');

define('PRODUCT_PACKAGE_TYPE_BANNER', '1');
define('PRODUCT_PACKAGE_TYPE_ECARD', '2');
define('PRODUCT_PACKAGE_TYPE_CERTIFICATE', '3');

define('LISTING_LOGO_POSITION_TOP_LEFT', '1');
define('LISTING_LOGO_POSITION_TOP_CENTER', '2');
define('LISTING_LOGO_POSITION_TOP_RIGHT', '3');

define("ENQUIRY_STATUS_PENDING","1");
define("ENQUIRY_STATUS_SOLVED","2");
define("ENQUIRY_STATUS_REJECTED","0");
