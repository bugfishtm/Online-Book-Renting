# Error Pages

DO NOT CHANGE FILES IN THAT FOLDER, THEY MAY GET OVERWRITTEN DURING CORE UPDATES!

This directory contains custom error pages for the website, including the essential 404 and 503 pages.

**Pages:**
- `error.404.php`: Page displayed when a resource is not found (404 error).
- `error.503.php`: Page shown during temporary server unavailability (503 error).

**Custom Error Handling:**
- Other error pages are dynamically called through PHP functions.
- Ensure that PHP functions are appropriately configured for error handling.

**Important Notes:**
- Check server logs for insights into recurring errors.

**Caution:**
- Avoid excessive details on error pages for security reasons.
- Keep error pages concise and user-friendly.

By maintaining effective error pages, you can enhance the user experience and provide helpful information in case of unexpected issues.
