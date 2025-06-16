![Bugfish](https://img.shields.io/badge/Bugfish-jQuery-orange)
![Status](https://img.shields.io/badge/Status-Finished-green)
![License](https://img.shields.io/badge/License-GPLv3-black)
![Version](https://img.shields.io/badge/Version-1.0-white)
# Bugfish Sortselect (jquery selectbox plugin)

Repository:  https://github.com/bugfishtm/bugfish-jquery-sortselect   
Documentation: https://bugfishtm.github.io/bugfish-jquery-sortselect/  
The documentation is available in this repositories "docs" folder!

The "multiselect-sortable" jQuery plugin enhances the functionality of multiple select elements by allowing you to easily sort and manage selected options in a dual list box. This revised version of the plugin now includes a "rid" (Resource Identifier) parameter, which helps in distinguishing between different instances of the script when used on the same webpage. Failure to provide a unique "rid" value for each instance can result in errors or unexpected behavior.

Screenshot:  
![Demo Image](./docs/demo.png)

Load the necessary jQuery libraries:

	<script src="/path/to/cdn/jquery.min.js"></script>
	<script src="/path/to/cdn/jquery-ui.min.js"></script>

Load the multiselect-sortable plugin's JavaScript and CSS files:

	<script src="assets/js/jquery.multiselect.sortable.js"></script>
	<link rel="stylesheet" href="assets/css/jquery.multiselect.sortable.js.css" />

Add the "multiselectsortable" class to your multiple select element and define pre-selected options using the "selected" attribute. Ensure you provide a unique "rid" value for each instance:
	
	<select name="multiselectsortable" class="multiselectsortable demo multiselectsortable-1" multiple data-rid="instance-1">
	</select>
	 
	<select name="multiselectsortable" class="multiselectsortable demo multiselectsortable-2" multiple data-rid="instance-2">
	</select>

	<select name="multiselectsortable" class="multiselectsortable demo multiselectsortable-3" multiple data-rid="instance-3">
	</select>

Call the function on the select element to activate the plugin, ensuring you pass the "rid" parameter for each instance:

	 jQuery(function($){
	   // Example 1
	   $('.multiselectsortable-1').bugfish_sortselect({
	    rid: 'instance-1'
	   });
	 });
	
	
	 jQuery(function($){
	   // Example 2
	   $('.multiselectsortable-2').bugfish_sortselect({
	    rid: 'instance-2'
	   });
	 });
	
	
	jQuery(function($){
	  // Example 3
	  $('.multiselectsortable-3').bugfish_sortselect({
	   rid: 'instance-3'
	 });
	});



## Folder Description

|Folder|Description|
|-|-|
|_release|Release Packages|
|_source| The plugins source code + example file!|
|docs|Files for the Github Repositories Pages and Documentations, view the Documentation by viewing the index.html file in your browser!|

## jQuery and jQuery-UI Included for Convenience

In this repository, both jQuery and jQuery-UI are included to showcase the functionality of the repository's related jQuery plugin. We have included these libraries to make it easier for developers who use this product to implement it quickly. By providing jQuery and jQuery-UI JavaScript files, we aim to streamline the development process and ensure that developers have the necessary resources readily available to harness the full potential of this repository's features. This convenience is intended to simplify integration and help developers get up and running with the provided plugin more efficiently.

## Support and Assistance

If you encounter any issues or require assistance, please visit www.forum.bugfish.eu for additional resources. You can also contact us at request@bugfish.eu, and we will do our best to assist you.

## License Information

The license details for this Bugfish-jQuery-Sortselect project can be found in the "license.md" file within the project repository. Please review this file to understand the terms and conditions of use and distribution. It is essential to comply with the project's license to ensure legal and ethical usage of the provided resources.