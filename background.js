var data_to_use= window.location.href;
var data_to_use_parse = data_to_use.substring(data_to_use.indexOf('ticketId=') +9,data_to_use.indexOf('ticketId=') +15);
$(".contact").append('</br><span class=\"kiwidget\"></span></br>');
$(".kiwidget").load("https://www.YOURSITE.com/backend_autoask_email_resolver_chrome.php?id="+data_to_use_parse);