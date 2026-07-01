<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/core/db.php");

$conn = $link;

if (!$link) {
    die("DB error: " . mysqli_connect_error());
}

session_start();

/* =========================
   SESSION SAFE
========================= */
$_USERID = $_SESSION["id"] ?? null;
$isloggedin = ($_SESSION["loggedin"] ?? false) ? "yes" : "no";

/* =========================
   GLOBAL
========================= */
$_GLOBALQ = mysqli_query($link, "SELECT * FROM global WHERE id='1'");
$_GLOBAL = mysqli_fetch_assoc($_GLOBALQ);

/* =========================
   USER LOAD SAFE
========================= */
$_USER = [];

if ($_USERID) {
    $_USERQ = mysqli_query($link, "SELECT * FROM users WHERE id='$_USERID'");
    $_USER = mysqli_fetch_assoc($_USERQ) ?? [];
}

/* =========================
   IP UPDATE SAFE
========================= */
$iphash = $_SERVER["REMOTE_ADDR"] ?? "0.0.0.0";

if ($_USERID) {
    mysqli_query($link, "UPDATE users SET ip='$iphash' WHERE id='$_USERID'");
}

/* =========================
   REMOVE BUG QUERY (ESTO TE ROMPÍA TODO)
========================= */
// ❌ MAL: readto
// ✔ CORRECTO: readed

$unreadmsg = 0;
if ($_USERID) {
    $unreadq = mysqli_query($conn, "SELECT * FROM messages WHERE readed='0' AND receiver_id='{$_USER['id']}'");
    $unreadmsg = mysqli_num_rows($unreadq);
}

/* =========================
   BAN CHECK
========================= */
$ipbansresult = mysqli_query($link, "SELECT * FROM ip_bans WHERE ip='$iphash'");
$ipbansresultCheck = mysqli_num_rows($ipbansresult);

/* =========================
   SETTINGS
========================= */
$sitename = "NOUNBLOX";
$motto = "an good nostalgia";
$company = "Virtue Development";

$traileryt = "mcGeBAkEwKc";

$clientdownloadlink = "/client/nounbloxinstaller.exe";

$site_email = "superwingmaster@gmail.com";
$discord = "7N5BRVZb66";
$twitter = "NOUNBLOX";
$reddit = "NOUNBLOX";
$youtube = "NOUNBLOX";

error_reporting(0);
?>
