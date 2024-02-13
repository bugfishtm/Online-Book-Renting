# CAPTCHA Files

DO NOT CHANGE FILES IN THAT FOLDER, THEY MAY GET OVERWRITTEN DURING CORE UPDATES!

This directory contains CAPTCHA PHP files designed for inclusion in projects. These CAPTCHAs can be displayed using an HTML image tag, and the session key with the code is `_HIVE_SITE_COOKIE_."captcha.XXXX"`.

**Usage:**
- Include the CAPTCHA PHP files in your project to enable CAPTCHA functionality.
- Display the CAPTCHA image using an HTML image tag with the appropriate source.

**Integration:**
- Ensure that session handling is appropriately configured in your project.
- Use the session key `_HIVE_SITE_COOKIE_."captcha.XXXX"` to associate CAPTCHA codes with user sessions.

**Important Notes:**
- Securely handle session keys to prevent abuse.
- Customize the CAPTCHA appearance or complexity based on project requirements.

**Caution:**
- Regularly update and review the CAPTCHA implementation for security enhancements.
- Implement server-side validation to verify CAPTCHA input.