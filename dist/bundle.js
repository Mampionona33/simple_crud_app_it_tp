/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/handleCheckAll.js":
/*!*******************************!*\
  !*** ./src/handleCheckAll.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"handleCheckAll\": () => (/* binding */ handleCheckAll)\n/* harmony export */ });\nvar handleCheckAll = function handleCheckAll() {\n  var checkboxAll = document.getElementById(\"selected_ids\");\n  checkboxAll && checkboxAll.addEventListener(\"change\", function (event) {\n    var isChecked = event.target.checked;\n    var checkboxes = document.querySelectorAll('input[name=\"deleted_ids[]\"]');\n    for (var i = 0; i < checkboxes.length; i++) {\n      if (checkboxes[i].type === \"checkbox\") {\n        checkboxes[i].checked = isChecked;\n      }\n    }\n  });\n};\n\n//# sourceURL=webpack://my-webpack-project/./src/handleCheckAll.js?");

/***/ }),

/***/ "./src/handleClickDeleteOne.js":
/*!*************************************!*\
  !*** ./src/handleClickDeleteOne.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"handleClickDeleteOne\": () => (/* binding */ handleClickDeleteOne)\n/* harmony export */ });\nvar handleClickDeleteOne = function handleClickDeleteOne() {\n  var delete_one = document.getElementsByName(\"delete_one\");\n  var tableForm = document.getElementById(\"tableForm\");\n  if (delete_one.length > 0) {\n    delete_one.forEach(function (element) {\n      var btnId = element.getAttribute(\"id\");\n      var clickedButton = document.getElementById(btnId);\n      clickedButton.addEventListener(\"click\", function (ev) {\n        ev.preventDefault(); // Annuler le comportement par défaut du bouton submit\n        var confirmDelete = confirm(\"\\xCAtes-vous s\\xFBr de vouloir supprimer \".concat(clickedButton.dataset.user, \" ?\"));\n        if (confirmDelete) {\n          var hidenInput = document.createElement(\"input\");\n          var userId = clickedButton.dataset.id;\n          hidenInput.setAttribute(\"type\", \"hidden\");\n          hidenInput.setAttribute(\"name\", \"delete_user_id\");\n          hidenInput.setAttribute(\"value\", userId);\n          tableForm.appendChild(hidenInput);\n          tableForm.submit();\n          tableForm.remove(hidenInput);\n        }\n      });\n    });\n  }\n};\n\n//# sourceURL=webpack://my-webpack-project/./src/handleClickDeleteOne.js?");

/***/ }),

/***/ "./src/handleClickDeleteSelected.js":
/*!******************************************!*\
  !*** ./src/handleClickDeleteSelected.js ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"handleClickDeleteSelected\": () => (/* binding */ handleClickDeleteSelected)\n/* harmony export */ });\nvar handleClickDeleteSelected = function handleClickDeleteSelected() {\n  var delete_selected = document.getElementById(\"delete_selected\");\n  var deleted_ids = document.querySelectorAll('input[name=\"deleted_ids[]\"]');\n  var tableForm = document.getElementById(\"tableForm\");\n  delete_selected && delete_selected.addEventListener(\"click\", function (ev) {\n    var listSelectedId = [];\n    deleted_ids.forEach(function (element) {\n      var checkedElement = element.checked;\n      if (checkedElement) {\n        listSelectedId.push(element.value);\n      }\n    });\n    if (listSelectedId.length > 0) {\n      var confirmDelete = confirm(\"Êtes-vous sûr de vouloir supprimer ces éléments ?\");\n      if (confirmDelete) {\n        // Suppression des champs cachés ajoutés\n        document.querySelectorAll('input[name=\"delete_id\"]').forEach(function (input) {\n          return input.remove();\n        });\n        // Soumission du formulaire\n        tableForm.submit();\n      }\n    } else {\n      alert(\"Veuillez sélectionner au moins un élément à supprimer.\");\n    }\n  });\n};\n\n//# sourceURL=webpack://my-webpack-project/./src/handleClickDeleteSelected.js?");

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _handleClickDeleteSelected__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handleClickDeleteSelected */ \"./src/handleClickDeleteSelected.js\");\n/* harmony import */ var _handleCheckAll__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./handleCheckAll */ \"./src/handleCheckAll.js\");\n/* harmony import */ var _handleClickDeleteOne__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./handleClickDeleteOne */ \"./src/handleClickDeleteOne.js\");\nconsole.log(\"bundle loaded!!\");\n\n\n\n(0,_handleClickDeleteSelected__WEBPACK_IMPORTED_MODULE_0__.handleClickDeleteSelected)();\n(0,_handleCheckAll__WEBPACK_IMPORTED_MODULE_1__.handleCheckAll)();\n(0,_handleClickDeleteOne__WEBPACK_IMPORTED_MODULE_2__.handleClickDeleteOne)();\n\n//# sourceURL=webpack://my-webpack-project/./src/index.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./src/index.js");
/******/ 	
/******/ })()
;