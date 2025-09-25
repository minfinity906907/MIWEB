<?php
// contact.php - simple mail handler using PHP mail()
// IMPORTANT: Ensure your hosting enables PHP mail() or replace with SMTP solution.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic sanitization
    $name = strip_tags(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $company = strip_tags(trim($_POST['company'] ?? ''));
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please provide a valid email address.';
    } else {
        $to = 'info@mohaninfinity.com';
        $subject = 'Website enquiry from ' . $name;
        $body = "Name: $name\n"
              . "Email: $email\n"
              . "Company: $company\n\n"
              . "Message:\n$message\n";
        $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n" .
                   'Reply-To: ' . $email . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        // send mail
        if (mail($to, $subject, $body, $headers)) {
            $success = 'Thank you! Your message has been sent.';
        } else {
            $error = 'There was a problem sending your message. Please try again later.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact — Mohan Infinity</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased text-gray-900 bg-gray-50">
  <div class="max-w-3xl mx-auto p-6">
    <?php if (!empty($error)): ?>
      <div class="bg-red-100 text-red-800 p-4 rounded mb-4"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="bg-green-100 text-green-800 p-4 rounded mb-4"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <a href="index.html" class="inline-block mb-4 text-indigo-600 underline">← Back to home</a>

    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-xl font-semibold mb-4">Send a message</h2>
      <form method="post" action="contact.php" class="grid gap-3">
        <input name="name" placeholder="Your name" required class="w-full border border-gray-200 rounded-md px-3 py-2" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" />
        <input name="email" type="email" placeholder="Email" required class="w-full border border-gray-200 rounded-md px-3 py-2" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" />
        <input name="company" placeholder="Company (optional)" class="w-full border border-gray-200 rounded-md px-3 py-2" value="<?php echo isset($company) ? htmlspecialchars($company) : ''; ?>" />
        <textarea name="message" placeholder="How can we help?" rows="6" required class="w-full border border-gray-200 rounded-md px-3 py-2"><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
        <div class="flex items-center gap-3">
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Send</button>
          <a href="index.html" class="text-sm text-gray-500">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
