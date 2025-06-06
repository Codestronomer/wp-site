/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/view/woo-account-dashboard.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/view/woo-account-dashboard.js":
/*!**********************************************!*\
  !*** ./src/js/view/woo-account-dashboard.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var WooAccountDashboardHandler = function WooAccountDashboardHandler($scope, $) {\n  var $wooAccountDashboardWrapper = $(\".eael-account-dashboard-wrapper\", $scope);\n  var wrap = $('.eael-account-dashboard-wrap', $scope);\n  var icons = wrap.data('eawct-icons');\n  if (wrap.hasClass('eawct-has-custom-tab') && icons) {\n    icons = JSON.parse(atob(icons));\n    if (icons) {\n      $.each(icons, function (index, icon) {\n        if (icon) {\n          $('.eael-custom-tab-' + index).removeClass('eael-wcd-icon').find('a').prepend(icon);\n        }\n      });\n    }\n  }\n  if (elementorFrontend.isEditMode()) {\n    $('.eael-account-dashboard-navbar li, .woocommerce-orders-table__cell-order-actions .view', $scope).on('click', function () {\n      var woo_nav_class = 'woocommerce-MyAccount-navigation-link';\n      var classes = $(this).attr('class').split(' ');\n      var target = '';\n      if (classes.length) {\n        classes.forEach(function (className) {\n          if (className.includes(woo_nav_class + '--')) {\n            target = className.replace(woo_nav_class + '--', '');\n          }\n        });\n      }\n      var $this_attr_class = $(this).attr('class');\n      if ($this_attr_class.includes('woocommerce-button') && $this_attr_class.includes('view')) {\n        target = 'view-order';\n      }\n      $(\".eael-account-dashboard-body .\".concat(woo_nav_class), $scope).removeClass('is-active');\n      $(\".eael-account-dashboard-body .\".concat(woo_nav_class, \"--\").concat(target), $scope).addClass('is-active');\n      $('.eael-account-dashboard-body .tab-content', $scope).removeClass('active');\n      $(\".eael-account-dashboard-body .tab-\".concat(target), $scope).addClass('active');\n      var pageHeading = target[0].toUpperCase() + target.substring(1);\n      $(\".eael-account-dashboard-header h3\", $scope).html(pageHeading);\n    });\n  }\n\n  // Oceanwp, Travel Ocean \n  if ($('body').hasClass('theme-oceanwp')) {\n    var navBar = $('.eael-account-dashboard-navbar .woocommerce-MyAccount-navigation');\n    $('.eael-account-dashboard-navbar .woocommerce-MyAccount-tabs').remove();\n    $('.eael-account-dashboard-navbar').append(navBar);\n  }\n};\neael.hooks.addAction(\"init\", \"ea\", function () {\n  if (eael.elementStatusCheck('eaelAccountDashboard')) {\n    return false;\n  }\n  elementorFrontend.hooks.addAction(\"frontend/element_ready/eael-woo-account-dashboard.default\", WooAccountDashboardHandler);\n});\n\n//# sourceURL=webpack:///./src/js/view/woo-account-dashboard.js?");

/***/ })

/******/ });