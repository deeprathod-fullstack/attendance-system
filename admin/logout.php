<?php
require __DIR__ . '/../includes/bootstrap.php';

logout_user();

// Start a fresh session only to carry the confirmation message.
session_start();
flash('success', 'You have been logged out.');
redirect(url('login.php'));
