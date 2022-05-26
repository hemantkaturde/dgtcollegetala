<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = "web";
$route['404_override'] = 'login/error';

/*********** USER DEFINED ROUTES *******************/
$route['Login'] = 'login';
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';

$route['banner'] = 'admin/banner';
$route['addBanner'] = 'admin/addBanner';
$route['addNewBanner'] = 'admin/addNewBanner';
$route['editBanner/(:num)'] = "admin/editBanner/$1";
$route['updateBanner'] = "admin/updateBanner";

$route['events'] = 'admin/events';
$route['addEvents'] = 'admin/addEvents';
$route['addNewEvents'] = 'admin/addNewEvents';
$route['editEvents/(:num)'] = "admin/editEvents/$1";
$route['updateEvents'] = "admin/updateEvents";

/*********** ADMIN CONTROLLER ROUTES *******************/
$route['noaccess'] = 'login/noaccess';
$route['userListing'] = 'admin/userListing';
$route['userListing/(:num)'] = "admin/userListing/$1";
$route['addNew'] = "admin/addNew";
$route['addNewUser'] = "admin/addNewUser";
$route['editOld'] = "admin/editOld";
$route['editOld/(:num)'] = "admin/editOld/$1";
$route['editUser'] = "admin/editUser";
$route['deleteUser'] = "admin/deleteUser";
$route['log-history'] = "admin/logHistory";
$route['log-history-backup'] = "admin/logHistoryBackup";
$route['log-history/(:num)'] = "admin/logHistorysingle/$1";
$route['log-history/(:num)/(:num)'] = "admin/logHistorysingle/$1/$2";
$route['backupLogTable'] = "admin/backupLogTable";
$route['backupLogTableDelete'] = "admin/backupLogTableDelete";
$route['log-history-upload'] = "admin/logHistoryUpload";
$route['logHistoryUploadFile'] = "admin/logHistoryUploadFile";
$route['addDocuments'] = "admin/addDocuments";
$route['deleteDocument'] = "admin/deleteDocument";

// ====
$route['sendEmail/(:num)'] = "admin/sendEmail/$1";
$route['addCompany'] = "admin/addCompany";
$route['addNewCompany'] = "admin/addNewCompany";
$route['companyListing'] = "admin/companyListing";
$route['editcompany/(:num)'] = "admin/editcompany/$1";
$route['editCompUser'] = "admin/editCompUser";
$route['attachmentcompany/(:num)'] = "admin/attachmentcompany/$1";


$route['vendorListing'] = "admin/vendorListing";
$route['addVendor'] = "admin/addVendor";
$route['addNewVendor'] = "admin/addNewVendor";
$route['deleteVendor'] = "admin/deleteVendor";
$route['editVendor/(:num)'] = "admin/editVendor/$1";
$route['editVendorRecord'] = "admin/editVendorRecord";
$route['vendorView/(:num)'] = "admin/vendorView/$1";

/*********** USER CONTROLLER ROUTES *******************/
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['endTask/(:num)'] = "user/endTask/$1";
$route['etasks'] = "user/etasks";
$route['userEdit'] = "user/loadUserEdit";
$route['updateUser'] = "user/updateUser";


/*********** LOGIN CONTROLLER ROUTES *******************/
$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";



/*********** ROLE CONTROLLER ROUTES *******************/
$route['roleListing'] = "role/roleListing";
$route['addRole'] = "role/addRole";
$route['addNewRole'] = "role/addNewRole";
$route['editRole/(:num)'] = "role/editRole/$1";
$route['editRoleRecord'] = "role/editRoleRecord";
$route['deleteRole'] = "role/deleteRole";

/* End of file routes.php */
/* Location: ./application/config/routes.php */