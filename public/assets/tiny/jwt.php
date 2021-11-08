<?php
use Firebase\JWT\JWT;
require_once './jwt/JWT.php';

$vusuario = $_SESSION['scodtipo'];
$vnombre =$_SESSION['scodigo'];

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDTYKU8U90URrRe
5YbiPoQQqYAD70pgK+Jjo8+bILV8y7jlBXzRWQN9wcLkcgQAWFNQMwaYxc7P1gbS
16ABxbpBy42hwdLNtJCgN91iNO853ADPoOFDf+xntLa7ArdTUFyQx9rzc7I5D5j4
yU9XDdP6HwAC0QsGN+FE5UWrTv8j2jEwV5HeZb5kfX4HWTc4lll3fFMWRxxXtKoM
fM7r2RcwE6AQmmFBY1BhThSjMy+oLfY4433vMcemBDp3nfa0TBbBVoe8G6y71qwT
Rq1m45uoFZAEE45atJawSe0ID/hH+tdUz/ydt0iDu5pKleFq9DUIXjYPaiayapsA
7FSd8W4TAgMBAAECggEAUWaIe2D4ZFSOJXVSqlHU3e3IZLuD8uEzf5eX3W+NNI/n
lhq05JHY7FbvzLWzoMZi3yGnSrHyYMtVOWDcN5KDlc7jrgVMPvdoMqsQ0D7+WVPF
5C9aUHo0+gL307DKFIWAAClWwiYt3heJm1U6/pVOqqXBhVQnYK+oSrXYTI5RZuZu
G02q6DuzvbboDQ+1aUc6iXiSLni8LdTqbWF4bdnweW6MpPXT2WH/a/Lyx2pJMIfm
A4P71enCOVi2B1GSSsQJ9532IQaIXpyOnC0AC71O1UgMz81dXAsBgK02J6gyI/sh
C9j3qc83ku8OBP+gdzqYwMUve3NKlhDHZPS5aKsyUQKBgQD6wDn56SgFVp3VnFM6
wvPYVxhOsXLPXnPgkEwh8GMnwsnQ2OLS9JUZwWHt6/qEJj+9UC9zOuJsu7royESA
gCa3ST1xEyvW5VMFA1biEewPJqHIbpqSel+zFel9uKp4G8FG41WI3xgAJi8pPIM4
i2RR0cOxFvrtcgyPvfzCiW9JhwKBgQDXzWrNo1Y6y213KXA5RQArtjKu2pXUr+J4
hGhIsNy0il6Ktr+kYVEtX9pPyv2B3t+7YTpELZbIp+snXcJ9pUMgVwLGiXxJlU2I
/Vud4b5/Ed2TH5/XfNdRZhcW3vFcQ2Esj6UPPE+Kj1izT7RZ+A7NaU0U9c9C5Ous
DtFRt03qFQKBgDEBMFNvBatFakM88eciApXdL5rxgwaT5wGUMczQNhCnONngCTRB
KIKIEKN24tbAwuQ0r5FNiMLHTZgAy6JxaR+Y6LEYlhDBcKAiLvCvn/q2ChgpxXuq
/tj5B1DSrj4a7oL0GttM/lvJGp5sfRin5Us4O454d0HAcEQHVUaPpXgxAoGBAKN2
e9IsSSLb+JzsjI80zv5NUnLUK+4hFGDJmtyE64jtztMvvlZbSMwf8RPD5Oa81afv
69y805xGZX86LBpUVlZm0jlk5vot179OellLJ6rE85t/tunZLJgBxreSRCzo9PB2
FkdGHdIM5tlcJHaJyVyayMJ5t3cqQ8Her3tAaApJAoGAFbD3dPo2Qu9mrRfcniKM
ls3+PnnelsAmoRiC5ePmBjpAqzMSEUgWC7+cl2+lmM9rKgyWrj3cMPFLq2Fx6cc1
N7LO+26H94wVyxyDuTWNIDFetAGS7tGhZts3bgYWNZNUaZge0zwKdRnt3IgGueuB
MBlrT8HWVfL4/kyCIkkBPXk=
-----END PRIVATE KEY-----
EOD;

// NOTE: Before you proceed with the TOKEN, verify your users session or access.
$vusuario="code".$vusuario;
$vnombre= "code".$vnombre;
$payload = array(
  "sub" => $vusuario, // unique user id string
  "name" => $vnombre, // full name of user
  // Optional custom user root path
  // "https://claims.tiny.cloud/drive/root" => "/johndoe",

  "https://claims.tiny.cloud/drive/root" => "/$vusuario",

  "exp" => time() + 60 * 10 // 10 minute expiration
);

try {
  $token = JWT::encode($payload, $privateKey, 'RS256');
  http_response_code(200);
  header('Content-Type: application/json');
  echo json_encode(array("token" => $token));
} catch (Exception $e) {
  http_response_code(500);
  header('Content-Type: application/json');
  echo $e->getMessage();
}
?>
