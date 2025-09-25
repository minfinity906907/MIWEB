Mohan Infinity - HTML + PHP static site
--------------------------------------

Files:
- index.html          : Main site (uses Tailwind CDN)
- contact.php         : Handles contact form and sends email via PHP mail()
- assets/             : logo.svg and brochure PDF placeholder
- .htaccess           : optional webserver config

Installation / Deploy:
1. Upload all files to your PHP-enabled server (Apache, cPanel, etc.)
2. Ensure PHP is enabled; contact.php requires PHP 7+.
3. For mail() to work, hosting must have mail enabled. If not, replace the mail() call with an SMTP library like PHPMailer and configure SMTP credentials.
4. Replace assets/MohanInfinity_Brochure.pdf with your actual brochure.

Security notes:
- Form inputs are minimally sanitized; for production, consider adding CAPTCHA, better validation, and using an SMTP server with authentication.

